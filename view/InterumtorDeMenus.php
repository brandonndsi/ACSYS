<?php 

session_start();

if (@!$_SESSION['user']) {
             header('Location: ../../index.php');
            
            
        } else {
           $dato=$_SESSION['tipo'];
            if($dato!='Administrador'){
           	include_once 'menuCliente.php'; 
            }else{
               include_once 'menuView.php';
            }
        }
 
 ?>