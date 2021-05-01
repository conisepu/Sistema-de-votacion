<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>RESULTADOS GRAFICA</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <link rel="stylesheet" href="css/estilos_resultados_estudiante.css">
        
    </head>
    <body>

        <script src="js/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script sec="main.js"></script>
    
        <nav>
            
            <div class="logo_CEIND">
                <img src="img/logo_CEIND.jpg" alt="logo_CEIND">
            </div>
            <ul class="nav-links">
                <li>
                    <a href="menu_estudiante.html">Votaciones</a>
                </li>

                <li>
                    <a href="resultados_estudiante.html">Resultados</a>
                </li>

                <li>
                     <a href="admin_CEIND.html">Administración</a>
                </li>

                <li>                
                      
                    <a href="#">
                        <img src="img/img_perfil.png" alt="imgPerfil">  
                        <b>ESTUDIANTE</b>
                        <p>Francisca Ramirez</p>
                    </a>  
                    <ul>
                        <li><a href="#">Cambiar contraseña</a></li>
                    </ul>
                </li>
            </ul>

        </nav>


        <div class="container">


            <div class="row">
                <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                    <div class="card-header">Fecha</div>
                    <div class="card-body">
                        <h5 class="card-title">23/04/2021</h5>
                    </div>
                </div>
                <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                    <div class="card-header">Votantes</div>
                    <div class="card-body">
                        <h5 class="card-title">239</h5>
                        </div>
                </div>
                <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                    <div class="card-header">Candidatos</div>
                    <div class="card-body">
                        <h5 class="card-title">4</h5>
                        </div>
                </div>
                <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                    <div class="card-header">Universo</div>
                    <div class="card-body">
                        <h5 class="card-title">45%</h5>
                        </div>
                </div>
            </div>

            <div class="row my-3">
                <div class="col-md-12 text-center">
                    <h2> TITULO DE LA VOTACION <h2>
                    <canvas id="idGrafica" class="grafica"></canvas>
            </div>

            <div class="row my-3">
                <div class="col-md-12 text-center">
                    <div id="idContTabla"></div>
                </div>
            </div>






        </div>

 


        
        
        <script src="js/js_resultado_estudiante.js"></script>
        
    </body>
</html>