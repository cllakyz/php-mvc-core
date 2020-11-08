<?php


namespace App\Core\Middlewares;

use App\Core\Application;
use App\Core\Exceptions\ForbiddenException;

/**
 * Class AuthMiddleware
 * @author Celal Akyüz <cllakyz@hotmail.com>
 * @package App\Core\Middlewares
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