<?php
  include 'funciones/rol_estudiante.php'
?>
<?php include 'conexion/db.php' ?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Menu Estudiante</title>
        <link rel="stylesheet" href="css/estilos_menuCEIND.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
    </head>
    <body>
        
    <?php include 'navEstudiante.php' ?>

<!-- LISTADO DE VOTACIONES -->
<div class="col-lg-12">
	<div class="card card-outline card-primary">
		<div class="container card-body">
			<table class="table tabe-hover table-bordered" id="list">
				<colgroup>
					<col width="5%">
					<col width="20%">
					<col width="20%">
					<col width="20%">
					<col width="20%">
					<col width="15%">
				</colgroup>
				<thead>
					<tr>
                        <th>estado</th>
						<th>Titulo</th>
						<th>Inicio</th>
						<th>Fin</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$qry = $conn->query("SELECT * FROM votacion order by date(start_date) asc,date(end_date) asc ");
                    $fechaActual = date('Y-m-d'); 
                    while($row= $qry->fetch_assoc()):
                        $idVotacion= $row['id'];
                        //estado de la votacion
                         $estado = $conn->query("SELECT estado FROM estados WHERE id_votacion= $idVotacion and id_usuario= $Id_Usuario"); 
                         while ($raw = $estado->fetch_assoc()) {
                            $estadoUsuario =  $raw['estado'];
                        }
                    ?>
                    <?php if ($row['estado_votacion'] == '1'): ?>
					<tr>
                
                    <!-- ACA EMPIEZA EL INICIO DEL IF  -->
                        <?php if ( $estadoUsuario == '0'  && $fechaActual >= $row['start_date']  && $fechaActual <= $row['end_date']  ): ?>
                            <td><b> <i class="fas fa-lock-open"></i></b></td>
                            <td><a href="res.php?page=answer_survey&id=<?php echo $row['id'] ?>" > <b><?php echo ucwords($row['title']) ?></b></a></td>
                        <?php else: ?>
                            <td><b> <i class="fas fa-lock"></i></b></td>
                            <td><a > <b><?php echo ucwords($row['title']) ?></b></a></td>
                        <?php endif; ?>
                    <!-- ACA TERMINA EL IF -->
						<td><b><?php echo date("M d, Y",strtotime($row['start_date'])) ?></b></td>
						<td><b><?php echo date("M d, Y",strtotime($row['end_date'])) ?></b></td>
                        
					</tr>
                    <?php endif ?>	
				<?php endwhile; ?>
				</tbody>
			</table>
		</div>
       
	</div>
</div>



<!-- FIN LISTADO DE VOTACIONES -->

        
        
        <script src="js/jquery-3.6.0.min.js"></script>
        <script src="js/js_menuEstudiante.js"></script>
        
    </body>
</html>