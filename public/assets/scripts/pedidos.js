$(document).ready(function(){

    $('.modal').on('show.bs.modal', function (e) {

        var rowid = $(e.relatedTarget).data('id');
        
        idPedido = $(this).find('#id_pedido').val();
        selectEstado = $(this).find('.id_estado');

        $(this).find('#id_estado_change').on('change', function () {

            idEstado = $(this).val();

            $.ajax({
                type: "POST",
                url: 'pedido/changeStatus', // This is what I have updated
                data: { id_estado: idEstado,
                        id_pedido: idPedido
                      }
                }).done(function(msg) {
                });
            });
        });
        
        $(this).on('hidden.bs.modal', function (){
            window.location.reload();
        });

    $(".buscador").on("keyup", function() {
        var value = $(this).val();

        $("table tr").each(function(index) {
            if (index !== 0) {

                $row = $(this);

                var id = $row.find("th:first").text();

                if (id.indexOf(value) !== 0) {
                    $row.hide();
                }
                else {
                    $row.show();
                }
            }
        });
    });

});