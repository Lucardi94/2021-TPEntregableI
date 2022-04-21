<?php
    class responsable{

        // ATRIBUTOS
        private $nombre;
        private $apellido;
        private $nroEmpleado;
        private $nroLicencia;

        // METODO CONSTRUCTOR
        public function __construct($nom, $ape, $nEmp, $nLic){
            $this->nombre = $nom;
            $this->apellido = $ape;
            $this->nroEmpleado = $nEmp;
            $this->nroLicencia = $nLic;
        }

        // METODOS DE ACCESO
        public function getNombre(){
            return $this->nombre;
        }
        public function getApellido(){
            return $this->apellido;
        }
        public function getNroEmpleado(){
            return $this->nroEmpleado;
        }
        public function getNroLicencia(){
            return $this->nroLicencia;
        }

        public function setNombre($nNom){
            $this->nombre = $nNom;
        }
        public function setApellido($nApe){
            $this->apellido = $nApe;
        }
        public function setNroEmpleado($nNEmp){
            $this->nroEmpleado = $nNEmp;
        }
        public function setNroLicencia($nNLic){
            $this->nroLicencia = $nNLic;
        }

        // METODO toString()
        public function __toString(){
            return $this->getNombre()." ".$this->getApellido()."\n".
            "N° EMPLEADO: ".$this->getNroEmpleado()."\n".
            "N° LICENCIA: ".$this->getNroLicencia();
        }
    }