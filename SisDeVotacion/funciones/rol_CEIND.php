<?php
  session_start();
  $Id_Usuario=$_SESSION['ID_Usuario'];
  if(!isset($_SESSION['ID_Usuario'])){
    header('location: index.php');
  }else{
    if($Id_Usuario != 3 && $Id_Usuario != 20){
      header('location: menu_estudiante.php');
    }
  }
?>