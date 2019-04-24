<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Support\Collection;

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
    public function boot(ResponseFactory $response)
    {
        \Validator::extend('mobile', function ($attribute, $value, $parameters, $validator) {
            if ( !preg_match('/^(?:09)(?!.*-.*-)(?:\d(?:-)?){9}$/m', $value) ) {
				return false;
			}

			return true;
		});

		Collection::macro('main_cols', function () {
			return $this->map(function ($value) {
				return $value->main_cols();
			});
		});
    }
}
