<?php


namespace App\Core\Db;

use App\Core\Application;
use App\Core\Model;
use PDOStatement;

/**
 * Class DbModel
 *
 * @author Celal Akyüz <cllakyz@hotmail.com>
 * @package App\Core\Db
 */
abstract class DbModel extends Model
{
    /**
     * Table name
     * @return string
     */
    abstract public function tableName(): string;

    /**
     * Model attributes
     * @return array
     */
    abstract public function attributes(): array;

    /**
     * Table primary key
     * @return string
     */
    abstract public function primaryKey(): string;

    /**
     * Save new records func.
     * @return bool
     */
    public function save()
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $params = array_map(fn($attr) => ":$attr", $attributes);
        $statement = self::prepare("INSERT INTO $tableName (".implode(',', $attributes).") VALUES (".implode(',', $params).")");
        foreach ($attributes as $attribute) {
            $statement->bindValue(":$attribute", $this->{$attribute});
        }

        $statement->execute();

        return true;
    }

    /**
     * Get one record func.
     * @param array $where
     * @return mixed
     */
    public function findOne(array $where)
    {
        $tableName = static::tableName();
        $attributes = array_keys($where);
        $sql = implode('AND ', array_map(fn($attr) => "$attr = :$attr", $attributes));
        $statement = self::prepare("SELECT * FROM $tableName WHERE $sql");
        foreach ($where as $key => $value) {
            $statement->bindValue(":$key", $value);
        }
        $statement->execute();
        return $statement->fetchObject(static::class);
    }

    /**
     * Database prepare func.
     * @param $sql
     * @return bool|PDOStatement
     */
    public static function prepare($sql)
    {
        return Application::$app->db->pdo->prepare($sql);
    }
}