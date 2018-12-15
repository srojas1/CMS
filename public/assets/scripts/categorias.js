$(document).ready(function(){

    $('.crear_categoria').on('click',function () {

        $nombreCategoria =$('.nueva_categoria').val();

               $.ajax({
                type: "POST",
                url: 'categoria/storeCategory',
                data: {categoria: $nombreCategoria}
            }).done(function() {
                location.reload();
                alert('Se agregó la categoría exitosamente');
               });
    });
});