$(document).ready(function(){

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
});