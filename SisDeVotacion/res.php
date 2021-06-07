<?php
  include 'funciones/rol_estudiante.php'
?>

<?php include 'conexion/db.php' ?>
<?php 
$qry = $conn->query("SELECT * FROM votacion where id = ".$_GET['id'])->fetch_array();
foreach($qry as $k => $v){
	if($k == 'title')
		$k = 'stitle';
	$$k = $v;
}

?>
<html>
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Menu Estudiante</title>
        <link rel="stylesheet" href="css/estilos_menuCEIND.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	</head>
    <body>
        
	<?php include 'navEstudiante.php' ?>

		<!-- VERIFICA SI LA ENCUESTA YA SE CONTESTO  -->
		<?php 
		$fechaActual = date('Y-m-d'); 
		$i = 0;
		
		$id_votacion= $id;
		$estado = $conn->query("SELECT estado FROM estados WHERE id_votacion= $id_votacion and id_usuario= $Id_Usuario"); 
		while ($raw = $estado->fetch_assoc()) {
		   $estadoUsuario =  $raw['estado'];
		}		
		?>

<div class="container">

		<div class="col-md-8 mx-auto">
			<div class="card card-outline card-success">

			<?php if ($fechaActual < $start_date  || $fechaActual > $end_date):  ?>
				<div class = "mx-auto p-5">
			<h3 ><b>Votacion fuera de la fecha permitida :)</b></h3>
				</div>

			<?php elseif ( $estadoUsuario == '0' ): ?>
				<div class = "mx-auto p-5">
					<h3 ><b><?php echo $stitle ?></b></h3>
				</div>
				<form action="" id="manage-survey">
					<input type="hidden" name="id_votacion" value="<?php echo $id ?>">
				<div class="card-body ui-sortable m-3 ">
					<?php 
					$question = $conn->query("SELECT * FROM preguntas where id_votacion = $id ");
					while($row=$question->fetch_assoc()):	
					?>
					
					<div class="callout callout-info">
						<h5><?php echo $row['pregunta'] ?></h5>	
						<div class="col-md-12">
			            <input type="hidden" name="qid[<?php echo $row['id_pregunta'] ?>]" value="<?php echo $row['id_pregunta'] ?>">
						<input type="hidden" name="type[<?php echo $row['id_pregunta'] ?>]" value="<?php echo $row['type'] ?>">	
						<?php
							
							if($row['type'] == 'radio_opt'):
							
							$pregunta = $row['id_pregunta'];
							$opciones = $conn->query("SELECT * FROM opciones where idVotacion = $id  and idPregunta = $pregunta");
							while($op=$opciones->fetch_assoc()):
								$i++;	
						?>
							<div class="icheck-primary"> 
								<input type="radio" id="option_<?php echo $i ?>" name="answer[<?php echo $row['id_pregunta'] ?>]" value="<?php echo $op['nombre']?>" >						
								<label for="option_<?php echo $i ?>"><?php echo $op['nombre']  ?></label>
							</div>
						<?php endwhile; ?>
						<?php elseif($row['type'] == 'check_opt'): 
						
						$pregunta = $row['id_pregunta'] ;
						$opciones = $conn->query("SELECT * FROM opciones where idVotacion = $id  and idPregunta = $pregunta");
						while($op=$opciones->fetch_assoc()):	
							$i++;
						?>
							<div class="icheck-primary"> 
								<input type="checkbox" id="option_<?php echo $i ?>" name="answer[<?php echo $row['id_pregunta'] ?>][]" value="<?php echo $op['nombre']?>" >
								<label for="option_<?php echo $i ?>"><?php echo $op['nombre']  ?></label>
							</div>
						<?php endwhile; ?>
						<?php else: ?>
							<div class="form-group">
								<textarea name="answer[<?php echo $row['id_pregunta'] ?>]" id="" cols="30" rows="4" class="form-control" placeholder="..." ></textarea>
							</div>
						<?php endif; ?>
						</div>	
					</div>
					<?php endwhile; ?>
				</div>
				</form>
				<div class="card-footer border-top border-success">
					<div class="d-flex w-100 justify-content-center">
						<button class="btn btn-sm btn-flat bg-gradient-primary mx-1" form="manage-survey">Submit Answer</button>
						<button class="btn btn-sm btn-flat bg-gradient-secondary mx-1" type="button" onclick="location.href = 'index.php?page=survey_widget'">Cancel</button>
					</div>
				</div>
			</div>
		</div>
	</div>

	
	
	<!-- EN CASO QUE HAYA CONTESTADO LA PREGUNTA -->
	<?php else: ?>
		<div class = "mx-auto p-5">
			<h3 ><b>Votacion realizada </b></h3>
		</div>
    <?php endif; ?>

</div>
<?php include 'footer.php' ?>
<script>
	$('#manage-survey').submit(function(e){
		e.preventDefault()

		console.log($(this).serialize());
		$.ajax({
			url:'todb.php?action=save_answer',
			method:'POST',
			data:$(this).serialize(),
			success:function(resp){
				console.log(resp);
				if(resp == 1){
					setTimeout(function(){
						location.href = 'menu_estudiante.php'
					},2000)
				}
				if(resp == 0 ){
					swal.fire({
						title: "No se puede realizar esta acción",
						scrollbarPadding: false
					})
				}
			}
		})
	})
</script>


