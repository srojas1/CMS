$(document).ready(function(){

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

});