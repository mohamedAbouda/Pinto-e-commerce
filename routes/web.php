<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('locale/{locale}', function ($locale) {
    \Session::put('locale', $locale);
    return redirect()->back();
});

Route::get('index', 'Web\HomeController@index')->name('index');
Route::get('/', 'Web\HomeController@index')->name('home');

Route::get('grid', function() {
    return view('site.products.search');
})->name('grid');
Route::get('/logout', 'Auth\WebController@logout')->name('web.logout');
Route::get('/register' , 'Auth\WebController@getRegisterForm')->name('register');
Route::get('/reset/password' , 'Auth\WebController@resetPassword')->name('reset.password');
Route::get('client/reset/{token}' , 'Auth\WebController@clientResetPasswordGet')->name('client.reset.password');
Route::post('client/change/password' , 'Auth\WebController@clientChangePassword')->name('client.change.password');
Route::get('merchant/register' , 'Auth\WebController@merchantRegisterGet')->name('merchant.register.get');
Route::post('store/merchant/data' , 'Auth\WebController@storeMerchantDataRegister')->name('store.merchant.register');


/*Route::get('/policy' , 'Web\HomeController@policy')->name('policy');
Route::get('/about' , 'Web\HomeController@about')->name('about');
Route::get('/terms' , 'Web\HomeController@terms')->name('terms');
Route::get('/contact' , 'Web\HomeController@contact')->name('contact');*/

/*
|--------------------------------------------------------------------------
| Website Routes
|--------------------------------------------------------------------------
*/
// Auth::routes();

/**
* Web auth routes
*/

