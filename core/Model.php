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

    public function prepare(string $SQL, array $data)
    {
        $sth = $this->db->prepare($SQL);
        return $sth->execute(array_values($data));
    }

    public function preFetch(string $SQL, array $data)
    {
        $sth = $this->db->prepare($SQL);
        if ($sth->execute(array_values($data))) {
            $sth->setFetchMode(PDO::FETCH_CLASS, Entity::class);
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
        return $this->preFetchAll($SQL, $filter);
    }

    public function getBy($key, $value, $table = NULL)
    {
        $table = $table != NULL ? $table : $this->table;
        $SQL = "SELECT * FROM $table WHERE $key = ?";
        return $this->preFetch($SQL, [$value]);
    }

    public function preFetchAll(string $SQL, array $data)
    {
        $sth = $this->db->prepare($SQL);
        if ($sth->execute(array_values($data))) {
            $sth->setFetchMode(PDO::FETCH_CLASS, Entity::class);
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
