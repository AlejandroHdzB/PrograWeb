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
}
?>
