$(document).ready(function(){

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