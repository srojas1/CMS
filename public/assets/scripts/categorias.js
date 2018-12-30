$(document).ready(function(){

    $('.crear_categoria').on('click',function () {

        $nombreCategoria =$('.nueva_categoria').val();

               $.ajax({
                type: "POST",
                url: 'categoria/storeCategory',
                data: {categoria: $nombreCategoria}
            }).done(function() {
                location.reload();
                alert('Se agregó la categoría exitosamente');
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
                location.reload();
            });
        });
    });
});