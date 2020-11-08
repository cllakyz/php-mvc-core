<?php


namespace App\Core;

/**
 * Class Session
 *
 * @author Celal Akyüz <cllakyz@hotmail.com>
 * @package App\Core
 */
class Session
{
    /** Class consts */
    protected const FLASH_KEY = 'flash_messages';

    /**
     * Session constructor.
     */
    public function __construct()
    {
        ob_start();
        session_start();

        $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];
        foreach ($flashMessages as $key => &$message) {
            // Mark to be removed
            $message['remove'] = true;
        }

        $_SESSION[self::FLASH_KEY] = $flashMessages;
    }

    /**
     * Set flash messages
     * @param $key
     * @param $value
     */
    public function setFlash($key, $value)
    {
        $_SESSION[self::FLASH_KEY][$key] = [
            'remove' => false,
            'value' => $value
        ];
    }

    /**
     * Get flash messages
     * @param $key
     * @return false|mixed
     */
    public function getFlash($key)
    {
        return $_SESSION[self::FLASH_KEY][$key]['value'] ?? false;
    }

    /**
     * Set session
     * @param $key
     * @param $value
     */
    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    /**
     * Get session
     * @param $key
     * @return false|mixed
     */
    public function get($key)
    {
        return $_SESSION[$key] ?? false;
    }

    /**
     * Remove session
     * @param $key
     */
    public function remove($key)
    {
        unset($_SESSION[$key]);
    }

    /**
     * destructor func.
     */
    public function __destruct()
    {
        // Iterate over marked to
        $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];
        foreach ($flashMessages as $key => $message) {
            if ($message['remove']) {
                unset($_SESSION[self::FLASH_KEY][$key]);
            }
        }
    }
}