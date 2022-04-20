<?php
/**
 * La empresa de Transporte de Pasajeros “Viaje Feliz” quiere registrar la información referente a sus viajes.
 * 
 * De cada viaje se precisa almacenar 
 *      código
 *      destino
 *      cantidad máxima de pasajeros
 *      pasajeros del viaje
 * 
 * Realice la implementación de la clase Viaje e implemente los métodos necesarios para modificar los atributos de dicha clase (incluso los datos de los pasajeros). 
 * Utilice un array que almacene la información correspondiente a los pasajeros. 
 * 
 * Cada pasajero es un array asociativo con las claves 
 *      “nombre”
 *      “apellido”
 *      “numero de documento”
 * 
 * Modificar la clase Viaje para que ahora los pasajeros sean un objeto que tenga los atributos
 *      nombre
 *      apellido
 *      numero de documento
 *      teléfono
 * 
 * El viaje ahora contiene una referencia a una colección de objetos de la clase Pasajero.
 * 
 * También se desea guardar la información de la persona responsable de realizar el viaje, para ello cree una clase ResponsableV que registre el 
 *      número de empleado
 *      número de licencia
 *      nombre
 *      apellido
 * 
 * La clase Viaje debe hacer referencia al responsable de realizar el viaje.
 * Volver a implementar las operaciones que permiten modificar el nombre, apellido y teléfono de un pasajero.
 * Luego implementar la operación que agrega los pasajeros al viaje, solicitando por consola la información de los mismos.
 * Se debe verificar que el pasajero no este cargado mas de una vez en el viaje. 
 * De la misma forma cargue la información del responsable del viaje.
 * Nota: Recuerden que deben enviar el link a la resolución en su repositorio en GitHub.
 */
    class viaje{

        // ATRIBUTOS
        private $codigo;
        private $destino;
        private $cantidadMaxima;
        private $listaPasajero;
        private $objResponsable;

        // METODO CONSTRUCTOR
        public function __construct($cod, $des, $canMax, $lisPas, $objRes){
            $this->codigo = $cod;
            $this->destino = $des;
            $this->cantidadMaxima = $canMax;
            $this->listaPasajero = $lisPas;
            $this->objResponsable = $objRes;
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
        public function getObjResponsable(){
            return $this->objResponsable;
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
        public function setObjResponsable($nObjRes){
            $this->objResponsable = $nObjRes;
        }

        // METODO toString()
        public function __toString(){
            return "Codigo: ".$this->getCodigo().
            "\nDestino: ".$this->getDestino().
            "\nCantidad de Personas: ".$this->getCantidadMaxima().
            "\nResponsable: ".$this->getObjResponsable().
            "\nPasajeros:\n".$this->textoListaPasajeros();
        }

        public function textoListaPasajeros(){
            /* Retorna un string con los datos de la matrice listaPasajero, en caso que no este vacio */
            $txt = "SIN PASAJEROS\n";

            if (count($this->getListaPasajero())>0){
                $txt = "Pasajeros:\n";
                foreach ($this->getListaPasajero() as $indice => $pasajero){
                    $numero = $indice + 1;
                    $txt = $txt.$numero." - ".$pasajero."\n";
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
                return "Operacion Exitosa!";
            } else return "Operacion Fallida! mismo codigo";
        }

        public function cambiarDestino($nDes){
            if ($this->getDestino() != $nDes){  // Verifica que sea otro destino
                $this->setDestino($nDes);                
                return "Operacion Exitosa!";
            } else return "Operacion Fallida! mismo destino";
        }

        public function cambiarCantidadMaxima($nCanMax){
            if ($this->getCantidadMaxima() != $nCanMax){ // Verifica que sea otra cantidad 
                if (count($this->getListaPasajero()) <= $nCanMax){ // Verifica que sea alcanzen la capacidad para los pasajeros ya ingresados al viaje
                    $this->setCantidadMaxima($nCanMax);
                    return "Operacion Exitosa!";
                } else return "Operacion Fallida! hay ".count($this->getListaPasajero())." pasajeros";
            } else return "Operacion Fallida! misma cantidad maxima";
        }

        /**
         * FUNCIONES DE LA LISTA PASAJEROS
         */

        public function agregarPasajero($nPasajero){
            $lista = $this->getListaPasajero();
            if (!$this->existeNroDocumentoPasajero($nPasajero->getNroDocumento())){ // verifica que no existan dos personas con ese dni
                if (count($lista) < $this->getCantidadMaxima()){ // verifica que el viaje tenga capacidad para uno mas                           
                    array_push($lista, $nPasajero);
                    $this->setListaPasajero($lista);
                    return "Operacion Exitosa!";
                } else return "Operacion Fallida! Viaje Completo";
            } else return "Operacion Fallida! ya existe documento";
        }

        public function borrarPasajero($i){
            /* Setea la lista con la mosificacion deseada */
            $lista = $this->getListaPasajero();
            if (count($lista) > 0){ 
                if (!is_null($lista[$i])){
                    array_splice($lista,$i,1);
                    $this->setListaPasajero($lista);
                    return "Operacion Exitosa!";
                } else return "Operacion Fallida! Numero no valido";
            } else return "Operacion Fallida! Lista vacia";
        }

        public function cambiarNombrePasajero($nNom, $i){
            /* Setea la lista con la mosificacion deseada */
            $lista = $this->getListaPasajero();
            if ($lista[$i]->getNombre()!= $nNom){
                $lista[$i]->setNombre($nNom);
                return "Operacion Exitosa!";
            } else return "Operacion Fallida! mismo nombre";
        }

        public function cambiarApellidoPasajero($nApe, $i){
            /* Setea la lista con la mosificacion deseada */
            $lista = $this->getListaPasajero();
            if ($lista[$i]->getApellido()!= $nApe){
                $lista[$i]->setApellido($nApe);
                return "Operacion Exitosa!";
            } else return "Operacion Fallida! mismo apellido";
        }

        public function cambiarNroDocumentoPasajero($nDni, $i){
            /* Setea la lista con la mosificacion deseada */
            $lista = $this->getListaPasajero();
            if (!$this->existeNroDocumentoPasajero($nDni)){
                $lista[$i]->setNroDocumento($nDni);
                return "Operacion Exitosa!";
            } else return "Operacion Fallida! ya existe documento";
        }

        public function cambiarTelefonoPasajero($nTel, $i){
            /* Setea la lista con la mosificacion deseada */
            $lista = $this->getListaPasajero();
            if ($lista[$i]->getTelefono() != $nTel){ // Verifica que sea otro telefono
                $lista[$i]->setTelefono($nTel);
                return "Operacion Exitosa!";
            } else return "Operacion Fallida! mismo telefono";
        }

        public function existeNroDocumentoPasajero($nDni){
            /* Busca si existe un pasajero con ese dni */
            $existe = false;
            foreach ($this->getListaPasajero() as $pasajero){
                if ($pasajero->getNroDocumento() == $nDni){
                    $existe = true;
                }
            }
            return $existe;
        }

        /**
         * FUNCIONES DEL RESPONSABLE DEL VIAJE
         */

        public function cambiarNombreResponsable($nNom){
            /* Setea la lista con la mosificacion deseada */
            if ($this->getObjResponsable()->getNombre()!= $nNom){
                $this->getObjResponsable()->setNombre($nNom);
                return "Operacion Exitosa!";
            } else return "Operacion Fallida! mismo nombre";
        }

        public function cambiarApellidoResponsable($nApe){
            /* Setea la lista con la mosificacion deseada */
            if ($this->getObjResponsable()->getApellido()!= $nApe){
                $this->getObjResponsable()->setApellido($nApe);
                return "Operacion Exitosa!";
            } else return "Operacion Fallida! mismo apellido";
        }

        public function cambiarNroLicenciaResponsable($nNLic){
            /* Setea la lista con la mosificacion deseada */
            if ($this->getObjResponsable()->getNroLicencia() != $nNLic){
                $this->getObjResponsable()->setNroLicencia($nNLic);
                return "Operacion Exitosa!";
            } else return "Operacion Fallida! mismo numero de licencia";
        }

        public function cambiarNroEmpleadoResponsable($nNEmp){
            /* Setea la lista con la mosificacion deseada */
            if ($this->getObjResponsable()->getNroEmpleado() != $nNEmp){
                $this->getObjResponsable()->setNroEmpleado($nNEmp);
                return "Operacion Exitosa!";
            } else return "Operacion Fallida! mismo numero de empleado";
        }
    }