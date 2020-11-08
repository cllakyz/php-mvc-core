<?php


namespace App\Core;

use App\Core\Middlewares\BaseMiddleware;

/**
 * Class Controller
 *
 * @author Celal Akyüz <cllakyz@hotmail.com>
 * @package App\Core
 */
class Controller
{
    /** Class variables */
    public string $layout = 'main';
    public string $action = '';
    /**
     * @var BaseMiddleware[]
     */
    protected array $middlewares = [];

    /**
     * Set Layout
     *
     * @param $layout
     */
    public function setLayout($layout)
    {
        $this->layout = $layout;
    }

    /**
     * Render view func.
     *
     * @param string $view
     * @param array $params
     * @return string|string[]
     */
    public function render(string $view, array $params = [])
    {
        return Application::$app->view->renderView($view, $params);
    }

    /**
     * Set the middlewares
     * @param BaseMiddleware $middleware
     */
    public function registerMiddleware(BaseMiddleware $middleware)
    {
        $this->middlewares[] = $middleware;
    }

    /**
     * @return BaseMiddleware[]
     */
    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }
}