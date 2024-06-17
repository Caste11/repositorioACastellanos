<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="web/css/estilosLoginYRegistros.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Registar</title>
</head>
<body id="loginRegister">


<div class="container">
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <h2 class="text-center text-dark mt-5">Resgistrarse en Virtual Vault</h2>
        <div class="card my-5">

          <form class="card-body cardbody-color p-lg-5" action="index.php?accion=registrar" method="post">

            <div class="mb-3">
            <input type="email" name="email" placeholder="Introduce tu email" class="form-control" id="Username" required value="<?= isset($email) ? $email : '' ?>"> 
            </div>
            <div class="mb-3">
            <input type="password" name="password" placeholder="Intorducce la password" class="form-control" id="password" required value="<?= isset($password) ? $password : '' ?>"> 
            </div>
            <div class="mb-3">
            <input type="text" name="nombre" placeholder="Introduce tu nombre" class="form-control" id="Username" required value="<?= isset($nombre) ? $nombre : '' ?>"> 
            </div>
            <div class="mb-3">
            <input type="text" name="telefono" placeholder="Introduce tu telefono" class="form-control" id="Username" required value="<?= isset($telefono) ? $telefono : '' ?>"> 
            </div>
            <div class="mb-3">
            <input type="text" name="poblacion" placeholder="Introduce tu poblacion" class="form-control" id="Username" required value="<?= isset($poblacion) ? $poblacion : '' ?>"> 
            </div>
            <div class="text-center"><button type="submit" class="btn btn-color px-5 mb-5 w-100">Registrate</button></div>
            <div id="emailHelp" class="form-text text-center mb-5 text-dark">Estas registrado pues <a href="index.php?accion=inicio" class="text-dark fw-bold"> Inicia Sesión</a>
            <?php 
                imprimirMensaje();
              ?>  
          </div>
          </form>
        </div>

      </div>
    </div>
  </div>

</body>
</html>