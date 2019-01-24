$(document).ready(function(){

    $(document).on('keyup', '.buscador', function () {
        var value = $(this).val().toLowerCase();
        $(".table_cliente tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

});