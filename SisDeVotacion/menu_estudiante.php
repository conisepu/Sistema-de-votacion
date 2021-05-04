<html>
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Menu Estudiante</title>
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
                    <a href="menu_estudiante.html">Votaciones</a>
                </li>

                <li>
                    <a href="resultados_estudiante.html">Resultados</a>
                </li>

                <li>
                     <a href="#">Contacto</a> 
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
            <div class="burger">
                <div class="linea1"></div>
                <div class="linea2"></div>
                <div class="linea3"></div>
            </div>
        </nav>

        <?php include'conexion/db.php' ?>
<!-- LISTADO DE VOTACIONES -->
<div class="col-lg-12">
	<div class="card card-outline card-primary">
		<div class="card-header">
				<a class="btn btn-block btn-sm btn-default btn-flat d-flex justify-content-end " href="./menu_CEIND.html">
				<i ></i> Añadir nueva encuesta
				</a>
				
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
						<th>Titulo</th>
						<th>Inicio</th>
						<th>Fin</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$qry = $conn->query("SELECT * FROM votacion order by date(start_date) asc,date(end_date) asc ");
					while($row= $qry->fetch_assoc()):
					?>
					<tr>
						<td><b><?php echo ucwords($row['title']) ?></b></td>
						<td><b><?php echo date("M d, Y",strtotime($row['start_date'])) ?></b></td>
						<td><b><?php echo date("M d, Y",strtotime($row['end_date'])) ?></b></td>
					</tr>	
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