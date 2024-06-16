<?php
class Orm{
    protected $table;
    protected $db;

    function __construct($table,PDO $conn){
        $this->table = $table;
        $this->db = $conn;
    }


    function insert($data){
        $sql = "INSERT INTO {$this->table} (";
        foreach($data as $key=>$value){
            $sql.="{$key},";
        }

        $fin=strrpos("$sql",",");
        $sql=substr($sql,0,$fin);
        $sql.=") VALUES (";

        foreach($data as $key=>$value){
            $sql.="{$value},";
        }

        $fin=strrpos("$sql",",");
        $sql=substr($sql,0,$fin);
        $sql.=")";

        $stm = $this->db->prepare($sql);

        $succes = false;
        try{
            $succes = $stm->execute();
        }catch(PDOException $ex){
            echo $ex->getMessage();
        }

        return $succes;

    }

    function getAllUsers(  ){

        $sql="SELECT user, rol FROM {$this->table} ORDER BY rol DESC";
        $stm = $this->db->prepare($sql);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    function getInfoByUser( $user ){

        $sql="SELECT * FROM {$this->table} WHERE user='{$user}'";
        $stm = $this->db->prepare($sql);
        $stm->execute();
        return $stm->fetch(PDO::FETCH_ASSOC);
    }


    
    function updateInfoByUser( $user, $data ){

        $sql="UPDATE {$this->table} SET ";
        foreach($data as $key=>$value){
            $sql.="{$key} = :{$key}, ";
        }

        $fin = strrpos("$sql",",");
        $sql=substr($sql,0,$fin);
        $sql.=" WHERE user = :user";

        $data['user'] = $user;
        $stm = $this->db->prepare($sql);

        $succes = false;
        try{
            $succes = $stm->execute($data);
        }catch(PDOException $ex){
            echo $ex->getMessage();
        }

        return $succes;

    }

}
?>