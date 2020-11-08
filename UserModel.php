<?php


namespace App\Core;

use App\Core\Db\DbModel;

/**
 * Class UserModel
 *
 * @author Celal Akyüz <cllakyz@hotmail.com>
 * @package App\Core
 */
abstract class UserModel extends DbModel
{
    /**
     * User fullname
     * @return string
     */
    abstract public function getDisplayName(): string;
}