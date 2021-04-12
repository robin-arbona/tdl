<?php

namespace core;

use Exception;
use PDO;

class Model
{
    protected $db;
    protected $host = 'localhost';
    protected $login = 'root';
    protected $dbname = 'tdl';
    protected $password = '';
    protected $table;
    protected $port = '3306';
    //protected $login = 'web-user';
    //protected $dbname = 'robin-arbona_tdl';
    //protected $password = 'web-user-o8GBhuzo';

    public function __construct()
    {
        try {
            $db = new PDO("mysql:host={$this->host};port={$this->port};dbname={$this->dbname}", $this->login, $this->password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            die($e->getMessage());
        }
        $this->db = $db;
        $this->table = $this->getTableName();
    }

    public function add(array $data, $table = NULL)
    {
        $table = $table != NULL ? $table : $this->table;
        $SQL = "INSERT INTO $table (" . implode(",", array_keys($data)) . ') VALUES (' . implode(',', array_fill(0, count($data), '?')) . ')';
        return $this->prepare($SQL, $data);
    }

    public function update(array $data, $table = NULL)
    {
        $table = $table != NULL ? $table : $this->table;
        $SQL = "UPDATE $table SET ";
        $lastKey = array_key_last($data);
        foreach ($data as $key => $value) {
            $SQL .= $key == $lastKey ? "$key=? WHERE id={$data['id']} " : "$key=?, ";
        }
        return $this->prepare($SQL, $data);
    }

    public function search(string $keyword, string $tableField, $table = NULL)
    {
        $data = ["keyword" => $keyword];
        $table = $table != NULL ? $table : $this->table;
        $SQL = "SELECT * FROM $table WHERE LOCATE( ?, $tableField)";
        return $this->preFetchAll($SQL, $data);
    }

    public function prepare(string $SQL, array $data)
    {
        $sth = $this->db->prepare($SQL);
        return $sth->execute(array_values($data));
    }

    public function preFetch(string $SQL, array $data, $table = Null)
    {
        $sth = $this->db->prepare($SQL);
        if ($sth->execute(array_values($data))) {
            $className = class_exists('entity\\' . $table . 'Entity') ? 'entity\\' . $table . 'Entity' : 'core\Entity';
            $sth->setFetchMode(PDO::FETCH_CLASS, $className);
            return $sth->fetch();
        } else {
            return false;
        }
    }

    /**
     * Returen a array of object matching to all table, filter available
     * @param array $filter ['key'=>'value'] : SELECT * FROM table WHERE key = value
     */
    public function getAll($filter = [], $table = NULL)
    {
        $table = $table != NULL ? $table : $this->table;
        $SQL = "SELECT * FROM $table";
        if (!empty($filter) && (count($filter) == 1)) {
            $key = implode('', array_keys($filter));
            $SQL .= ' WHERE ' . $key . ' = ?';
        } elseif (!empty($filter) && (count($filter) != 1)) {
            return false;
        }
        return $this->preFetchAll($SQL, $filter, $table);
    }

    public function getBy($key, $value, $table = NULL)
    {
        $table = $table != NULL ? $table : $this->table;
        $SQL = "SELECT * FROM $table WHERE $key = ?";
        return $this->preFetch($SQL, [$value], $table);
    }

    public function execute($SQL, $data)
    {
        $sth = $this->db->prepare($SQL);
        return $sth->execute(array_values($data));
    }

    public function remove($key, $value, $table = NULL)
    {
        $table = $table != NULL ? $table : $this->table;
        $SQL = "DELETE FROM $table WHERE $key = ?";
        return $this->execute($SQL, [$value], $table);
    }

    public function preFetchAll(string $SQL, array $data, $table = NULL)
    {
        $sth = $this->db->prepare($SQL);
        if ($sth->execute(array_values($data))) {
            $className = class_exists('entity\\' . $table . 'Entity') ? 'entity\\' . $table . 'Entity' : 'core\Entity';
            $sth->setFetchMode(PDO::FETCH_CLASS, $className);
            return $sth->fetchAll();
        } else {
            return false;
        }
    }

    public function getTableName()
    {
        $className = get_class($this);
        $pos = strpos($className, 'model\\') + 6;
        $table = '';
        for ($i = $pos; $i < strlen($className); $i++) {
            $table .= strtolower($className[$i]);
        }
        return ucfirst(str_replace('model', '', $table));
    }
}
