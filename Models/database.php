<?php

namespace Models;

use PDO;

require_once './.env';
class Database
{
    private static $pdo;
    private static function setBdd()
    {
        $dns = 'pgsql:host=localhost;dbname=' . $_ENV['DB_NAME'];

        $user = $_SESSION['user'];
        $pwd = $_SESSION['password'];
        self::$pdo = new PDO($dns, $user, $pwd, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
        ]);
        self::$pdo->exec("SET NAMES 'UTF8'");
    }
    protected function getBdd()
    {
        if (self::$pdo === null) {
            self::setBdd();
        }
        return self::$pdo;
    }
    protected function setparamBdd($user, $pwd)
    {
        $dns = 'pgsql:host=localhost;dbname=' . $_ENV['DB_NAME'];
        self::$pdo = new PDO($dns, $user, $pwd, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
        ]);
        self::$pdo->exec("SET NAMES 'UTF8'");
    }
}