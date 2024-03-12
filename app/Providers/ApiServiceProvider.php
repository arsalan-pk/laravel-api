<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;

class ApiServiceProvider extends ServiceProvider implements DeferrableProvider
{
    protected $customHelpers = [
        'ApiValidation',
        'ApiResponse'
    ];
    /**
     * Register services.
     */
    public function register(): void
    {
        //
        foreach ($this->customHelpers as $helper) {
            $this->registerHelper($helper);
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }


     /**
     * Register a custom helper class.
     *
     * @param string $helper The name of the helper class
     */
    protected function registerHelper(string $helper): void
    {

        $filePath = app_path("Helpers/{$helper}.php");
        if (file_exists($filePath)) {
            require_once($filePath);

            $helperClass = "\\App\\Helpers\\{$helper}";

            $this->app->singleton($helperClass, function ($app) use ($helperClass) {
                return new $helperClass();
            });
        }
    }
}
