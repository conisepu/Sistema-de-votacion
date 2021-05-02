<?php 
session_start(); 

include("db.php");

if (isset($_POST['login'])) {
        
	    $correo = trim($_POST['user']);
        $pass = trim($_POST['pass']);
	    $consulta = "SELECT pass, ID FROM usuarios.usuarios WHERE mail='$correo'";
        $hash = mysqli_query($conn,$consulta);
        $filas=mysqli_num_rows($hash);
        if($filas<1){
            echo('asdasdasd');
            header('Location:../index.php?fallo=true');
        }
        
        while($hash2= $hash->fetch_assoc()){
                            
                if (password_verify($pass, $hash2['pass'])) {
                    $contrass=$hash2['pass'];
                    $ID_Usuario=$hash2['ID'];
                    echo '¡La contraseña es válida!';
                    $consulta = "SELECT * FROM usuarios.usuarios WHERE mail='$correo' and pass='$contrass'"; //verifica si la contraseña y pass estan bien puestas
                    $resultado = mysqli_query($conn,$consulta);
                
                    $filas=mysqli_num_rows($resultado);
                
                    if($filas>0){
                        
                        if($correo=='ceind@mail.udp.cl'){
                            header('Location: ../menu_CEIND.php');
                        }                        
                        else{
                            header('Location: ../menu_estudiante.html');

                        }
                        
        
                    }
        
        
        
        
                }else {
                    header('Location:../index.php?fallo=true');
                    
                    
                }
        }
        
        
    
}

?>

