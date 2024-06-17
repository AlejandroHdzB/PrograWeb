function insert(event) {
    let formulario = document.getElementById("productForm");
    event.preventDefault();

    let vn = validarVacio(formulario.elements[0].value, formulario.elements[0].name)
    let vp = validarVacio(formulario.elements[1].value, formulario.elements[1].name)
    let vc = validarVacio(formulario.elements[2].value, formulario.elements[2].name)
    let vd = validarVacio(formulario.elements[3].value, formulario.elements[3].name)


    if (vn && vp && vc && vd) {
        let p = validarNumeros(formulario.elements[2].value, formulario.elements[2].name)
        let c = validarNumeros(formulario.elements[3].value, formulario.elements[3].name)
        if (p && c) {
            let nombre = formulario.elements[0].value.trim();
            let precio = formulario.elements[1].value.trim();
            let cantidad = formulario.elements[2].value.trim();
            let detalles = formulario.elements[3].value.trim();


            let datos = {
                nombre: nombre,
                precio: precio,
                cantidad: cantidad,
                detalles: detalles
            }
            $.ajax({
                type: "POST",
                url: "../model/insertProduct.php",
                data: datos,
                success: function (result) {
                    alert(result)
                },
                error: function (xhr, status, error) {
                    console.error("Error en la solicitud:", error);
                }
            });
        }
    }else{
        alert("falta llenar datos")
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