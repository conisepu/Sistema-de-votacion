<?php

    include 'conexion/db.php';
    $qry = $conn->query("SELECT * FROM votacion where id = ".$_GET['id'])->fetch_array();
    foreach($qry as $k => $v){
    if($k == 'title')
    $k = 'stitle';
    $$k = $v;
 }

include 'menu_CEIND.php';
?>
soy la pagina de editar

    



