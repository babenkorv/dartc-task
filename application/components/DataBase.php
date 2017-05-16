<?php

namespace application\components;

class DataBase
{
    protected static $_instance;
    private static $connect;

    private static function getInstance()
    {
        if (self::$_instance === null) {
            self::$_instance = new self;
        }
        return self::$_instance;
    }

    private function __construct()
    {
        self::$connect = new \PDO("mysql:host=localhost;dbname=testDB;charset=utf8", 'root', '');
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }

    /**
     * Execute a raw SQL query on the database.
     *
     * @param $sql
     * @param array $values
     * @return mixed
     * @throws \Exception
     */
    public static function query($sql, $values = [])
    {
        self::getInstance();
        
        if (!$sth = self::$connect->prepare($sql)) {
            throw new \Exception('Database Error: query is not a prepare');
        }

        if (!$sth->execute($values)) {
            throw new \Exception('Database Error: query is not a execute');
        }
        return $sth;
    }

    /**
     * Run the query and returns all the rows found.
     *
     * @param string $sql Raw SQL string to execute.
     * @param array &$values Optional array of values to bind to the query.
     * @return string
     */
    public static function findAll($sql, $values = [])
    {
        $sth = self::query($sql, $values);
        $row = $sth->fetchAll(\PDO::FETCH_ASSOC);

        return $row;
    }

    /**
     * Run the query and returns first row.
     *
     * @param string $sql Raw SQL string to execute.
     * @param array &$values Optional array of values to bind to the query.
     * @return string
     */
    public static function findOne($sql, $values = [])
    {
        $sth = self::query($sql, $values);
        $row = $sth->fetchAll(\PDO::FETCH_ASSOC);

        return $row[0];
    }
}