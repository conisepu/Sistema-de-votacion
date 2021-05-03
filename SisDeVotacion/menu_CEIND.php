<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Menu CEIND</title>
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
                    <a href="resultados_CEIND.html">Resultados</a>
                </li>

                <li>
                    <a href="#">Listas</a> 
                    <ul>
                        <li><a href="#">Listas Alumnos</a></li>
                        <li><a href="#">Listas Profesores</a></li>
                        <li><a href="#">Listas Administracion</a></li>
                    </ul>
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
<div class="container p-5">
	<div class="card">
		<div class="card-body">
			<form id="manage_survey">
				<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
				<div class="row">
					<div class="col-md-8 mx-auto ">
						<div class="form-group">
							<label for="" class="control-label">Titulo</label>
							<input type="text" name="title" class="form-control form-control-sm" required value="<?php echo isset($stitle) ? $stitle : '' ?>">
						</div>
						<div class="form-group">
							<label for="" class="control-label">Inicio</label>
							<input type="date" name="start_date" class="form-control form-control-sm"  required value="<?php echo isset($start_date) ? $start_date : '' ?>">
						</div>
						<div class="form-group">
							<label for="" class="control-label">Fin</label>
							<input type="date" name="end_date" class="form-control form-control-sm" required value="<?php echo isset($end_date) ? $end_date : '' ?>">
						</div>
					</div>
				</div>
				<hr>
				<div class="col-lg-12 text-right justify-content-center d-flex">
					<button   class="btn btn-primary mr-2">Guardar</button>
					<button class="btn btn-secondary" type="button" onclick="location.href = 'lista.php'">Cancelar</button>
				</div>
			</form>
		</div>
	</div>
</div>
<script  src="ajax.js"> </script>
<?php include 'footer.php' ?>
</html>