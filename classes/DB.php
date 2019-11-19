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

    public function actions($action, $table, $where = [])
    {
        if (count($where) === 3) {
            $operators = ['=', '<', '>', '<=', '>='];

            $field = $where[0];
            $operator = $where[1];
            $value = $where[2];

            if (in_array($operator, $operators)) {
                $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";

                if ($this->query($sql, [$value])) {
                    return $this;
                }
            }
            return $this;
        }
    }

    public function get($table, $where)
    {
        return $this->actions("SELECT *", $table, $where);
    }

    public function delete($table, $where)
    {
        return $this->actions("DELETE", $table, $where);
    }

    public function insert($table, $fields = [])
    {

        $keys = array_keys($fields);
        $col = implode(', ', $keys);
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

    public function update($table, $id, $fields)
    {
        $set = '';
        $x = 1;

        foreach ($fields as $name => $value) {
            $set .= "{$name} = ?";
            if ($x < count($fields)) {
                $set .= ', ';
            }
            $x++;
        }
        // die($set);

        $sql = "UPDATE {$table} SET {$set} WHERE id = {$id}";
        // echo $sql;

        if (!$this->query($sql, $fields)->error()) {
            return true;
        }
        return false;
    }

    public function results()
    {
        return $this->_results;
    }

    public function first()
    {
        return $this->results()[0];
    }

    public function count()
    {
        return $this->_count;
    }

}