Route::get('facebook/redirect','Auth\SocialiteController@facebookRedirect')->name('facebook.redirect');
Route::get('facebook/callback','Auth\SocialiteController@facebookCallBack')->name('facebook.callback');
Route::get('google/redirect','Auth\SocialiteController@googleRedirect')->name('google.redirect');
Route::get('google/callback','Auth\SocialiteController@googleCallBack')->name('google.callback');
/**
* Web routes
*/
Route::group(['as' => 'web.','middleware' => ['updateSessionItemsLogin']] , function(){
    Route::post('add/compare/product', 'Web\CompareController@add')->name('add.compare.product');
    Route::get('product/{id}/show', 'Web\ProductController@show')->name('show.product');
    Route::post('/products/review/{product?}', 'Web\ProductController@review')
    ->name('products.review');
    Route::post('check/product/quantity', 'Web\CartController@checkQuantity')->name('check.product.quantity');
    Route::post('delete/compare/product', 'Web\CompareController@delete')->name('delete.compare.product');
    Route::get('compare/products', 'Web\CompareController@index')->name('compare.index');
    Route::get('all/merchants', 'Web\HomeController@allMerchants')->name('all.merchants');
    Route::get('merchant/{id}/products', 'Web\HomeController@getMerchantProduct')->name('get.merchant.products');
    Route::get('map/locations', 'Web\HomeController@locations')->name('store.locations');
    Route::group(['prefix' => 'wishlist' , 'as' => 'wishlist.'] , function(){
        Route::get('/' , 'Web\WishlistController@index')->name('index');
        Route::post('add/product' , 'Web\WishlistController@add')->name('add');
        Route::post('wishlist/delete' , 'Web\WishlistController@delete')->name('delete');
        Route::get('wishlist/delete/all' , 'Web\WishlistController@deleteAll')->name('delete.all');
    });
    Route::get('/contact', 'Web\ContactController@index')->name('contact');
    Route::get('my/account', 'Web\HomeController@myAccount')->name('user.account');
    Route::post('my/account/edit', 'Web\HomeController@submitAccountEdit')->name('submit.account.edit');
    Route::get('active/orders', 'Web\OrderController@activeOrders')->name('active.orders');
    Route::get('history/orders', 'Web\OrderController@historyOrders')->name('history.orders');
    Route::get('order/{order}/details', 'Web\OrderController@orderDetails')->name('order.details');
    Route::post('cancel/order', 'Web\OrderController@cancelOrder')->name('cancel.order');
    Route::post('user/reorder', 'Web\OrderController@userReorder')->name('user.reorder');
    Route::get('order/{order}/submit/dispute', 'Web\OrderController@submitDispute')->name('order.submit.dispute');
    Route::post('order/dispute/save', 'Web\OrderController@orderDisputeSubmit')->name('order.dispute.store');
    Route::get('/about', 'Web\ContactController@about')->name('about');
    Route::get('/terms/conditions', 'Web\ContactController@terms')->name('terms');
    Route::get('/policy', 'Web\ContactController@policy')->name('policy');
    Route::post('/contact/submit', 'Web\ContactController@submit')->name('submit.contact');

    Route::get('/', 'Web\HomeController@index')->name('index');
    Route::get('home', 'Web\HomeController@index')->name('home');
    Route::get('/offers', 'Web\HomeController@offers')->name('offers');
    Route::group(['prefix' => '/auth/password' , 'as' => 'auth.'], function(){
        Route::get('/forget' , 'Auth\WebController@getForgetPassword')->name('getForgetPassword');
        Route::post('/forget' , 'Auth\WebController@postForgetPassword')->name('postForgetPassword'); // notify
        Route::get('/reset/{token}' , 'Auth\WebController@getResetPassword')->name('getResetPassword');
        Route::post('/reset/{token}' , 'Auth\WebController@postResetPassword')->name('postResetPassword'); // notify
    });

    Route::get('products/search' ,'Web\ProductController@getSearchPage')->name('products.search');
    Route::get('products/ajax/search' ,'Web\ProductController@getSearchPageData')->name('products.ajax.search.parameters');
    Route::post('products/ajax/search' ,'Web\ProductController@search')->name('products.ajax.search');

    Route::group(['middleware' => 'auth:client'], function () {
        Route::get('/products/reviews/{product}', 'Web\ProductController@reviews')
        ->name('products.reviews');

    });

    Route::resource('/products', 'Web\ProductController' , [
        'only' => ['index','show']
    ]);

    Route::post('/contact', 'Web\HomeController@contact')->name('contactUsPost');

    Route::group(['prefix' => 'cart' , 'as' => 'cart.'] , function(){
        Route::get('/','Web\CartController@index')->name('index');
        Route::get('destroy','Web\CartController@destroy')->name('destroy');
        Route::post('add/','Web\CartController@addToCart')->name('addToCart');
        Route::post('update/qty/item/cart','Web\CartController@updateQtyItem')->name('update.item.qty');
        Route::post('remove/item/cart','Web\CartController@removeItem')->name('remove.item');
        Route::post('remove/item/cart/row','Web\CartController@removeItemRow')->name('remove.item.row');
        Route::post('add/coupon','Web\CartController@AddCouponAndSave')->name('add.coupon.save');
        Route::get('checkout','Web\CartController@checkout')->name('checkout')->middleware('auth:client');
        Route::post('checkout/submit','Web\CartController@checkoutSubmit')->name('checkout.submit');
    });

    Route::post('/register' , 'Auth\WebController@postRegister')->name('postRegister');

    Route::get('/login', 'Auth\WebController@getLoginForm')->name('login');
    Route::post('/login', 'Auth\WebController@login')->name('web.login');

    Route::resource('/blog', 'Web\BlogController' , [
        'only' => ['index','show']
    ]);
    Route::post('/blog/comment/{post}','Web\BlogController@comment')->name('blog.comment');


    Route::post('/subscribe' , 'Web\HomeController@subscribe')->name('subscribe');

    Route::get('/mail' , 'Web\HomeController@mailTest');

    Route::group(['prefix' => 'checkout' , 'as' => 'checkout.'], function(){
        Route::get('visa' , 'Web\CheckoutController@visaIndex');
        Route::post('visa' , 'Web\CheckoutController@visaStore');
        Route::get('paypal' , 'Web\CheckoutController@paypalStore');
        Route::get('cancel' , 'Web\CheckoutController@cancel');
    });

    Route::post('/visits/count' , 'Web\HomeController@count')->name('visits.count');

    Route::get('/csv/import' , 'Web\HomeController@csv');
    Route::post('/csv/import' , 'Web\HomeController@map');
});

