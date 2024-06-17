<?php 

class ControladorFavoritos {

    public function crear() {
        $connexionDB = new ConnexionDB(MYSQL_USER,MYSQL_PASS,MYSQL_HOST,MYSQL_DB);
        $conn = $connexionDB->getConnexion();

        $favoritosDAO = new FavoritosDAO($conn);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $idUsuario = htmlspecialchars($_POST['idUsuario']);
            $idJuego = htmlspecialchars($_POST['idJuego']);

            $favorito = new Favorito();
            $favorito->setIdUsuario($idUsuario);
            $favorito->setIdJuego($idJuego);

            $id = $favoritosDAO->insert($favorito);

            if ($id != null) {
                echo json_encode(['respuesta' => 'ok', 'idFavorito' => $id]);
            } else {
                echo json_encode(['respuesta' => 'error']);
            }
        }
    }

    public function eliminar() {
        $connexionDB = new ConnexionDB(MYSQL_USER,MYSQL_PASS,MYSQL_HOST,MYSQL_DB);
        $conn = $connexionDB->getConnexion();

        $favoritosDAO = new FavoritosDAO($conn);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $idUsuario = htmlspecialchars($_POST['idUsuario']);
            $idJuego = htmlspecialchars($_POST['idJuego']);

            $resultado = $favoritosDAO->delete($idUsuario, $idJuego);

            if ($resultado) {
                echo json_encode(['respuesta' => 'ok']);
            } else {
                echo json_encode(['respuesta' => 'error']);
            }
        }
    }
}

?>