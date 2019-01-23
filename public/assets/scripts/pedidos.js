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
                    alert('se modificó el estado');
                    location.reload();
                });
            });
        });
        
        $(this).on('hidden.bs.modal', function (){
            window.location.reload();
        });

    $('.nav-tabs > li > a.historico').on("click",function(e){
        e.preventDefault();
        $(document).find(".buscador").addClass("buscadorHistorico");
        $(document).find(".buscador").removeClass("buscador");

    });

    $('.nav-tabs > li > a.pedidos').on("click",function(e){
        e.preventDefault();
        $(document).find(".buscadorHistorico").addClass("buscador");
        $(document).find(".buscadorHistorico").removeClass("buscadorHistorico");
    });

    $(document).on('keyup', '.buscador', function () {
        var value = $(this).val().toLowerCase();
        $(".table_pedido").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    $(document).on('keyup', '.buscadorHistorico', function () {
        var value = $(this).val().toLowerCase();
        $(".table_historico").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

});