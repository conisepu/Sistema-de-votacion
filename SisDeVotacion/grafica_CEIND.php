<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>RESULTADOS GRAFICA CEIND</title>
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
                    <a href="lista.php">Votaciones</a>
                </li>

                <li>
                    <a href="resultados_CEIND.php">Resultados</a>
                </li>

                <li>
                    <a href="Listas_Alumnos.html">Lista alumnos</a> 
                    
               </li>

                <li>
                    <a href="#">Tricel</a> 
               </li>


                <li>                    
                    <a href="#">
                        <img src="img/logo_CEIND.jpg" alt="imgPerfil">
                         Administrador CEIND
                    </a>
                    <ul>
                        <li><a href="#">Cambiar contraseña</a></li>
                    </ul>
                </li>
            </ul>
            <div class="burger">
                <div class="linea1"></div>
                <div class="linea2"></div>
                <div class="linea3"></div>
            </div>
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

            <div class="row my-3">
                <div class="col-md-12 text-center">
                    <h2> Pregunta 1  <h2>
                    <canvas id="MiGrafica" width="400" height="300"></canvas>
                </div>
            </div>

            <div class="row my-3">
                <div class="col-md-12 text-center">
                    <div id="idContTabla"></div>
                </div>
            </div>
        <?php endwhile; ?>



        </div>


 


        
        
        <script src="js/js_resultado_estudiante.js"></script>
        <script>
            let miCanvas=document.getElementById("MiGrafica").getContext("2d");

            var chart = new Chart(miCanvas,{
                type:"bar",
                data:{
                    labels:["Fernanda Montes","Bastian Sanchez","Eduardo Carrasco","Pedro Saez"],
                    datasets:[
                        {
                            label:"% de Votos",
                            backgroundColor:"rgb(62, 185, 193)",
                            data:[14,60,6,20]

                        }
                    ]
                }

            
            })
        </script>
        
    </body>
</html>