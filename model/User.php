<?php
require_once ('Crud.php');
require_once ('validation.php');


class User extends Crud{
    public $con=null;
    private $table='users';
    private $field=[];
  

    public function getSelectAll(){
        return $this->selectAll($this->table);
    }

    public function userSelect(array $fields){
        return $this->customSelectAll($this->table,$fields);
    }

    public function userSelectId(array $fields, array $whereValue){
        return $this->findbyid($this->table,$fields, $whereValue);
    }
    
}
