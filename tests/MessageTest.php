<?php

use Teleapi\Sms\Message;

class MessageTest extends PHPUnit_Framework_TestCase
{
    protected $to = '7148675309';
    protected $from = '5625980218';
    protected $text = 'Nothing is certain but death and taxes.';
    protected $message;

    public function setUp()
    {
        $this->message = new Message($this->to, $this->from, $this->text);
    }

    public function testGetters()
    {
        $this->assertEquals($this->to, $this->message->to());
        $this->assertEquals($this->from, $this->message->from());
        $this->assertEquals($this->text, $this->message->text());
    }

    public function testSetters()
    {
        $to = '1234567890';
        $from = '0987654321';
        $text = 'An old fashioned.';

        $this->message->setTo($to);
        $this->message->setFrom($from);
        $this->message->setText($text);

        $this->assertEquals($to, $this->message->to());
        $this->assertEquals($from, $this->message->from());
        $this->assertEquals($text, $this->message->text());
    }

    public function testItGetsTextLength()
    {
        $this->assertGreaterThan(0, $this->message->length());
    }
}
