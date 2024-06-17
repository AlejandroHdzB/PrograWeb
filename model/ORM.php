<?php
class Orm {
    protected $table;
    protected $db;
    protected $id;

    function __construct($id, $table, PDO $conn) {
        $this->id = $id;
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
    function insert($data) {
        // Construir la consulta SQL con los nombres de columnas
        $sql = "INSERT INTO {$this->table} (";
        foreach($data as $key => $value) {
            $sql .= "{$key},";
        }
    
        // Eliminar la última coma
        $fin = strrpos($sql, ",");
        $sql = substr($sql, 0, $fin);
        $sql .= ") VALUES (";
    
        // Añadir los marcadores de posición para los valores
        foreach($data as $key => $value) {
            $sql .= "?,";
        }
    
        // Eliminar la última coma
        $fin = strrpos($sql, ",");
        $sql = substr($sql, 0, $fin);
        $sql .= ")";
    
        // Preparar la consulta
        $stm = $this->db->prepare($sql);
    
        // Obtener los valores en el orden correcto
        $values = array_values($data);
    
        // Ejecutar la consulta y manejar errores
        $success = false;
        try {
            $success = $stm->execute($values);
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    
        return $success;
    }
    
    function getAll() {
        $sql = "SELECT * FROM {$this->table}";
        $stm = $this->db->prepare($sql);
        $stm->execute();
        return $stm->fetchAll();
    }

    function getById($id) {
        $sql = "SELECT * FROM {$this->table} WHERE id = :id";
        $stm = $this->db->prepare($sql);
        $stm->bindParam(':id', $id, PDO::PARAM_INT);
        $stm->execute();
        return $stm->fetch();
    }

    function deleteById($id){
        $succes=false;
        $sql="DELETE FROM {$this->table} WHERE id={$id}";
        $stm=$this->db->prepare($sql);
        $stm->execute();
        return $stm->fetch();
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
