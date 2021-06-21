<?php
  include 'funciones/rol_estudiante.php'
?>
<?php include 'conexion/db.php' ?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>RESULTADOS ESTUDIANTE</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <link rel="stylesheet" href="css/estilos_resultados_estudiante.css">
        
    </head>
    <body>

        <script src="js/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script sec="main.js"></script>
	
		<?php include 'navEstudiante.php' ?>


<div class = "container">
	<div class="col-md-8 mx-auto  container-fluid ">
		<div id="msg"></div>
		
		<form action="" id="manage-user">	
			<input type="hidden" name="id" value="<?php echo($Id_Usuario);?>">

			<div class="form-group">
				<label for="password">Nueva Contraseña</label>
				<input type="password" name="password" id="password" class="form-control" >
			</div>
			
			<div class="m-2">
                <button   class="btn btn-primary mr-2">Guardar</button>
                            
            </div>

		</form>
	</div>
</div>



</body>
</html>
<script>
	
	$('#manage-user').submit(function(e){
		e.preventDefault();
		$.ajax({
			url:'todb.php?action=update_user',
			method:'POST',
			data:$(this).serialize(),
			success:function(resp){
				console.log(resp);
				if(resp ==1){
					//alert_toast("Data successfully saved",'success')
					setTimeout(function(){
						location.reload()
					},1000)
				}else if (resp == 2 ){
					$('#msg').html('<div class="alert alert-danger">Ingrese contraseña</div>')

				}
				else {
					$('#msg').html('<div class="alert alert-danger">Error</div>')
				}
			}
		})
	})

</script>