/*
|--------------------------------------------------------------------------
| Admin Dashboard Routes
|--------------------------------------------------------------------------
*/
//Route::get('/login', 'Auth\DashboardController@getLoginForm')->name('login');
// Route::get('/', 'Auth\DashboardController@getLoginForm')->name('login');

// login into dashboard
Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.'], function () {
    Route::get('/login', 'Auth\DashboardController@getLoginForm')->name('loginForm');
    Route::post('/login', 'Auth\DashboardController@login')->name('login');
    Route::post('/logout', 'Auth\DashboardController@logout')->name('logout');
    Route::post('reviews/status/toggle','Dashboard\ProductController@toggleStatus')->name('review.toggle.status');
    Route::post('reviews/status/update','Dashboard\ProductController@updateReview')->name('review.update');
    Route::get('approved/reviews','Dashboard\ProductController@approvedReviews')->name('approved.reviews');
    Route::get('disapproved/reviews','Dashboard\ProductController@disapprovedReviews')->name('disapproved.reviews');
});
Route::group(['prefix' => 'dashboard/merchant/', 'as' => 'dashboard.merchant.'], function () {
    Route::get('/login', 'Auth\DashboardController@getLoginForm')->name('loginForm');
    Route::get('/register', 'Auth\DashboardController@getRegisterForm')->name('registerForm');
    Route::post('/login', 'Auth\DashboardController@login')->name('login');
    Route::post('/register', 'Auth\DashboardController@register')->name('register');
    Route::post('/logout', 'Auth\DashboardController@logout')->name('logout');

    Route::group(['prefix' => '/auth/password' , 'as' => 'auth.'], function(){
        Route::get('/forget' , 'Auth\MerchantForgetPasswordController@getForgetPassword')->name('getForgetPassword');
        Route::post('/forget' , 'Auth\MerchantForgetPasswordController@postForgetPassword')->name('postForgetPassword'); // notify
        Route::get('/reset/{token}' , 'Auth\MerchantForgetPasswordController@getResetPassword')->name('getResetPassword');
        Route::post('/reset/{token}' , 'Auth\MerchantForgetPasswordController@postResetPassword')->name('postResetPassword'); // notify
    });
});
// all dashboard routes
//'role:admin|superAdmin'
Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.', 'middleware' => ['auth:web,admin,merchant','dashboard']], function () {
    /**
    * The middleware 'first' will cause a redirect loop as it redirects to route('getFt')
    */
    Route::get('clients/{status}', 'Dashboard\UserController@approvedUsers')->name('admin.approved.users.filter');
    Route::get('merchant/active/orders', 'Dashboard\OrderController@merchantActiveOrders')->name('merchant.active.orders');
    Route::get('merchant/history/orders', 'Dashboard\OrderController@merchantHistoryOrders')->name('merchant.history.orders');
    Route::get('/merchant/profile/edit', 'Dashboard\AdminController@getMerchantProfile')->name('merchant.get.profile.edit');
    Route::get('/merchant/profile/view', 'Dashboard\AdminController@viewMerchantProfile')->name('merchant.get.profile.view');
    Route::post('/merchant/profile/update', 'Dashboard\AdminController@updateMerchantProfile')->name('merchant.get.profile.update');
    Route::get('install' , 'Dashboard\HomeController@getInstall')->name('getFt');
    Route::post('install' , 'Dashboard\HomeController@install')->name('postFt');

    //['middleware' => ['first']] ,
    Route::group([],function(){
        // index of dashboard
        Route::get('/', 'Dashboard\HomeController@index')->name('index');
        Route::get('/index', 'Dashboard\HomeController@index')->name('index');

        // PAGES
        Route::resource('pages', 'Dashboard\PageController');

        Route::get('merchant/offers', 'Dashboard\DiscountController@merchantOffers')->name('merchant.offers');

        Route::resource('governorates', 'Dashboard\GovernorateController');

        Route::resource('corporate_deals', 'Dashboard\CorporateDealController');
        Route::post('corporate_deals/toggle/status', 'Dashboard\CorporateDealController@toggleStatus')->name('toggle.status.corporate_deals');
        Route::get('corporate_deals/all/active', 'Dashboard\CorporateDealController@corporateDealActive')->name('active.corporate_deals');

        Route::get('corporate_deals/not/active', 'Dashboard\CorporateDealController@corporateDealNotActive')->name('notActive.corporate_deals');

        Route::get('products/with/correlation', 'Dashboard\ProductController@withCorrelationProducts')->name('with.correlation.products');
        Route::get('products/without/correlation', 'Dashboard\ProductController@withoutCorrelationProducts')->name('without.correlation.products');

        //toggle approve products

        Route::post('admin/toggle/approve/products', 'Dashboard\ProductController@toggleApprove')->name('admin.toggle.approve');
        Route::get('approved/products', 'Dashboard\ProductController@approvedProducts')->name('show.approved.products');
        Route::get('disapproved/products', 'Dashboard\ProductController@disapprovedProducts')->name('show.disapproved.products');

        // USERS
        Route::resource('users', 'Dashboard\UserController');


        Route::post('product/add/discount', 'Dashboard\ProductController@DiscountProductAdd')->name('product.add.discount');
        Route::post('product/delete/discount', 'Dashboard\ProductController@DiscountProductDelete')->name('product.delete.discount');


        Route::resource('key_words', 'Dashboard\KeyWordController');

        //Inventory Products
        Route::post('save/product/inventory', 'Dashboard\ProductController@saveInventory')->name('save.product.inventory');

        Route::post('delete/product/inventory', 'Dashboard\ProductController@deleteInventory')->name('delete.product.inventory');
        Route::post('shipping/page', 'Dashboard\ProductController@shippingPage')->name('product.shipping.page');
        Route::post('store/shipping/page', 'Dashboard\ProductController@storeShippingPage')->name('store.product.shipping.page');
        Route::post('store/related/products', 'Dashboard\ProductController@storeRelatedProducts')->name('store.related.products');
        Route::post('store/product/images', 'Dashboard\ProductController@storeProductImages')->name('store.product.images');

        Route::post('check/section', 'Dashboard\ProductController@checkProductSection')->name('product.check.section');
        Route::post('change/subcategory/ajax', 'Dashboard\ProductController@changeSubCategoryAjax')->name('change.subCategory.ajax.admin');


        Route::post('user/status/toggle', 'Dashboard\UserController@statusToggle')->name('user.status.toggle');

        // Admins
        Route::resource('admins', 'Dashboard\AdminController');

        Route::resource('contact_messages', 'Dashboard\ContactMessagesController');



        // CATEGORIES
        Route::group(['prefix' => 'categories', 'as' => 'categories.'], function () {
            Route::get('/', 'Dashboard\CategoryController@index')->name('index');
            Route::get('index', 'Dashboard\CategoryController@index')->name('index');
            Route::get('create', 'Dashboard\CategoryController@create')->name('create');
            Route::post('create', 'Dashboard\CategoryController@store')->name('store');
            Route::get('{id?}/edit', 'Dashboard\CategoryController@edit')->name('edit');
            Route::post('{id?}/edit', 'Dashboard\CategoryController@update')->name('update');
            Route::get('{id?}/destroy', 'Dashboard\CategoryController@destroy')->name('destroy');
        });

        // SIZES
        Route::group(['prefix' => 'sizes', 'as' => 'sizes.'], function () {
            Route::get('/', 'Dashboard\SizeController@index')->name('index');
            Route::get('index', 'Dashboard\SizeController@index')->name('index');
            Route::get('create', 'Dashboard\SizeController@create')->name('create');
            Route::post('create', 'Dashboard\SizeController@store')->name('store');
            Route::get('{id?}/edit', 'Dashboard\SizeController@edit')->name('edit');
            Route::post('{id?}/edit', 'Dashboard\SizeController@update')->name('update');
            Route::get('{id?}/destroy', 'Dashboard\SizeController@destroy')->name('destroy');
        });

        // COLORS
        Route::group(['prefix' => 'colors', 'as' => 'colors.'], function () {
            Route::get('/', 'Dashboard\ColorController@index')->name('index');
            Route::get('index', 'Dashboard\ColorController@index')->name('index');
            Route::get('create', 'Dashboard\ColorController@create')->name('create');
            Route::post('create', 'Dashboard\ColorController@store')->name('store');
            Route::get('{id?}/edit', 'Dashboard\ColorController@edit')->name('edit');
            Route::post('{id?}/edit', 'Dashboard\ColorController@update')->name('update');
            Route::get('{id?}/destroy', 'Dashboard\ColorController@destroy')->name('destroy');
        });

        // PRODUCTS
        Route::group(['prefix' => 'products', 'as' => 'products.'], function () {
            Route::get('/', 'Dashboard\ProductController@index')->name('index');
            Route::get('index', 'Dashboard\ProductController@index')->name('index');
            Route::get('create', 'Dashboard\ProductController@create')->name('create');
            Route::post('create', 'Dashboard\ProductController@store')->name('store');
            Route::get('{id?}/edit', 'Dashboard\ProductController@edit')->name('edit');
            Route::get('{id?}/show', 'Dashboard\ProductController@show')->name('show');
            Route::get('{id}/reviews', 'Dashboard\ProductController@reviews')->name('reviews');
            Route::post('delete/review', 'Dashboard\ProductController@deleteReview')->name('delete.review');

            Route::post('{id?}/edit', 'Dashboard\ProductController@update')->name('update');
            Route::get('{id?}/destroy', 'Dashboard\ProductController@destroy')->name('destroy');
            Route::post('change/product/featured', 'Dashboard\ProductController@changeFeaturedStatus')->name('change.featured.status');
            Route::post('change/product/featured/ajax', 'Dashboard\ProductController@changeFeaturedStatusAjax')->name('change.featured.status.ajax');
            Route::get('featured', 'Dashboard\ProductController@featuredProductsRequests')->name('featured.products');

            Route::get('subcategories', 'Dashboard\ProductController@subCategories')->name('subcategories');
            Route::get('{id}/add/stock', 'Dashboard\ProductController@addStock')->name('add.stock');
            Route::get('{id}/remove/stock', 'Dashboard\ProductController@removeStock')->name('remove.stock');
            Route::post('save/stock', 'Dashboard\ProductController@saveStock')->name('save.stock');
        });

        // INVENTORY
        Route::group(['prefix' => 'inventory', 'as' => 'inventory.'], function () {
            Route::get('/', 'Dashboard\InventoryController@index')->name('index');
            Route::get('index', 'Dashboard\InventoryController@index')->name('index');
            Route::get('{id?}/edit', 'Dashboard\InventoryController@edit')->name('edit');
            Route::post('{id?}/edit', 'Dashboard\InventoryController@update')->name('update');
        });

        // GIFT CARDS
        Route::group(['prefix' => 'gifts', 'as' => 'gifts.'], function () {
            Route::get('/', 'Dashboard\GiftCardController@index')->name('index');
            Route::get('index', 'Dashboard\GiftCardController@index')->name('index');
            Route::get('create', 'Dashboard\GiftCardController@create')->name('create');
            Route::post('create', 'Dashboard\GiftCardController@store')->name('store');
            Route::get('{id?}/edit', 'Dashboard\GiftCardController@edit')->name('edit');
            Route::post('{id?}/edit', 'Dashboard\GiftCardController@update')->name('update');
            Route::get('{id?}/destroy', 'Dashboard\GiftCardController@destroy')->name('destroy');
        });

        // CUSTOMERS
        Route::group(['prefix' => 'customers', 'as' => 'customers.'], function () {
            Route::get('/', 'Dashboard\CustomerController@index')->name('index');
            Route::get('index', 'Dashboard\CustomerController@index')->name('index');
            Route::get('import', 'Dashboard\CustomerController@import')->name('import');
            Route::post('import', 'Dashboard\CustomerController@fetch')->name('fetch');
            Route::get('create', 'Dashboard\CustomerController@create')->name('create');
            Route::post('create', 'Dashboard\CustomerController@store')->name('store');
            Route::get('{id?}/show', 'Dashboard\CustomerController@show')->name('show');
            Route::get('{id?}/edit', 'Dashboard\CustomerController@edit')->name('edit');
            Route::post('{id?}/edit', 'Dashboard\CustomerController@update')->name('update');
            Route::get('{id?}/destroy', 'Dashboard\CustomerController@destroy')->name('destroy');

            Route::post('access/{access}/{customer?}' , 'Dashboard\CustomerController@access')->name('access');
        });

        // PAYMENT METHODS
        Route::group(['prefix' => 'payment_methods', 'as' => 'payment_methods.'], function () {
            Route::get('/', 'Dashboard\PaymentMethodController@index')->name('index');
            Route::get('index', 'Dashboard\PaymentMethodController@index')->name('index');
            Route::post('availability', 'Dashboard\PaymentMethodController@availability')->name('availability');
            Route::get('edit/{type}' , 'Dashboard\PaymentMethodController@edit')->name('edit');
            Route::post('update' , 'Dashboard\PaymentMethodController@update')->name('update');
        });

        // DELIVERY OPTIONS
        Route::group(['prefix' => 'delivery_options', 'as' => 'delivery_options.'], function () {
            Route::get('/', 'Dashboard\DeliveryOptionController@index')->name('index');
            Route::get('index', 'Dashboard\DeliveryOptionController@index')->name('index');
            Route::get('create', 'Dashboard\DeliveryOptionController@create')->name('create');
            Route::post('create', 'Dashboard\DeliveryOptionController@store')->name('store');
            Route::get('{id?}/edit', 'Dashboard\DeliveryOptionController@edit')->name('edit');
            Route::post('{id?}/edit', 'Dashboard\DeliveryOptionController@update')->name('update');
            Route::get('{id?}/destroy', 'Dashboard\DeliveryOptionController@destroy')->name('destroy');
            Route::delete('{id?}/destroy', 'Dashboard\DeliveryOptionController@destroy')->name('destroy');
        });

        // REDEEMED GIFTS
        Route::group(['prefix' => 'redeemed_gifts', 'as' => 'redeemed_gifts.'], function () {
            Route::get('/', 'Dashboard\RedeemedGiftController@index')->name('index');
            Route::get('index', 'Dashboard\RedeemedGiftController@index')->name('index');
            //Route::get('{id?}/show', 'Dashboard\RedeemedGiftController@show')->name('show');
            Route::get('{id?}/destroy', 'Dashboard\RedeemedGiftController@destroy')->name('destroy');
        });

        // COLLECTION
        Route::get('collection/product/{product}', 'Dashboard\CollectionController@product')
        ->name('collection.product');
        Route::post('collection/{collection}/product/{product}', 'Dashboard\CollectionController@productCollection')
        ->name('collection.productCollection');
        Route::resource('collection', 'Dashboard\CollectionController');

        // BANNERS
        Route::resource('banners' ,'Dashboard\BannerController');

        // SETTINGS
        Route::group(['prefix' => 'setting', 'as' => 'setting.'], function () {
            Route::get('/', 'Dashboard\SettingController@index')->name('index');
            Route::post('/update', 'Dashboard\SettingController@update')->name('update');
            Route::get('/manage/menu', 'Dashboard\SettingController@manageMenu')->name('manageMenu');
            Route::post('/manage/menu/reset', 'Dashboard\SettingController@resetMenu')->name('menu.reset');
        });


        // SOCIAL MEDIAS
        Route::group(['prefix' => 'socialmedias', 'as' => 'socialmedias.'], function () {
            Route::get('/', 'Dashboard\SocialMediaController@index')->name('index');
            Route::get('index', 'Dashboard\SocialMediaController@index')->name('index');
            Route::get('create', 'Dashboard\SocialMediaController@create')->name('create');
            Route::post('create', 'Dashboard\SocialMediaController@store')->name('store');
            Route::get('{id?}/edit', 'Dashboard\SocialMediaController@edit')->name('edit');
            Route::post('{id?}/edit', 'Dashboard\SocialMediaController@update')->name('update');
            Route::get('{id?}/destroy', 'Dashboard\SocialMediaController@destroy')->name('destroy');
        });

        // DISCOUNT
        Route::post('offers/{offer}/toggle/status', 'Dashboard\DiscountController@toggleActivation')->name('offers.toggleActivation');
        Route::resource('offers', 'Dashboard\DiscountController');
        Route::resource('sliders', 'Dashboard\SliderController');

        // BRAND
        Route::resource('brands', 'Dashboard\BrandController');

        // Bolicy
        Route::resource('policy', 'Dashboard\PolicyController');
        // Terms
        Route::resource('terms', 'Dashboard\TermController');
        // About
        Route::resource('about', 'Dashboard\AboutController');

        Route::post('delete/image/product', 'Dashboard\ProductController@deleteImage')->name('delete.image.product');
        // Store Locations
        Route::resource('storelocations', 'Dashboard\StoreLocationController');
        // Store Locations
        Route::resource('contact', 'Dashboard\ContactController');


        // SUBSCRIBER
        Route::get('subscribers/import', 'Dashboard\SubscriberController@import')->name('subscribers.import');
        Route::post('subscribers/import', 'Dashboard\SubscriberController@fetch')->name('subscribers.fetch');
        Route::resource('subscribers', 'Dashboard\SubscriberController');

        // REPORTS
        Route::group(['prefix' => 'reports'], function () {
            Route::get('/', 'Dashboard\ReportsController@index')->name('reports.index');
            Route::post('customers-by-countries', 'Dashboard\ReportsController@customersByCountries')->name('reports.customers-by-countries');
            // Route::get('salesPerMonth', 'Dashboard\ReportsController@salesPerMonth')->name('reports.salesPerMonth');
        });

        // COUPON
        Route::get('coupons/generate', 'Dashboard\CouponController@generate')->name('coupons.generate');
        Route::resource('coupons', 'Dashboard\CouponController');

        //SUBCATEGORIES
        Route::resource('subCategories', 'Dashboard\SubCategoryController' , [
            'except' => ['show']
        ]);

        //Merchants conrol
        Route::resource('merchants', 'Dashboard\MerchantController');
        Route::resource('gift_cards', 'Dashboard\GiftCardController');
        Route::get('list/gift_cards', 'Dashboard\GiftCardController@listAll')->name('list.gift.cards');
        Route::post('change/status/giftCard', 'Dashboard\GiftCardController@changeStatus')->name('giftCard.change.status');
        Route::get('search/merchant/gift_cards', 'Dashboard\GiftCardController@searchMerchantGiftCards')->name('search.merchant.gift');
        Route::post('merchant/status/toggle', 'Dashboard\MerchantController@statusToggle')
        ->name('merchant.status.toggle');
        Route::get('approved/merchants', 'Dashboard\MerchantController@approvedMerchants')
        ->name('approved.merchants');
        Route::get('disapproved/merchants', 'Dashboard\MerchantController@disapprovedMerchants')
        ->name('disapproved.merchants');

        //ORDERS
        Route::post('order/state/change/' , 'Dashboard\OrderController@changeOrderState')->name('orders.changeOrderState');
        Route::post('order/filter' , 'Dashboard\OrderController@filter')->name('orders.filter');
        Route::get('orders/dispute/{order}', 'Dashboard\OrderController@disputeComments')->name('orders.disputeComments');
        Route::post('orders/dispute/{order}', 'Dashboard\OrderController@disputeCommentReply');
        Route::resource('orders', 'Dashboard\OrderController');
        Route::get('active/orders', 'Dashboard\OrderController@activeOrders')->name('active.orders');
        Route::get('history/orders', 'Dashboard\OrderController@historyOrders')->name('history.orders');



        Route::group(['prefix' => '/my/admins/','as' => 'merchant_admins.'], function(){
            Route::get('/','Dashboard\MerchantAdminController@index')->name('index');
            Route::get('create','Dashboard\MerchantAdminController@create')->name('create');
            Route::post('store','Dashboard\MerchantAdminController@store')->name('store');
            Route::get('/{admin}','Dashboard\MerchantAdminController@show')->name('show');
            Route::get('{admin}/edit','Dashboard\MerchantAdminController@edit')->name('edit');
            Route::patch('{admin}/update','Dashboard\MerchantAdminController@update')->name('update');
            Route::delete('{admin}','Dashboard\MerchantAdminController@destroy')->name('destroy');
        });

        /**
        * branches
        */
        Route::resource('branches', 'Dashboard\BranchController');
    });
});
