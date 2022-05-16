<?php
    class viajeAereo extends viaje {
        // ATRIBUTOS
        private $numeroVuelo;
        private $categoriaAsiento;
        private $nombreAereolineas;
        private $numeroEscalas;

        // METODO CONSTRUCTOR
        public function __construct($cod, $des, $canMax, $lisPas, $objRes, $imp, $idaVue, $nroVue, $catAsi, $nomAer, $nroEsc){
            parent::__construct($cod, $des, $canMax, $lisPas, $objRes, $imp, $idaVue);
            $this->numeroVuelo = $nroVue;
            $this->categoriaAsiento = $catAsi;
            $this->nombreAereolineas = $nomAer;
            $this->numeroEscalas = $nroEsc;
        }

        // METODOS DE ACCESO
        public function getNumeroVuelo(){
            return $this->numeroVuelo;
        }
        public function getCategoriaAsiento(){
            return $this->categoriaAsiento;
        }
        public function getNombreAereolineas(){
            return $this->nombreAereolineas;
        }
        public function getNumeroEscalas(){
            return $this->numeroEscalas;
        }

        public function setNumeroVuelo($nNroVue){
            $this->numeroVuelo = $nNroVue;
        }
        public function setCategoriaAsiento($nCatAsi){
            $this->categoriaAsiento = $nCatAsi;
        }
        public function setNombreAereolineas($nNomAer){
            $this->nombreAereolineas = $nNomAer;
        }
        public function setNumeroEscalas($nNumEsc){
            $this->numeroEscalas = $nNumEsc;
        }

        // METODO toString()
        public function __toString(){
            $txt = parent::__toString();
            $txt.= "Codigo: ".$this->getCodigo()."\n".
            "Destino: ".$this->getDestino()."\n".
            "Cantidad de Personas: ".$this->getCantidadMaxima()."\n".
            "Responsable: ".$this->getObjResponsable()."\n".
            "Importe: ".$this->getImporte()."$\n".
            "Ida y Vuelta: ".$this->textoIdaVuelta()."\n";
            return $txt;
        }

        // FUNCIONES PROPIAS        
        public function darImporte(){
            /**
             * Si el viaje es aéreo :
             * 	- el asiento es primera clase sin escalas, se incrementa un 40%, 
             * 	- el viaje además de ser un asiento de primera clase, el vuelo tiene escalas se incrementa el importe del viaje un 60%.
             * Tanto para viajes terrestres o aéreos, si el viaje es ida y vuelta, se incrementa el importe del viaje un 50%. 
             */
            $total = parent::getImporte();
            if ($this->getCategoriaAsiento() && $this->getNumeroEscalas() == 0){  
                $total*=1.40;
            } elseif ($this->getCategoriaAsiento() && $this->getNumeroEscalas() > 0){
                $total*=1.60;
            }
            if (parent::getIdaVuelta()){
                $total*=1.50;
            }            
            return $total;
        }
    }