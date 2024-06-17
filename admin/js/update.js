document.addEventListener('DOMContentLoaded', function () {

    let datosGuardados = localStorage.getItem('datos');

    if (datosGuardados) {
        let d = JSON.parse(datosGuardados);
        console.log(d.id);
        document.getElementById('id').value = d.id;
        console.log(d.nombre);
        document.getElementById('nombre').value = d.nombre;
        console.log(d.precio);
        document.getElementById('precio').value = d.precio;
        console.log(d.cantidad);
        document.getElementById('cantidad').value = d.cantidad;
    } else {
        console.log('No hay datos guardados en localStorage.');
    }
    localStorage.removeItem('datos');
});

function update(event) {
    event.preventDefault()
    let formulario = document.getElementById("formularioActualizar");

    let vp = validarVacio(formulario.elements[2].value, formulario.elements[2].name)
    let vc = validarVacio(formulario.elements[3].value, formulario.elements[3].name)
    if (vp && vc) {
        let p = validarNumeros(formulario.elements[2].value, formulario.elements[2].name)
        let c = validarNumeros(formulario.elements[3].value, formulario.elements[3].name)

        if (p && c) {
            let id = formulario.elements[0].value;
            let n = formulario.elements[1].value;
            let p = formulario.elements[2].value;
            let c = formulario.elements[3].value;


            let datos = {
                id: id,
                nombre: n,
                precio: p,
                cantidad: c
            }
            $.ajax({
                type: "POST",
                url: "../model/updateProductos.php",
                data: datos,
                success: function (result) {
                    alert(result)
                },
                error: function (xhr, status, error) {
                    console.error("Error en la solicitud:", error);
                }
            });
        }
    }
}

function validarVacio(dato, nombre) {
    if (dato === null || dato === undefined) {
        alert(nombre + ' es vacio');
        return false;
    }
    if (typeof dato === 'string' && dato.trim() === '') {
        alert(nombre + ' es vacio');
        return false;
        
    }
    return true;
}

function validarNumeros(numero, nombre) {
    if (numero < 0) {
        alert(nombre + ' es menor que cero');
        return false;
    } else {
        return true;
    }

}
