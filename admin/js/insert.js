function insert(event){
    let formulario = document.getElementById("productForm");
        event.preventDefault();
        if (nombre === '') { // Nombre
            valid = false;
            $('#nombre').addClass('is-invalid');
            $('#nombreError').text('El nombre es obligatorio.')
        } else {
            $('#nombre').removeClass('is-invalid');
            $('#nombreError').text('')
        }

        if (precio === '' ) { // Precio
            valid = false;
            $('#precio').addClass('is-invalid');
            $('#precioError').text('El precio es obligatorio.')
        } else if ( parseFloat(precio) <= 0 ){
            valid = false;
            $('#precio').addClass('is-invalid');
            $('#precioError').text('El precio debe ser mayor a cero.')

        } else {
            $('#precio').removeClass('is-invalid');
            $('#precioError').text('')
        }
        
        if (cantidad === '') { // Cantidad
            valid = false;
            $('#cantidad').addClass('is-invalid');
            $('#cantidadError').text('La cantidad es obligatoria.')
            
        } else if ( parseInt(cantidad) <= 0 ){
            valid = false;
            $('#cantidad').addClass('is-invalid');
            $('#cantidadError').text('La cantidad debe ser mayor a cero.')

        } else {
            $('#cantidad').removeClass('is-invalid');
            $('#cantidadError').text('')
        }
        
        if (detalles === '') { // Detalles
            valid = false;
            $('#detalles').addClass('is-invalid');
            $('#detallesError').text('Los detalles son obligatorios.')
        } else {
            $('#detalles').removeClass('is-invalid');
            $('#detallesError').text('')
        }
        let p = validarNumeros(formulario.elements[2].value,formulario.elements[2].name)
        let c = validarNumeros(formulario.elements[3].value,formulario.elements[3].name)
        if (p && c ){
            let nombre = formulario.elements[0].value.trim();
            let precio = formulario.elements[1].value.trim();
            let cantidad = formulario.elements[2].value.trim();
            let detalles = formulario.elements[3].value.trim();
        

            let datos={
                nombre:nombre,
                precio:precio,
                cantidad:cantidad,
                detalles:detalles
            }
            $.ajax({
                type: "POST",
                url: "../model/insertProduct.php",
                data:datos,
                success: function(result) {
                    alert(result)
                },
                error: function(xhr, status, error) {
                    console.error("Error en la solicitud:", error);
                }
            });
        }
  
}

function validarNumeros(numero,nombre){
    if(numero < 0){
        alert(nombre + ' es menor que cero');
        return false;
    }else{
        return true;
    }
    
}