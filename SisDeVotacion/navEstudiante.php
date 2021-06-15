
<nav>
            
            <div class="logo_CEIND">
                <img src="img/logo_CEIND.jpg" alt="logo_CEIND">
            </div>
            <ul class="nav-links">
                <li>
                    <a href="menu_estudiante.php">Votaciones</a>
                </li>

                <li>
                    <a href="resultados_estudiante.php">Resultados</a>
                </li>

                <li>
                     <a href="#">Contacto </a> 
                </li>

                <li>                
                <?php

                    //Usario
                    $estado = $conn->query("SELECT mail FROM usuarios WHERE ID=$Id_Usuario"); 
                    while ($raw = $estado->fetch_assoc()) {
                        $mail =  $raw['mail'];
                    }
                ?>                    
                    <a href="#">
                        <img src="img/img_perfil.png" alt="imgPerfil">  
                        <b>ESTUDIANTE</b>
                        <p> <?php echo($mail); ?> </p>
                    </a>  
                    
                    <ul>
                        <li><a href="perfil.php">Cambiar contraseña</a></li>
                        <li><a href="todb.php?action=logout">Cerrar sesion</a></li>
                    </ul>
                </li>
            </ul>
            <div class="burger">
                <div class="linea1"></div>
                <div class="linea2"></div>
                <div class="linea3"></div>
            </div>
        </nav>