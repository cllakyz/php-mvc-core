<?php


namespace cllakyz\phpmvc\Middlewares;

/**
 * Class BaseMiddleware
 * @author Celal Akyüz <cllakyz@hotmail.com>
 * @package cllakyz\phpmvc\Middlewares
 */
abstract class BaseMiddleware
{
    abstract public function execute();
}