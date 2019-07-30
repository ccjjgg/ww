<?php
class DB{
    private $dbh;
    public function __construct($host,$dbname,$user,$pass)
    {
        $this->dbh = new PDO('mysql:host=$host;dbname=$dbname', $user, $pass);
        $this->dbh->exec("set names utf8");
    }

    public function getOne($table)
    {
        $sql = "select * from $table";
        $stmt = $this->dbh->query($sql);
        return $stmt->fetch(2);
    }
    public function getAll($table)
    {
        $sql = "select * from $table";
        $stmt = $this->dbh->query($sql);
        return $stmt->fetchAll(2);
    }
    public function del($table,$where)
    {
        $sql = "delete from $table where $where";
        return $this->dbh->exec($sql);
    }
    public function up($table,$name,$where)
    {
        $sql = "update set $table name='$name' where $where";
        return $this->dbh->exec($sql);
    }
    public function insert($sql)
    {
        return $this->dbh->exec($sql);
    }
}