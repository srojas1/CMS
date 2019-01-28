$(document).ready(function(){

    $('.modal').on('show.bs.modal', function (e) {

        var rowid = $(e.relatedTarget).data('id');
        
        idPedido = $(this).find('#id_pedido').val();
        selectEstado = $(this).find('.id_estado');
        idEstadoChange = $(this).find('#id_estado_done').val();

        $(this).find('.detalle_aceptar a').on('click', function () {

            $.ajax({
                type: "POST",
                url: 'pedido/changeStatus',
                data: {
                    id_estado: idEstadoChange,
                    id_pedido: idPedido
                }
            }).done(function(msg) {
                alert('se modificó el estado');
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
        $(".table_pedido tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    $(document).on('keyup', '.buscadorHistorico', function () {
        var value = $(this).val().toLowerCase();
        $(".table_historico tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

});