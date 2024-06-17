<?php 

class ControladorJuegos{
    public function ver(){
        //Creamos la conexión utilizando la clase que hemos creado
        $connexionDB = new ConnexionDB(MYSQL_USER,MYSQL_PASS,MYSQL_HOST,MYSQL_DB);
        $conn = $connexionDB->getConnexion();

        $juegosDAO = new JuegosDAO($conn);
        $fotosDAO = new FotosDao($conn);
        $categoriasDAO = new CategoriasDAO($conn);
        $favoritosDAO = new FavoritosDAO($conn);
        $categorias = $categoriasDAO->getAllCategorias();
        $juegos = $juegosDAO->getAll();

        $juegosConFoto = array();

        foreach ($juegos as $j) {
            $fotos = $fotosDAO->getFotosByIdJuego($j->getId());
            $primeraFoto = $fotos[0]->getNombrefoto();
            $j->setFoto($primeraFoto);
            $j->setIdCategoria($categoriasDAO->getNombreById($j->getIdCategoria()));
            $juegosConFoto[] = $j;
        }

        $favoritosDeUsuario = $favoritosDAO->obtenerTodosDeUsuario(Sesion::getUsuario()->getId());
        
        require 'app/vistas/VerJuegos.php';
    }

    public function mijuego(){
        $connexionDB = new ConnexionDB(MYSQL_USER,MYSQL_PASS,MYSQL_HOST,MYSQL_DB);
        $conn = $connexionDB->getConnexion();

        $juegosDAO = new JuegosDAO($conn);
        $fotosDAO = new FotosDao($conn);
        $categoriasDAO = new CategoriasDAO($conn);
        $categorias = $categoriasDAO->getAllCategorias();
        $juegos = $juegosDAO->obtenerJuegoPorIdUsuario(Sesion::getUsuario()->getId());

        $juegosConFoto = array();

        foreach ($juegos as $j) {
            $fotos = $fotosDAO->getFotosByIdJuego($j->getId());
            $primeraFoto = $fotos[0]->getNombrefoto();
            $j->setFoto($primeraFoto);
            $j->setIdCategoria($categoriasDAO->getNombreById($j->getIdCategoria()));
            $juegosConFoto[] = $j;
        }

        require 'app/vistas/MiJuego.php';
    }

    public function insertar(){

        $error = '';

        $connexionDB = new ConnexionDB(MYSQL_USER,MYSQL_PASS,MYSQL_HOST,MYSQL_DB);
        $conn = $connexionDB->getConnexion();

        $juegosDAO = new JuegosDAO($conn);
        $categoriasDAO = new CategoriasDAO($conn);
        $juegos = $juegosDAO->obtenerJuegoPorIdUsuario(Sesion::getUsuario()->getId());

        if($_SERVER['REQUEST_METHOD']=='POST'){
            $titulo = htmlspecialchars($_POST['titulo']);
            $descripcion = htmlspecialchars($_POST['descripcion']);
            $precio = htmlspecialchars($_POST['precio']);
            $idCategoria = htmlspecialchars($_POST['idCategoria']);

            if(empty($titulo)||empty($descripcion)||empty($precio)||empty($idCategoria)){
                $error = "Los campos son obligatorios";
            }
            else{
                $array_fotos = array();
                $array_fotosTMP = array();
                $array_fotosINS = array();

                if ($_FILES['fotos']['error'][0] == UPLOAD_ERR_NO_FILE) {
                    $error = "Debes añadir al menos una foto al juego";
                } elseif (count($_FILES['fotos']['name']) > 7) {
                    $error = "No puedes subir más de 7 fotos a un juego";
                } else {
                    $num_files = count($_FILES['fotos']['name']);

                    for ($i = 0; $i < $num_files; $i++) {
                        $array_fotos[] = $_FILES['fotos']['name'][$i];
                        $array_fotosTMP[] = $_FILES['fotos']['tmp_name'][$i];
                    }
                }

                foreach ($array_fotos as $i => $foto) {
                    // Comprobamos que la extensión de los archivos introducidos son válidas
                    $extension = pathinfo($foto, PATHINFO_EXTENSION);
                    if ($extension != 'jpg' && $extension != 'jpeg' && $extension != 'png') {
                        $error = "Alguna de las fotos no tiene un formato admitido, deben de ser jpg, jpeg o png";
                    } else {
                        // Copiamos la foto al disco
                        // Calculamos un hash para el nombre del archivo
                        $foto = uniqid(true) . '.' . $extension;

                        // Si existe un archivo con ese nombre volvemos a calcular el hash
                        while (file_exists("web/fotosJuegos/$foto")) {
                            $foto = uniqid(true) . '.' . $extension;
                        }

                        foreach ($array_fotosTMP as $j => $fotoTMP) {
                            if ($i == $j && $error == '') {
                                if (!move_uploaded_file($fotoTMP, "web/fotosJuegos/$foto")) {
                                    die("Error al copiar la foto a la carpeta fotosJuegos");
                                }
                            }
                        }

                        $array_fotosINS[] = $foto;
                    }
                }

                if($error == '' ){
                    $juego = new Juego();
                    $juego->setTitulo($titulo);
                    $juego->setDescripcion($descripcion);
                    $juego->setIdCategoria($idCategoria);
                    $juego->setPrecio($precio);
                    $juego->setIdUsuario(Sesion::getUsuario()->getId());

                    $idJ = $juegosDAO->insert($juego);

                    $juego->setIdCategoria($categoriasDAO->getNombreById($idCategoria));

                    if($idJ != null){
                        $fotosDAO = new FotosDAO($conn);
                        $fotosDAO->insertarVariasFotos($array_fotosINS, $idJ);
                    
                        // Asegúrate de que $array_fotosINS[0] contiene el nombre de la primera foto
                        $fotoUrl = "web/fotosJuegos/" . $array_fotosINS[0];
                        print json_encode(['respuesta' => 'ok', 'juego' => $juego->toJSON($idJ), 'primerafoto' => $fotoUrl]);
                    } else {
                        print json_encode(['respuesta' => 'error']);
                    }
                }
            }
        }
    }

