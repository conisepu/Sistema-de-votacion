<?php
session_start();
ini_set('display_errors', 1);
Class Action {
	private $db;

	public function __construct() {
		ob_start();
   	include 'conexion/db.php';
    
    $this->db = $conn;
	}
	function __destruct() {
	    $this->db->close();
	    ob_end_flush();
	}

	function save_survey(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id')) && !is_numeric($k)){
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}

		if(empty($id)){
			$save = $this->db->query("INSERT INTO votacion set $data");
		}else{
			$save = $this->db->query("UPDATE votacion set $data WHERE id = $id");
		}
		
		if($save)
		return 1;
		
	}

	function delete_survey(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM votacion where id = ".$id);
		if($delete){
			return 1;
		}
		else{
			$opciones = $this->db->query("DELETE FROM opciones where idVotacion = ".$id);
			$preguntas = $this->db->query("DELETE FROM preguntas where id_votacion = ".$id);
			$delete = $this->db->query("DELETE FROM votacion where id = ".$id);
			if($delete) {
				return 1;
			}
			else{
				return -1;
			}
		}
		return -1 ;
		
	}
	

	function save_question(){
		extract($_POST);

		if ($_POST["type"] == 'textfield_s') {
			$data = "";
			foreach($_POST as $k => $v){
				if(!in_array($k, array('id')) && !is_numeric($k)){
					if(empty($data)){
						$data .= " $k='$v' ";
					}else{
						$data .= ", $k='$v' ";
					}
				}
			}
			$save = $this->db->query("INSERT INTO preguntas set $data");

		}
		else{
			$data = " id_votacion=$id_votacion ";
			$data .= ", pregunta='$pregunta'";
			$data .= ", type='$type'";
			$save = $this->db->query("INSERT INTO preguntas set $data");

			$id =  mysqli_insert_id($this->db);

			//OPCIONES MULTIPLE 

			foreach ($opcion as $k => $v) {
				$data = "";
				$data = " idVotacion=$id_votacion ";
				$data .= ",idPregunta=$id";
				$data .= ",nombre='$v'";
				$opcion = $this->db->query("INSERT INTO opciones set $data");
			}

			if($opcion) {
				return 1;
			}

		}
			
		if($save){
			return 1;
		}
		else{
			return($data);
		}
		
	}
	function delete_question(){
	extract($_POST);
	$opciones = $this->db->query(" DELETE FROM opciones where idPregunta = '".$ids[0]."' and idVotacion = '".$ids[1]."' ");
	
	$texto = "DELETE FROM preguntas where id_pregunta = ".$ids[0];
	$delete = $this->db->query("DELETE FROM preguntas where id_pregunta = ".$ids[0]);
	if($delete){
		return 1;
	}
	else{
		return -1;
	}
}


}