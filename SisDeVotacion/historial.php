<?php
  include 'funciones/rol_CEIND.php'
?>
<?php include'conexion/db.php' ?>
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
        
    <?php include 'navA.php' ?>

<!-- LISTADO DE VOTACIONES -->
<div class="col-lg-12">


		<div class="container card-body">
			<table class="table tabe-hover table-bordered" id="list">
				<colgroup>
                    <col width="5%">
					<col width="10%">
					<col width="15%">
					<col width="5%">
				</colgroup>
				<thead>
					<tr>
            <th>Usuario</th>
            <th>Accion</th>
			<th> Titulo </th>						
			<th>Fecha de Registro</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$qry = $conn->query("SELECT * FROM historial_votacion");

					while($row= $qry->fetch_assoc()):
					?>
					<tr>
                    <td class="fecha"><b><?php echo ucwords($row['usuario']) ?></b></td>
                    <td class="fecha"><b><?php echo ucwords($row['accion']) ?></b></td>
			        <td class="titulo"><b><?php echo ucwords($row['title']) ?></b></td>
                    <td class="titulo"><b><?php echo ucwords($row['FECHA_REGISTRO']) ?></b></td>

					</tr>	
				<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- FIN LISTADO DE VOTACIONES -->