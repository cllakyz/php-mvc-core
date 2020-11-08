<?php


namespace cllakyz\phpmvc\Form;

use cllakyz\phpmvc\Model;

/**
 * Class BaseField
 * @author Celal Akyüz <cllakyz@hotmail.com>
 * @package cllakyz\phpmvc\Form
 */
abstract class BaseField
{

    /** Class variables */
    public Model $model;
    public string $attribute;

    /**
     * Field constructor.
     *
     * @param Model $model
     * @param $attribute
     */
    public function __construct(Model $model, string $attribute)
    {
        $this->model = $model;
        $this->attribute = $attribute;
    }

    /**
     * Render Input func.
     * @return string
     */
    abstract public function renderInput(): string;

    /**
     * Class instance toString
     *
     * @return string
     */
    public function __toString()
    {
        return sprintf('
            <div class="form-group">
                <label>%s</label>
                %s
                <div class="invalid-feedback">%s</div>
            </div>
        ',
            $this->model->getLabel($this->attribute),
            $this->renderInput(),
            $this->model->getFirstError($this->attribute)
        );
    }
}