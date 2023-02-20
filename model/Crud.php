<?php
require_once ('../config/Connection.php');


class Crud{

    public $pdo;
    public $query_result;
    public function __construct(){
       //instantiate pdo connection
        $pd=new Connection();
        $this->pdo=$pd->getInstance();
    }
    /*
        expected data format
        insert('users', ['username'=>'peter2','email'=>'peter2@gmailcom','password'=>'test']);
    */
    public function insert($table, array $col_val){
        
        $key=array_keys($col_val);
        $columns=implode(",",$key);
        $tbl_parameter="";
        $tbl_value=array();
        foreach($key as $val){
            $tbl_parameter.="?,";
            $realval=$col_val[$val];
            if($val == 'password'){
                $realval=password_hash($realval,PASSWORD_DEFAULT);
            }
            array_push($tbl_value,$realval);
          
        }
        $tbl_parameter_binding=rtrim($tbl_parameter,",");
        $query="insert into $table($columns) values($tbl_parameter_binding)";
        $this->prepare_execute($query,$tbl_value);
        echo json_encode('insertion successful');
       
        
    }
   
    public function selectAll(string $table){
       
        $query="select * from $table";
        $query=$this->prepare_execute($query);
        return $query->fetchAll();
    }
    //implode select fields
    public function generalCustomSelect(string $table, array $fields=[]){
        $fields= implode(',',$fields);
        $query="select $fields from $table";
        return $query;
    }

     /*
        expected data format
        customSelectAll('user',['username','email']));
    */
    public function customSelectAll(string $table, array $value=[]){
        $q=$this->generalCustomSelect($table,$value);
        $query=$this->prepare_execute($q);
        return $query->fetchAll();
    }
   
    /**expected data format table,fields, field=>value|clause
     * findbyId('user',  ['username','email'],  ['id'=>'19|and','email'=>'peter@gmailcom|']));
     */
    public function findbyid(string $table, array $tbl_col=[], array $whereVal){
       //generate custom columns
        $q=$this->generalCustomSelect($table,$tbl_col);
        $key=array_keys($whereVal);
         $q.=" where";
       $whereValue=array();
        foreach($whereVal as $key=>$value){
           $clauses=explode('|',$value);//set parameter bindings on where clause.clauses[1] is for other clause e.g and, or
           $q.=" $key = ? $clauses[1] ";
           array_push($whereValue,$clauses[0]);  
        }
        $query=$this->prepare_execute($q,$whereValue);
        return $query->fetchAll();
      
    }
    
    public function prepare_execute($q,array $value=[]){
        $sql=$this->pdo->prepare($q);
        $sql->execute($value);
        return $sql;
 
    }
   
}



