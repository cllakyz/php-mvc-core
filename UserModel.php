<?php


namespace cllakyz\phpmvc;

use cllakyz\phpmvc\Db\DbModel;

/**
 * Class UserModel
 *
 * @author Celal Akyüz <cllakyz@hotmail.com>
 * @package cllakyz\phpmvc
 */
abstract class UserModel extends DbModel
{
    /**
     * User fullname
     * @return string
     */
    abstract public function getDisplayName(): string;
}