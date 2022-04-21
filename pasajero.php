<?php
    class pasajero{

        // ATRIBUTOS
        private $nombre;
        private $apellido;
        private $nroDocumento;
        private $telefono;

        // METODO CONSTRUCTOR
        public function __construct($nom, $ape, $dni, $tel){
            $this->nombre = $nom;
            $this->apellido = $ape;
            $this->nroDocumento = $dni;
            $this->telefono = $tel;
        }

        // METODOS DE ACCESO
        public function getNombre(){
            return $this->nombre;
        }
        public function getApellido(){
            return $this->apellido;
        }
        public function getNroDocumento(){
            return $this->nroDocumento;
        }
        public function getTelefono(){
            return $this->telefono;
        }

        public function setNombre($nNom){
            $this->nombre = $nNom;
        }
        public function setApellido($nApe){
            $this->apellido = $nApe;
        }
        public function setNroDocumento($nDni){
            $this->nroDocumento = $nDni;
        }
        public function setTelefono($nTel){
            $this->telefono = $nTel;
        }

        // METODO toString()
        public function __toString(){
            return $this->getNombre()." ".$this->getApellido()." - DNI:".$this->getNroDocumento()." - TEL. ".$this->getTelefono();
        }
    }