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
    
}
?>