<?php

namespace IAMXID\IamxWalletPro;

use IAMXID\IamxWalletPro\View\Components\IdentityConnector;
use IAMXID\IamxWalletPro\View\Components\IdentityDecryptData;
use IAMXID\IamxWalletPro\View\Components\IdentityEncryptData;
use IAMXID\IamxWalletPro\View\Components\IdentitySignData;
use IAMXID\IamxWalletPro\View\Components\IdentityVerifyData;
use IAMXID\IamxWalletPro\View\Components\IdentityVerifyDID;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class IamxWalletProServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        if($this->app->runningInConsole()) {

            if(!class_exists('AddDidToUsersTable')) {
                $this->publishes([
                    __DIR__.'/../database/migrations/add_vuid_to_users_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_add_vuid_to_users_table.php'),

                ], 'migrations');
            }

            if(!class_exists('CreateIamxIdentityAttributesTable')) {
                $this->publishes([
                    __DIR__.'/../database/migrations/create_iamx_identity_attributes_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_iamx_identity_attributes_table.php'),

                ], 'migrations');
            }
        }


        // Load package views
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'iamxwalletpro');

        // Load package routes
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        // Register blade components
        Blade::component('iamxwalletpro-identity-connector', IdentityConnector::class);
        Blade::component('iamxwalletpro-identity-sign', IdentitySignData::class);
        Blade::component('iamxwalletpro-identity-verify', IdentityVerifyData::class);
        Blade::component('iamxwalletpro-identity-verify-did', IdentityVerifyDID::class);
        Blade::component('iamxwalletpro-identity-encrypt', IdentityEncryptData::class);
        Blade::component('iamxwalletpro-identity-decrypt', IdentityDecryptData::class);
    }
}
