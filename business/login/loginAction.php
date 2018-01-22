<?php
  // Import the file loginBusiness.php
  require_once 'loginBusiness.php';
  //We received the password and user;
  $password = $_POST['password'];
  $user = $_POST['user'];

  //Initialize the class loginBusiness;
  $loginBusiness = new loginBusiness();

  //Invoke the method login that is in the class loginBusiness and send the parameters ;
  echo $loginBusiness->login($user, $password);

 ?>
