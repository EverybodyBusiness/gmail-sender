<?php

namespace Elb\GmailSender;

use Illuminate\Support\ServiceProvider;

class GmailSenderServiceProvider extends ServiceProvider
{

    // 패키지의 기능을 등록하는 곳
    public function register()
    {

        $this->app->singleton(GmailSender::class, function ($app) {
            return new GmailSender();
        });
    }

    public function boot()
    {
        $this->publishes([
            dirname(__DIR__) . '/config/gmail-sender.php' => config_path('gmail-sender.php'),
        ], 'config');

        $this->publishes([
            dirname(__DIR__) . '/database/migrations/' => database_path('migrations'),
        ], 'migrations');
    }
}
