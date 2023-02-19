<?php
require_once ('Allerror.php');
require_once ('Crud.php');

class Validation extends Crud{
    /**
     * validate('users',['username'=>'unique|required|string|image']);
     */
    public function validate($table=null,array $val=[], array $post_val=[]){
        foreach($val as $key=>$value){
            $check=explode('|',$value);
            foreach($check as $val){
                $value=$post_val[$key];
               
                if($val == 'unique'){
                  
                   $q="select * from $table where $key = ? ";
                   $result=$this->prepare_execute($q,[$value]);
                   if ($result->rowCount() > 0){

                        try{
                            throw new Allerror("This $key already exit");
                            
                        }catch(Allerror $e){
                            echo $e->getMessage();
                            echo "<br>";
                        }
                }   
               }
                if($val == 'email'){
                  
                   if (filter_var($value, FILTER_VALIDATE_EMAIL) === false)
                    try{
                        throw new Allerror("This $key is invalid");
                    }catch(Allerror $e){
                        echo $e->getMessage();
                    }
                }
                if($val == 'integer'){
                    if (is_int($value) === false)
                    try{
                        throw new Allerror("Integer value is expected");
                    }catch(Allerror $e){
                        echo $e->getMessage();
                    }
                }
                if($val == 'string'){
                    if (is_string($value) === false)
                    try{
                        throw new Allerror("String value is expected");
                    }catch(Allerror $e){
                        echo $e->getMessage();
                    }
                }
                if($val == 'image'){
                    $extension = pathinfo($value, PATHINFO_EXTENSION);
                    $imgEx=['jpg','jpeg','png'];
                    if(!in_array($extension, $imgEx))
                    try{
                        throw new Allerror("Image of type jpg, jpeg or png required");
                    }catch(Allerror $e){
                        echo $e->getMessage();
                    }
                }
            }
        }
    }
}