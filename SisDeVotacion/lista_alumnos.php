<?php
  include 'funciones/rol_CEIND.php'
?>
<?php include'conexion/db.php' ?>
<html>
    <head>
    <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>LISTA ALUMNOS</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <link rel="stylesheet" href="css/estilos_resultados_estudiante.css">
        <link rel="stylesheet" href="css/boton.css">
	</head>
    <body>
        
    <?php include 'navA.php' ?>

    <div class="card bg-light mb-3 mx-auto m-5" style="max-width: 35rem;">
  <div class="card-header">
  <h5 class="card-title">Ingreso de lista de alumnos</h5>
  </div>
  <div class="card-body">

    <p class="card-text">Seleccione un archivo de excel que contenga columnas con los siguientes nombres: RUT, Nombre Estudiante, Año Ingreso, Sexo y Correo UDP.</p>
    <form action="#" method="POST" enctype="multipart/form-data">
        <input type="file" name="excel">
        <input type="submit" name="submit">
    </form>
  </div>
</div>



<?php
    if(isset($_FILES['excel']['name'])){
        include "funciones/xlsx.php";
        if($conn){
            $excel=SimpleXLSX::parse($_FILES['excel']['tmp_name']);
            //echo "<pre>";
            #var_dump($excel->rows(0));
            #print_r($excel);
            #print_r($excel->dimension(0));
            #print_r($excel->sheetNames());
            for ($sheet=0; $sheet < sizeof($excel->sheetNames()) ; $sheet++) { 
                $rowcol=$excel->dimension($sheet);
                $cont=0;
                if($rowcol[0]!=1 && $rowcol[1]!=1){
                    $i=0;
                    foreach ($excel->rows($sheet) as $key => $row) {
                        $q="";
                        print_r($i);
                        foreach ($row as $key => $cell) {
                             
                            if($i==0){
                                $cell =str_replace(' ', '', $cell);
                                $q.=$cell. " varchar(50),";
                            }else{
                                if(str_contains($cell, "'")){
                                    $cell =str_replace("'", "", $cell);
                                } 
                                $q.="'".$cell. "',";
                            }
                                                     
                            
                        }
                        #var_dump($q);
                        if($i==0){
                            $delete="DROP table alumnos_industrias";
                            if(mysqli_query($conn,$delete))
                            {
                                #var_dump(mysqli_query($conn,$query));
                                echo "se borro la tabla";
                            }

                            $query="CREATE table alumnos_industrias (".rtrim($q,",").");";
                        }else{
                            $query="INSERT INTO alumnos_industrias values (".rtrim($q,",").");";
                        }
                        echo $query;
                        #var_dump($conn);

                        if(mysqli_query($conn,$query))
                        {
                            #var_dump(mysqli_query($conn,$query));
                            echo "funciono la insertacion del excel";
                        }
                        echo "<br>";
                        $i++;
                    }
                    $cont++;
                }
            }
        }
    }

?>
</body>
</html>