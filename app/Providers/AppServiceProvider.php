<?php

namespace App\Providers;

use App\Models\EmailConfiguration;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // if(isset(Auth::user()->id)) {

        //     $configuration = EmailConfiguration::where("user_id", Auth::user()->id)->first();

        //     // dd($configuration);

        //     if (!is_null($configuration)) {
        //         $config = array(
        //             'default' => 'smtp',
        //             'mailers' => array(
        //                 'smtp' => array(
        //                     'transport' => 'smtp',
        //                     'host' => $configuration->host,
        //                     'port' => $configuration->port,
        //                     // 'encryption' => $configuration->encryption,
        //                     'username' => $configuration->user_name,
        //                     'password' => $configuration->password,
        //                     ),
        //                 ),
        //             'from' => array(
        //                 'address' => 'test@gmail.com',
        //                 'name' => $configuration->sender_name,
        //             ),
        //         );
        //         Config::set('mail', $config);
        //         // $runtimeConfig = Config::get('mail');
        //         // dd($runtimeConfig);
        //     }
        // }
    }
}