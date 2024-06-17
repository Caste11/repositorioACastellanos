<?php 

class FotosDAO {
    private mysqli $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function insert($nombrefoto){
        if(!$stmt = $this->conn->prepare("INSERT INTO fotos (nombrefoto, idJuego) VALUES (?,?)")){
            die("Error al preparar la consulta insert: " . $this->conn->error );
        }

        $nombrefoto = $foto->getNombrefoto();
        $idJuego = $foto->getIdJuego();

        $stmt->bind_param('si', $nombrefoto, $idJuego);
        
        if($stmt->execute()){
            return $stmt->insert_id;
        }
        else{
            return false;
        }
    }

    public function insertarVariasFotos(array $fotos, int $idJuego):bool {
        if (!$stmt = $this->conn->prepare("INSERT INTO fotos (nombrefoto, idJuego) VALUES (?,?)")) {
            die("Error al preparar la consulta insert: " . $this->conn->error );}
    
            foreach ($fotos as $nombrefoto) {
                $stmt->bind_param('si', $nombrefoto, $idJuego);
                $stmt->execute();
            }
    
            if ($this->conn->affected_rows == count($fotos)) {
                return true;
            } else {
                return false;
            }
        }

        public function getFotosByIdJuego($idJuego):array{
            //$this->conn->prepare() devuelve un objeto de la clase mysqli_stmt
           if (!$stmt = $this->conn->prepare("SELECT * FROM fotos WHERE idJuego = ?")) {
            echo "Error en la SQL: " . $this->conn->error;
           }
           //Asociar las variables a las interrogaciones (parámetros)
           $stmt->bind_param('i',$idJuego);
           //Ejecutamos la SQL
           $stmt->execute();
           //Obtener el objeto mysql_result
           $result = $stmt->get_result();
      
          $array_fotosjuegos = array();

          while($foto = $result->fetch_object(Foto::class)){
               $array_fotosjuegos[] = $foto;
          }
          return $array_fotosjuegos;
          
        }
}

?>