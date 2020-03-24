<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Validator::extendImplicit('checkBadEmail',function($attribute,
        $value,$parameters,$validator){
          if(\Str::endsWith(request('email'),'@bad.guy')&&(
            $value=='')){
              return false;
            }
            return true;
        },'悪人の方は:attributeを必ず入力してください');

        \Validator::extend('passwordCheck',function($attribute,$value,$parameters,$validator){
          if(!preg_match('/\A(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,}+\z/i',$value)){
            return false;
          }
            return true;
        },'パスワードは半角英数字をそれぞれ１種類含む8文字以上のパスワードです');
    }
}
