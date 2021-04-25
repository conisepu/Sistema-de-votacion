<?php
ob_start();
$action = $_GET['action'];
include 'funciones/funciones.php';
$crud = new Action();

if($action == "save_survey"){
	$save = $crud->save_survey();
	if($save)
		echo $save;
}

if($action == "save_question"){
	$save = $crud->save_question();
	if($save)
		echo $save;
}

if($action == "delete_question"){
	$delete = $crud->delete_question();
	if($delete)
		echo $delete;
}

if($action == "delete_survey"){
	$delete = $crud->delete_survey();
	if($delete)
		echo $delete;
}


ob_end_flush();


?>
