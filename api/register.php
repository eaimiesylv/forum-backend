<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json');
header('Access-Control-Allow-Methods:POST');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

require_once("../model/Crud.php");
require_once("../model/Validation.php");
require_once("../model/Allerror.php");

if(empty($_POST)){
  try{
    throw new Allerror('Empty Post request');
  }catch(Allerror $e){
    http_response_code(401);
    echo json_encode($e->getMessage());
     exit();
  }
}
/*
$data = json_decode(file_get_contents("php://input"));
print_r($data); 
$username= $fdata->username;
$email =   $data->email;
$password =  $data->password;*/
$username= $_POST['username'];
$email =   $_POST['email'];
$password =  $_POST['password'];
//$data=["username"=>$username,"email"=>$email,"password"=>$password];

//data validation
$validate= new Validation();
$validate->Validator('users',[['username'=>"string|unique|required"],
                              ['email'=>"email|unique|required"],
                              ['password'=>"string|required"],
                            ],$_POST);


$newuser= new Crud();
echo json_encode($newuser->insert('users',$_POST));                 
 //class Registe
/*$newuser= new User();
$validation= new Validation();

echo json_encode($newuser->getSelectAll());

echo json_encode($newuser->userSelect(['username','email']));

echo json_encode($newuser->userSelectId(['username','email'],['id'=>'19|']));

$validation->validate('users',['email'=>'unique|required|email'],['email'=>'peter@gmailcom']);

e

*/