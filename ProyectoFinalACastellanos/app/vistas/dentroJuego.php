<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Juego</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="web/css/estilosdentroJuego.css">
    <style>
        body{
            background-image: url(web/imagenes/fondoDentroJuego.png);
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
                            <a class="nav-link" href="index.php?accion=sobremi">Sobre Mi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?accion=ver_juegos">Volver Atras</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="container">
        <h1><?php echo htmlspecialchars($juego->getTitulo()); ?></h1>
        <div class="game-details">
            <p><strong>Descripción:</strong> <?php echo htmlspecialchars($juego->getDescripcion()); ?></p>
            <p><strong>Precio:</strong> $<?php echo htmlspecialchars($juego->getPrecio()); ?></p>
            <p><strong>Categoría:</strong> <?php echo htmlspecialchars($juego->getIdCategoria()); ?></p>
            <p><strong>Fecha de Creación:</strong> <?php echo htmlspecialchars($juego->getFechaCreacion()); ?></p>
        </div>
        
        <h2>Fotos</h2>
        <?php if (!empty($fotos)) { ?>
            <div class="photos">
                <?php foreach ($fotos as $foto) { ?>
                    <img src="web/fotosJuegos/<?php echo htmlspecialchars($foto->getNombrefoto()); ?>" alt="Foto del juego">
                <?php } ?>
            </div>
        <?php } else { ?>
            <p>No hay fotos disponibles para este juego.</p>
        <?php } ?>
    </div>
</body>
</html>
