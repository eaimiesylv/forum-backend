<?php


class Allerror extends \Exception{
    protected $message="";
    public function __construct($msg){
    $this->message=$msg;
    }
}