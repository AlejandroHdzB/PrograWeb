function extraeElementosFila (button){
    let claseDelBoton = button.className;
    let clases = claseDelBoton.split(' ');
    console.log('Clase del botón:', clases[1]);

    //extra para ver que funcione
    let row = button.closest('tr');
    let datos ={
    id :row.cells[0].textContent,
    nombre :row.cells[1].textContent,
    precio :row.cells[2].textContent,
    cantidad :row.cells[3].textContent
    }
    console.log(`ID: ${datos.id}, Nombre: ${datos.nombre}, Precio: ${datos.precio}, Cantidad: ${datos.cantidad}`);
    localStorage.setItem('datos', JSON.stringify(datos));
    //extra para ver que funcione
    window.location.href = 'update.php';
}