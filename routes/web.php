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

/*
|--------------------------------------------------------------------------
| Website Routes
|--------------------------------------------------------------------------
*/
Route::get('locale/{locale}', function ($locale) {
    \Session::put('locale', $locale);
    return redirect()->back();
});

Route::get('index', 'Web\HomeController@index')->name('index');
Route::get('/', 'Web\HomeController@index')->name('home');
Route::get('/logout', 'Auth\WebController@logout')->name('web.logout');
Route::get('/reset/password' , 'Auth\WebController@resetPassword')->name('reset.password');


Route::get('facebook/redirect','Auth\SocialiteController@facebookRedirect')->name('facebook.redirect');
Route::get('facebook/callback','Auth\SocialiteController@facebookCallBack')->name('facebook.callback');
Route::get('google/redirect','Auth\SocialiteController@googleRedirect')->name('google.redirect');
Route::get('google/callback','Auth\SocialiteController@googleCallBack')->name('google.callback');

Route::group(['as' => 'web.','middleware' => ['shareSessionItems']] , function(){
    Route::get('/u/login', 'Auth\WebController@getLoginForm')->name('login');
    Route::get('/u/forget/password', 'Auth\WebController@getForgetPasswordForm')->name('forget.password');
    Route::post('/u/forget/password', 'Auth\WebController@ForgetPassword')->name('forget.password.post');
    Route::get('/u/logout', 'Auth\WebController@logout')->name('logout');
    Route::post('/u/login', 'Auth\WebController@login');
    Route::get('/u/register' , 'Auth\WebController@getRegisterForm')->name('register');
    Route::post('/u/register' , 'Auth\WebController@postRegister');
    Route::get('client/reset/{token}' , 'Auth\WebController@clientResetPasswordGet')->name('client.reset.password');
    Route::post('/u/client/change/password' , 'Auth\WebController@clientChangePassword')->name('client.change.password');

});

