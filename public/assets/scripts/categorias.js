$(document).ready(function(){

    $(document).on('click','.crear_categoria',function () {
        var postData = new FormData($("#create_category_form")[0]);

            $.ajax({
                type: "POST",
                url: 'categoria/storeCategory',
                contentType: false,
                cache: false,
                processData: false,
                data: postData
            }).done(function() {
                alert('Se agregó la categoría exitosamente');
                $('.modal').modal('hide');
                $(".table_categoria").load(window.location + " .table_categoria");
               });
    });

    $('.modal').on('show.bs.modal', function (e) {

        $idCategoria = $(this).find('.id_categoria').val();

        $(document).on('click', '.editar_categoria', function (event) {
            event.stopImmediatePropagation();

            var postData = new FormData($("#edit_category_form_" + $idCategoria)[0]);

            $.ajax({
                type: "POST",
                url: 'categoria/editCategoria',
                contentType: false,
                cache: false,
                processData: false,
                data: postData
            }).done(function (data) {
                alert('Se modificó la categoría exitosamente');
                $('.modal').modal('hide');
                $(".table_categoria").load(window.location + " .table_categoria");
            });
        });
    });
});