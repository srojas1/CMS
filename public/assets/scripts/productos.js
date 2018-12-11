$(document).ready(function(){

    $('.crear_categoria_inside').on('click',function () {

        $nombreCategoria  = $('.nueva_categoria_inside').val();
        $selectCategorias = $('#categoriaProducto');

        $.ajax({
            type: "POST",
            url: 'categoria/storeCategory',
            data: {categoria: $nombreCategoria}
        }).done(function(data) {
            postsjson = $.parseJSON(data);
            $selectCategorias.append($('<option>', {
                value: postsjson.id,
                text: $nombreCategoria
            }));
            alert('Se agregó la categoría exitosamente');
        });
    });

    $('.crear_producto').on('click',function () {

        $nombreProducto       = $('#nombreProducto').val();
        $codigoProducto       = $('#codigoProducto').val();
        $descripcionProducto  = $('#descripcionProducto').val();
        $selectCategorias     = $('#categoriaProducto').val();

        $.ajax({
            type: "POST",
            url: 'producto/storeProducto',
            data: {
                nombreProducto: $nombreProducto,
                codigoProducto: $codigoProducto,
                descripcionProducto: $descripcionProducto,
                selectCategorias: $selectCategorias
            }
        }).done(function(data) {
            alert('Se agregó el producto exitosamente');
        });


    });

    //images
    function readURLMain(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.imagen-featured')
                    .attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    //images
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.imagen-galeria')
                    .attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    $(".main_image").change(function() {
        readURLMain(this);
    });

    $(".gallery_image").change(function() {
        readURL(this);
    });
});