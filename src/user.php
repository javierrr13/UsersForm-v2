<?php

class Usuario {
    public $id;
    public $mail;
    public $renovacion;
    public $nombre;
    public $status;
    public $experiencia;
    public $proyecto;
    public $fechaIN;
    public $fechaOUT;
    public $ubicacion;
    public $permisos;
    public $coordinador;
    public $observaciones;
    public $conocimientos;
    
   

    // Constructor de la clase Usuario
    public function __construct($id = null, $mail = "", $renovacion = "no", $nombre = "", $status = "", $experiencia = "No", 
                                $proyecto = "", $fechaIN = "", $fechaOUT = "", $ubicacion = "", $permisos = "", 
                                $coordinador = "", $observaciones = "", $conocimientos = "") 
    {
        $this->id = $id;
        $this->mail = $mail;
        $this->renovacion = $renovacion;
        $this->nombre = $nombre;
        $this->status = $status;
        $this->experiencia = $experiencia;
        $this->proyecto = $proyecto;
        $this->fechaIN = $fechaIN;
        $this->fechaOUT = $fechaOUT;
        $this->ubicacion = $ubicacion;
        $this->permisos = $permisos;
        $this->coordinador = $coordinador;
        $this->observaciones = $observaciones;
        $this->conocimientos = $conocimientos;
      
    }
  
}
?>
