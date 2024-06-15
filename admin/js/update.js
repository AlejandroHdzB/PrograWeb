document.addEventListener('DOMContentLoaded', function() {

    let datosGuardados = localStorage.getItem('datos');

    if (datosGuardados) {
        let d = JSON.parse(datosGuardados);
        console.log(d.id); 
        document.getElementById('id').value=d.id;
        console.log(d.nombre); 
        document.getElementById('nombre').value=d.nombre;      
        console.log(d.precio); 
        document.getElementById('precio').value=d.precio;
        console.log(d.cantidad);
        document.getElementById('cantidad').value=d.cantidad;   
    } else {
        console.log('No hay datos guardados en localStorage.');
    }
});
