<?php
class Orm{
    protected $table;
    protected $db;

    function __construct($table,PDO $conn){
        $this->table = $table;
        $this->db = $conn;
    }
    

    function updateById($id, $data){
        $sql = "UPDATE {$this->table} SET";
        foreach ($data as $key => $value){
            $sql .= " {$key} = :{$key},";
        }
    
        $sql = rtrim($sql, ",");
        $sql .= " WHERE id = :id";
    
        $data['id'] = $id;
        $stm = $this->db->prepare($sql);
    
        $success = false;
    
        try {
            $success = $stm->execute($data);
        } catch(PDOException $ex) {
            echo $ex->getMessage();
        }
    
        return $success;
    }

}
?>