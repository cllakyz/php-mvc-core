<?php


namespace cllakyz\phpmvc\Middlewares;

use cllakyz\phpmvc\Application;
use cllakyz\phpmvc\Exceptions\ForbiddenException;

/**
 * Class AuthMiddleware
 * @author Celal Akyüz <cllakyz@hotmail.com>
 * @package cllakyz\phpmvc\Middlewares
 */
class AuthMiddleware extends BaseMiddleware
{
    /** Class variables */
    public array $actions = [];

    /**
     * AuthMiddleware constructor.
     * @param array $actions
     */
    public function __construct(array $actions = [])
    {
        $this->actions = $actions;
    }

    /**
     * Middleware execute function
     * @throws ForbiddenException
     */
    public function execute()
    {
        if (Application::isGuest()) {
            if (empty($this->actions) || in_array(Application::$app->controller->action, $this->actions)) {
                throw new ForbiddenException();
            }
        }
    }
}