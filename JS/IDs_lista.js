document.querySelectorAll('.delete-list').forEach(elementt => {
    elementt.addEventListener('click', function () {
        const Med_ID = parseInt(this.parentElement.querySelector('.real-image').id);
        let deletenumber = listaMed.indexOf(Med_ID);
        if (deletenumber !== -1) {
            listaMed.splice(deletenumber, 1);
            document.getElementById(Med_ID).closest('.all-medicine-container').remove();
            alert("Elemento eliminado de tu lista")
        }
        else {
            alert("Ha ocurrido un error al eliminar este elemento de tu lista")
        }
        localStorage.setItem('lista_med', JSON.stringify(listaMed));
        console.log(listaMed);
    });
});

var informacion = {
    ID_Med: listaMed
};

$('.gototable').click(function () {
    $.post('../php/tabla.php', {
        data: JSON.stringify(informacion)  
    }, function (data) {
        window.location.href="../php/tabla_pagina.php"
    });
});
