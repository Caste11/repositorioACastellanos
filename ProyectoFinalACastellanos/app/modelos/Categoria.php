<?php 

class Categoria{
    private $id;
    private $categoria;
    

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
     * Get the value of categoria
     */
    public function getIdCategoria() {
        return $this->categoria;
    }

    /**
     * Set the value of categoria
     */
    public function setIdCategoria($categoria): self {
        $this->categoria = $categoria;
        return $this;
    }
}

?>