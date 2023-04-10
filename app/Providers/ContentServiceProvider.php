<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DB;

class ContentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->exception = DB::table('vw_detail_exception')->get();

        view()->composer('layouts.header', function($view) {
            $view->with(['contents' => $this->exception]);
        });
    }
}
