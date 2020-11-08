<?php


namespace cllakyz\phpmvc;

/**
 * Class Response
 *
 * @package cllakyz\phpmvc
 * @author Celal Akyüz <cllakyz@hotmail.com>
 */
class Response
{
    /**
     * Set http response status code
     *
     * @param int $code
     */
    public function setStatusCode(int $code)
    {
        http_response_code($code);
    }

    /**
     * redirect func.
     * @param string $url
     */
    public function redirect(string $url)
    {
        header('Location: ' . $url);
        exit;
    }
}