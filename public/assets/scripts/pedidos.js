$(document).ready(function(){

    $('.modalPedido').on('hidden.bs.modal', function (e) {
       e.stopImmediatePropagation();
       location.reload();
    });

    $('.modal').on('show.bs.modal', function (e) {
        e.stopImmediatePropagation();

        var rowid = $(e.relatedTarget).data('id');
        
        idPedido = $(this).find('#id_pedido').val();
        selectEstado = $(this).find('.id_estado');

        $(this).on('click',".detalle_aceptar a", function (event) {

            idEstadoChange = $(this).next('#id_status_next').val();
            labelExtra     = "("+$(this).text()+")";

            $.ajax({
                type: "POST",
                url: 'pedido/changeStatus',
                data: {
                    id_estado: idEstadoChange,
                    id_pedido: idPedido,
                    label_extra: labelExtra
                }
            }).done(function(msg) {
                $(".modal-content").load(window.location + " .modal-content");
            });
        });

        $(this).on('click',".detalle_rechazar a", function (event) {

            idEstadoChange = $(this).next('#id_status_next').val();

            $.ajax({
                type: "POST",
                url: 'pedido/changeStatus',
                data: {
                    id_estado: idEstadoChange,
                    id_pedido: idPedido
                }
            }).done(function(msg) {
                $(".modal-content").load(window.location + " .modal-content");
            });
        });
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