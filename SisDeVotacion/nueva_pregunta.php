<?php include 'conexion/db.php' ?>

<div class="container-fluid" >
	<form action="" id="manage-question">
	<div class="col-lg-12">
		<div  class="row">
				<div class="col-sm-6 border-right">	
						<div class="form-group">
							<label for="" class="control-label">Question</label>
							<textarea name="question" id="" cols="30" rows="4" class="form-control"></textarea>
						</div>
						<div class="form-group">
							<label for="" class="control-label">Tipo de pregunta</label>
							<select name="type" id="type" class="custom-select custom-select-sm">
								<?php if(isset($id)): ?>
								<option value="" disabled="" selected="">Please Select here</option>
								<?php endif; ?>
								<option value="radio_opt" <?php   $type == 'radio_opt' ? 'selected':'' ?>>Single Answer/Radio Button</option>
								<option value="check_opt" <?php  $type == 'check_opt' ? 'selected':'' ?>>>Multiple Answer/Check Boxes</option>
								<option value="textfield_s" <?php  $type == 'textfield_s' ? 'selected':'' ?> >>Text Field/ Text Area</option>
							</select>
						</div>
						
				</div>
				<div class="col-sm-6">
					<b>Preview</b>
					<div class="preview">
						<?php if(!isset($id)): ?>
						<center><b>Select Question Answer type first.</b></center>
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
								      		<label for="" class="control-label">Label</label>
								      	</th>
								      	<th class="text-center"></th>
							     	</tr>
						     	</thead>
						     	<tbody>
						     		<?php  
						     		$i = 0;
						     		foreach(json_decode($frm_option) as $k => $v):
						     			$i++;
						     		?>
						     		<tr class="">
								      	<td class="text-center">
								      		<div class="icheck-primary d-inline" data-count = '<?php echo $i ?>'>
									        	<input type="<?php echo $opt ?>" id="<?php echo $opt ?>Primary<?php echo $i ?>" name="<?php echo $opt ?>" checked="">
									        	<label for="<?php echo $opt ?>Primary<?php echo $i ?>">
									        	</label>
									        </div>
								      	</td>

								      	<td class="text-center">
								      		<input type="text" class="form-control form-control-sm check_inp"  name="opcion[]" value="<?php echo $v ?>">
								      	</td>
								      	<td class="text-center"></td>
							     	</tr>
						     		<?php  endforeach; ?>

						     	</tbody>
						      </table>
						      <div class="row">
						      <div class="col-sm-12 text-center">
						      	<button class="btn btn-sm btn-flat btn-default" type="button" onclick="<?php echo $type ?>($(this))"><i class="fa fa-plus"></i> Add</button>
						      </div>
						      </div>
						    </div>
						</div>

						<?php else: ?>
								<textarea name="frm_opt" id="" cols="30" rows="10" class="form-control" disabled="" placeholder="Write Something here..."></textarea>
						<?php endif; ?>
						<?php endif; ?>
					</div>
				</div>
		
		</div>
	</div>
	</form>	
</div>
