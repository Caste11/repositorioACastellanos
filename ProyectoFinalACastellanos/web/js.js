let botonInsertar = document.getElementById('botonNuevoJuego');

botonInsertar.addEventListener('click', function () {
    let fotos = document.getElementById('fotos').files;

    // Enviamos los datos mediante el POST construyendo el FormData
    const datos = new FormData();
    for (var i = 0; i < fotos.length; i++) {
        datos.append('fotos[]', fotos[i]);
    }
    datos.append('titulo', document.getElementById('titulo').value);
    datos.append('descripcion', document.getElementById('descripcion').value);
    datos.append('precio', document.getElementById('precio').value);
    datos.append('idCategoria', document.getElementById('categoria').value);

    const options = {
        method: "POST",
        body: datos
    };

    fetch("index.php?accion=insertar_juego", options)
    .then(respuesta => {
        return respuesta.json();
    })
    .then(data => {
        if (data.respuesta === 'ok') {
            const juego = JSON.parse(data.juego);
            
            // Crear el contenedor para el nuevo juego
            let juegoDiv = document.createElement('div');
            juegoDiv.className = 'juego';

            // Título del juego
            let titulo = document.createElement('div');
            titulo.innerText = 'Titulo: ' + juego.titulo;
            juegoDiv.appendChild(titulo);

            // Descripción del juego
            let descripcion = document.createElement('div');
            descripcion.innerText = 'Descripción: ' + juego.descripcion;
            juegoDiv.appendChild(descripcion);

            // Añadir la primera foto del juego
            if (data.primerafoto) {
                let fotosDiv = document.createElement('div');
                fotosDiv.className = 'fotos';
                let img = document.createElement('img');
                img.src = data.primerafoto;
                fotosDiv.appendChild(img);
                juegoDiv.appendChild(fotosDiv);
            }

            // Categoria del juego
            let categoria = document.createElement('div');
            categoria.innerText = 'Categoria: ' + juego.idCategoria;
            juegoDiv.appendChild(categoria);

            // Precio del juego
            let precio = document.createElement('div');
            precio.innerText = 'Precio: ' + juego.precio + ' $';
            juegoDiv.appendChild(precio);

            // Añadir el icono de la papelera
            var papelera = document.createElement('i');
            papelera.className = 'fa-solid fa-trash papelera';
            papelera.setAttribute('data-idJuego', juego.id);
            juegoDiv.appendChild(papelera);

            // Añadir el nuevo juego al contenedor de juegos
            document.getElementById('contenedorJuegos').appendChild(juegoDiv);
            
            // Cerrar el modal
            var myModalEl = document.getElementById('modalCrear');
            var modal = bootstrap.Modal.getInstance(myModalEl);
            modal.hide();

            document.getElementById('titulo').value = '';
            document.getElementById('descripcion').value = '';
            document.getElementById('precio').value = '';
            document.getElementById('categoria').value = '';
            document.getElementById('fotos').value = '';

            //Añadir manejador de evento Borrar a la nueva papelera
            papelera.addEventListener('click',manejadorBorrar);

        } else {
            // Manejo de errores (opcional)
            alert('Error al insertar el juego: ' + data.error);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});

let papeleras = document.querySelectorAll('.papelera');
papeleras.forEach(papelera => {
    papelera.addEventListener('click',manejadorBorrar);
});

function manejadorBorrar(){
    //this referencia al elementos del DOM sobre el que hemos hecho click
    var idJuego= this.getAttribute('data-idJuego');
    //Llamamos al script del servidor que borra la tarea pasándole el idTarea como parámetro
    fetch('index.php?accion=borrar_juego&id='+idJuego)
    .then(datos => datos.json())
    .then(respuesta =>{
        if(respuesta.respuesta=='ok'){
            this.parentElement.remove();
        }
        else{
            alert("No se ha encontrado el juego en el servidor");
            this.style.visibility='visible';
        }
    })
    
}
