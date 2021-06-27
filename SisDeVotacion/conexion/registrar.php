<?php 

include("db.php");

if (isset($_POST['register'])) {
    

		$mail = trim($_POST['correo']);
		$cadena_buscada = '@mail.udp.cl';
		

		
		$consulta2 = "SELECT * FROM usuarios WHERE mail='$mail' ";//esta consulta sirve para verificar si existe el usuario en la base de datos
		$resultado2 = mysqli_query($conn,$consulta2);

		if(!empty($resultado2->fetch_array())){
			include('../enviar_correo/recuperar_pass.php');
			header('Location:../index.php?fallo=usuario');
		}else{


			if(strpos($mail, $cadena_buscada)){
				
				$consulta = "INSERT INTO usuarios(mail, pass) VALUES ('$mail','')";
				$resultado = mysqli_query($conn,$consulta);
				include('../enviar_correo/recuperar_pass.php');

				
				
				if ($resultado) {
					//header('Location: ../');
					
				} else {
					?> 
					<h3 class="bad">¡Ups ha ocurrido un error!</h3>
					
				<?php
				}
			}else{
				header('Location:../index.php?fallo=mail');
			}
		}

        
        
	    
      
    
}

?>