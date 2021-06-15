<nav>
            
            <div class="logo_CEIND">
                <img src="img/logo_CEIND.jpg" alt="logo_CEIND">
            </div>
            <ul class="nav-links">
                <li>
                    <a href="lista.php">Votaciones</a>
                </li>

                <li>
                    <a href="resultados_CEIND.php">Resultados</a>
                </li>

                <li>
                    <a href="lista_alumnos.php">Listas alumnos</a> 
                   
               </li>

                <li>
                    <a href="#">Tricel</a> 
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
                        <img src="img/logo_CEIND.jpg" alt="imgPerfil">
                        <b>Administrador</b>
                         <p> <?php echo($mail); ?> </p>
                    </a>

                    <ul>
                        <li><a href="#">Cambiar contraseña</a></li>
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