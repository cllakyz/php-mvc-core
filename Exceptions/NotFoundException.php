<?php


namespace App\Core\Exceptions;

use Exception;

/**
 * Class NotFoundException
 * @author Celal Akyüz <cllakyz@hotmail.com>
 * @package App\Core\Exceptions
 */
class NotFoundException extends Exception
{
    protected $message = 'Page not found';
    protected $code = 404;
}