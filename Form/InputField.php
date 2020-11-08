<?php


namespace App\Core\Form;

use App\Core\Model;

/**
 * Class InputField
 *
 * @author Celal Akyüz <cllakyz@hotmail.com>
 * @package App\Core\Form
 */
class InputField extends BaseField
{
    /** Class constants */
    public const TYPE_TEXT = 'text';
    public const TYPE_PASSWORD = 'password';
    public const TYPE_EMAIL = 'email';
    public const TYPE_NUMBER = 'number';

    /** Class variables */
    public string $type;

    /**
     * Field constructor.
     *
     * @param Model $model
     * @param $attribute
     */
    public function __construct(Model $model, string $attribute)
    {
        parent::__construct($model, $attribute);
        $this->type = self::TYPE_TEXT;
    }

    /**
     * Set password field
     *
     * @return $this
     */
    public function passwordField()
    {
        $this->type = self::TYPE_PASSWORD;
        return $this;
    }

    /**
     * Set email field
     *
     * @return $this
     */
    public function emailField()
    {
        $this->type = self::TYPE_EMAIL;
        return $this;
    }

    /**
     * Set number field
     *
     * @return $this
     */
    public function numberField()
    {
        $this->type = self::TYPE_NUMBER;
        return $this;
    }

    /**
     * Render Input func.
     * @return string
     */
    public function renderInput(): string
    {
        return sprintf('<input type="%s" name="%s" value="%s" class="form-control%s">',
            $this->type,
            $this->attribute,
            $this->model->{$this->attribute},
            $this->model->hasError($this->attribute) ? ' is-invalid' : null
        );
    }
}