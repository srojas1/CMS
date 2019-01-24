$(document).ready(function(){

    $('.modal').on('show.bs.modal', function (e) {

        $idRecompensa = $(this).find('.id_recompensa').val();

        $(document).on('click', '.editar_recompensa', function (event) {
            event.stopImmediatePropagation();

            var postData = new FormData($("#edit_recompensa_form_" + $idRecompensa)[0]);

            $.ajax({
                type: "POST",
                url: 'recompensa/editRecompensa',
                contentType: false,
                cache: false,
                processData: false,
                data: postData
            }).done(function (data) {
                alert('Se modificó la recompensa exitosamente');
                location.reload();
            });
        });
    });

    $(document).on('click','.crear_recompensa',function () {

        var postData = new FormData($("#create_recompensa_form")[0]);

        $.ajax({
            type: "POST",
            url: 'recompensa/storeRecompensa',
            contentType: false,
            cache: false,
            processData: false,
            data: postData
        }).done(function(data) {
            alert('Se agregó la recompensa exitosamente');
            location.reload();
        });

    });

    $('.nav-tabs > li > a.recompensa').on("click",function(e){
        e.preventDefault();
        $(document).find(".buscador").addClass("buscadorRecompensa");
        $(document).find(".buscadorCupon").addClass("buscadorRecompensa");
        $(document).find(".buscador").removeClass("buscador");
        $(document).find(".buscadorCupon").removeClass("buscadorCupon");
    });

    $(document).on('keyup', '.buscadorRecompensa', function () {
        var value = $(this).val().toLowerCase();
        $(".table_recompensa tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});