<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\Dashboard\CustomerStoreRequest;
use App\Http\Requests\Dashboard\CustomerUpdateRequest;
use App\Models\Country;
use App\Models\FileCSV;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\UserDenyed;
use App\Notifications\UserGranted;
use League\Csv\Reader;

class CustomerController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = User::paginate(20);
        return view('dashboard.customers.index', compact('customers'));
    }

    /**
     * Display a Page that contains form to upload csv file.
     *
     * @return \Illuminate\Http\Response
     */
    public function import()
    {
        return view('dashboard.customers.import');
    }

    /**
     * import customers from csv file.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function fetch(Request $request)
    {
        $this->validate($request, ['file' => 'required']);

        // check extension of the file
        if ($request->file('file')->getClientOriginalExtension() != 'csv') {
            return back()->with('info', 'Wrong file. Only available extension is CSV.');
        }

        // Save file in database
        $csv = new FileCSV;
        $csv['path'] = $request->file('file')->store('csv/customers');
        $csv->save();

        // Get path of the file
        $path = realpath('storage/app/' . $csv['path']);

        // Load the file
        if ($reader = Reader::createFromPath($path)->setDelimiter(',')) {

            $succeed = 0;
            $failed = 0;

            // Create new customers at database
            $results = $reader->fetch();
            foreach ($results as $row) {
                if (sizeof($row) > 3) {

                    try {
                        User::create([
                            'name' => $row[0],
                            'email' => $row[1],
                            'password' => bcrypt(123456),
                            'country_id' => $row[2],
                            'phone' => $row[3],
                            'company' => $row[4],
                            'address' => $row[5],
                        ]);
                        $succeed++;
                    } catch (\Exception $exception) {
                        $failed++;
                    }

                } else {
                    return back()->with('info', 'A row at the file has less number of the required parameters.');
                }
            }
            return redirect(route('dashboard.customers.index'))->with('success', $succeed . ' customers imported successfully and ' . $failed . ' failed.');

        }
        return back()->with('info', 'Failed loading the file. Try again with a correct file.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$countries = [['id' => 1, 'name' => 'EGY']];
        $countries = Country::all();
        return view('dashboard.customers.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerStoreRequest $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($request['password']);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images/customers');
        }
        if (User::create($data)) {
            return redirect(route('dashboard.customers.index'))->with('success', 'Customer created.');
        }
        return back()->with('info', 'Customer did not create.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ($customer = User::find($id)) {
            $countries = [['id' => 1, 'name' => 'EGY']];
            $customer->orders = $customer->orders()->paginate(10);
            return view('dashboard.customers.show', compact('customer', 'countries'));
        }
        return back()->with('info', 'Customer did not found in database.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if ($customer = User::find($id)) {
            //$countries = [['id' => 1, 'name' => 'EGY']];
            $countries = Country::all();
            return view('dashboard.customers.edit', compact('customer', 'countries'));
        }
        return back()->with('info', 'Customer did not found in database.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerUpdateRequest $request, $id)
    {
        $data = $request->all();
        $customer = User::find($id);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images/customers');
        }
        if ($customer->update($data)) {
            return redirect('dashboard/customers/index')->with('success', 'Customer updated.');
        }
        return back()->with('info', 'Customer did not update.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($customer = User::find($id)) {
            $customer->delete();
            return redirect()->route('dashboard.customers.index')->with('success', 'Customer deleted.');
        }
        return back()->with('info', 'Customer did not delete!');
    }

    public function access(Request $request , $access = 'grant' , User $customer)
    {
        if ($access === 'grant') {
            $customer->valid = 1;
            $customer->notify(new UserGranted($customer));
        }else{
            $customer->valid = -1;
            //get reason and notify
            $reason = $request->get('reason');
            $customer->notify(new UserDenyed($reason));
        }
        $customer->save();
        return redirect()->back()->with('success', 'Customer access state changed.');
    }
}
