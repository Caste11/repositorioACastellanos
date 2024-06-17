<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aquí podra encontrar todos tus juegos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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

    <h1>Bienvenido <?= Sesion::getUsuario()->getNombre() ?> a tu apartado de juegos</h1>

    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCrear" data-bs-whatever="@mdo">Nuevo Juego</button>
    
    <div id="contenedorJuegos">
        <?php foreach ($juegosConFoto as $j): ?>
            <div class="juego">
                <div class="titulo">Titulo: <?= $j->getTitulo() ?></div>
                <div class="descripcion">Descripción: <?= $j->getDescripcion() ?></div>
                <div class="fotos">
                    <img src="web/fotosJuegos/<?= $j->getFoto() ?>" alt="">
                </div>
                <div class="categoria">Categoria: <?= $j->getIdCategoria() ?></div>
                <div class="precio">Precio: <?= $j->getPrecio() ?> $</div>
                <i class="fa-solid fa-trash papelera" data-idJuego="<?= $j->getId()?>"></i>
        <?php endforeach; ?>
    </div>

    <div class="modal fade" id="modalCrear" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Nuevo Juego</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="titulo" class="col-form-label">Titulo:</label>
                            <input type="text" class="form-control" id="titulo" name="titulo">
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="col-form-label">Descripción:</label>
                            <textarea class="form-control" id="descripcion" name="descripcion"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="fotos" class="col-form-label">Foto:</label>
                            <input type="file" class="form-control" id="fotos" name="fotos[]" multiple>
                        </div>
                        <div class="mb-3">
                            <label for="categoria" class="col-form-label">Categoria:</label>
                            <select name="categoria" id="categoria" class="form-control">
                                <?php foreach ($categorias as $c): ?>
                                    <option value="<?= $c->getId() ?>"><?= $c->getIdCategoria() ?></option>
                                <?php endforeach; ?>  
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="precio" class="col-form-label">Precio:</label>
                            <input type="text" class="form-control" id="precio" name="precio">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="botonNuevoJuego">Confirmar Anuncio</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="web/js.js" type="text/javascript"></script>
</body>
</html>
