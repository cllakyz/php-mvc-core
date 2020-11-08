<?php


namespace cllakyz\phpmvc\Form;

use cllakyz\phpmvc\Model;

/**
 * Class TextareaField
 * @author Celal Akyüz <cllakyz@hotmail.com>
 * @package cllakyz\phpmvc\Form
 */
class TextareaField extends BaseField
{
    /**
     * TextareaField constructor.
     * @param Model $model
     * @param string $attribute
     */
    public function __construct(Model $model, string $attribute)
    {
        parent::__construct($model, $attribute);
    }

    /**
     * Textarea field
     * @return string
     */
    public function renderInput(): string
    {
        return sprintf('<textarea name="%s" class="form-control%s">%s</textarea>',
            $this->attribute,
            $this->model->hasError($this->attribute) ? ' is-invalid' : '',
            $this->model->{$this->attribute}
        );
    }
}