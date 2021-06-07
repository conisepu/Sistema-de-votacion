<?php
  include 'funciones/rol_CEIND.php'
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>RESULTADOS CEIND</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <link rel="stylesheet" href="css/estilos_resultados_estudiante.css">
        
    </head>
    <body>
        <script src="js/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script sec="main.js"></script>
        
        <?php include 'navA.php' ?>


        <?php include'conexion/db.php' ?>
<!-- LISTADO DE VOTACIONES -->
<div class="col-lg-12">
	<div class="card card-outline card-primary">

				
		</div>
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
                        <th>Cierre de la votacion</th>
						<th>Titulo de la encuesta</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$qry = $conn->query("SELECT * FROM votacion order by date(start_date) asc,date(end_date) asc ");
					while($row= $qry->fetch_assoc()):
					?>

					<tr>
                        <td><b><?php echo date("M d, Y",strtotime($row['end_date'])) ?></b></td> 
						<td>
                            <li>
                                <a href="grafica_CEIND.php?&id=<?php echo $row['id'] ?>"><b><?php echo ucwords($row['title']) ?></b></a>
                            </li>
                            
                        </td>
                        

					</tr>	
				<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- FIN LISTADO DE VOTACIONES -->












        
        
        <script src="js/js_resultado_estudiante.js"></script>
        
    </body>
</html>
    
        <script src="js/jquery-3.6.0.min.js"></script>
        <script src="js/js_resultados_CEIND.js"></script>
    </body>
</html>