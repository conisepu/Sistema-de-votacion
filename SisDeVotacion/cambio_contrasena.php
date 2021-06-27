
<?php
  include 'funciones/rol_estudiante.php'
?>

<div class = "container">
	<div class="col-md-8 mx-auto  container-fluid ">
		<div id="msg"></div>
		
		<form action="" id="manage-user">	
			<input type="hidden" name="id" value="<?php echo($Id_Usuario);?>">

			<div class="form-group">
				<label for="password">Nueva Contraseña</label>
				<input type="password" name="password" id="password" class="form-control" >
			</div>

		</form>
	</div>
</div>

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
                        location.replace('menu_estudiante.php')
					},1000)
				}else if (resp == 2 ){
					$('#msg').html('<div class="alert alert-danger">Ingrese contraseña</div>')

				}
                else if (resp == 3) {
                    $('#msg').html('<div class="alert alert-danger">Error</div>')
                }
			}
		})
	})
</script>
   