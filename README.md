# Sms Broadcast Notification Channel

This package makes it easy to send notifications using [Sms Broadcast](https://www.smsbroadcast.com.au/) with Laravel > 5.6.

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

    public function toSmsBroadcast($notifiable)
    {
        return (new SmsBroadcastMessage)
            ->content("Task #{$notifiable->id} is complete!");
    }
}
```

In your notifiable model, make sure to include a `routeNotificationForSmsBroadcast()` method, which returns an australian phone number.

```php
public function routeNotificationForSmsBroadcast()
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
