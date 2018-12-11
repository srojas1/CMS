$(document).ready(function(){

    $('.crear_categoria').on('click',function () {

        $nombreCategoria =$('.nueva_categoria').val();
        $selectCategorias = $('#categoriaProducto');

            $.ajax({
                type: "POST",
                url: 'categoria/storeCategory',
                data: {categoria: $nombreCategoria}
            }).success(function(data) {
                $selectCategorias.append($('<option>', {
                    value: data.id,
                    text: $nombreCategoria
                }));
            });
    });
});