Route::group(['as' => 'web.','middleware' => ['shareSessionItems'] ,'namespace' => 'Web'] , function(){
    Route::get('/', 'HomeController@index')->name('index');
    Route::get('home', 'HomeController@index')->name('home');
    Route::get('shop' ,'ProductController@getSearchPage')->name('products.shop');
    Route::get('products/ajax/search' ,'ProductController@getSearchPageData')->name('products.ajax.search.parameters');
    Route::post('shop' ,'ProductController@search')->name('products.ajax.search');
    // Route::group(['middleware' => 'auth:client'], function () {
    //     Route::get('/products/reviews/{product}', 'ProductController@reviews')
    //     ->name('products.reviews');
    // });
    Route::resource('/products', 'ProductController' , [
        'only' => ['index','show']
    ]);
    Route::group(['prefix' => 'wishlist' , 'as' => 'wishlist.' ,'middleware' => ['auth:client']] , function(){
        Route::get('/' , 'WishlistController@index')->name('index');
        Route::post('add/product' , 'WishlistController@add')->name('add');
        Route::post('wishlist/delete' , 'WishlistController@delete')->name('delete');
        Route::get('wishlist/delete/all' , 'WishlistController@deleteAll')->name('delete.all');
    });
    Route::get('/about', 'ContactController@about')->name('about');
    Route::get('/contact', 'ContactController@index')->name('contact');
    Route::post('/contact', 'ContactController@submit')->name('submit.contact');
    Route::group(['prefix' => 'cart' , 'as' => 'cart.'] , function(){
        Route::get('/','CartController@index')->name('index');
        Route::get('destroy','CartController@destroy')->name('destroy');
        Route::post('add/','CartController@addToCart')->name('addToCart');
        Route::post('update/qty/item/cart','CartController@updateQtyItem')->name('update.item.qty');
        Route::post('remove/item/cart','CartController@removeItem')->name('remove.item');
        Route::post('remove/item/cart/row','CartController@removeItemRow')->name('remove.item.row');
        Route::post('add/coupon','CartController@AddCouponAndSave')->name('add.coupon.save');
        Route::post('update','CartController@updateCart')->name('update')->middleware('auth:client');
        Route::get('checkout','CartController@checkout')->name('checkout')->middleware('auth:client');
        Route::post('checkout','CartController@checkoutSubmit')->middleware('auth:client');
        // Route::post('checkout/submit','CartController@checkoutSubmit')->name('checkout.submit');
    });
    Route::post('check/product/quantity', 'CartController@checkQuantity')->name('check.product.quantity');
    Route::post('/subscribe' , 'HomeController@subscribe')->name('subscribe');
    Route::get('/terms', 'ContactController@terms')->name('terms');
    Route::get('/shipping', 'ContactController@shipping')->name('shipping');
    Route::get('/policy', 'ContactController@policy')->name('policy');
    Route::resource('/blog', 'BlogController' , [
        'only' => ['index','show']
    ]);
    Route::group(['middleware' => ['auth:client']] , function(){
        Route::post('/blog/comment/{post}','BlogController@comment')->name('blog.comment');
    });
    // Route::post('add/compare/product', 'CompareController@add')->name('add.compare.product');
    // Route::get('product/{id}/show', 'ProductController@show')->name('show.product');
    // Route::post('/products/review/{product?}', 'ProductController@review')->name('products.review');
    // Route::post('delete/compare/product', 'CompareController@delete')->name('delete.compare.product');
    // Route::get('compare/products', 'CompareController@index')->name('compare.index');
    // Route::get('map/locations', 'HomeController@locations')->name('store.locations');
    // Route::get('my/account', 'HomeController@myAccount')->name('user.account');
    // Route::post('my/account/edit', 'HomeController@submitAccountEdit')->name('submit.account.edit');
    // Route::get('active/orders', 'OrderController@activeOrders')->name('active.orders');
    // Route::get('history/orders', 'OrderController@historyOrders')->name('history.orders');
    // Route::get('order/{order}/details', 'OrderController@orderDetails')->name('order.details');
    // Route::post('cancel/order', 'OrderController@cancelOrder')->name('cancel.order');
    // Route::post('user/reorder', 'OrderController@userReorder')->name('user.reorder');
    // Route::get('order/{order}/submit/dispute', 'OrderController@submitDispute')->name('order.submit.dispute');
    // Route::post('order/dispute/save', 'OrderController@orderDisputeSubmit')->name('order.dispute.store');
    // Route::get('/offers', 'HomeController@offers')->name('offers');
    // Route::group(['prefix' => '/auth/password' , 'as' => 'auth.'], function(){
    //     Route::get('/forget' , 'Auth\WebController@getForgetPassword')->name('getForgetPassword');
    //     Route::post('/forget' , 'Auth\WebController@postForgetPassword')->name('postForgetPassword'); // notify
    //     Route::get('/reset/{token}' , 'Auth\WebController@getResetPassword')->name('getResetPassword');
    //     Route::post('/reset/{token}' , 'Auth\WebController@postResetPassword')->name('postResetPassword'); // notify
    // });
    // Route::post('/register' , 'Auth\WebController@postRegister')->name('postRegister');
    // Route::get('/login', 'Auth\WebController@getLoginForm')->name('login');
    // Route::post('/login', 'Auth\WebController@login');

    // Route::get('/mail' , 'HomeController@mailTest');
    // Route::group(['prefix' => 'checkout' , 'as' => 'checkout.'], function(){
    //     Route::get('visa' , 'CheckoutController@visaIndex');
    //     Route::post('visa' , 'CheckoutController@visaStore');
    //     Route::get('paypal' , 'CheckoutController@paypalStore');
    //     Route::get('cancel' , 'CheckoutController@cancel');
    // });
    // Route::post('/visits/count' , 'HomeController@count')->name('visits.count');
    // Route::get('/csv/import' , 'HomeController@csv');
    // Route::post('/csv/import' , 'HomeController@map');
});

/*
|--------------------------------------------------------------------------
| Admin Dashboard Routes
|--------------------------------------------------------------------------
*/

