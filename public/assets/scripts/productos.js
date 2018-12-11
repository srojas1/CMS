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

    //atributos

    $('.crear_atributo').on('click',function () {

        $nombreAtributo  = $('.nuevo_atributo').val();
        $selectAtributos = $('#atributoProducto');
        $valores = $('#valores').val();

        $values = $valores.split(",");
        $arr=[];

        for(var i=0; i < $values.length; i++) {
            $arr.push($values[i]);
        }

        $.ajax({
            type: "POST",
            url: 'atributo/storeAtributo',
            data: {
                    atributo: $nombreAtributo,
                    valores:$arr
                  }
        }).done(function(data) {
            postsjson = $.parseJSON(data);
            $selectAtributos.append($('<option>', {
                value: postsjson.id,
                text: $nombreAtributo
            }));

            $('.atributo_contenedor').load(' .atributo_contenedor');

            alert('Se agregó el atributo exitosamente');
        });
    });

    $('#producto_vincular').selectize();

    $('.crear_vinculacion').on('click', function(){

        productoVinculadoId = $('#producto_vincular').val();
        productoVinculadoText = $('#producto_vincular').text();

        $('.container_vinculacion').append('<div class="form-group col-9">' +
            '<input type="hidden" value="'+ productoVinculadoId +'">' +
            '<div class="d-inline-flex"><img src="{{ asset(\'assets/img/producto-icon.jpg\') }}" alt="..." class="thumbnail border-top border-bottom border-right border-left">' +
            productoVinculadoText +'</div>' +
            '</div>' +
            '<div class="form-group col-3">' +
            '<a href="#" class="badge-pill eliminarRelacion shadow-sm">' +
            '<i class="material-icons">clear</i>' +
            '</a>' +
            '</div>');
    });

    $(".buscador").on("keyup", function() {
        var value = $(this).val();

        $("table tr").each(function(index) {
            if (index !== 0) {

                $row = $(this);

                var id = $row.find("div:first").text();

                if (id.indexOf(value) !== 0) {
                    $row.hide();
                }
                else {
                    $row.show();
                }
            }
        });
    });

});