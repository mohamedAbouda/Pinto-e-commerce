<?php

namespace App\Http\Controllers\Web;

use App\Models\DeliveryOption;
use App\Models\Order;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Anouar\Paypalpayment\Facades\PaypalPayment;
use PayPal\Exception\PayPalConnectionException;
use Cart;
use App\Mail\OrderInvoiceEmail;
use Mail;

require_once __DIR__ . '/../../../../vendor/autoload.php';

class CheckoutController extends Controller
{
    protected $payfortConfig;
    protected $_apiContext;
    private $orderObject;
    private $cart;

    public function doFirst()
    {
       
    }

    public function payRedirect(Request $request, $cart, $orderObject, $products)
    {
        $this->doFirst();
        //return $products;

        $this->orderObject = $orderObject;
        $this->cart = $cart;

        $visa = PaymentMethod::where(['name' => 'visa'])->first();
        $paypal = PaymentMethod::where(['name' => 'paypal'])->first();
        $cash = PaymentMethod::where(['name' => 'Cash on delivery'])->first();

        if ($request->payment_method_id == $cash->id) {
            Mail::to($this->orderObject->email)->send(new OrderInvoiceEmail($this->orderObject));
            Cart::destroy();
            session()->forget('cart.options');
            return redirect()->route('web.index')->with('success', 'Order sent successfully.');
        }

        session()->put('order' , $orderObject->id);

        if ($request->payment_method_id == $visa->id) {
            return $this->visaIndex();
        }

        if ($request->payment_method_id == $paypal->id) {
            return $this->paypalIndex($products);
        }

        return $request->all();
    }

    public function visaIndex()
    {
        $payfortConfig = $this->payfortConfig;
        $order = $this->orderObject;
        $payfortConfig['amount_in_cents'] = $order['price'] * 100;
        $payfortConfig['order_id'] = $order->id;

        $cart = $this->cart;
        return view('web.checkout.visa', compact('payfortConfig','cart','order'));
    }

    public function visaStore(Request $request)
    {
        $this->doFirst();
        # Read the fields that were automatically submitted by beautiful.js
        $token = $request['startToken'];
        $email = $request['startEmail'];

        # Setup the Start object with your private API key
        \Start::setApiKey($this->payfortConfig['api_keys']['secret_key']);

        # Process the charge
        try {
            $charge = \Start_Charge::create(array(
                "amount" => $this->payfortConfig['amount_in_cents'],
                "currency" => $this->payfortConfig['currency'],
                "card" => $token,
                "email" => $email,
                "ip" => $_SERVER["REMOTE_ADDR"],
                "description" => "Charge Description"
            ));

            // echo "<h1>Successfully charged 10.00 AED</h1>";
            // echo "<p>Charge ID: " . $charge["id"] . "</p>";
            // echo "<p>Charge State: " . $charge["state"] . "</p>";

            Transaction::create([
                'order_id' => $request['orderId'],
                'payment_method_id' => PaymentMethod::where('name', 'VISA')->first()->id,
                'token' => $token,
                'price' => Order::where('id', $request['orderId'])->first()->price,
            ]);
            $order_id = session()->get('order');
            $order = Order::where('id',$order_id)->first();
            if ($order) {
                Mail::to($order->email)->send(new OrderInvoiceEmail($order));
            }

            Cart::destroy();
            session()->forget('cart.options');
            session()->forget('order');

            return redirect()->route('web.index')->with('success', 'Order sent successfully.');

        } catch (\Start_Error $e) {
            $error_code = $e->getErrorCode();
            $error_message = $e->getMessage();

            /* depending on $error_code we can show different messages */
            if ($error_code === "card_declined") {
                echo "<h1>Charge was declined</h1>";
            } else {
                echo "<h1>Charge was not processed</h1>";
            }
            echo "<p>" . $error_message . "</p>";
            return redirect()->route('web.index')->withErrors(['msg' => $error_message]);
        }
    }

    public function paypalIndex($products)
    {
        // ### Payer
        $payer = Paypalpayment::payer();
        $payer->setPaymentMethod("paypal");

        $totalProductPrices = 0;
        $items = [];

        foreach ($products as $product) {
            $productObject = Product::where('id', $product['product_id'])->first();
            //return $productObject;
            $item = Paypalpayment::item();
            $item->setName($productObject['name'])
                ->setDescription($productObject['description'])
                ->setCurrency('USD')
                ->setQuantity($product['amount'])
                ->setTax('0.00')
                ->setPrice($productObject['price']);
            $items[] = $item;
            $totalProductPrices += ($productObject['price'] * $product['amount']);
        }

        $itemList = Paypalpayment::itemList();
        $itemList->setItems($items);

        $details = Paypalpayment::details();
        $details->setShipping(DeliveryOption::where('id', $this->orderObject['delivery_option_id'])->first()->price)
            ->setTax("0.00")
            ->setSubtotal($totalProductPrices);

        //Payment Amount
        $amount = Paypalpayment::amount();
        $amount->setCurrency("USD")
            // the total is $17.8 = (16 + 0.6) * 1 ( of quantity) + 1.2 ( of Shipping).
            ->setTotal($this->orderObject->price)
            ->setDetails($details);

        // Adding data to session
        session()->put('orderId', $this->orderObject->id);
        session()->put('orderPrice', $this->orderObject->price);

        //return $amount;

        // ### Transaction
        $transaction = Paypalpayment::transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription("Payment description")
            ->setInvoiceNumber(uniqid());

        // ### Payment
        // A Payment Resource; create one using
        // the above types and intent as 'sale'

        $payment = Paypalpayment::payment();

        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setTransactions(array($transaction))
            ->setRedirectUrls([
                'return_url' => url('checkout/paypal'),
                'cancel_url' => url('checkout/cancel'),
            ]);

        //return $payment;

        try {
            // ### Create Payment
            $payment->create($this->_apiContext);
        } catch (PayPalConnectionException $e) {
            echo $e->getData();
            return "Exception: " . $e->getMessage() . PHP_EOL;
        }

        return redirect($payment->getApprovalLink());
    }

    public function paypalStore(Request $request)
    {
        $this->doFirst();
        Transaction::create([
            'order_id' => session()->get('orderId'),
            'payment_method_id' => PaymentMethod::where('name', 'paypal')->first()->id,
            'paypal_payment_id' => $request['paymentId'],
            'token' => $request['token'],
            'paypal_payer_id' => $request['PayerID'],
            'price' => session()->get('orderPrice'),
        ]);

        $order_id = session()->get('order');
        $order = Order::where('id',$order_id)->first();
        if ($order) {
            Mail::to($order->email)->send(new OrderInvoiceEmail($order));
        }

        Cart::destroy();
        session()->forget('cart.options');
        session()->forget('orderId');
        session()->forget('orderPrice');
        session()->forget('order');

        return redirect()->route('web.index')->with('success', 'Order sent successfully.');
    }

    public function cancel(Request $request)
    {
        return redirect()->route('web.cart.checkout');
    }

    public function getPayfortConfig()
    {
        $this->doFirst();
        return $this->payfortConfig;
    }
}
