<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Virtual Vault</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .card {
            width: 250px; /* Ancho fijo de la carta */
            margin: 15px; /* Espacio alrededor de cada carta */
        }
        .card-img-top {
            height: 200px; /* Altura de la imagen */
            object-fit: cover; /* Ajuste de la imagen dentro del contenedor */
        }
        .card-title, .card-text {
            white-space: nowrap; /* Evita que el texto se rompa en varias líneas */
            overflow: hidden; /* Oculta el texto desbordado */
            text-overflow: ellipsis; /* Añade puntos suspensivos al texto desbordado */
        }

        body{
            background-image: url(web/imagenes/fondoTodosLosJuegos.png);
            background-attachment: fixed;
            background-repeat: no-repeat;
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php?accion=ver_juegos">Virtual Vault</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php?accion=misJuegos">Mis Juegos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?accion=sobremi">Sobre Mi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?accion=logout">Cerrar Sesion</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="container">
        <div class="d-flex flex-wrap">
            <?php foreach ($juegosConFoto as $i => $juego): ?>
                <div class="card flex">
                    <a href="index.php?accion=ver_dentro&id=<?= $juego->getId()?>" class="w-100" style="text-decoration: none; color: black;">
                        <div>
                            <img src="web/fotosJuegos/<?= $juego->getFoto() ?>" class="card-img-top" alt="<?= $juego->getTitulo() ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?= $juego->getTitulo() ?></h5>
                                <p class="card-text"><?= $juego->getDescripcion() ?></p>
                                <p class="card-text"><?= $juego->getIdCategoria() ?></p>
                                <p class="card-text"><small class="text-muted"><?= $juego->getPrecio() ?> $</small></p>
                            </div>
                        </div>
                    </a>
                    <input class="idJuego" type="hidden" value="<?= $juego->getId()?>">
                    <input class="idUsuario" type="hidden" value="<?= $juego->getIdUsuario()?>">
                    <?php 
                        $isFavorite = false;
                        if ($favoritosDeUsuario != null) {
                            foreach ($favoritosDeUsuario as $j => $favorito) {
                                if ($favorito == $juego->getId()) {
                                    $isFavorite = true;
                                    break;
                                }
                            }
                        }
                    ?>
                    <?php if ($isFavorite): ?>
                        <i class="fa-solid fa-star m-2 p-2 w-100" id="favorito" style="color: #FFD43B;"></i>
                    <?php else: ?>
                        <i class="fa-regular fa-star m-2 p-2 w-100" id="nofavorito"></i>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="web/JsFavoritos/favoritos.js"></script>
</body>
</html>
