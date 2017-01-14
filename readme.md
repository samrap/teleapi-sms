# Teleapi SMS

[![Build Status](https://travis-ci.org/samrap/teleapi-sms.svg?branch=master)](https://travis-ci.org/samrap/teleapi-sms)

This package provides a fluent interface to the Teleapi SMS service.

### Installation

Install via Composer:

`composer require samrap/teleapi-sms`

### Usage

The Teleapi SMS package provides two classes which allow you to easily create and send text messages over HTTP.

#### The Client

The Client is used to send text messages to the Teleapi SMS service. The HTTP implementation is abstracted using [httplug](), allowing you to define any [PSR-7](http://www.php-fig.org/psr/psr-7/) compliant client or [adapter](http://docs.php-http.org/en/latest/clients.html) as the HTTP layer. This gives you full control over how requests are sent and allows you to easily mock API requests in unit tests.

To get started, you will need to choose the HTTP client you want to use. We recommend using the PHP HTTP [CURL Client](https://github.com/php-http/curl-client) for simple applications and [Guzzle](https://github.com/guzzle/guzzle) for more complex apps. Of course, any PSR-7 compliant library can be used. In this example we will use the CURL Client.

First, we will add the CURL Client to our requirements:

`composer require php-http/curl-client`

Now that our HTTP client is installed, we can instantiate and use our SMS client:

```php
use Teleapi\Sms\Client;

$client = new Client('api_token');
```

We have now created our SMS client which is ready for use. Notice how we did not specify the HTTP client to use. Behind the scenes, the SMS client searches for any installed package that provides a `php-http/client-implementation` and loads it automagically. This will only work for some clients, it is better practice to specify the HTTP client explicitly. Have a look at [Clients and Adapters](http://docs.php-http.org/en/latest/clients.html) in the PHP HTTP documentation on how to instantiate a client. Then, simply pass it as the second argument to the SMS Client's constructor:

```php
use Teleapi\Sms\Client;

// Some code to create our HTTP client...

$client = new Client('api_token', $httpClient);
```

In any case, we are now ready to use our SMS client, so let's create a Message and send it off!

All messages are represented by the `Teleapi\Sms\Message` class and are extremely simple to create:

```php
use Teleapi\Sms\Message;

$to = '7148675309';
$from = '7141234567';
$text = 'Welcome to our amazing product!';
$message = new Message($to, $from, $text);
```

Now, we can send the message on its way by calling the client's `send` method and passing the Message as its single argument:

```php
$client->send($message);
```

We can check if the message sent successfully by calling the its `sent` method:

```php
$client->send($message);

if ($message->sent()) {
    echo 'Successfully sent message!';
}
```

A complete example might look like the following:

```php
use Teleapi\Sms\Client;

// Some code to create our HTTP client...

$client = new Client('api_token', $httpClient);
$message = new Message(
    '7148675309',
    '7141234567',
    'Welcome to our amazing product!'
);

$client->send($message);

if ($message->sent()) {
    echo 'Successfully sent message!';
}
```

## More info & features coming soon!
