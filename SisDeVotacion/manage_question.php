<?php include 'conexion/db.php' ?>
<?php
if(isset($_GET['id_pregunta'])){
	$qry = $conn->query("SELECT * FROM preguntas where id_pregunta = ".$_GET['id_pregunta'])->fetch_array();
foreach($qry as $k => $v){
	$$k = $v;
}
}
?>

<div class="container-fluid">
	<form action="" id="manage-question">
		<div class="col-lg-12">
			<div class="row">
				<div class="col-sm-6 border-right">
						<input type="hidden" name="id" value="<?php echo isset($id_pregunta) ? $id_pregunta : '' ?>">
						<input type="hidden" name="id_votacion" value="<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?>">
						
						<div class="form-group">
							<label for="" class="control-label">Pregunta</label>
							<textarea name="pregunta"class="form-control"><?php echo isset($pregunta)? $pregunta: '' ?></textarea>
						</div>	
						<div class="form-group">
							<label for="" class="control-label">Tipo de pregunta</label>
							<select name="type" id="type" class="custom-select custom-select-sm">
								<?php if(isset($id_pregunta)): ?>
								<option value="" disabled="" selected="">Please Select here</option>
								<?php endif; ?>
								<option value="radio_opt" <?php echo isset($type) && $type == 'radio_opt' ? 'selected':'' ?> >Selecion unica</option>
								<option value="check_opt" <?php echo isset($type) && $type == 'check_opt' ? 'selected':'' ?> >Selecion multiple</option>
								<option value="textfield_s" <?php echo isset($type) && $type == 'textfield_s' ? 'selected':'' ?> >Texto</option>
							</select>
						</div>
						
				</div>
				<div class="col-sm-6">
				
				
					<b>Vista previa</b>
					<div class="preview">
						<?php if(!isset($id_pregunta)): ?>
						<center><b>Selecione una tipo de preguna primero</b></center>
						<?php else: ?>
							<div class="callout callout-info">
							<?php if($type != 'textfield_s'): 
								$opt= $type =='radio_opt' ? 'radio': 'checkbox';
							?>
						      <table width="100%" class="table">
						      	<colgroup>
						      		<col width="10%">
						      		<col width="80%">
						      		<col width="10%">
						      	</colgroup>
						      	<thead>
							      	<tr class="">
								      	<th class="text-center"></th>

								      	<th class="text-center">
								      		<label for="" class="control-label">Opciones</label>
								      	</th>
								      	<th class="text-center"></th>
							     	</tr>
						     	</thead>
						     	<tbody>
						     		<?php  
						     		// ACA EMPIEZA UN WHILE
									

									$opciones = $conn->query("SELECT * FROM opciones where idPregunta = $id_pregunta");
									$i = 0;
									while($op=$opciones->fetch_assoc()):
										$i++;	
						     		?>
						     		<tr class="">
								      	<td class="text-center">
								      		<div class="icheck-primary d-inline"  data-count='<?php echo $i ?>'>
											  <input type="<?php echo $opt ?>" id="<?php echo $opt ?>Primary<?php echo $i ?>" name="<?php echo $opt ?>">
									        	<label for="<?php echo $opt ?>Primary<?php echo $i ?>">
									        	</label>	
									        </div>
								      	</td>
								      	<td class="text-center">
								      		<input type="text" class="form-control form-control-sm check_inp"  name="opcion[]" value="<?php echo $op['nombre'] ?>">
								      	</td> 
								      	<td class="text-center"></td>
							     	</tr>
						     		<!-- ACA TERMINA UN WHILE -->
									 <?php endwhile; ?>
						     	</tbody>
						      </table>
							  <?php
							  $new = '';
							  if($type == 'radio_opt'){
								  $new = 'new_radio';
							  }
							  else if ($type == 'check_opt') {
								  $new = 'new_check';
							  }
							 
							 ?>		
							  	
						      <div class="row">
						      <div class="col-sm-12 text-center">
						      	<button class="btn btn-sm btn-flat btn-default" type="button" onclick="<?php echo $new ?>($(this))"><i class="fa fa-plus"></i> Agregar</button>
						      </div>
						      </div>
						    </div>
						</div>

						<?php else: ?>
								<textarea name="frm_opt"  class="form-control" disabled="" placeholder="..."></textarea>
						<?php endif; ?>
						<!-- ACA TERMINA EL ELSE PARA EDITAR -->
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>


