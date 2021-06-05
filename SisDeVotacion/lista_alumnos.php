<?php
  include 'funciones/rol_CEIND.php'
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>listas votaciones</title>
        <link rel="stylesheet" href="css/estilos_menuCEIND.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	</head>
    <body>
        
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
                    <a href="#">
                        <img src="img/logo_CEIND.jpg" alt="imgPerfil">
                         Administrador CEIND
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

<?php include'conexion/db.php' ?>
<!-- LISTADO DE VOTACIONES -->
    <form action="#" method="POST" enctype="multipart/form-data">
        <input type="file" name="excel">
        <input type="submit" name="submit">
    </form>

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
                            $query="CREATE table ".$excel->sheetName($sheet)." (".rtrim($q,",").");";
                        }else{
                            $query="INSERT INTO ".$excel->sheetName($sheet)." values (".rtrim($q,",").");";
                        }
                        #echo $query;
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
</html>