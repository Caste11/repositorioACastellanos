<?php 

class FavoritosDAO {

    private mysqli $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    function obtenerTodosDeUsuario($idUsuario):array|null {
      if (!$stmt = $this->conn->prepare("SELECT * FROM favoritos WHERE idUsuario = ?")) {
        echo "Error en la SQL: " . $this->conn->error;
      }

      $stmt->bind_param('i', $idUsuario);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows >= 1) {
          $array_favoritos_id = array();
          while ($favorito = $result->fetch_object(Favorito::class)) {
              $array_favoritos_id[] = $favorito->getIdJuego();
          }
          return $array_favoritos_id;
      } else {
          return null;
      }
    }

    function insert($favorito):int|bool{
        if(!$stmt = $this->conn->prepare("INSERT INTO favoritos (idUsuario, idJuego) VALUES (?,?) ")){
          die("Error al prepar la consulta insert: " . $this->conn->error);
        }

        $idUsuario = $favorito->getIdUsuario();
        $idJuego = $favorito->getIdJuego();
        $stmt->bind_param('ii',$idUsuario,$idJuego);
        if($stmt->execute()){
          return $stmt->insert_id;
        }else{
          return false;
        }
    }

    public function delete($idUsuario, $idJuego) {
      if(!$stmt = $this->conn->prepare("DELETE FROM favoritos WHERE idUsuario = ? AND idJuego = ?")) {
          echo "Error en la SQL: " . $this->conn->error;
      }
      //Asociar las variables a las interrogaciones(parámetros)
      $stmt->bind_param('ii', $idUsuario, $idJuego);
      //Ejecutamos la SQL
      $stmt->execute();
      //Comprobamos si ha borrado algún registro o no
      if ($stmt->affected_rows==1) {
          return true;
      } else {
          return false;
      }
    }
}
?>