$('#manage_survey').submit(function(e){
    e.preventDefault()
    $('input').removeClass("border-danger")
    start_load()
    $('#msg').html('')
    $.ajax({
        url:"todb.php?action=save_survey",
        method:"POST",
        data:$("#manage_survey").serialize(),  
        success:function(resp)
        {      if(resp == 1){
                //alert_toast('Data successfully saved.',"success");
                setTimeout(function(){
                    location.replace('lista.php')
                },1500)
            }
            
        }             
    });
})
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

            console.log(resp);
        }
    })
})

})

// BORRA UNA VOTACION
//$('#list').dataTable()
$('.delete_survey').click(function(){
_conf("Are you sure to delete this survey?","delete_survey",[$(this).attr('data-id')])
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

// EDITAR O BORRAR UNA PREGUNTA 


$('.edit_question').click(function(){
    uni_modal("New Question","nueva_pregunta.php?sid=<?php echo $id ?>&id="+$(this).attr('data-id'),"large")
})

