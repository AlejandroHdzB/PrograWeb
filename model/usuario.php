<?php
class Usuarios extends Orm{
    function __construct(PDO $connection){
        parent::__construct('id','usuarios',$connection);
    }

    function getNombreAdmin() {
        $sql = "SELECT CONCAT(nombre, ' ', apellidos) AS nombreCompleto FROM usuarios WHERE rol = 'ADMIN'";
        $stm = $this->db->prepare($sql);
        $stm->execute();
        $result = $stm->fetch(PDO::FETCH_ASSOC);
        return $result['nombreCompleto'];
    }
    function validaLogin($data){
        $sql = "SELECT * FROM {$this->table} WHERE ".$data;
        $stm = $this->db->prepare($sql);
        try{
            $stm->execute();
        }catch(PDOException $ex){
            echo $ex->getMessage();
        }
        return $stm->fetch();
    }
}
?>