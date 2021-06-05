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
<div class="col-lg-12">
	<div class="card card-outline card-primary">
		<div class="card-header">
				<a class="btn btn-block btn-sm btn-default btn-flat d-flex justify-content-end " href="./menu_CEIND.php">
				  <i >Añadir nueva encuesta</i> 
				</a>
    </div>

		<div class="container card-body">
			<table class="table tabe-hover table-bordered" id="list">
				<colgroup>
          <col width="5%">
					<col width="5%">
					<col width="20%">
					<col width="5%">
				</colgroup>
				<thead>
					<tr>
            <th>Inicio</th>
            <th>Fin</th>
						<th>Titulo </th>						
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$qry = $conn->query("SELECT * FROM votacion order by date(start_date) asc,date(end_date) asc ");
					while($row= $qry->fetch_assoc()):
					?>
					<tr>
            <td class="fecha"><b><?php echo date("M d, Y",strtotime($row['start_date'])) ?></b></td>
            <td class="fecha"><b><?php echo date("M d, Y",strtotime($row['end_date'])) ?></b></td>
						<td class="titulo"><b><?php echo ucwords($row['title']) ?></b></td>
						<td class="text-center">
		                    <div class="btn-group">
		                        <a href="./edit_encuesta.php?page=edit_encuesta&id=<?php echo $row['id'] ?>"class="btn  btn-flat">
		                          <i class="fas fa-pencil-alt" title="Editar titulo y fecha"></i>
		                        </a>
		                        <a  href="./editar_votacion.php?&id=<?php echo $row['id'] ?>" class="btn  btn-flat">
		                          <i class="fas fa-plus-circle" title="Agregar pregunta"></i>
		                        </a>
		                        <button type="button" class="btn  btn-flat delete_survey" data-id="<?php echo $row['id'] ?>">
		                          <i class="fas fa-eraser" title="Eliminar"></i>
		                        </button>
	                      </div>
						</td>
					</tr>	
				<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- FIN LISTADO DE VOTACIONES -->




<!-- /.content -->
<div class="modal fade" id="confirm_modal" role='dialog'>
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Confirmar</h5>
      </div>
      <div class="modal-body">
        <div id="delete_content"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id='confirm' onclick="">Continuar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="uni_modal" role='dialog'>
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title"></h5>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id='submit' onclick="$('#uni_modal form').submit()">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="uni_modal_right" role='dialog'>
    <div class="modal-dialog modal-full-height  modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span class="fa fa-arrow-right"></span>
        </button>
      </div>
      <div class="modal-body">
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="viewer_modal" role='dialog'>
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
              <button type="button" class="btn-close" data-dismiss="modal"><span class="fa fa-times"></span></button>
              <img src="" alt="">
      </div>
    </div>
  </div>
  </div>
  <!-- /.content-wrapper -->
  <?php include 'footer.php' ?>
<script> 
$('.delete_survey').click(function(){
_conf("Esta seguro de continuar con esta operacion?","delete_survey",[$(this).attr('data-id')])
})
function delete_survey($id){
    start_load()
    $.ajax({
        url:'todb.php?action=delete_survey',
        method:'POST',
        data:{id:$id},
        success:function(resp){
            console.log(resp);
            setTimeout(function(){
                location.reload()
            },1500)
        }
    })
}

</script>



</html>
</html>