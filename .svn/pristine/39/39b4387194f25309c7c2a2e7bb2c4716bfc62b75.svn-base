<?php

namespace App\Providers;

use Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('max_date', function($attribute, $value, $parameters) {
            return $parameters[0] ? strtotime($value) <= $parameters[0] : true;
        });

        Validator::extend('min_date', function($attribute, $value, $parameters) {
            return strtotime($value) >= strtotime(request()->$parameters[0]);
        });
        Validator::replacer('min_date', function($message, $attribute, $rule, $parameters) {
            return '截止时间比开始时间小';
        });

        Validator::extend('over_time_required_with', function($attribute, $value, $parameters) {
            if(strtotime($value) - strtotime(request()->$parameters[1]) >= $parameters[0]){
                foreach($parameters as $i=>$field){
                    if($i <=1) continue;
                    $bool = request()->has($field);
                    if($bool) return true;
                }
                return false;
            } else {
                return true;
            }
        });
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
