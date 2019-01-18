$(document).ready(function(){

    $('.modal').on('show.bs.modal', function (e) {

        $idCupon = $(this).find('.id_cupon').val();

        $(document).on('click', '.editar_cupon', function (event) {
            event.stopImmediatePropagation();

            var postData = new FormData($("#edit_cupon_form_" + $idCupon)[0]);

            $.ajax({
                type: "POST",
                url: 'cupon/editCupon',
                contentType: false,
                cache: false,
                processData: false,
                data: postData
            }).done(function (data) {
                alert('Se modificó el cupón exitosamente');
                location.reload();
            });
        });

        $(document).on('click','.crear_vinculacion_cliente',function (event) {
            event.stopImmediatePropagation();

            clienteVinculadoIdCreate = $('#cliente_vincular_cupon').val();
            clienteVinculadoTextCreate = $('#cliente_vincular_cupon option:selected').text();

            $('.container_vinculacion_promo').append('<div class="container-fluid row col-12 justify-content-start align-items-center"><div class="form-group col-5">' +
                '<input name="clienteVinculadoCupon[]" type="hidden" value="'+ clienteVinculadoIdCreate +'">' +
                '<div class="d-inline-flex"><img src="/images/producto-icon.jpg" alt="..." class="thumbnail border-top border-bottom border-right border-left">' +
                clienteVinculadoTextCreate +'</div>' +
                '</div>' +
                '<div class="form-group col-3">' +
                '<a href="#" class="badge-pill eliminarRelacionCupon shadow-sm">' +
                '<i class="material-icons">clear</i>' +
                '</a>' +
                '</div></div>');
        });

        $(document).on('click','.eliminarRelacionCupon',function () {
            $(this).parent().parent().remove();
        });

        $(document).on('click','.crear_vinculacion_cliente_edit',function (event) {
            event.stopImmediatePropagation();

            clienteVinculadoIdEdit = $('#cliente_vincular_cupon_'+$idCupon).val();
            clienteVinculadoTextEdit = $('#cliente_vincular_cupon_'+$idCupon+' option:selected').text();

            $('.container_vinculacion_'+$idCupon).append('<div class="container-fluid row col-12 justify-content-start align-items-center"><div class="form-group col-5">' +
                '<input name="productoVinculadoPromoEdit[]" type="hidden" value="'+ clienteVinculadoIdEdit +'">' +
                '<div class="d-inline-flex"><img src="/images/producto-icon.jpg" alt="..." class="thumbnail border-top border-bottom border-right border-left">' +
                clienteVinculadoTextEdit +'</div>' +
                '</div>' +
                '<div class="form-group col-3">' +
                '<a href="#" class="badge-pill eliminarRelacion shadow-sm">' +
                '<i class="material-icons">clear</i>' +
                '</a>' +
                '</div></div>');
        });

        $('#vencimientoCupon_'+$idCupon).datepicker();
    });

    $(document).on('click','.crear_cupon',function () {

        var postData = new FormData($("#create_cupon_form")[0]);

        $.ajax({
            type: "POST",
            url: 'cupon/storeCupon',
            contentType: false,
            cache: false,
            processData: false,
            data: postData
        }).done(function(data) {
            alert('Se agregó el cupón exitosamente');
            location.reload();
        });

    });

    $('#vencimientoCupon').datepicker();

});