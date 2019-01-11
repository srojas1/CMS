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