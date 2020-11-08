<?php


namespace cllakyz\phpmvc\Db;

use cllakyz\phpmvc\Application;
use PDO;
use PDOStatement;

/**
 * Class Database
 *
 * @author Celal Akyüz <cllakyz@hotmail.com>
 * @package cllakyz\phpmvc\Db
 */
class Database
{
    /** Class Variables */
    public PDO $pdo;
    private string $timestamp;
    protected static string $charset = 'UTF8';

    /**
     * Database constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        $dsn = $config['dsn'] ?? '';
        $user = $config['user'] ?? '';
        $password = $config['password'] ?? '';
        $this->pdo = new PDO($dsn, $user, $password);
        $this->pdo->exec('SET NAMES `' . self::$charset . '`');
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->timestamp = date('Y-m-d H:i:s');
    }

    /**
     * Migration files run func.
     */
    public function applyMigrations()
    {
        $this->createMigrationsTable();
        $appliedMigrations = $this->getAppliedMigrations();

        $newMigrations = [];
        $files = scandir(Application::$ROOT_DIR . '/database/migrations');
        $toApplyMigrations = array_diff($files, $appliedMigrations);

        foreach ($toApplyMigrations as $migration) {
            if ($migration === '.' || $migration === '..')
                continue;

            require_once Application::$ROOT_DIR . '/database/migrations/' . $migration;
            $className = pathinfo($migration, PATHINFO_FILENAME);
            $instance = new $className();
            $this->log("Applying migration $migration");
            $instance->up();
            $this->log("Applied migration $migration");
            $newMigrations[] = $migration;
        }

        if (!empty($newMigrations)) {
            $this->saveMigrations($newMigrations);
        } else {
            $this->log("All migrations are applied");
        }
    }

    /**
     * Create migrations table func.
     */
    public function createMigrationsTable()
    {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS `migrations` (
	        `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	        `migration` VARCHAR(255) NOT NULL COLLATE 'utf8_general_ci',
	        `created_at` TIMESTAMP NULL DEFAULT current_timestamp(),
	        PRIMARY KEY (`id`) USING BTREE
            ) 
            COLLATE='utf8_general_ci'
            ENGINE=InnoDB;");
    }

    /**
     * Get Created migrations.
     * @return array
     */
    public function getAppliedMigrations()
    {
        $statement = $this->pdo->prepare("SELECT migration FROM migrations");
        $statement->execute();

        return $statement->fetchAll();
    }

    /**
     * Save migration record func.
     * @param array $migrations
     */
    public function saveMigrations(array $migrations)
    {
        $str = implode(',', array_map(fn($m) => "('$m')", $migrations));
        $statement = $this->pdo->prepare("INSERT INTO migrations (migration) VALUES $str");
        $statement->execute();
    }

    /**
     * PDO prepare
     * @param $sql
     * @return bool|PDOStatement
     */
    public function prepare($sql)
    {
        return $this->pdo->prepare($sql);
    }

    /**
     * Migration log func.
     * @param $message
     */
    protected function log($message)
    {
        echo '[' . $this->timestamp . '] - ' . $message . PHP_EOL;
    }
}