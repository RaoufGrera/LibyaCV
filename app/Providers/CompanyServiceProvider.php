<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helpers\CompanyClass;

class CompanyServiceProvider extends ServiceProvider
{
    protected $defer = true;

    public function boot()
    {

    }

    public function register()
    {
        $this->app->bind('App\Helpers\CompanyConstant',function(){
            return new CompanyClass();
        });
    }

    public function provides()
    {
        return ['App\Helpers\CompanyConstant'];
    }
}
