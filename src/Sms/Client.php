<?php

namespace Teleapi\Sms;

use Http\Client\HttpClient;
use GuzzleHttp\Psr7\Request;
use Http\Discovery\HttpClientDiscovery;

class Client
{
    const BASE_URI = 'https://sms.teleapi.net/sms/send';

    /**
     * The API token.
     *
     * @var string
     */
    protected $token;

    /**
     * A php-http compatible HTTP client.
     *
     * @var \Http\Client\HttpClient
     */
    protected $http;

    /**
     * The headers to pass to each request.
     *
     * @var array
     */
    protected $headers = [
        'Content-Type' => 'application/x-www-form-urlencoded',
    ];

    /**
     * Create a new Client instance.
     *
     * @param  string  $token
     * @param  \Http\Client\HttpClient  $http
     */
    public function __construct($token, HttpClient $http = null)
    {
        $this->token = $token;
        $this->setHttpClient($http ?: HttpClientDiscovery::find());
    }

    /**
     * Set the Http client.
     *
     * @param  \Http\Client\HttpClient  $http
     */
    public function setHttpClient(HttpClient $http)
    {
        $this->http = $http;
    }

    /**
     * Send a message.
     *
     * @param  \Teleapi\Sms\Message  $message
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function send(Message $message)
    {
        $response = $this->http->sendRequest($this->prepareRequest($message));

        if ($response->getStatusCode() === 200) {
            $message->setSent(true);
        }

        return $response;
    }

    /**
     * Prepare a Request object for the given Message.
     *
     * @param  \Teleapi\Sms\Message  $message
     * @return \Psr\Http\Message\RequestInterface
     */
    final private function prepareRequest(Message $message)
    {
        return new Request('POST', self::BASE_URI, $this->headers, http_build_query([
            'token' => $this->token,
            'source' => $message->from(),
            'destination' => $message->to(),
            'message' => $message->text(),
        ]));
    }
}
