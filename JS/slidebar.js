
document.querySelectorAll('.catalogue-slidebar-info').forEach(elementt => {
    elementt.addEventListener('click', function () {
        let categoria = this.id;
        console.log(categoria);
        $.post('../php/recarga_catalogo.php',{
            data_category: JSON.stringify(categoria)
        }, function (data_category){
            $('.father').empty();
            $('.father').html(data_category);
        })
        })
    });