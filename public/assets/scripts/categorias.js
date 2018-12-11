$(document).ready(function(){

    $('.crear_categoria').on('click',function () {

        $nombreCategoria =$('.nombre-nueva-categoria').val();

            $.ajax({
                type: "POST",
                url: 'categoria/storeCategory',
                data: {categoria: $nombreCategoria}
            }).done(function(msg) {
                alert('Categoría creada '+msg);
            });
    });
});