<div id="check_opt_clone"  style="display: none">
	<div class="callout callout-info">
      <table width="100%" class="table">
      	<colgroup>
      		<col width="10%">
      		<col width="80%">
      		<col width="10%">
      	</colgroup>
      	<thead>
	      	<tr class="">
		      	<th class="text-center"></th>

		      	<th class="text-center">
		      		<label for="" class="control-label">Opciones</label>
		      	</th>
		      	<th class="text-center"></th>
	     	</tr>
     	</thead>
     	<tbody>
     		<tr class="">
		      	<td class="text-center">
		      		<div class="icheck-primary d-inline" data-count = '1'>
			        	<input type="checkbox" id="checkboxPrimary1" checked="">
			        	<label for="checkboxPrimary1">
			        	</label>
			        </div>
		      	</td>
		      	<td class="text-center">
		      		<input type="text" class="form-control form-control-sm check_inp" name="opcion[]">
		      	</td>
				<td class="text-center btn_remove"><a href="javascript:void(0)"><span class="fa fa-times" ></span></a></td>	
		      	<td class="text-center"></td>
	     	</tr>
	     	<tr class="">
		      	<td class="text-center">
		      		<div class="icheck-primary d-inline" data-count = '2'>
			        	<input type="checkbox" id="checkboxPrimary2" >
			        	<label for="checkboxPrimary2">
			        	</label>
			        </div>
		      	</td>
				
		      	<td class="text-center">
		      		<input type="text" class="form-control form-control-sm check_inp" name="opcion[]">
		      	</td>
				<td class="text-center btn_remove"><a href="javascript:void(0)"><span class="fa fa-times" ></span></a></td>
		      	<td class="text-center"></td>
	     	</tr>
     	</tbody>
      </table>
      <div class="row">
      <div class="col-sm-12 text-center">
      	<button class="btn btn-sm btn-flat btn-default" type="button" onclick="new_check($(this))"><i class="fa fa-plus"></i> Agregar</button>
      </div>
      </div>
    </div>
</div>

<div id="radio_opt_clone" style="display: none">
	<div class="callout callout-info">
      <table width="100%" class="table">
      	<colgroup>
      		<col width="10%">
      		<col width="80%">
      		<col width="10%">
      	</colgroup>
      	<thead>
	      	<tr class="">
		      	<th class="text-center"></th>

		      	<th class="text-center">
		      		<label for="" class="control-label">Opciones</label>
		      	</th>
		      	<th class="text-center"></th>
	     	</tr>
     	</thead>
     	<tbody>
     		<tr class="">
		      	<td class="text-center">
		      		<div class="icheck-primary d-inline" data-count = '1'>
			        	<input type="radio" id="radioPrimary1" name="radio" checked="">
			        	<label for="radioPrimary1">
			        	</label>
			        </div>
		      	</td>
							
		      	<td class="text-center">
		      		<input type="text" class="form-control form-control-sm check_inp"  name="opcion[]">
		      	</td>
				  <!-- BOTON DE PRUEBA -->
				<td class="text-center btn_remove"><a href="javascript:void(0)"><span class="fa fa-times" ></span></a></td>
		      	<td class="text-center"></td>
	     	</tr>
	     	<tr class="">
		      	<td class="text-center">
		      		<div class="icheck-primary d-inline" data-count = '2'>
			        	<input type="radio" id="radioPrimary2" name="radio" >
			        	<label for="radioPrimary2">
			        	</label>
			        </div>
		      	</td>
						
		      	<td class="text-center">
		      		<input type="text" class="form-control form-control-sm check_inp"  name="opcion[]">
		      	</td>
				<td class="text-center btn_remove"><a href="javascript:void(0)"><span class="fa fa-times" ></span></a></td>	
		      	<td class="text-center"></td>
	     	</tr>
     	</tbody>
      </table>
      <div class="row">
      <div class="col-sm-12 text-center">
      	<button class="btn btn-sm btn-flat btn-default" type="button" onclick="new_radio($(this))"><i class="fa fa-plus"></i> Agregar </button>
      </div>
      </div>
    </div>
