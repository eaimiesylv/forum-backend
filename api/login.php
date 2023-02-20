<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type:application/json");
header("Access-Control-Allow-Methods:POSTS");
header("Access-Control-Allow-Headers:Access-Control-Allow-Origin,Content-Type,Access-Control-Allow-Methods,Access-Control-Allow-Headers,Authorization");
/*$newuser= new User();
$validation= new Validation();

echo json_encode($newuser->getSelectAll());

echo json_encode($newuser->userSelect(['username','email']));

echo json_encode($newuser->userSelectId(['username','email'],['id'=>'19|']));

$validation->validate('users',['email'=>'unique|required|email'],['email'=>'peter@gmailcom']);

echo json_encode($newuser->insert('users', ['username'=>'peter2','email'=>'peter2@gmailcom','password'=>'test']));

*/