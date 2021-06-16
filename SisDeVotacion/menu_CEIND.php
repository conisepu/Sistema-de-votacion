<?php
  include 'funciones/rol_CEIND.php'
?>
<?php include 'conexion/db.php' ?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Menu CEIND</title>
        <link rel="stylesheet" href="css/estilos_editEncuesta.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    </head>
    <body>
        
    <?php include 'navA.php' ?>



        <!-- ///////////////////////////////////////////////////////////////////////////////////// -->
        <div class="container p-5">
            <div class="card">
                <div class="card-body">
                    <form id="manage_survey">
                        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
                        <input type="hidden" name="id_admi" value="<?php echo($Id_Usuario)?>">
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
                            <button class="btn btn-primary mr-2" id="enviar_formulario" >Guardar</button>
                            <button class="btn btn-secondary"  type="button" onclick="location.href = 'lista.php'">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

<script> 
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
        beforeSend: function () {
            $('#enviar_formulario').prop("disabled", true);
            $('#manage_survey').css("opacity", ".5");
        }, 
        success:function(resp)    
        {      
            console.log(resp);
            if(resp == 1){
                
                setTimeout(function(){
                    location.replace('lista.php')
                },1500)
            }
            
        }             
    });
})

</script>
<?php include 'footer.php' ?>
</html>