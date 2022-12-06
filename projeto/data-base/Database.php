<?php

class Database
{

  const SERVERNAME = '127.0.0.1';
  const DBNAME = 'swe';
  const USERNAME = 'root';
  const PASS = '';

  private $table;

  private $connection;

  public function __construct($table = null)
  {
    $this->table = $table;
    $this->setConnection();
  }

  private function setConnection()
  {
    $this->connection = new mysqli(self::SERVERNAME, self::USERNAME, self::PASS, self::DBNAME);
    if ($this->connection->connect_error) {
      die("Connection failed: " . $this->connection->connect_error);
    }
  }

  public function insert($values)
  {
    $fields = array_keys($values);
    $binds = array_pad($values, count($fields), '?');

    $query = 'INSERT INTO ' . $this->table . ' (' . implode(',', $fields) . ') VALUES (' . implode(',', $binds) . ')';

    $respInsert = $this->connection->query($query);
    $this->connection->close();

    if ($respInsert === TRUE) {
      return true;
    } else {
      return false;
    }

  }

  public function select($where = null, $order = null, $limit = null, $fields = '*')
  {
    $where = strlen($where) ? 'WHERE ' . $where : '';
    $order = strlen($order) ? 'ORDER BY ' . $order : '';
    $limit = strlen($limit) ? 'LIMIT ' . $limit : '';

    $query = 'SELECT ' . $fields . ' FROM ' . $this->table . ' ' . $where . ' ' . $order . ' ' . $limit;

    // echo $query;
    $result = $this->connection->query($query);
    $this->connection->close();
    return $result;
  }

  public function update($where, $values)
  {
    $s = implode(
      ', ',
      array_map(
        function ($k, $v) {
          return $k . ' = ' . $v;
        },
        array_keys($values),
        array_values($values)
      )
    );
    $query = 'UPDATE ' . $this->table . ' SET ' . $s . ' WHERE ' . $where;
    // echo $query;
    $respUpdate = $this->connection->query($query);
    $this->connection->close();
    if ($respUpdate === TRUE) {
      return true;
    } else {
      return false;
    }

  }

  public function delete($where)
  {
    $query = 'DELETE FROM ' . $this->table . ' WHERE ' . $where;
    // echo $query;
    $respDelete = $this->connection->query($query);
    $this->connection->close();
    if ($respDelete === TRUE) {
      return true;
    } else {
      return false;
    }
  }
}