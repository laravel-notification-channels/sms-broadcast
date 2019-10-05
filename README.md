# Sms Broadcast Notification Channel

<p align="center">
    <a href="https://travis-ci.org/laravel-notification-channels/sms-broadcast">
        <img src="https://travis-ci.org/laravel-notification-channels/sms-broadcast.svg?branch=master" alt="Build status">
    </a>
    <a href="https://packagist.org/packages/laravel-notification-channels/sms-broadcast">
        <img src="https://poser.pugx.org/laravel-notification-channels/sms-broadcast/downloads" alt="Downloads">
    </a>
    <a href="https://packagist.org/packages/laravel-notification-channels/sms-broadcast">
        <img src="https://poser.pugx.org/laravel-notification-channels/sms-broadcast/v/stable" alt="Latest release">
    </a>
    <a href="https://scrutinizer-ci.com/g/laravel-notification-channels/sms-broadcast/">
        <img src="https://scrutinizer-ci.com/g/laravel-notification-channels/sms-broadcast/badges/coverage.png?b=master" alt="Code coverage">
    </a>
    <a href="LICENSE.md">
        <img src="https://poser.pugx.org/laravel-notification-channels/sms-broadcast/license" alt="License">
    </a>
</p>

This package makes it easy to send notifications using [Sms Broadcast](https://www.smsbroadcast.com.au/) with Laravel > 5.6 & 6.0.

It uses my [Sms Broadcast PHP package](https://github.com/atymic/sms-broadcast-php) under the hood.

## Contents

- [Installation](#installation)
	- [Setting up the Sms Broadcast service](#setting-up-the-Sms Broadcast-service)
- [Usage](#usage)
	- [Available Message methods](#available-message-methods)
- [Changelog](#changelog)
- [Testing](#testing)
- [Security](#security)
- [Contributing](#contributing)
- [Credits](#credits)
- [License](#license)


## Installation

Install the package using composer

```bash
composer require laravel-notification-channels/sms-broadcast
```

Add the configuration to your `services.php` config file:

```php
'smsbroadcast' => [
    'username' => env('SMS_BROADCAST_USERNAME'),
    'password' => env('SMS_BROADCAST_PASSWORD'),
    'default_sender' => env('SMS_BROADCAST_DEFAULT_SENDER', null),
]
```

## Usage

You can use the channel in your `via()` method inside the notification:

```php
use Illuminate\Notifications\Notification;
use NotificationChannels\SmsBroadcast\SmsBroadcastMessage;
use NotificationChannels\SmsBroadcast\SmsBroadcastChannel;

class AccountApproved extends Notification
{
    public function via($notifiable)
    {
        return [SmsBroadcastChannel::class];
    }

    public function toSmsbroadcast($notifiable)
    {
        return (new SmsBroadcastMessage)
            ->content("Task #{$notifiable->id} is complete!");
    }
}
```

In your notifiable model, make sure to include a `routeNotificationForSmsbroadcast()` method, which returns an australian phone number.

```php
public function routeNotificationForSmsbroadcast()
{
    return $this->phone; // 0412345678 or 6142345678
}
```

### Available methods

`sender()`: Sets the sender's name or phone number.

`content()`: Set a content of the notification message.

`delay()`: Set a delay, in minutes before sending the message

`reference()`: Set the SMS ref code

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.


## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [atymic](https://github.com/atymic)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
