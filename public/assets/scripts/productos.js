$(document).ready(function(){

    $('.eliminarAtributo').on('click',function(){

        $(this).parent().parent().remove();

    });

    $('.eliminarRelacion').on('click',function(){

        $(this).parent().parent().remove();

    });

    $('.modal').on('show.bs.modal', function (e) {

        $idProducto = $(this).find('.id_producto').val();

        $('.editar_producto').on('click',function () {

            var postData = new FormData($("#edit_product_form_"+$idProducto)[0]);

            $.ajax({
                type: "POST",
                url: 'producto/editProducto',
                contentType: false,
                cache: false,
                processData: false,
                data: postData
            }).done(function(data) {
                location.reload();
                alert('Se modificó el producto exitosamente');
            });
        });

        $('document').on('click','eliminarRelacion',function(){
            alert('test');
            $(this).parent().parent().remove();

        });

        $('.crear_vinculacion').on('click', function(){

            productoVinculadoId = $('#producto_vincular').val();
            productoVinculadoText = $('#producto_vincular option:selected').text();

            $('.container_vinculacion').append('<div class="container-fluid row col-12 justify-content-start align-items-center"><div class="form-group col-9">' +
                '<input name="productoVinculado[]" type="hidden" value="'+ productoVinculadoId +'">' +
                '<div class="d-inline-flex"><img src="{{ asset(\'images/producto-icon.jpg\') }}" alt="..." class="thumbnail border-top border-bottom border-right border-left">' +
                productoVinculadoText +'</div>' +
                '</div>' +
                '<div class="form-group col-3">' +
                '<a href="#" class="badge-pill eliminarRelacion shadow-sm">' +
                '<i class="material-icons">clear</i>' +
                '</a>' +
                '</div></div>');
        });

        $('.crear_vinculacion_edit').on('click', function(){

            productoVinculadoId = $('#producto_vincular_'+$idProducto).val();
            productoVinculadoText = $('#producto_vincular_'+$idProducto+' option:selected').text();

            $('.container_vinculacion').append('<div class="container-fluid row col-12 justify-content-start align-items-center"><div class="form-group col-9">' +
                '<input name="productoVinculado[]" type="hidden" value="'+ productoVinculadoId +'">' +
                '<div class="d-inline-flex"><img src="{{ asset(\'images/producto-icon.jpg\') }}" alt="..." class="thumbnail border-top border-bottom border-right border-left">' +
                productoVinculadoText +'</div>' +
                '</div>' +
                '<div class="form-group col-3">' +
                '<a href="#" class="badge-pill eliminarRelacion shadow-sm">' +
                '<i class="material-icons">clear</i>' +
                '</a>' +
                '</div></div>');
        });
    });


    $('.crear_producto').on('click',function () {
        var postData = new FormData($("#create_product_form")[0]);

        $.ajax({
            type: "POST",
            url: 'producto/storeProducto',
            contentType: false,
            cache: false,
            processData: false,
            data: postData
        }).done(function(data) {
            location.reload();
            alert('Se agregó el producto exitosamente');
        });

    });

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

    $(document).on('click','.crear_atributo',function () {

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

            $('#editarProductoAtributos').load(' #editarProductoAtributos');

            alert('Se agregó el atributo exitosamente');
        });
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