    public function borrar(){
        //Creamos la conexión utilizando la clase que hemos creado
        $connexionDB = new ConnexionDB(MYSQL_USER,MYSQL_PASS,MYSQL_HOST,MYSQL_DB);
        $conn = $connexionDB->getConnexion();

        //Creamos el objeto JuegosDAO para acceder a BBDD a través de este objeto
        $juegosDAO = new JuegosDAO($conn);
        $fotosDAO = new FotosDAO($conn);

        //Obtener el mensaje
        $idJuego = htmlspecialchars($_GET['id']);
        $juegos = $juegosDAO->obtenerJuegoPorID($idJuego);
        error_log(json_encode($juegos));

        //Ruta de la carpeta donde se guardan las fotos
        $ruta = "web/fotosJuegos/";

        //Obtener fotos por el id
        $foto = $fotosDAO->getFotosByIdJuego($idJuego);
        foreach ($foto as $f) {
            $fotos = $f->getNombrefoto();
            
                $rutaCompleta2 = $ruta . $fotos;
                
                if (file_exists($rutaCompleta2)) {
                    if (unlink($rutaCompleta2)) {
                    } else {
                        $_SESSION['error'] = "Error al intentar eliminar el archivo.";
                    }
                } else {
                    $_SESSION['error'] = "El archivo no existe en la ruta proporcionada.";
                }
            
        }

        //Comprobamos que mensaje pertenece al usuario conectado
        if($juego = $juegosDAO->borrarJuego($idJuego)){

            echo json_encode(['respuesta'=>'ok']);
        }else{
            echo json_encode(['respuesta'=>'error', 'mensaje'=>'Juego no encontrado']);
        }

    }

    public function dentro(){
         // Crear la conexión utilizando la clase que hemos creado
         $connexionDB = new ConnexionDB(MYSQL_USER,MYSQL_PASS,MYSQL_HOST,MYSQL_DB);
         $conn = $connexionDB->getConnexion();
 
         // Obtener el ID del juego desde la solicitud GET
         $idJuego = htmlspecialchars($_GET['id']);
         
         $juegosDAO = new JuegosDAO($conn);
         $fotosDAO = new FotosDAO($conn);
         $categoriasDAO = new CategoriasDAO($conn);
 
         // Obtener el juego por ID
         $juego = $juegosDAO->obtenerJuegoPorID($idJuego);
 
         // Verificar si el juego existe
         if ($juego) {
             // Obtener las fotos del juego
             $fotos = $fotosDAO->getFotosByIdJuego($idJuego);
             
             // Obtener el nombre de la categoría
             $categoriaNombre = $categoriasDAO->getNombreById($juego->getIdCategoria());
             $juego->setIdCategoria($categoriaNombre);
             
             require 'app/vistas/dentroJuego.php';
         } else {
             // Manejo de error si el juego no se encuentra
             echo "Juego no encontrado";
         }
    }

    public function editar(){
        require 'app/vistas/editarJuego.php';
    }

}
?>