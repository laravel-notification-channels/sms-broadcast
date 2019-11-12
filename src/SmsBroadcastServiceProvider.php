<?php

namespace NotificationChannels\SmsBroadcast;

use Atymic\SmsBroadcast\Api\Client;
use Atymic\SmsBroadcast\Factory\ClientFactory;
use Illuminate\Support\ServiceProvider;

class SmsBroadcastServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->singleton(Client::class, function ($app) {
            if (empty($app['config']['services.smsbroadcast.username'])
                || empty($app['config']['services.smsbroadcast.password'])) {
                throw new \InvalidArgumentException('Missing SMS broadcast config in services');
            }

            return ClientFactory::create(
                $app['config']['services.smsbroadcast.username'],
                $app['config']['services.smsbroadcast.password'],
                $app['config']['services.smsbroadcast.default_sender']
            );
        });
    }
}
