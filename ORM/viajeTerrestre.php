<?php
    class viajeTerrestre extends viaje{
        // ATRIBUTOS
        private $semicama;

        // METODO CONSTRUCTOR
        public function __construct($cod, $des, $canMax, $lisPas, $objRes, $imp, $idaVue, $sem){
            parent::__construct($cod, $des, $canMax, $lisPas, $objRes, $imp, $idaVue);
            $this->semicama = $sem;
        }

        // METODOS DE ACCESO
        public function getSemicama(){
            return $this->semicama;
        }

        public function setSemicama($nSem){
            $this->semicama = $nSem;
        }

        // METODO toString()
        public function __toString(){
            $txt = parent::__toString();
            $txt.= "Semicama: ".$this->textoIdaVuelta()."\n";
            return $txt;
        }

        // FUNCIONES PROPIAS        
        public function darImporte(){
            /**
             * Si el viaje es terrestre y el asiento es cama, se incrementa el importe un 25%.
             * pTanto para viajes terrestres o aéreos, si el viaje es ida y vuelta, se incrementa el importe del viaje un 50%. 
             */
            $total = parent::getImporte();
            if ($this->getSemicama()){  
                $total*=1.25;
            }
            if (parent::getIdaVuelta()){
                $total*=1.50;
            }  
            return $total;
        }


    }