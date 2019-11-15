<?php

class DB
{
    private static $_instance = null;
    private $_con, $_query, $_results;

    private function __construct()
    {
        try {
            $this->_con = new PDO('mysql:host=' . Config::get('mysql/host') . ';dbname=' . Config::get('mysql/dbname'),
                Config::get('mysql/username'), Config::get('mysql/password'));
        } catch (PDOException $e) {
            die($e->getMessage());
        }

    }

    public function getInstance()
    {
        if (!self::$_instance) {
            self::$_instance = new DB();
        }
        return self::$_instance;
    }

    public function query($sql, $params = [])
    {
        if ($this->_query = $this->_con->prepare($sql)) {
            $x = 1;
            if (count($params)) {
                foreach ($params as $param) {
                    $this->_query->bindValue($x, $param);
                    $x++;
                }
            }
        }
        if ($this->_query->execute()) {
            return $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);

        }

    }

}