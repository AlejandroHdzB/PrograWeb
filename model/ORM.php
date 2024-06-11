<?php
class Orm{
    protected $table;
    protected $db;

    function __construct($table,PDO $conn){
        $this->table = $table;
        $this->db = $conn;
    }

}
?>