<?php 

class JuegosDAO {
    private mysqli $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAll():array{
        //$this->conn->prepare() devuelve un objeto de la clase mysqli_stmt
       if (!$stmt = $this->conn->prepare("SELECT * FROM juegos ORDER BY fecha_creacion DESC")) {
        echo "Error en la SQL: " . $this->conn->error;
       }
       //Ejecutamos la SQL
       $stmt->execute();
       //Obtener el objeto mysql_result
       $result = $stmt->get_result();

      $array_juegos = array();

      while($juegos = $result->fetch_object(Juego::class)){
           $array_juegos[] = $juegos;
      }
      return $array_juegos;
    }

    public function obtenerJuegoPorIdUsuario($idUsuario) {
        if (!$stmt = $this->conn->prepare("SELECT * FROM juegos WHERE idUsuario = ?")) {
            echo "Error en la SQL: " . $this->conn->error;
           }
           //Asociar las variables a las interrogaciones (parámetros)
           $stmt->bind_param('i',$idUsuario);
           //Ejecutamos la SQL
           $stmt->execute();
           //Obtener el objeto mysql_result
           $result = $stmt->get_result();
      
          $array_misjuegos = array();
      
          while($juego = $result->fetch_object(Juego::class)){
               $array_misjuegos[] = $juego;
          }
          return $array_misjuegos;
    }

    public function obtenerJuegoPorID($id) {
      $query = "SELECT * FROM juegos WHERE id = ?";
      $stmt = $this->conn->prepare($query);
      $stmt->bind_param('i', $id);
      $stmt->execute();
      
      $resultado = $stmt->get_result()->fetch_object(Juego::class);
      return $resultado;
    }

    function insert($juego):int|bool{
        if(!$stmt = $this->conn->prepare("INSERT INTO juegos (precio, titulo, descripcion, fecha_creacion, idUsuario, idCategoria) VALUES (?,?,?,?,?,?) ")){
          die("Error al prepar la consulta insert: " . $this->conn->error);
        }
        $precio = $juego->getPrecio();
        $titulo = $juego->getTitulo();
        $descripcion = $juego->getDescripcion();
        $fecha_creacion = date("Y-m-d H:i:s");
        $idUsuario = $juego->getIdUsuario();
        $categoria = $juego->getIdCategoria();
        $stmt->bind_param('dsssii',$precio,$titulo,$descripcion,$fecha_creacion, $idUsuario, $categoria);
        if($stmt->execute()){
          return $stmt->insert_id;
        }else{
          return false;
        }
        
        
    }

    public function borrarJuego($id) {
      if(!$stmt = $this->conn->prepare("DELETE FROM juegos WHERE id = ?"))
      {
          echo "Error en la SQL: " . $this->conn->error;
      }
      //Asociar las variables a las interrogaciones(parámetros)
      $stmt->bind_param('i',$id);
      //Ejecutamos la SQL
      $stmt->execute();
      //Comprobamos si ha borrado algún registro o no
      if($stmt->affected_rows==1){
          return true;
      }
      else{
          return false;
      }
    }

    
  

}

?>