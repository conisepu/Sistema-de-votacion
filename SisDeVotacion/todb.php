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

if($action == "save_answer"){
	$save = $crud->save_answer();
	if($save)
		echo $save;
}
if($action == 'logout'){
	$logout = $crud->logout();
	if($logout)
		echo $logout;
}

if($action == 'votacion_estado'){
	$update = $crud->votacion_estado();
	if($update)
		echo $update;
}
if($action == 'grafico_estado'){
	$update = $crud->grafico_estado();
	if($update)
		echo $update;
}

if($action == "update_user"){
	$update = $crud->update_user();
	if($update)
		echo $update;
}


ob_end_flush();


?>
