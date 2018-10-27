<?php

namespace KDuma\Validator;

use Illuminate\Support\ServiceProvider;

class PolishValidatorRulesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        \Validator::extend('pesel', PeselNumberRule::class.'@passes');
        \Validator::extend('identity_card', PolishIdentityCardNumberRule::class.'@passes');

        $this->loadTranslationsFrom(__DIR__ . '/translations', 'kd-validator');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
