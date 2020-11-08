<?php


namespace cllakyz\phpmvc\Exceptions;

use Exception;

/**
 * Class NotFoundException
 * @author Celal Akyüz <cllakyz@hotmail.com>
 * @package cllakyz\phpmvc\Exceptions
 */
class NotFoundException extends Exception
{
    protected $message = 'Page not found';
    protected $code = 404;
}