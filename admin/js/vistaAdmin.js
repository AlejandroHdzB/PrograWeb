function extraeElementosFila (button){
    let claseDelBoton = button.className;
    let clases = claseDelBoton.split(' ');
    console.log('Clase del botón:', clases[1]);


    let row = button.closest('tr');
    let id = row.cells[0].textContent;
    let nombre = row.cells[1].textContent;
    let precio = row.cells[2].textContent;
    let cantidad = row.cells[3].textContent;

    console.log(`ID: ${id}, Nombre: ${nombre}, Precio: ${precio}, Cantidad: ${cantidad}`);
 
}