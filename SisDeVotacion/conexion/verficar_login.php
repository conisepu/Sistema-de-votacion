<?php 
session_start();
include("db.php");

if(isset($_SESSION['ID_Usuario'])){
    switch($_SESSION['ID_Usuario']){
        case 3:
            header('location: lista.php');
        break;

        case 20:
            header('location: lista.php');
        break;


        default:
        header('location: menu_estudiante.php');
        break;
    }
}


if (isset($_POST['login'])) {
    ////////////////////////////////
    

    if(isset($_POST['user']) && isset($_POST['pass'])){
        $correo = trim($_POST['user']);
        $pass = trim($_POST['pass']);

        $consulta = "SELECT * FROM usuarios WHERE mail='$correo'";
        $tabla_usuarios = mysqli_query($conn,$consulta);
        $filas=mysqli_num_rows($tabla_usuarios);

        if($filas<1){
            echo('fallo...');
            header('Location:../index.php?fallo=true');
        }elseif($tabla_usuarios = $tabla_usuarios->fetch_assoc()){
            // validar rol
            $hash = $tabla_usuarios['pass'];
            //var_dump($hash);

            if(password_verify($pass, $hash)){
                $ID_Usuario=$tabla_usuarios['ID'];
                echo '¡La contraseña es válida!';
                
                $consulta = "SELECT * FROM usuarios WHERE mail='$correo' and pass='$hash'"; //verifica si la contraseña y pass estan bien puestas
                $resultado = mysqli_query($conn,$consulta);
                $filas=mysqli_num_rows($resultado);
                
                    if($filas>0){

                        $_SESSION['ID_Usuario'] = $ID_Usuario;

                        switch($_SESSION['ID_Usuario']){
                            case 3: //ID del CEIND
                                echo "entro al ceind";
                                header('location: ../lista.php');
                                break;
                            
                            case 20: //ID del tricel
                                echo "entro al tricel";
                                header('location: ../lista.php');
                                break; 

                            default:
                                echo "entro al estuduante";
                                header('location: ../menu_estudiante.php');
                                break;
                        }
                        
        
                    }
            }else {
                echo "contraseña incorrecta";
                header('Location:../index.php?fallo=true');
            }
            
        }

    }





    /*//////////////////////////////
        
	    $correo = trim($_POST['user']);
        $pass = trim($_POST['pass']);
	    $consulta = "SELECT pass, ID FROM usuarios WHERE mail='$correo'";
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
                    $consulta = "SELECT * FROM usuarios WHERE mail='$correo' and pass='$contrass'"; //verifica si la contraseña y pass estan bien puestas
                    $resultado = mysqli_query($conn,$consulta);
                
                    $filas=mysqli_num_rows($resultado);
                
                    if($filas>0){
                        $_SESSION['ID_Usuario']=$ID_Usuario;
                        if($correo=='ceind@mail.udp.cl'){
                            header('Location: ../lista.php');
                        }                        
                        else{
                            header('Location: ../menu_estudiante.php');

                        }
                        
        
                    }
        
        
        
        
                }else {
                    header('Location:../index.php?fallo=true');
                    
                    
                }
        }*/
        
        
    
}

?>

