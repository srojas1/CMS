$(document).ready(function(){

    $('#modalAgregarProducto').on('hidden.bs.modal', function () {
        location.reload();
    });

    $('.modal_editar_producto').on('hidden.bs.modal', function () {
        location.reload();
    });

    $('.modal').on('show.bs.modal', function () {

        $idProducto = $(this).find('.id_producto').val();

        $(document).on('click','.editar_producto',function (event) {
            event.stopImmediatePropagation();

            var postData = new FormData($("#edit_product_form_"+$idProducto)[0]);

            $.ajax({
                type: "POST",
                url: 'producto/editProducto',
                contentType: false,
                cache: false,
                processData: false,
                data: postData
            }).done(function(data) {
                alert('Se modificó el producto exitosamente');
                location.reload();
            });
        });

        $(document).on('click','.crear_vinculacion',function (event) {
            event.stopImmediatePropagation();

            productoVinculadoIdCreate = $('#producto_vincular').val();
            productoVinculadoTextCreate = $('#producto_vincular option:selected').text();

            $('.container_vinculacion').append('<div class="container-fluid row col-12 justify-content-start align-items-center"><div class="form-group col-9">' +
                '<input name="productoVinculado[]" type="hidden" value="'+ productoVinculadoIdCreate +'">' +
                '<div class="d-inline-flex"><img src="/images/producto-icon.jpg" alt="..." class="thumbnail border-top border-bottom border-right border-left">' +
                productoVinculadoTextCreate +'</div>' +
                '</div>' +
                '<div class="form-group col-3">' +
                '<a href="#" class="badge-pill eliminarRelacion shadow-sm">' +
                '<i class="material-icons">clear</i>' +
                '</a>' +
                '</div></div>');
        });

        $(document).on('click','.eliminarRelacion',function () {
            $(this).parent().parent().remove();
        });

        $(document).on('click','.crear_vinculacion_edit',function (event) {
            event.stopImmediatePropagation();

            productoVinculadoIdEdit = $('#producto_vincular_'+$idProducto).val();
            productoVinculadoTextEdit = $('#producto_vincular_'+$idProducto+' option:selected').text();

            $('.container_vinculacion_'+$idProducto).append('<div class="container-fluid row col-12 justify-content-start align-items-center"><div class="form-group col-9">' +
                '<input name="productoVinculadoEdit[]" type="hidden" value="'+ productoVinculadoIdEdit +'">' +
                '<div class="d-inline-flex"><img src="/images/producto-icon.jpg" alt="..." class="thumbnail border-top border-bottom border-right border-left">' +
                productoVinculadoTextEdit +'</div>' +
                '</div>' +
                '<div class="form-group col-3">' +
                '<a href="#" class="badge-pill eliminarRelacion shadow-sm">' +
                '<i class="material-icons">clear</i>' +
                '</a>' +
                '</div></div>');
        });

        $(document).on('click','.eliminarAtributo',function () {
            $(this).parent().parent().remove();
        });

        $(document).on('click','.eliminarAtributoEdit',function () {

            $idAtributo = $(this).prev('.idAtributoProducto').val();

            $.ajax({
                type:"POST",
                url: 'atributo/destroyAtributo',
                cache: false,
                data: {id:$idAtributo}
            }).done(function(data){
                alert('Se eliminó el atributo');
            });

            $(this).parent().parent().remove();

        });

        $(document).on('click','.crear_categoria_inside',function () {
            $nombreCategoria  = $('#nueva_categoria_inside').val();
            $selectCategorias = $('#categoriaProducto');

            $.ajax({
                type: "POST",
                url: 'categoria/storeCategory',
                cache: false,
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

        $(document).on('click','.crear_categoria_inside_edit',function () {
            $nombreCategoria  = $('#nueva_categoria_inside_'+$idProducto).val();
            $selectCategorias = $('#categoriaProducto_'+$idProducto);

            $.ajax({
                type: "POST",
                url: 'categoria/storeCategory',
                cache: false,
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

        $(document).on('click','.crear_atributo_edit',function () {

            $nombreAtributo  = $('.nuevo_atributo_'+$idProducto).val();
            $selectAtributos = $('#atributoProducto_'+$idProducto);
            $valores = $('#valores_'+$idProducto).val();

            $values = $valores.split(",");
            $arr=[];

            for(var i=0; i < $values.length; i++) {
                $arr.push($values[i]);
            }

            $.ajax({
                type: "POST",
                url: 'atributo/storeAtributo',
                cache: false,
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
                alert('Se agregó el atributo exitosamente');
                $('#agregarProductoAtributos_'+$idProducto).load(' #agregarProductoAtributos_'+$idProducto);
            });
        });

        $(document).on('click','.agregar_atributo',function () {

            $attribute_id = $('#atributoProducto_'+$idProducto).val();
            $product_id   = $idProducto;

                $.ajax({
                    type: "POST",
                    url: 'atributo/addAtributoProductoFromEdit',
                    cache: false,
                    data: {
                        attribute_id: $attribute_id,
                        product_id: $product_id,
                        valor: 'sin valor asignado'
                    }
                }).done(function(data) {
                    alert('Se agregó el atributo exitosamente');
                    $('.atributo_contenedor_'+$idProducto).load(' .atributo_contenedor_'+$idProducto);
                });

        });
    });

    $(document).on('click','.crear_producto',function () {
        var postData = new FormData($("#create_product_form")[0]);

        $.ajax({
            type: "POST",
            url: 'producto/storeProducto',
            contentType: false,
            cache: false,
            processData: false,
            data: postData
        }).done(function(data) {
            alert('Se agregó el producto exitosamente');
            location.reload();
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
            cache: false,
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

            alert('Se agregó el atributo exitosamente');
            $('#editarProductoAtributos').load(' #editarProductoAtributos');
        });
    });

    $('.nav-tabs > li > a.categorias').on("click",function(e){
        e.preventDefault();
        $(document).find(".buscador").addClass("buscadorCategorias");
        $(document).find(".buscador").removeClass("buscador");

    });

    $('.nav-tabs > li > a.productos').on("click",function(e){
        e.preventDefault();
        $(document).find(".buscadorCategorias").addClass("buscador");
        $(document).find(".buscadorCategorias").removeClass("buscadorCategorias");
    });

    $(document).on('keyup', '.buscador', function () {
        var value = $(this).val().toLowerCase();
        $(".table_producto tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    $(document).on('keyup', '.buscadorCategorias', function () {
        var value = $(this).val().toLowerCase();
        $(".table_categoria tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    $(document).on('click','#disable_product', function(){

        $visibilidad = $('#hid_visibilidad').val();
        $id_producto = $('#id_producto').val();

        $.ajax({
            type: "POST",
            url: 'producto/disable',
            cache: false,
            data: {
                visibilidad: $visibilidad,
                id_producto: $id_producto
            }
        }).done(function(data) {
            $('.modal').modal('hide');
            $(".table_producto").load(window.location + " .table_producto");
        });
    });

    $('.pagination-demo').twbsPagination({
        totalPages: 5,
        startPage: 1,
        visiblePages: 5,
        initiateStartPageClick: true,
        href: false,
        hrefVariable: '{{number}}',
        first: 'First',
        prev: 'Previous',
        next: 'Next',
        last: 'Last',
        loop: false,
        onPageClick: function (event, page) {
            $('.page-active').removeClass('page-active');
            $('#page'+page).addClass('page-active');
        },
        paginationClass: 'pagination',
        nextClass: 'next',
        prevClass: 'prev',
        lastClass: 'last',
        firstClass: 'first',
        pageClass: 'page',
        activeClass: 'active',
        disabledClass: 'disabled'

    });
});