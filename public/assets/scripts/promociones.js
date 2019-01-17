$(document).ready(function(){

    $('.modal').on('show.bs.modal', function (e) {

        $idPromocion = $(this).find('.id_promocion').val();

        $(document).on('click', '.editar_promocion', function (event) {
            event.stopImmediatePropagation();

            var postData = new FormData($("#edit_promocion_form_" + $idPromocion)[0]);

            $.ajax({
                type: "POST",
                url: 'promocion/editPromocion',
                contentType: false,
                cache: false,
                processData: false,
                data: postData
            }).done(function (data) {
                alert('Se modificó la promoción exitosamente');
                location.reload();
            });
        });

        $(document).on('click','.crear_vinculacion_promo',function (event) {
            event.stopImmediatePropagation();

            productoVinculadoIdCreate = $('#producto_vincular_promo').val();
            productoVinculadoTextCreate = $('#producto_vincular_promo option:selected').text();

            $('.container_vinculacion_promo').append('<div class="container-fluid row col-12 justify-content-start align-items-center"><div class="form-group col-9">' +
                '<input name="productoVinculadoPromo[]" type="hidden" value="'+ productoVinculadoIdCreate +'">' +
                '<div class="d-inline-flex"><img src="/images/producto-icon.jpg" alt="..." class="thumbnail border-top border-bottom border-right border-left">' +
                productoVinculadoTextCreate +'</div>' +
                '</div>' +
                '<div class="form-group col-3">' +
                '<a href="#" class="badge-pill eliminarRelacionPromo shadow-sm">' +
                '<i class="material-icons">clear</i>' +
                '</a>' +
                '</div></div>');
        });

        $(document).on('click','.eliminarRelacionPromo',function () {
            $(this).parent().parent().remove();
        });

        $(this).find('#lanzamientoPromocion').datepicker();
        $(this).find('#fechaFinPromocion').datepicker();
    });

    $(document).on('click','.crear_promocion',function () {

        var postData = new FormData($("#create_promocion_form")[0]);

        $.ajax({
            type: "POST",
            url: 'promocion/storePromocion',
            contentType: false,
            cache: false,
            processData: false,
            data: postData
        }).done(function(data) {
            alert('Se agregó la promoción exitosamente');
            location.reload();
        });

    });

    $('#lanzamientoPromocion').datepicker();
    $('#fechaFinPromocion').datepicker();

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

    $(".main_image").change(function() {
        readURLMain(this);
    });

});