<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre Mi</title>
    <style>
        body{
            background-color: grey;
        }
    </style>
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
                            <a class="nav-link active" aria-current="page" href="index.php?accion=misJuegos">Mis Juegos</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="index.php?accion=ver_juegos">Volver Atras</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Sobre Mi</h1>
        <div id="primera-parte" class="mb-5">
            <div id="sobre-mi" class="mb-4">
                <p>Hola buenas, soy Alejandro Castellanos Moreno, una simple persona a la cual le gusta la informática y todo lo relacionado con ello. Ahora mismo estoy terminando de cursar un grado de programación (DAW).</p>
            </div>

            <div id="imagenes-contacto" class="d-flex justify-content-center gap-3">
                <a href="https://github.com/Caste11" target="_blank" class="me-3"><img src="web/imagenes/github.png" class="img-fluid" alt="GitHub" style="width: 50px;"></a>
                <a href="mailto:castellanosmoreno9@gmail.com"><img src="web/imagenes/gmail.png" class="img-fluid" alt="GitHub" style="width: 50px;"></a>
            </div>
        </div>

        <div id="segunda-parte">
            <div id="mis-estudios" class="mb-5">
                <h2 class="text-center mb-4">Estudios Realizados</h2>
                <div id="estudios1" class="mb-4">
                    <h3>Grado Superior - Desarrollo de Aplicaciones Web</h3>
                    <p>Terminado en Junio de 2024</p>
                    <p>En dicho grado se enseña a desarrollar aplicaciones web totalmente completas y funcionales.</p>
                </div>
                <div id="estudios2" class="mb-4">
                    <h3>Grado Medio - Sistemas Microinformáticos y Redes</h3>
                    <p>Terminado en Junio de 2022</p>
                    <p>En dicho grado se enfoca sobre la formación profesional sobre conocimientos y habilidades sobre la gestión, diseño y mantenimiento de sistemas de redes.</p>
                </div>
                <div id="estudios3" class="mb-4">
                    <h3>ESO</h3>
                    <p>Terminado en Junio de 2020</p>
                    <p>Estudios Generales</p>
                </div>
            </div>
            <div id="curriculum" class="text-center">
                <h2 class="mb-3">Currículum Vitae</h2>
                <p>Se puede descargar mi CV en formato de PDF en el siguiente botón:</p>
                <a href="web/archivos/CV_AlejandroCastellanos.pdf" download class="btn btn-primary">Descargar CV</a>
                <a href="index.php?accion=ver_juegos" class="btn btn-danger">Volver Atras</a>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
