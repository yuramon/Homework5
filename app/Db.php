<?php


class Db
{
    public static function getConnection()
    {
        $params = include("../migrations-db.php");
        $dsn = "mysql:host = {$params['host']}; dbname = {$params['dbname']}";
        $db = new PDO($dsn, $params['user'], $params['password'], [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        $db->exec('USE myPageDB;');

        return $db;

    }


}