$(document).ready(function(){

    $(document).on('click','.crear_categoria',function () {
        var postData = new FormData($("#create_category_form")[0]);

            $.ajax({
                type: "POST",
                url: 'categoria/create',
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
                url: 'categoria/update',
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

    $('.pagination-demo').twbsPagination({
        totalPages: 5,
        startPage: 1,
        visiblePages: 5,
        initiateStartPageClick: true,
        href: false,
        hrefVariable: '{{number}}',
        first: 'First',
        prev: 'Previous',
        next: 'Next',
        last: 'Last',
        loop: false,
        onPageClick: function (event, page) {
            $('.page-active').removeClass('page-active');
            $('#page'+page).addClass('page-active');
        },
        paginationClass: 'pagination',
        nextClass: 'next',
        prevClass: 'prev',
        lastClass: 'last',
        firstClass: 'first',
        pageClass: 'page',
        activeClass: 'active',
        disabledClass: 'disabled'

    });

});