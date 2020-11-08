<?php


namespace App\Core;

/**
 * Class View
 * @author Celal Akyüz <cllakyz@hotmail.com>
 * @package App\Core
 */
class View
{
    /** Class Variables */
    public string $title = '';

    /**
     * Render view
     *
     * @param string $view
     * @param array $params
     * @return string|string[]
     */
    public function renderView(string $view, array $params = [])
    {
        $viewContent = $this->viewContent($view, $params);
        $layoutContent = $this->layoutContent();
        return str_replace('{{ Content }}', $viewContent, $layoutContent);
    }

    /**
     * Get Layout content
     *
     * @return false|string
     */
    protected function layoutContent()
    {
        $layout = Application::$app->layout;
        if (Application::$app->controller) {
            $layout = Application::$app->controller->layout;
        }
        ob_start();
        include_once Application::$ROOT_DIR . '/views/layouts/' . $layout . '.php';
        return ob_get_clean();
    }

    /**
     * Get view content
     *
     * @param string $view
     * @param array $params
     * @return false|string
     */
    protected function viewContent(string $view, array $params = [])
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include_once Application::$ROOT_DIR . '/views/' . $view . '.php';
        return ob_get_clean();
    }
}