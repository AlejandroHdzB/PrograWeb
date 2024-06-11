<?php
class Productos extends Orm{
    function __construct(PDO $connection){
        parent::__construct('productos',$connection);
    }
}
?>