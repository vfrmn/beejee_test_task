<?php

namespace Core;

use PDO;

class MyPDO
{
    use Singleton;

    public static function getInstance($host = HOST, $dbname = DBNAME, $username = USERNAME, $password = PASSWORD)
    {
        if (self::$instance === null)
            self::setConnect($host, $dbname, $username, $password);
        return self::$instance;
    }

    private static function setConnect($host, $dbname, $login, $password)
    {
        try {
            $opt = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
            self::$instance = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $login, $password, $opt);
        } catch
        (PDOException $e) {
            print("Error! " . $e->getMessage() . "<br>");
            die();
        }
    }

    public static function select($sql_request, $args = null)
    {
        self::getInstance();
        $statement = self::$instance->prepare($sql_request);
        $statement->execute($args);
        return $statement->fetchAll();
    }

    public static function first($sql_request, $args = [])
    {

        self::getInstance();
        $statement = self::$instance->prepare($sql_request);
        $statement->execute($args);
        return $statement->fetch();
    }

    public static function runWithoutFetch($sql_request, $args = [])
    {

        self::getInstance();
        $statement = self::$instance->prepare($sql_request);
        $statement->execute($args);
        return $statement;
    }

    public static function insert($sql_request, $args = [])
    {
        self::getInstance();
        if (empty($args)) {
            return self::$instance->query($sql_request);
        } else {
            $statement = self::$instance->prepare($sql_request);
            $statement->execute($args);
            return $statement;
        }
    }


}

