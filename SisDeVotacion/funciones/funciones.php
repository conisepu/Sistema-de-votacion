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
	function logout(){
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		header("location:index.php");
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

			$saveh = $this->db->query("INSERT INTO historial_votacion ( title, accion, usuario, FECHA_REGISTRO) VALUES ('$title', 'Creacion de votacion', CURRENT_USER,NOW()) ");
			//se obtiene el id de $save 
			$idV = mysqli_insert_id($this->db);

			//se crea las referencias entre las encuestas y usuarios

			//SE OBTIENEN LOS CORREOS DE LOS ALUMNOS HABILITADOS PARA VOTAR 


			$correos = $this->db->query("SELECT CorreoUDP FROM sheet1;");
			while ($row = $correos->fetch_assoc()) {
				$estadoInicial ="";
				$correo_usuario =$row['CorreoUDP'];
				$estadoInicial =" id_votacion=$idV ";
				$estadoInicial .=",correo_alumno= '$correo_usuario'";
				$estado = $this->db->query("INSERT INTO estados set $estadoInicial");

				
			}
			
			
		}
		else{
			$titlemodify=$this->db->query("SELECT title FROM votacion where id = ".$id);
			while ($row = $titlemodify->fetch_assoc()) {
				$titlem=$row['title'];
			}
			$saveh = $this->db->query("INSERT INTO historial_votacion ( title, accion, usuario, FECHA_REGISTRO) VALUES ('$titlem', 'Edicion de votacion', CURRENT_USER,NOW()) ");
			$save = $this->db->query("UPDATE votacion set $data WHERE id = $id");
			

		}	
		if($save)
				return 1;
		
	}

	function delete_survey(){
		extract($_POST);
		$titledelete=$this->db->query("SELECT title FROM votacion where id = ".$id);
		while ($row = $titledelete->fetch_assoc()) {
			$titled=$row['title'];
		}
		$deleteh = $this->db->query("INSERT INTO historial_votacion ( title, accion, usuario, FECHA_REGISTRO) VALUES ('$titled', 'Eliminacion de votacion', CURRENT_USER,NOW()) ");
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

			if(empty($id)){
				$save = $this->db->query("INSERT INTO preguntas set $data");
			}else{
				$type_before = $this->db->query("SELECT * FROM opciones where idPregunta = ".$id);
				// SIGNIFICA QUE TENIA OPCIONES , SE PROCEDE A BORRARLAS
				if(mysqli_num_rows($type_before) > 0) {
					$opciones = $this->db->query(" DELETE FROM opciones  where idPregunta = ".$id);
					$save = $this->db->query("UPDATE preguntas set $data where id_pregunta = $id");
				}
				// SIGNIFICA QUE ERA UNA UNA PREGUNTA DE TEXTO Y SE MODIFICA LA PREGUNTA
				else{
					$save = $this->db->query("UPDATE preguntas set $data where id_pregunta = $id");
				}
			}
		}


		else{
			$data = " id_votacion=$id_votacion ";
			$data .= ", pregunta='$pregunta'";
			$data .= ", type='$type'";
			// SE ESTA CREANDO UNA NUEVA PREGUNTA
			if(empty($id)){
				$save = $this->db->query("INSERT INTO preguntas set $data");

				$idP =  mysqli_insert_id($this->db);
	
				//OPCIONES MULTIPLE 
	
				foreach ($opcion as $k => $v) {
					$data = "";
					$data = " idVotacion=$id_votacion ";
					$data .= ",idPregunta=$idP";
					$data .= ",nombre='$v'";
					
					$opcion = $this->db->query("INSERT INTO opciones set $data");
				}
	
				if($opcion) {
					return 1;
				}
			}
			// SE ESTA ACTUALIZANDO UNA PREGUNTA 
			else{
				// SE PROCEDE A BORRAR LAS ANTERIORES PARA VOLVER A SUBIR LAS ACTUALIZADAS
				$opciones = $this->db->query(" DELETE FROM opciones  where idPregunta = ".$id);
				$save = $this->db->query("UPDATE preguntas set $data where id_pregunta = $id");

				//SE INSERTAN LAS NUEVAS OPCIONES 
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

		}
			
		if($save){
			return 1;
		}
		else{
			return(-1);
		}
		
	}
	function delete_question(){
	extract($_POST);
	$opciones = $this->db->query(" DELETE FROM opciones where idPregunta =".$id);
	$delete = $this->db->query("DELETE FROM preguntas where id_pregunta = ".$id);
	if($delete){
		return 1;
	}
	else{
		return -1;
	}
	
	}

	function save_answer(){
		extract($_POST);
		$Id_Usuario=$_SESSION['ID_Usuario'];
		$fechaActual = date('Y-m-d'); 
		$fechas = $this->db->query("SELECT  start_date, end_date FROM votacion WHERE id= $id_votacion");
		$correo = $this->db->query("SELECT mail FROM usuarios WHERE  ID = $Id_Usuario");
		while ($r = $correo->fetch_assoc()) {
			$correo_Alumno=$r['mail'];
		}
		$estado =  $this->db->query("SELECT estado FROM estados WHERE id_votacion= $id_votacion and correo_alumno= '$correo_Alumno'");
		while ($row = $estado->fetch_assoc()) {
			$estadoUsuario=$row['estado'];       
		}
		while ($raw = $fechas->fetch_assoc()) {
			$start_date = $raw['start_date'];
			$end_date=$raw['end_date'];
		}
		
		if ($fechaActual < $start_date  || $fechaActual > $end_date) {
			return 0;
		}
		elseif($estadoUsuario == '0') {
				foreach($qid as $k => $v){
					//$qid[$k] es el id de la pregunta 
					$data = " id_votacion=$id_votacion ";
					$data .= ", id_pregunta=$qid[$k]" ;
					
					// //$data .= ", user_id='{$_SESSION['login_id']}' ";
					
					if($type[$k] == 'check_opt'){
					$data .= ", respuesta='[".implode("],[",$answer[$k])."]' ";
					}else{
						$data .= ", respuesta='$answer[$k]' ";
					}
					$save[] = $this->db->query("INSERT INTO respuestas set $data");
					
				}
						
				
			if(isset($save)){
				//actualizar el estado de la pregunta 
				
				//$estado = "id_usuario=$Id_Usuario";
				$estado = "estado=1";
				
				$nuevoEstado = $this->db->query("UPDATE estados set $estado  WHERE id_votacion= $id_votacion and correo_alumno= '$correo_Alumno'");
				//$estado = "UPDATE estados set $estado WHERE id_votacion = $id_votacion";
				return 1;
			}
		}
		else {
			return 0;
		}
	}

	function votacion_estado(){
		extract($_POST);
		if(isset($estado_votacion)) {
			$data = "estado_votacion=$estado_votacion";	
		}
		else {
			$data= "estado_votacion=0";
		}

		$update = $this->db->query("UPDATE votacion set $data WHERE id = $id ");

		if($update) {
			return 1;
		}
		
		}

	function grafico_estado(){
			extract($_POST);
			if(isset($estado_grafico)) {
				$data = "estado_grafico=$estado_grafico";	
			}
			else {
				$data= "estado_grafico=0";
			}
	
			$update = $this->db->query("UPDATE votacion set $data WHERE id = $id ");

			if($update) {
				return 1;
			}
			return $data;
			
			}


	function update_user(){
			extract($_POST);
			
			if(empty($password)) {			
				return 2;		
			}
			else {
				$consulta_hash= $this->db->query("SELECT pass FROM usuarios WHERE ID=$id");
				while ($row = $consulta_hash->fetch_assoc()) {
					$hash_antiguo=$row['pass'];
				}

				//verifica que las contraseñas coincidan 
				if(password_verify($password_antigua, $hash_antiguo)) {
					$hash = password_hash($password, PASSWORD_BCRYPT);
					$data = "pass = '$hash'";
					$update = $this->db->query("UPDATE usuarios set $data WHERE ID=$id"); 
					return 1;
				}
				else {
					return 3;
				}
				

			}


		}


}