<?php
    class empresa{
        // ATRIBUTOS
        private $nroEmpresa;
        private $nombre;
        private $direccion;
        private $listaViaje;
        private $mensajeOperacion;

        public function __construct(){
            $this->nroEmpresa = 0;
            $this->nombre = "";
            $this->direccion = "";
            $this->listaViaje = NULL;
        }

        // METODOS DE ACCESO
        public function getNroEmpresa(){
            return $this->nroEmpresa;
        }
        public function getNombre(){
            return $this->nombre;
        }
        public function getDireccion(){
            return $this->direccion;
        }
        public function getListaViaje(){
            return $this->listaViaje;
        }
        public function getMensajeOperacion(){
            return $this->mensajeOperacion;
        }

        


        public function cargar($empresa){
            $this->setNombre($responsable['rnombre']);
            $this->setApellido($responsable['rapellido']);
            $this->setNroEmpleado($responsable['rnumeroempleado']);
            $this->setNroLicencia($responsable['rnumerolicencia']);
        }
    }