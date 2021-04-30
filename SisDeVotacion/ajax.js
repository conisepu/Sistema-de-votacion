//CREA UNA NUEVA VOTACION
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


// BORRA UNA VOTACION
//$('#list').dataTable()
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


