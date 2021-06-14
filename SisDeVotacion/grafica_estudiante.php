<?php
  include 'funciones/rol_estudiante.php'
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

        <?php include 'navEstudiante.php' ?>
        <!-- VERIFICA SI EL ALUMNO PERTENECE A LA LISTA  -->

        <?php
		$alumno_regular = $conn->query("SELECT RUT FROM alumnos_industrias INNER JOIN usuarios ON  alumnos_industrias.CorreoUDP =usuarios.mail WHERE usuarios.ID= $Id_Usuario");
        $situacion_regular = $alumno_regular->fetch_assoc();  
        ?>
        <?php if ( isset($situacion_regular['RUT']) ): ?>

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
        <?php if ($row['estado_grafico'] == '1'): ?>
            <div class="row my-3">
                <div class="col-md-12 text-center">
                    <h2> <?php echo ucwords($row['title']) ?> <h2>
                </div>
            </div>        

            <div class="row  d-flex justify-content-evenly ">
                <div class="card  mb-3" style="max-width: 18rem;">
                    <div class="card-header">Fecha</div>
                    <div class="card-body">
                        <h5 class="card-title"> <?php echo date("M d, Y",strtotime($row['end_date'])) ?> </h5>
                    </div>
                </div>

                <div class="card  mb-3" style="max-width: 18rem;">
                    <div class="card-header">Votantes</div>
                    <div class="card-body">
                        <h5 class="card-title"> <?php echo $votantes ?> </h5>
                        </div>
                </div>
                <div class="card  mb-3" style="max-width: 18rem;">
                    <div class="card-header">Universo</div>
                    <div class="card-body">
                        <?php
                            $EstudiantesTotales = $conn->query("SELECT * FROM sheet1 ");
                            $Total=mysqli_num_rows($EstudiantesTotales);       
                            if($EstudiantesTotales != '0'){
                                $universo = round(($votantes*100)/$Total, 2);
                            }
                            else{
                                $universo = 0;
                            }
                                               
                        ?>
                        <h5 class="card-title"><?php echo($universo)?>%</h5>
                        </div>
                </div>

            </div>
        <?php
            // PREGUNTAS 
	        $preguntas = $conn->query("SELECT * FROM preguntas WHERE id_votacion=$var");
            while($raw= $preguntas->fetch_assoc()):

	    ?>
        <?php
            //DESPLIEGUE DE LAS OPCIONES 
            $data = array(); // Array donde vamos a guardar los datos
            $id_pregunta=$raw['id_pregunta'];
	        $opciones = $conn->query(" SELECT nombre FROM opciones WHERE idVotacion=$var and idPregunta=$id_pregunta ");
            while($rew= $opciones->fetch_assoc()):
                $data[]=$rew['nombre']; // Guardar los resultados en la variable $data

	    ?>
        <?php endwhile; ?>
        <?php
            //CONTEO DE VOTOS SEGUN TIPO DE PREGUNTA 
            if ($raw['type'] == 'radio_opt' ){

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
            }
            elseif ($raw['type'] == 'check_opt') {

                $ans = array();
                $votos = array();
                $CountVotos = $conn->query(" SELECT * FROM respuestas WHERE id_votacion=$var and id_pregunta=$id_pregunta  ");
                while($ruw= $CountVotos->fetch_assoc()):
                    foreach(explode(",", str_replace(array("[","]"), '', $ruw['respuesta'])) as $v){
                        $ans[$ruw['id_pregunta']][$v][] = 1;
                        }
                endwhile;
                foreach($data as $d):
                    if ( isset($ans[$raw['id_pregunta']][$d]) ) {
                        $votos[]= count($ans[$raw['id_pregunta']][$d]);
                    }
                    else{
                        $votos[]=0;
                    }
                
                endforeach;    

            }
            //RESPUESTAS DE LAS PREGUNTAS EN FORMATO TEXO 
            else{

                $ans = array();
                $Respuestas = $conn->query(" SELECT * FROM respuestas WHERE id_votacion=$var and id_pregunta=$id_pregunta  ");
                while($ruw= $Respuestas->fetch_assoc()):
                    foreach(explode(",", str_replace(array("[","]"), '', $ruw['respuesta'])) as $v){
                        $ans[$ruw['id_pregunta']][] = $ruw['respuesta'];
                        }
                endwhile;

                
            }
        
	    ?>

            <div class="row my-3">
                <div class="col-md-12 text-center  ">
                    <h2> <?php echo $raw['pregunta'] ?>  <h2>
                    <?php if($raw['type'] != 'textfield_s'): ?>
                    <canvas id="<?php echo $raw['id_pregunta'] ?>" width="550" height="450" class ="mx-auto"></canvas>
                    <?php else: ?> 
                    <div class="row " >
                        <div clas = "col-md-12 mx-auto"  >  
                        <?php if(isset($ans[$raw['id_pregunta']])): ?>
                        <?php foreach($ans[$raw['id_pregunta']] as $val): ?>
                        <blockquote class="text-center"><?php echo $val ?></blockquote>
                        <?php endforeach; ?>
                        <?php endif; ?>
                        </div>
                    </div>
                    <?php endif ?>
                </div>
            </div>
            
            
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
                    },
                    options: {
                responsive: false
            }


                
                })


            </script>



            <?php endwhile; ?>
            <?php endif ?>  
        <?php endwhile; ?>
        <?php endif ?>


             
        </div>


 


        
        


        
    </body>
    <script src="js/js_resultado_estudiante.js"></script>
</html>