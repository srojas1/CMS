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