<?php


namespace App\Core\Middlewares;

/**
 * Class BaseMiddleware
 * @author Celal Akyüz <cllakyz@hotmail.com>
 * @package App\Core\Middlewares
 */
abstract class BaseMiddleware
{
    abstract public function execute();
}