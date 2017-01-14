<?php

use Teleapi\Sms\Client;
use Teleapi\Sms\Message;
use Http\Mock\Client as HttpClient;

class ClientTest extends PHPUnit_Framework_TestCase
{
    /**
     * Client to test.
     *
     * @var \Teleapi\Sms\Client
     */
    protected $client;

    /**
     * API token.
     *
     * @var string
     */
    protected $token = 'dummy_api_token';

    public function setUp()
    {
        $this->client = new Client($this->token);
    }

    public function testSendRequestIsValid()
    {
        $http = new HttpClient;
        $this->client->setHttpClient($http);

        $message = $this->makeMessage();
        $this->client->send($message);

        $request = $http->getRequests()[0];

        $this->assertEquals('POST', $request->getMethod());
        $this->assertEquals(Client::BASE_URI, (string) $request->getUri());
        $this->assertTrue($request->hasHeader('Content-Type'));
        $this->assertEquals('application/x-www-form-urlencoded', $request->getHeader('Content-Type')[0]);
        $this->assertEquals(http_build_query([
            'token' => $this->token,
            'source' => $message->from(),
            'destination' => $message->to(),
            'message' => $message->text(),
        ]), $request->getBody());
    }

    public function testMessageIsSent()
    {
        $message = $message = $this->makeMessage();
        $response = $this->client->send($message);

        $this->assertTrue($message->sent());
        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * Make a Message for testing with.
     *
     * @return \Teleapi\Sms\Message
     */
    protected function makeMessage()
    {
        return new Message('7148675309', '1234567890', 'text');
    }
}
