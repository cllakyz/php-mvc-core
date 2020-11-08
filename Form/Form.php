<?php


namespace cllakyz\phpmvc\Form;

use cllakyz\phpmvc\Form\InputField;
use cllakyz\phpmvc\Model;

/**
 * Class Form
 *
 * @author Celal Akyüz <cllakyz@hotmail.com>
 * @package cllakyz\phpmvc\Form
 */
class Form
{
    /**
     * Form begin text
     *
     * @param string $action
     * @param string $method
     * @return Form
     */
    public static function begin(string $action, string $method): Form
    {
        echo sprintf('<form action="%s" method="%s">', $action, strtoupper($method));
        return new Form();
    }

    /**
     * Form end text
     */
    public static function end()
    {
        echo '</form>';
    }

    /**
     * Form field func.
     *
     * @param Model $model
     * @param string $attribute
     * @return InputField
     */
    public function field(Model $model, string $attribute): InputField
    {
        return new InputField($model, $attribute);
    }
}