Route::get('/login', 'Auth\DashboardController@getLoginForm')->name('login');
Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.'], function () {
    Route::post('/login', 'Auth\DashboardController@login')->name('login');
    Route::post('/logout', 'Auth\DashboardController@logout')->name('logout');
});

Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.', 'middleware' => ['auth:web,admin','dashboard'] ,'namespace' => 'Dashboard'], function () {
    // index of dashboard
    Route::get('/', 'HomeController@index')->name('index');
    Route::get('/index', 'HomeController@index')->name('index');

    // PAGES
    Route::resource('pages', 'PageController');
    Route::resource('shipping', 'ShippingController');
    Route::get('offers', 'DiscountController@merchantOffers')->name('merchant.offers');
    Route::resource('governorates', 'GovernorateController');
    Route::resource('corporate_deals', 'CorporateDealController');
    Route::post('corporate_deals/toggle/status', 'CorporateDealController@toggleStatus')->name('toggle.status.corporate_deals');
    Route::get('corporate_deals/all/active', 'CorporateDealController@corporateDealActive')->name('active.corporate_deals');
    Route::get('corporate_deals/not/active', 'CorporateDealController@corporateDealNotActive')->name('notActive.corporate_deals');
    Route::get('products/with/correlation', 'ProductController@withCorrelationProducts')->name('with.correlation.products');
    Route::get('products/without/correlation', 'ProductController@withoutCorrelationProducts')->name('without.correlation.products');

    //toggle approve products
    Route::post('admin/toggle/approve/products', 'ProductController@toggleApprove')->name('admin.toggle.approve');
    Route::get('approved/products', 'ProductController@approvedProducts')->name('show.approved.products');
    Route::get('disapproved/products', 'ProductController@disapprovedProducts')->name('show.disapproved.products');

    // USERS
    Route::get('clients/{status}', 'UserController@approvedUsers')->name('users.filter');
    Route::resource('users', 'UserController');
    Route::post('product/add/discount', 'ProductController@DiscountProductAdd')->name('product.add.discount');
    Route::post('product/delete/discount', 'ProductController@DiscountProductDelete')->name('product.delete.discount');
    Route::resource('key_words', 'KeyWordController');

    //Inventory Products
    Route::post('save/product/inventory', 'ProductController@saveInventory')->name('save.product.inventory');
    Route::post('delete/product/inventory', 'ProductController@deleteInventory')->name('delete.product.inventory');
    Route::post('shipping/page', 'ProductController@shippingPage')->name('product.shipping.page');
    Route::post('store/shipping/page', 'ProductController@storeShippingPage')->name('store.product.shipping.page');
    Route::post('store/related/products', 'ProductController@storeRelatedProducts')->name('store.related.products');
    Route::post('store/product/images', 'ProductController@storeProductImages')->name('store.product.images');
    Route::post('check/section', 'ProductController@checkProductSection')->name('product.check.section');
    Route::post('change/subcategory/ajax', 'ProductController@changeSubCategoryAjax')->name('change.subCategory.ajax.admin');
    Route::post('user/status/toggle', 'UserController@statusToggle')->name('user.status.toggle');

    // Admins
    Route::resource('admins', 'AdminController');

    Route::resource('contact_messages', 'ContactMessagesController');

    // CATEGORIES
    Route::group(['prefix' => 'categories', 'as' => 'categories.'], function () {
        Route::get('/', 'CategoryController@index')->name('index');
        Route::get('index', 'CategoryController@index')->name('index');
        Route::get('create', 'CategoryController@create')->name('create');
        Route::post('create', 'CategoryController@store')->name('store');
        Route::get('{id?}/edit', 'CategoryController@edit')->name('edit');
        Route::post('{id?}/edit', 'CategoryController@update')->name('update');
        Route::get('{id?}/destroy', 'CategoryController@destroy')->name('destroy');
    });

    // SIZES
    Route::group(['prefix' => 'sizes', 'as' => 'sizes.'], function () {
        Route::get('/', 'SizeController@index')->name('index');
        Route::get('index', 'SizeController@index')->name('index');
        Route::get('create', 'SizeController@create')->name('create');
        Route::post('create', 'SizeController@store')->name('store');
        Route::get('{id?}/edit', 'SizeController@edit')->name('edit');
        Route::post('{id?}/edit', 'SizeController@update')->name('update');
        Route::get('{id?}/destroy', 'SizeController@destroy')->name('destroy');
    });

    // COLORS
    Route::group(['prefix' => 'colors', 'as' => 'colors.'], function () {
        Route::get('/', 'ColorController@index')->name('index');
        Route::get('index', 'ColorController@index')->name('index');
        Route::get('create', 'ColorController@create')->name('create');
        Route::post('create', 'ColorController@store')->name('store');
        Route::get('{id?}/edit', 'ColorController@edit')->name('edit');
        Route::post('{id?}/edit', 'ColorController@update')->name('update');
        Route::get('{id?}/destroy', 'ColorController@destroy')->name('destroy');
    });

    // PRODUCTS
    Route::group(['prefix' => 'products', 'as' => 'products.'], function () {
        Route::get('/', 'ProductController@index')->name('index');
        Route::get('index', 'ProductController@index')->name('index');
        Route::get('create', 'ProductController@create')->name('create');
        Route::post('create', 'ProductController@store')->name('store');
        Route::get('{id?}/edit', 'ProductController@edit')->name('edit');
        Route::get('{id?}/show', 'ProductController@show')->name('show');
        Route::get('{id}/reviews', 'ProductController@reviews')->name('reviews');
        Route::post('delete/review', 'ProductController@deleteReview')->name('delete.review');

        Route::post('{id?}/edit', 'ProductController@update')->name('update');
        Route::get('{id?}/destroy', 'ProductController@destroy')->name('destroy');
        Route::post('change/product/featured', 'ProductController@changeFeaturedStatus')->name('change.featured.status');
        Route::post('change/product/featured/ajax', 'ProductController@changeFeaturedStatusAjax')->name('change.featured.status.ajax');
        Route::get('featured', 'ProductController@featuredProductsRequests')->name('featured.products');

        Route::get('subcategories', 'ProductController@subCategories')->name('subcategories');
        Route::get('{id}/add/stock', 'ProductController@addStock')->name('add.stock');
        Route::get('{id}/remove/stock', 'ProductController@removeStock')->name('remove.stock');
        Route::post('save/stock', 'ProductController@saveStock')->name('save.stock');
    });

    // INVENTORY
    Route::group(['prefix' => 'inventory', 'as' => 'inventory.'], function () {
        Route::get('/', 'InventoryController@index')->name('index');
        Route::get('index', 'InventoryController@index')->name('index');
        Route::get('{id?}/edit', 'InventoryController@edit')->name('edit');
        Route::post('{id?}/edit', 'InventoryController@update')->name('update');
    });

    // GIFT CARDS
    Route::group(['prefix' => 'gifts', 'as' => 'gifts.'], function () {
        Route::get('/', 'GiftCardController@index')->name('index');
        Route::get('index', 'GiftCardController@index')->name('index');
        Route::get('create', 'GiftCardController@create')->name('create');
        Route::post('create', 'GiftCardController@store')->name('store');
        Route::get('{id?}/edit', 'GiftCardController@edit')->name('edit');
        Route::post('{id?}/edit', 'GiftCardController@update')->name('update');
        Route::get('{id?}/destroy', 'GiftCardController@destroy')->name('destroy');
    });

    // CUSTOMERS
    Route::group(['prefix' => 'customers', 'as' => 'customers.'], function () {
        Route::get('/', 'CustomerController@index')->name('index');
        Route::get('index', 'CustomerController@index')->name('index');
        Route::get('import', 'CustomerController@import')->name('import');
        Route::post('import', 'CustomerController@fetch')->name('fetch');
        Route::get('create', 'CustomerController@create')->name('create');
        Route::post('create', 'CustomerController@store')->name('store');
        Route::get('{id?}/show', 'CustomerController@show')->name('show');
        Route::get('{id?}/edit', 'CustomerController@edit')->name('edit');
        Route::post('{id?}/edit', 'CustomerController@update')->name('update');
        Route::get('{id?}/destroy', 'CustomerController@destroy')->name('destroy');

        Route::post('access/{access}/{customer?}' , 'CustomerController@access')->name('access');
    });

    // PAYMENT METHODS
    Route::group(['prefix' => 'payment_methods', 'as' => 'payment_methods.'], function () {
        Route::get('/', 'PaymentMethodController@index')->name('index');
        Route::get('index', 'PaymentMethodController@index')->name('index');
        Route::post('availability', 'PaymentMethodController@availability')->name('availability');
        Route::get('edit/{type}' , 'PaymentMethodController@edit')->name('edit');
        Route::post('update' , 'PaymentMethodController@update')->name('update');
    });

    // DELIVERY OPTIONS
    Route::group(['prefix' => 'delivery_options', 'as' => 'delivery_options.'], function () {
        Route::get('/', 'DeliveryOptionController@index')->name('index');
        Route::get('index', 'DeliveryOptionController@index')->name('index');
        Route::get('create', 'DeliveryOptionController@create')->name('create');
        Route::post('create', 'DeliveryOptionController@store')->name('store');
        Route::get('{id?}/edit', 'DeliveryOptionController@edit')->name('edit');
        Route::post('{id?}/edit', 'DeliveryOptionController@update')->name('update');
        Route::get('{id?}/destroy', 'DeliveryOptionController@destroy')->name('destroy');
        Route::delete('{id?}/destroy', 'DeliveryOptionController@destroy')->name('destroy');
    });

    // REDEEMED GIFTS
    Route::group(['prefix' => 'redeemed_gifts', 'as' => 'redeemed_gifts.'], function () {
        Route::get('/', 'RedeemedGiftController@index')->name('index');
        Route::get('index', 'RedeemedGiftController@index')->name('index');
        //Route::get('{id?}/show', 'RedeemedGiftController@show')->name('show');
        Route::get('{id?}/destroy', 'RedeemedGiftController@destroy')->name('destroy');
    });

    // COLLECTION
    Route::get('collection/product/{product}', 'CollectionController@product')
    ->name('collection.product');
    Route::post('collection/{collection}/product/{product}', 'CollectionController@productCollection')
    ->name('collection.productCollection');
    Route::resource('collection', 'CollectionController');

    // BANNERS
    Route::resource('banners' ,'BannerController');

    // SETTINGS
    Route::group(['prefix' => 'setting', 'as' => 'setting.'], function () {
        Route::get('/', 'SettingController@index')->name('index');
        Route::post('/update', 'SettingController@update')->name('update');
        Route::get('/manage/menu', 'SettingController@manageMenu')->name('manageMenu');
        Route::post('/manage/menu/reset', 'SettingController@resetMenu')->name('menu.reset');
    });

    // SOCIAL MEDIAS
    Route::group(['prefix' => 'socialmedias', 'as' => 'socialmedias.'], function () {
        Route::get('/', 'SocialMediaController@index')->name('index');
        Route::get('index', 'SocialMediaController@index')->name('index');
        Route::get('create', 'SocialMediaController@create')->name('create');
        Route::post('create', 'SocialMediaController@store')->name('store');
        Route::get('{id?}/edit', 'SocialMediaController@edit')->name('edit');
        Route::post('{id?}/edit', 'SocialMediaController@update')->name('update');
        Route::get('{id?}/destroy', 'SocialMediaController@destroy')->name('destroy');
    });

    // DISCOUNT
    Route::post('offers/{offer}/toggle/status', 'DiscountController@toggleActivation')->name('offers.toggleActivation');
    Route::resource('offers', 'DiscountController');
    Route::resource('sliders', 'SliderController');

    // BRAND
    Route::resource('brands', 'BrandController');

    // Bolicy
    Route::resource('policy', 'PolicyController');
    // Terms
    Route::resource('terms', 'TermController');
    // About
    Route::resource('about', 'AboutController' ,['only' => ['index' ,'create' ,'store']]);

    Route::post('delete/image/product', 'ProductController@deleteImage')->name('delete.image.product');
    // Store Locations
    Route::resource('storelocations', 'StoreLocationController');
    // Store Locations
    Route::resource('contact', 'ContactController');

    // SUBSCRIBER
    Route::get('subscribers/import', 'SubscriberController@import')->name('subscribers.import');
    Route::post('subscribers/import', 'SubscriberController@fetch')->name('subscribers.fetch');
    Route::resource('subscribers', 'SubscriberController');

    // REPORTS
    Route::group(['prefix' => 'reports'], function () {
        Route::get('/', 'ReportsController@index')->name('reports.index');
        Route::post('customers-by-countries', 'ReportsController@customersByCountries')->name('reports.customers-by-countries');
        // Route::get('salesPerMonth', 'ReportsController@salesPerMonth')->name('reports.salesPerMonth');
    });

    // COUPON
    Route::get('coupons/generate', 'CouponController@generate')->name('coupons.generate');
    Route::resource('coupons', 'CouponController');

    //SUBCATEGORIES
    Route::resource('subCategories', 'SubCategoryController' , [
        'except' => ['show']
    ]);

    Route::resource('gift_cards', 'GiftCardController');
    Route::get('list/gift_cards', 'GiftCardController@listAll')->name('list.gift.cards');
    Route::post('change/status/giftCard', 'GiftCardController@changeStatus')->name('giftCard.change.status');

    //ORDERS
    Route::post('order/state/change/' , 'OrderController@changeOrderState')->name('orders.changeOrderState');
    Route::post('order/filter' , 'OrderController@filter')->name('orders.filter');
    Route::get('orders/dispute/{order}', 'OrderController@disputeComments')->name('orders.disputeComments');
    Route::post('orders/dispute/{order}', 'OrderController@disputeCommentReply');
    Route::resource('orders', 'OrderController');
    Route::get('active/orders', 'OrderController@activeOrders')->name('active.orders');
    Route::get('history/orders', 'OrderController@historyOrders')->name('history.orders');

    /**
    * branches
    */
    Route::resource('branches', 'BranchController');

    Route::post('reviews/status/toggle','ProductController@toggleStatus')->name('review.toggle.status');
    Route::post('reviews/status/update','ProductController@updateReview')->name('review.update');
    Route::get('approved/reviews','ProductController@approvedReviews')->name('approved.reviews');
    Route::get('disapproved/reviews','ProductController@disapprovedReviews')->name('disapproved.reviews');
    Route::resource('blog', 'BlogController');
});
