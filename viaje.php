<?php
/**
 * La empresa de Transporte de Pasajeros “Viaje Feliz” quiere registrar la información referente a sus viajes.
 * De cada viaje se precisa almacenar el código del mismo, destino, cantidad máxima de pasajeros y los pasajeros del viaje.
 * Realice la implementación de la clase Viaje e implemente los métodos necesarios para modificar los atributos de dicha clase (incluso los datos de los pasajeros). 
 * Utilice un array que almacene la información correspondiente a los pasajeros. 
 * Cada pasajero es un array asociativo con las claves “nombre”, “apellido” y “numero de documento”.
 */
    class viaje{

        // ATRIBUTOS
        private $codigo;
        private $destino;
        private $cantidadMaxima;
        private $listaPasajero;

        // METODO CONSTRUCTOR
        public function __construct($cod, $des, $canMax, $lisPas){
            $this->codigo = $cod;
            $this->destino = $des;
            $this->cantidadMaxima = $canMax;
            $this->listaPasajero = $lisPas;
        }

        // METODOS DE ACCESO
        public function getCodigo(){
            return $this->codigo;
        }
        public function getDestino(){
            return $this->destino;
        }
        public function getCantidadMaxima(){
            return $this->cantidadMaxima;
        }
        public function getListaPasajero(){
            return $this->listaPasajero;
        }

        public function setCodigo($nCod){
            $this->codigo = $nCod;
        }
        public function setDestino($nDes){
            $this->destino = $nDes;
        }
        public function setCantidadMaxima($nCanMax){
            $this->cantidadMaxima = $nCanMax;
        }
        public function setListaPasajero($nLisPas){
            $this->listaPasajero = $nLisPas;
        }

        // METODO toString()
        public function __toString(){
            return "Codigo: ".$this->getCodigo().
            "\nDestino: ".$this->getDestino().
            "\nCantidad de Personas: ".$this->getCantidadMaxima().
            "\nPasajeros: ".$this->textoListaPasajeros();
        }

        public function textoListaPasajeros(){
            /* Retorna un string con los datos de la matrice listaPasajero, en caso que no este vacio */
            $txt = "SIN PASAJEROS\n";

            if (count($this->getListaPasajero())>0){
                $txt = "\n";
                foreach ($this->getListaPasajero() as $indice => $pasajero){
                    $numero = $indice + 1;
                    $txt = $txt.$numero." - ".$pasajero["apellido"].", ".$pasajero["nombre"]." - ".$pasajero["dni"]." \n";
                    //ejemplo: 1 - Alveal, Julio - 39333999
                }
            }
            
            return $txt;
        }

        /**
         * FUNCIONES PROPIAS
         */

        public function cambiarCodigo($nCod){
            if ($this->getCodigo() != $nCod){   // Verifica que sea otro codigo 
                $this->setCodigo($nCod);
                return true;
            } else return false;
        }

        public function cambiarDestino($nDes){
            if ($this->getDestino() != $nDes){  // Verifica que sea otro destino
                $this->setDestino($nDes);
                return true;
            } else return false;
        }

        public function cambiarCantidadMaxima($nCanMax){
            if ($this->getCantidadMaxima() != $nCanMax){ // Verifica que sea otra cantidad codigo 
                $this->setCantidadMaxima($nCanMax);
                return true;
            } else return false;
        }

        public function agregarPasajero($nPasajero){
            if (count($this->getListaPasajero()) < $this->getCantidadMaxima()){ // verifica que el viaje tenga capacidad para uno mas
                $lista = $this->getListaPasajero();                             
                array_push($lista, $nPasajero);
                $this->setListaPasajero($lista);
                return true;
            } else return false;
        }

        public function borrarPasajero($i){
            /* Setea la lista con la mosificacion deseada */
            $lista = $this->getListaPasajero();
            if (!is_null($lista[$i])){ 
                array_splice($lista,$i,1);
                $this->setListaPasajero($lista);
                return true;
            } else return false;
        }

        public function cambiarNombrePasajero($nNom, $i){
            /* Setea la lista con la mosificacion deseada */
            $lista = $this->getListaPasajero();
            if ($lista[$i]["nombre"] != $nNom){
                $lista[$i] = array ("nombre"=>$nNom,"apellido"=>$lista[$i]["apellido"],"dni"=>$lista[$i]["dni"]); //crea en lista[indice] la nueva matriz del espacio en la lista.           
                $this->setListaPasajero($lista);
                return true;
            } else return false;
        }

        public function cambiarApellidoPasajero($nApe, $i){
            /* Setea la lista con la mosificacion deseada */
            $lista = $this->getListaPasajero();
            if ($lista[$i]["apellido"] != $nApe){
                $lista[$i] = array ("nombre"=>$lista[$i]["nombre"],"apellido"=>$nApe,"dni"=>$lista[$i]["dni"]); //crea en lista[indice] la nueva matriz del espacio en la lista.           
                $this->setListaPasajero($lista);
                return true;
            } else return false;
        }

        public function cambiarDNIPasajero($nDni, $i){
            /* Setea la lista con la mosificacion deseada */
            $lista = $this->getListaPasajero();
            if ($lista[$i]["dni"] != $nDni){
                $lista[$i] = array ("nombre"=>$lista[$i]["nombre"],"apellido"=>$lista[$i]["apellido"],"dni"=>$nDni); //crea en lista[indice] la nueva matriz del espacio en la lista.           
                $this->setListaPasajero($lista);
                return true;
            } else return false;
        }
    }