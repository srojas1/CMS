$(document).ready(function(){

    $idEmpresa = $(this).find('.id_empresa').val();

    $(document).on('click', '.btn_actualizar_empresa', function (event) {
        event.stopImmediatePropagation();

        var postData = new FormData($("#edit_empresa_form_" + $idEmpresa)[0]);

        $.ajax({
            type: "POST",
            url: 'confEmpresa/editEmpresa',
            contentType: false,
            cache: false,
            processData: false,
            data: postData
        }).done(function (data) {
            alert('Se modificó la empresa exitosamente');
            window.location.reload();
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

    $(".main_image").change(function() {
        readURLMain(this);
    });

});