</div>
<div id="textfield_s_clone" style="display: none">
	<div class="callout callout-info">
		<textarea name="frm_opt" class="form-control" disabled=""  placeholder="..."></textarea>
	</div>
</div>
<script> 
// FUNCIONES PARA CREAR UNA NUEVA PREGUNTA 
function new_check(_this){
    var tbody=_this.closest('.row').siblings('table').find('tbody')
    var count = tbody.find('tr').last().find('.icheck-primary').attr('data-count')
        count++;
    console.log(count)
    var opt = '';
        opt +='<td class="text-center pt-1"><div class="icheck-primary d-inline" data-count = "'+count+'"><input type="checkbox" id="checkboxPrimary'+count+'"><label for="checkboxPrimary'+count+'"> </label></div></td>';
        opt +='<td class="text-center"><input type="text" class="form-control form-control-sm check_inp" name="opcion[]"></td>';
        opt +='<td class="text-center"><a href="javascript:void(0)" onclick="$(this).closest(\'tr\').remove()"><span class="fa fa-times" ></span></a></td>';
    var tr = $('<tr></tr>')
    tr.append(opt)
    tbody.append(tr)
	console.log('----');	
}
function new_radio(_this){
    var tbody=_this.closest('.row').siblings('table').find('tbody')
    var count = tbody.find('tr').last().find('.icheck-primary').attr('data-count')
        count++;
    console.log(count)
    var opt = '';
        opt +='<td class="text-center pt-1"><div class="icheck-primary d-inline" data-count = "'+count+'"><input type="radio" id="radioPrimary'+count+'" name="radio"><label for="radioPrimary'+count+'"> </label></div></td>';
        opt +='<td class="text-center"><input type="text" class="form-control form-control-sm check_inp" name="opcion[]"></td>';
        opt +='<td class="text-center"><a href="javascript:void(0)" onclick="$(this).closest(\'tr\').remove()"><span class="fa fa-times" ></span></a></td>';
    var tr = $('<tr></tr>')
    tr.append(opt)
    tbody.append(tr)
}
function check_opt(){
    var check_opt_clone = $('#check_opt_clone').clone()
    $('.preview').html(check_opt_clone.html())
}
function radio_opt(){
    var radio_opt_clone = $('#radio_opt_clone').clone()
    $('.preview').html(radio_opt_clone.html())
}
function textfield_s(){
    var textfield_s_clone = $('#textfield_s_clone').clone()
    $('.preview').html(textfield_s_clone.html())
}
$('[name="type"]').change(function(){
    window[$(this).val()]()
})
$(function () {
$('#manage-question').submit(function(e){
    e.preventDefault()
    start_load()
    // $('#msg').html('')
    $.ajax({
        url:'todb.php?action=save_question',
        data: new FormData($(this)[0]),
        cache: false,
        contentType: false,
        processData: false,
        method: 'POST',
        type: 'POST',
        success:function(resp){
                //alert_toast('Data successfully saved.',"success");
                setTimeout(function(){
                    location.reload()
                },1000)
        }
    })
})

})
$(document).on('click', '.btn_remove', function(){
		var button_id = $(this).closest('tr');
        $(button_id).remove();
});


</script>