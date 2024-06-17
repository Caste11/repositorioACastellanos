<?php 

class Foto{
    private $id;
    private $nombrefoto;
    private $idJuego;
    

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
     * Get the value of nombrefoto
     */
    public function getNombrefoto() {
        return $this->nombrefoto;
    }

    /**
     * Set the value of nombrefoto
     */
    public function setNombrefoto($nombrefoto): self {
        $this->nombrefoto = $nombrefoto;
        return $this;
    }

    /**
     * Get the value of idJuego
     */
    public function getIdJuego() {
        return $this->idJuego;
    }

    /**
     * Set the value of idJuego
     */
    public function setIdJuego($idJuego): self {
        $this->idJuego = $idJuego;
        return $this;
    }

    
}

?>