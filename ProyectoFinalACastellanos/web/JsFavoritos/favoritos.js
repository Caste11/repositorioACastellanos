document.querySelectorAll('#nofavorito').forEach((nofavorito) => {
    nofavorito.addEventListener('click', () => {
        aniadirFavorito(nofavorito)
    });
});

document.querySelectorAll('#favorito').forEach((favorito) => {
    favorito.addEventListener('click', () => {
        quitarFavorito(favorito)
    });
});

function aniadirFavorito(pulsado) {
    let idJuego = pulsado.parentElement.children[1].value;
    let idUsuario = pulsado.parentElement.children[2].value;

    const datos = new FormData();
    datos.append('idJuego', idJuego);
    datos.append('idUsuario', idUsuario);

    const options = {
        method: "POST",
        body: datos
    };

    fetch("index.php?accion=crear_favorito", options)
    .then(respuesta => {
        return respuesta.json();
    })
    .then(respuesta_crear => {
        if (respuesta_crear.respuesta != 'error') {
            let favorito = document.createElement('i');
            favorito.classList.add('fa-solid', 'fa-star', 'm-2', 'p-2', 'w-100');
            favorito.style.color = '#FFD43B';
            favorito.id = 'favorito';
            favorito.addEventListener('click', () => {
                quitarFavorito(favorito);
            });
            pulsado.parentElement.appendChild(favorito);
            pulsado.remove();
        }
    })
}

function quitarFavorito(pulsado) {
    let idJuego = pulsado.parentElement.children[1].value;
    let idUsuario = pulsado.parentElement.children[2].value;

    const datos = new FormData();
    datos.append('idJuego', idJuego);
    datos.append('idUsuario', idUsuario);

    const options = {
        method: "POST",
        body: datos
    };

    fetch("index.php?accion=eliminar_favorito", options)
    .then(respuesta => {
        return respuesta.json();
    })
    .then(respuesta_eliminar => {
        if (respuesta_eliminar.respuesta != 'error') {
            let favorito = document.createElement('i');
            favorito.classList.add('fa-regular', 'fa-star', 'm-2', 'p-2', 'w-100');
            favorito.addEventListener('click',  () => {
                aniadirFavorito(favorito);
            });
            pulsado.parentElement.appendChild(favorito);
            pulsado.remove();
        } else {
            console.log('error');
        }
    })
}