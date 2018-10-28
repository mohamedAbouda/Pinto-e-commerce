<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['namespace' => 'Apis'] ,function(){
    Route::group(['prefix' => 'auth'] ,function(){
        Route::post('login' ,'AuthController@loginClient');
        Route::post('register' ,'AuthController@registerClient');
        Route::post('social/register' ,'AuthController@socialRegisterClient');
        Route::post('social/login' ,'AuthController@socialLoginClient');
        Route::post('forget/password' ,'AuthController@forgetPassword');
    });
});


Route::group(['namespace' => 'Apis' ,'middleware' => 'auth:api_clients'] ,function(){
	Route::get('/', function (Request $request) {
		return $request->user();
	});
	Route::get('all/categories','CategoryController@allCategories');
	Route::post('featured/products','ProductController@featuredProducts');
	Route::post('search/products','ProductController@searchProducts');
	Route::post('popular/products','ProductController@popularProducts');
	Route::post('category/products','ProductController@categoryProducts');
	Route::post('user/profile','ProfileController@userProfile');
	Route::post('edit/user/profile','ProfileController@editUserProfile');
	Route::post('change/user/password','ProfileController@changeUserPassword');
	Route::get('user/wish/list','WishListcontroller@userWishList');
	Route::post('user/add/wish/list','WishListcontroller@userAddWishList');
	Route::post('user/delete/wish/list','WishListcontroller@userDeleteWishList');
	Route::post('user/add/cart','CartController@AddCart');
	Route::post('user/update/cart','CartController@updateCart');
	Route::get('get/cart','CartController@getCart');
	Route::post('cart/remove/item','CartController@cartRemoveItem');
	Route::post('user/add/address','AddressController@userAddAddress');
	Route::post('user/edit/address','AddressController@userEditAddress');
	Route::post('user/delete/address','AddressController@userDeleteAddress');
	Route::post('product/details','ProductController@productDetails');
	Route::post('add/product/review','ProductController@addProductReview');
	Route::post('history/orders','OrderController@historyOrders');
	Route::post('active/orders','OrderController@activeOrders');
	Route::post('order/details','OrderController@orderDetails');
	Route::post('update/order/status','OrderController@updateStatus');
	Route::post('store/order/dispute','OrderController@storeOrderDispute');
	Route::post('phone/verfiy' ,'AuthController@phoneVerfiy');
	Route::post('checkout' ,'CartController@checkout');
	Route::post('get/coupon' ,'CartController@getCoupon');
	Route::get('all/sliders' ,'SliderController@allSliders');

});
