<?php 

class Favorito {
    private $id;
    private $idUsuario;
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