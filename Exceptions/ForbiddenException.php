<?php


namespace App\Core\Exceptions;

use Exception;

/**
 * Class ForbiddenException
 * @author Celal Akyüz <cllakyz@hotmail.com>
 * @package App\Core\Exceptions
 */
class ForbiddenException extends Exception
{
    protected $message = 'You don\'t have permission to access this page';
    protected $code = 403;
}