<?php
    session_start(); 
    $Id_Usuario=$_SESSION['ID_Usuario'];
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>RESULTADOS GRAFICA ESTUDIANTE</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <link rel="stylesheet" href="css/estilos_resultados_estudiante.css">
        
    </head>
    <?php include'conexion/db.php' ?>
    <?php $_GET['id'] ?>
    <body>

        <script src="js/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="main.js"></script>

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
                    <a href="#">Contacto</a>
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
                        <p><?php echo($mail); ?></p>
                    </a>  
                    <ul>
                        <li><a href="#">Cambiar contraseña</a></li>
                        <li><a href="todb.php?action=logout">Cerrar sesion</a></li>
                    </ul>
                </li>
            </ul>

        </nav>


        <div class="container">
        <?php
            $var=$_GET['id'];
	        $qry = $conn->query("SELECT * FROM votacion WHERE id=$var order by date(start_date) asc,date(end_date) asc ");
            $CantVotantes = $conn->query("SELECT COUNT(*) FROM estados WHERE id_votacion=$var and estado=1");
            while ($row = $CantVotantes->fetch_assoc()) {
                $votantes=$row['COUNT(*)'];
            }
            while($row= $qry->fetch_assoc()):

	    ?>
            <div class="row my-3">
                <div class="col-md-12 text-center">
                    <h2> <?php echo ucwords($row['title']) ?> <h2>
                </div>
            </div>        

            <div class="row">
                <div class="card text-dark bg-info mb-3" style="max-width: 18rem;">
                    <div class="card-header">Fecha</div>
                    <div class="card-body">
                        <h5 class="card-title"> <?php echo date("M d, Y",strtotime($row['end_date'])) ?> </h5>
                    </div>
                </div>

                <div class="card text-dark bg-info mb-3" style="max-width: 18rem;">
                    <div class="card-header">Votantes</div>
                    <div class="card-body">
                        <h5 class="card-title"> <?php echo $votantes ?> </h5>
                        </div>
                </div>
                <div class="card text-dark bg-info mb-3" style="max-width: 18rem;">
                    <div class="card-header">Universo</div>
                    <div class="card-body">
                        <h5 class="card-title">45%</h5>
                        </div>
                </div>
            </div>
        <?php
            
	        $preguntas = $conn->query("SELECT * FROM preguntas WHERE id_votacion=$var");
            while($raw= $preguntas->fetch_assoc()):

	    ?>
        <?php
            $data = array(); // Array donde vamos a guardar los datos
            $id_pregunta=$raw['id_pregunta'];
	        $opciones = $conn->query(" SELECT nombre FROM opciones WHERE idVotacion=$var and idPregunta=$id_pregunta ");
            while($rew= $opciones->fetch_assoc()):
                $data[]=$rew['nombre']; // Guardar los resultados en la variable $data

	    ?>
        <?php endwhile; ?>
        <?php
            $votos = array(); // Array donde vamos a guardar los datos
            foreach($data as $d):
                $CountVotos = $conn->query(" SELECT COUNT(*) FROM respuestas WHERE id_votacion=$var and id_pregunta=$id_pregunta and respuesta='$d' ");
                if($CountVotos){
                    while($ruw= $CountVotos->fetch_assoc()):
                        $votos[]=$ruw['COUNT(*)']; 
                    endwhile;
                    
                }
                else{
                    $votos[]=0;
                }
            endforeach; 
	    
	    ?>
            <div class="row my-3">
                <div class="col-md-12 text-center">
                    <h2> <?php echo $raw['pregunta'] ?>  <h2>
                    <canvas id="<?php echo $raw['id_pregunta'] ?>" width="200" height="150"></canvas>
                </div>
            </div>
            <script src="js/js_resultado_estudiante.js"></script>
            <script>
                let grafica_<?php echo $raw['id_pregunta'] ?>=document.getElementById("<?php echo $raw['id_pregunta'] ?>").getContext("2d");

                var chart = new Chart(grafica_<?php echo $raw['id_pregunta'] ?>,{
                    type:"bar",
                    data:{
                        labels:[        
                            <?php foreach($data as $d):?>
                            "<?php echo $d?>", 
                            <?php endforeach; ?>
                            ],
                        datasets:[
                            {
                                label:"Cantidad de votos",
                                backgroundColor:"rgb(62, 185, 193)",
                                data:[
                                    <?php foreach($votos as $v):?>
                                    <?php echo $v;?>, 
                                    <?php endforeach; ?>
                                ]

                            }
                        ]
                    }

                
                })


            </script>



            <?php endwhile; ?>
        <?php endwhile; ?>



        </div>


 


        
        


        
    </body>
</html>