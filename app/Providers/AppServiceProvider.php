<?php
namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Session;
use App\Extensions\MyFileSessionHandler;
use Gloudemans\Shoppingcart\Facades\Cart;
use View;
use App\Models\SubCategory;
use App\Models\Slider;
use App\Models\WishList;
use App\Models\Category;
use Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Validator::extend('phone', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/^([\+0]([0-9]+[\- ]?)+)$/', $value);
            // return TRUE;
        });
        if(!app()->runningInConsole()){
            $wishListCount = 0;
            $compareCount = 0;
            if(Session::get('compareSession')){
                $compareCount = count(Session::get('compareSession'));
            }else{
                $compareCount = 0;
            }
            if(Auth::guard('client')->check()){
                $wishListCount = WishList::where('client_id',Auth::guard('client')->id())->count();
            }else{
                $wishListCount = 0;
            }
            $categoriesGlobal =SubCategory::inRandomOrder()->limit(7)->get();
            $slidersGlobal =Slider::all();
            $sectionsGlobal =Category::where('navBar',1)->with('subCategories')->orderBy('id','desc')->limit(4)->get();
            View::composer('*', function ($view) {
                $view->with(['cartSubTotal'=>Cart::subtotal(),'cartGlobal'=>Cart::content(),'CartCount'=>Cart::content()->count()]);
            });

            
            View::share('categoriesGlobal', $categoriesGlobal);
            View::share('slidersGlobal', $slidersGlobal);
            View::share('sectionsGlobal', $sectionsGlobal);
            View::share('wishListCount', $wishListCount);
            View::share('compareCount', $compareCount);
        }
        /*
        Session::extend('myFile', function ($app) {
            $lifetime = $this->app['config']['session.lifetime'];
            // return $this->buildSession(new FileSessionHandler(
            //     $this->app['files'], $this->app['config']['session.files'], $lifetime
            // ));
            return new MyFileSessionHandler(
                $this->app['files'], $this->app['config']['session.files'], $lifetime
            );
        });
        */
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
