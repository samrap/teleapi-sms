<?php

namespace Teleapi\Sms;

class Message
{
    /**
     * The phone number to send the text to.
     *
     * @var string
     */
    protected $to;

    /**
     * The phone number to send the text from.
     *
     * @var string
     */
    protected $from;

    /**
     * The text message.
     *
     * @var string
     */
    protected $text;

    /**
     * Whether or not the message has been sent.
     *
     * @var bool
     */
    protected $sent = false;

    /**
     * Create a new Message instance.
     *
     * @param  string  $to
     * @param  string  $from
     * @param  string  $text
     */
    public function __construct($to = null, $from = null, $text = '')
    {
        $this->to = $to;
        $this->from = $from;
        $this->text = $text;
    }

    /**
     * Set the text.
     *
     * @param  string  $text
     * @return void
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * Get the text.
     *
     * @return string
     */
    public function text()
    {
        return $this->text;
    }

    /**
     * Set the from number.
     *
     * @param  string  $from
     * @return void
     */
    public function setFrom($from)
    {
        $this->from = $from;
    }

    /**
     * Get the from number.
     *
     * @return string
     */
    public function from()
    {
        return $this->from;
    }

    /**
     * Set the to number.
     *
     * @param  string  $to
     * @return void
     */
    public function setTo($to)
    {
        $this->to = $to;
    }

    /**
     * Get the to number.
     *
     * @return string
     */
    public function to()
    {
        return $this->to;
    }

    /**
     * Get the length of the message.
     *
     * @return int
     */
    public function length()
    {
        return strlen($this->text);
    }

    /**
     * Tell the message whether it has been sent or not.
     *
     * @param  bool  $sent
     */
    public function setSent($sent)
    {
        $this->sent = (bool) $sent;
    }

    /**
     * Determine if the message has been sent by the client.
     *
     * @return bool
     */
    public function sent()
    {
        return $this->sent;
    }
}
