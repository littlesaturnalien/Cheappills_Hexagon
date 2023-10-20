let listaMed = [];

if(localStorage.getItem('lista_med') !== null){
    listaMed = JSON.parse(localStorage.getItem('lista_med'));
}
document.querySelectorAll('.add-list').forEach(elementt => {
    elementt.addEventListener('click', function () {
        const Med_ID = parseInt(this.parentElement.querySelector('.real-image').id);
        if (!listaMed.includes(Med_ID)) {
            listaMed.push(Med_ID);
            localStorage.setItem('lista_med', JSON.stringify(listaMed));
            alert("Medicamento agregado");
            console.log(listaMed);
        } else {
            alert("Tu medicamento ya ha sido agregado a la lista");
        }
    });
});




