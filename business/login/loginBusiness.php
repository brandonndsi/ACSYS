<?php

  class loginBusiness{
    //Variable that stores the class
    private $loginData;

    function __construct(){
      //Import the file loginData.php;
      require '../../data/login/loginData.php';
      //Initialize the class loginData;
      $this->loginData = new loginData();
    }
    //Method that starts session;
    function login($user, $password){
      return $this->loginData->login($user, $password);
    }
  }

 ?>
