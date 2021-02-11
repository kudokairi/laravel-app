<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class ExistsSoftDeleteProvider extends ServiceProvider
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
        Validator::extend('exists_soft_delete', function ($attribute, $value, $parameters, $validator) {
            return (\DB::table($parameters[0])->where($parameters[1] ?? 'id', $value)
            ->whereNull('deleted_at')
            ->exists()) ? false : true;
        });
    }
}
