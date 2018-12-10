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
            alert('El estado fue cambiad exitosamente');
        });

});