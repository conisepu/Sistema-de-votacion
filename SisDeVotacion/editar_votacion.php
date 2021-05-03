<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Editar votacion</title>
        <link rel="stylesheet" href="css/estilos_menuCEIND.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
		    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

	  
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
                    <a href="#">Listas alumnos</a> 
                    
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



<!-- PANEL DE EDICION  -->
<?php include 'conexion/db.php' ?>
<?php 
$qry = $conn->query("SELECT * FROM votacion where id = ".$_GET['id'])->fetch_array();
foreach($qry as $k => $v){
	if($k == 'title')
		$k = 'stitle';
	$$k = $v;
}
?>
<div class=" container col-lg-12">
	<div class="row">
		<div class="col-md-4">
			<div class="card card-outline card-primary">
				<div class="card-header">
					<h3 class="card-title">Informacion</h3>
				</div>
				<div class="card-body p-0 py-2">
					<div class="container-fluid">
						<p>Titulo: <b><?php echo $stitle ?></b></p>
						<p>Fecha inicio: <b><?php echo date("M d, Y",strtotime($start_date)) ?></b></p>
						<p>Fecha final: <b><?php echo date("M d, Y",strtotime($end_date)) ?></b></p>

					</div>
					<hr class="border-primary">
				</div>
			</div>
		</div>
		<div class="col-md-8">
			<div class="card card-outline card-success">
				<div class="card-header">
					<h3 class="card-title"><b>Preguntas</b></h3>
					<div class="card-tools">
						<button class="btn btn-block btn-sm btn-default btn-flat border-success new_question" type="button"><i class="fa fa-plus"></i> Agregar nueva pregunta</button> 
          </div>
				</div>
				<form action="" id="manage-sort">
				<div class="card-body ui-sortable">
					<?php 
					$question = $conn->query("SELECT * FROM preguntas where id_votacion = $id ");
					while($row=$question->fetch_assoc()):	
					?>
					<div class="callout callout-info">  
						<div class="row">
							<div class="col-md-12 d-flex justify-content-end">	
								<span class="dropleft float-right">
									<a class="fa fa-ellipsis-v text-dark" href="javascript:void(0)" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
									<div class="dropdown-menu" style="">
								        <a class="dropdown-item edit_question text-dark" href="javascript:void(0)" data-id="<?php echo $row['id_pregunta'] ?>"  >Editar</a>
								        <div class="dropdown-divider"></div>
								        <a id="informacion"class="dropdown-item delete_question text-dark" href="javascript:void(0)" data-id='[<?php echo $row['id_pregunta'] ?> ,<?php echo $row['id_votacion'] ?>]'>Borrar</a>
								     </div>
								</span>	
							</div>
              <h5><?php echo $row['pregunta'] ?></h5>	  	
						</div>	
						<div class="col-md-12">

            <input type="hidden" name="qid[]" value="<?php echo $row['id_pregunta'] ?>">	
                <?php
                    if($row['type'] == 'radio_opt'):
                    $pregunta = $row['id_pregunta'] ;
                    $opciones = $conn->query("SELECT * FROM opciones where idVotacion = $id  and idPregunta = $pregunta");
                    while($op=$opciones->fetch_assoc()):	
                ?>
                     <div class="icheck-primary"> 
                        <input type="radio" >
                      <label ><?php echo $op['nombre']  ?></label>
                    </div>
                <?php endwhile; ?>
                <?php elseif($row['type'] == 'check_opt'): 
                  $pregunta = $row['id_pregunta'] ;
                  $opciones = $conn->query("SELECT * FROM opciones where idVotacion = $id  and idPregunta = $pregunta");
                  while($op=$opciones->fetch_assoc()):	
                ?>
                      <div class="icheck-primary"> 
                        <input type="checkbox" >
                      <label ><?php echo $op['nombre']  ?></label>
                    </div>
                <?php endwhile; ?>
                <?php else: ?>
                <div class="form-group">
                    <textarea class="form-control" placeholder=""></textarea>
                </div>
                <?php endif; ?>              
                
						</div>	
					</div>
					<?php endwhile; ?>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>


<!-- modal preguntas -->
<div class="modal fade" id="confirm_modal" role='dialog'>
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Confirmacion</h5>
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
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title"></h5>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id='submit' onclick="$('#uni_modal form').submit()">Aceptar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
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
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
              <button type="button" class="btn-close" data-dismiss="modal"><span class="fa fa-times"></span></button>
              <img src="" alt="">
      </div>
    </div>
  </div>
  </div>
  <!-- /.content-wrapper -->



</body>
<script> 

// GUARDAR UNA PREGUNTA
$('.new_question').click(function(){
    uni_modal("Nueva pregunta ","manage_question.php?id=<?php echo $id ?>","large")
})

//EDITAR UNA PREGUNTA 
$('.edit_question').click(function(){
		uni_modal("Pregunta","manage_question.php?id=<?php echo $id ?>&id_pregunta="+$(this).attr('data-id'),"large")
	})

//ELIMINAR UNA PREGUNTA
$('.delete_question').click(function(){
_conf("Estas seguro de borrar esta pregunta?","delete_question",[$(this).attr('data-id')])
})
function delete_question(){
    start_load()
    $ids = $('#informacion').data('id');
    $.ajax({
        url:'todb.php?action=delete_question',
        method:'POST',
        data:{ids:$ids},
        success:function(resp){
          console.log(resp);
            if(resp==1){
                
                //alert_toast("Data successfully deleted",'success')
                setTimeout(function(){
                    location.reload()
                },1500)

            }
        }
    })
}


</script>



<?php include 'footer.php' ?>

</html>
