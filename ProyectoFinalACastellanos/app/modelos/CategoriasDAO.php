<?php 

class CategoriasDAO{
    private mysqli $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAllCategorias():array{
        //$this->conn->prepare() devuelve un objeto de la clase mysqli_stmt
       if (!$stmt = $this->conn->prepare("SELECT * FROM categorias")) {
        echo "Error en la SQL: " . $this->conn->error;
       }
       //Ejecutamos la SQL
       $stmt->execute();
       //Obtener el objeto mysql_result
       $result = $stmt->get_result();

      $array_categorias = array();

      while($categoria = $result->fetch_object(Categoria::class)){
           $array_categorias[] = $categoria;
      }
      return $array_categorias;
    }

    public function getNombreById($id) {
        $query = "SELECT categoria FROM categorias WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        
        $resultado = $stmt->get_result()->fetch_assoc();
        return $resultado['categoria'];
      }
}

?>