<?php 

class Juego {
    private $id;
    private $precio;
    private $titulo;
    private $descripcion;
    private $fecha_creacion;
    private $idUsuario;
    private $idCategoria;
    private $foto;

    /**
     * Get the value of id  
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId($id): self {
        $this->id = $id;
        return $this;
    }

    /**
     * Get the value of precio
     */
    public function getPrecio() {
        return $this->precio;
    }

    /**
     * Set the value of precio
     */
    public function setPrecio($precio): self {
        $this->precio = $precio;
        return $this;
    }

    /**
     * Get the value of titulo
     */
    public function getTitulo() {
        return $this->titulo;
    }

    /**
     * Set the value of titulo
     */
    public function setTitulo($titulo): self {
        $this->titulo = $titulo;
        return $this;
    }

    /**
     * Get the value of descripcion
     */
    public function getDescripcion() {
        return $this->descripcion;
    }

    /**
     * Set the value of descripcion
     */
    public function setDescripcion($descripcion): self {
        $this->descripcion = $descripcion;
        return $this;
    }
    
    /**
     * Get the value of fecha_creacion
     */
    public function getFechaCreacion() {
        return $this->fecha_creacion;
    }

    /**
     * Set the value of fecha_creacion
     */
    public function setFechaCreacion($fecha_creacion): self {
        $this->fecha_creacion = $fecha_creacion;
        return $this;
    }

    /**
     * Get the value of idUsuario
     */
    public function getIdUsuario() {
        return $this->idUsuario;
    }

    /**
     * Set the value of idUsuario
     */
    public function setIdUsuario($idUsuario): self {
        $this->idUsuario = $idUsuario;
        return $this;
    }

    /**
     * Get the value of foto
     */
    public function getFoto() {
        return $this->foto;
    }

    /**
     * Set the value of foto
     */
    public function setFoto($foto): self {
        $this->foto = $foto;
        return $this;
    }

    /**
     * Get the value of idCategoria
     */
    public function getIdCategoria() {
        return $this->idCategoria;
    }

    /**
     * Set the value of idCategoria
     */
    public function setIdCategoria($idCategoria): self {
        $this->idCategoria = $idCategoria;
        return $this;
    }

    public function toJSON($idJ){
        if($idJ != null){
            return json_encode(
                ['id'=>$idJ,
                'titulo' => $this->getTitulo(),
                'descripcion' => $this->getDescripcion(),
                'precio' => $this->getPrecio(),
                'fecha_Creacion' => $this->getFechaCreacion(),
                'idUsuario' => $this->getIdUsuario(),
                'idCategoria' => $this->getIdCategoria()]
            );
        }else{
            return json_encode(
                ['id'=>$this->getId(),
                'titulo' => $this->getTitulo(),
                'descripcion' => $this->getDescripcion(),
                'precio' => $this->getPrecio(),
                'fecha_Creacion' => $this->getFechaCreacion(),
                'idUsuario' => $this->getIdUsuario(),
                'idCategoria' => $this->getIdCategoria()]
            );
        }
    }
}

?>