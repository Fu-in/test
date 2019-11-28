<?php

class DB
{
    private static $_instance = null;
    private $_con, $_query, $_results, $_count;

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
            $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
            $this->_count = $this->_query->rowCount();
        }
        return $this;
    }

    public function action($action, $table, $where = [])
    {
        if (count($where) === 3) {
            $operators = ['<', '>', '<=', '>=', '='];

            $field = $where[0];
            $operator = $where[1];
            $value = $where[2];

            if (in_array($operator, $operators)) {
                $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";

                if ($this->query($sql, [$value])) {
                    return $this;
                }
            }

        }
    }

    public function get($table, $where)
    {
        return $this->action("SELECT *", $table, $where);
    }
    public function delete($table, $where)
    {
        return $this->action("DELETE", $table, $where);
    }

    public function insert($table, $fields = [])
    {

        $key = array_keys($fields);
        $col = implode(', ', $key);

        $value = '?';
        $x = 1;
        foreach ($fields as $field) {
            if ($x < count($fields)) {
                $value .= ', ?';
                $x++;
            }
        }

        $sql = "INSERT INTO users ($col) VALUES ($value)";
        if ($this->query($sql, $fields)) {
            return true;
        }

    }

    public function count()
    {
        return $this->_count;
    }
}