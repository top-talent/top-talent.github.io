<?php

namespace App\Http;

class Flash
{
    /**
     * The time in milliseconds of the flash message popup.
     *
     * @var bool|int
     */
    protected $timer = 2000;

    /**
     * Sets the popup timer in milliseconds.
     *
     * @param int|bool $ms
     *
     * @return Flash
     */
    public function setTimer($ms = 2000)
    {
        $this->timer = $ms;

        return $this;
    }

    /**
     * Generates a new session flash message.
     *
     * @param string $title
     * @param string $message
     * @param string $level
     * @param string $key
     */
    public function create($title, $message, $level = 'info', $key = 'flash_message')
    {
        $timer = $this->timer;

        session()->flash($key, compact('title', 'message', 'level', 'info', 'timer'));
    }

    /**
     * Generates an info flash message.
     *
     * @param string $title
     * @param string $message
     */
    public function info($title, $message)
    {
        $this->create($title, $message, 'info');
    }

    /**
     * Generates an success flash message.
     *
     * @param string $title
     * @param string $message
     */
    public function success($title, $message)
    {
        $this->create($title, $message, 'success');
    }

    /**
     * Generates an warning flash message.
     *
     * @param string $title
     * @param string $message
     */
    public function warning($title, $message)
    {
        $this->create($title, $message, 'warning');
    }

    /**
     * Generates an error flash message.
     *
     * @param string $title
     * @param string $message
     */
    public function error($title, $message)
    {
        $this->create($title, $message, 'error');
    }

    /**
     * Generates an overlay flash message.
     *
     * @param string $title
     * @param string $message
     * @param string $level
     */
    public function overlay($title, $message, $level)
    {
        $this->create($title, $message, $level, 'flash_message_overlay');
    }
}
