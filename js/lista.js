var informacion = {
    ID_Med: listaMed
}

$('.gotolist').click(function () {
    $.post('lista_agregada.php', {
        data: JSON.stringify(informacion)
    }, function (data) {
        $('body').empty();
        $('body').html(data);
        $(document).ready(function() {
            var script = $("<script>").attr({
                "defer": "defer",
                "src": "../js/IDs_lista.js"
            });
            $("head").append(script);
        });
    });
});
