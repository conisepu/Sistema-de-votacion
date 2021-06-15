<?php
    
    session_start();

    if(isset($_GET['cerrar_sesion'])){
        session_unset(); 

        // destroy the session 
        session_destroy(); 
    }
    
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

    
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>login Votaciones</title>
        <link rel="stylesheet" href="css/estilos_index.css">
    </head>
    <body>
        <div class="contenedor-form">

            <div class="logo_CEIND">
                <img src="img/logo_CEIND.jpg" alt="logo_CEIND">
            </div>
            
            <div class="toggle">
                <span>Crear cuenta / Recuperar Contraseña</span>
            </div>

            <div class="formulario">
                <form action="conexion/verficar_login.php" method="post">
                    <input type="text" id="user" name="user" placeholder="Usuario" required>
                    <input type="password" id="pass" name="pass" placeholder="Contraseña" required>
                    <input type="submit" id="login" name="login" value="Iniciar Sesión" >
                    <?php
                        if(isset($_GET['fallo']) && $_GET['fallo'] == 'true'){
                            ?>
                                <div class="mensaje"><h4>Correo o Contraseña incorrectos</h4></div>
                            <?php
                        }
                        else if(isset($_GET['fallo']) && $_GET['fallo'] == 'mail'){
                            ?>
                                <div class="mensaje"><h4>Mail incorrecto</h4></div>
                            <?php
                        }else if(isset($_GET['fallo']) && $_GET['fallo'] == 'usuario'){
                            ?>
                                <div class="mensaje"><h4>El usuario ya existe</h4></div>
                            <?php
                        }
                    ?>
                </form>
            </div>
            <div class="formulario">
                
                <form action="conexion/registrar.php" method="post">
                    
                    <input type="email" name="correo" placeholder="Correo electronico" required>
                    
                    <input type="submit" name="register" value="Registrarse">

                
                </form>
            </div>

           

        </div>

        <script src="js/jquery-3.6.0.min.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>