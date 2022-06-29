<?php
    class viaje{

        // ATRIBUTOS
        private $codigo;
        private $destino;
        private $cantidadMaxima;
        private $listaPasajero;
        private $objResponsable;
        private $importe;
        private $tipoAsiento;
        private $idaVuelta;        
        private $mensajeOperacion;

        // METODO CONSTRUCTOR
        public function __construct(){
            $this->codigo = 0;
            $this->destino = "";
            $this->cantidadMaxima = 0;
            $this->listaPasajero = NULL;
            $this->objResponsable = NULL;
            $this->importe = 0;
            $this->tipoAsiento = NULL;
            $this->idaVuelta = NULL;
        }

        public function cargar($viaje){
            $this->setCodigo($viaje['idviaje']);
            $this->setDestino($viaje['vdestino']);
            $this->setCantidadMaxima($viaje['vcantmaxpasajeros']);
            $this->setListaPasajero($viaje['ptelefono']);
            $this->setObjResponsable($viaje['objviaje']);
            $this->setImporte($viaje['objviaje']);
            $this->setTipoAsiento($viaje['objviaje']);
            $this->setIdaVuelta($viaje['objviaje']);
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
        public function getImporte(){
            return $this->importe;
        }
        public function getTipoAsiento(){
            return $this->tipoAsiento;
        }
        public function getIdaVuelta(){
            return $this->idaVuelta;
        }
        public function getMensajeOperacion(){
            return $this->mensajeOperacion;
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
        public function setImporte($nImp){
            $this->importe = $nImp;
        }
        public function setTipoAsiento($nTipAsi){
            $this->tipoAsiento = $nTipAsi;
        }
        public function setIdaVuelta($nIdaVue){
            $this->idaVuelta = $nIdaVue;
        }
        public function setMensajeOperacion($nMsj){
            $this->mensajeOperacion=$nMsj;
        }

        public function Buscar($id,$bool){
            $base=new BaseDatos();
            $consulta="Select * from viaje where idviaje=".$id;
            $resp=false;
            if($base->iniciar()){
                if($base->ejecutar($consulta)){
                    if($row2=$base->registro()){
                        $coleccion=array ();
                        if ($bool){                     
                            $objCine=new FuncionCine();
                            $objMusical=new FuncionMusical();
                            $objTeatro=new FuncionTeatro();
                            $listaTemp=array_merge($objCine->listar(), $objMusical->listar(), $objTeatro->listar());
                            for ($i=0; $i<count($listaTemp); $i++){
                                $funcion=$listaTemp[$i];
                                if ($funcion->getObjTeatro()->getIdTeatro() == $id){
                                    array_push($coleccion, $funcion);
                                }
                            }
                        }                      
                        $row2['listafuncion']=$coleccion;
                        $this->cargar($row2);
                        $resp=true;
                    } else { $this->setMensajeOperacion($base->getError()); }               
                } else { $this->setMensajeOperacion($base->getError()); }
            } else { $this->setMensajeOperacion($base->getError()); }		
            return $resp;
        }

        // METODO toString()
        public function __toString(){
            return "Codigo: ".$this->getCodigo()."\n".
            "Destino: ".$this->getDestino()."\n".
            "Cantidad de Personas: ".$this->getCantidadMaxima()."\n".
            "Responsable: ".$this->getObjResponsable()."\n".
            "Importe: ".$this->getImporte()."$\n".
            "Semicama: ".$this->textoBoolean($this->getTipoAsiento())."\n".
            "Ida y Vuelta: ".$this->textoBoolean($this->getIdaVuelta())."\n".
            $this->textoListaPasajeros();
        }

        public function textoBoolean($bool){
            /* Retorna un string con un si o no */
            $txt = "NO";
            if ($bool){
                $txt = "SI";
            }            
            return $txt;
        }

        public function textoListaPasajeros(){
            /* Retorna un string con los datos de la matrice listaPasajero, en caso que no este vacio */
            $txt = "SIN PASAJEROS\n";
            if (count($this->getListaPasajero())>0){
                $txt = "Pasajeros:\n";
                foreach ($this->getListaPasajero() as $indice => $pasajero){
                    $numero = $indice + 1;
                    $txt = $txt."     ".$numero." - ".$pasajero."\n"; //ejemplo:     1 - Alveal, Julio - 39333999
                }
            }            
            return $txt;
        }

        /**
         * MODIFICADORES PROPIOS
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
        
        public function venderPasaje($nPasajero){
            /**
             * Retorna verdadero si la cantidad de pasajeros del viaje es menor a la cantidad máxima de pasajeros.
             * falso caso contrario.
             */
            $lista = $this->getListaPasajero();
            //if (!$this->existeNroDocumentoPasajero($nPasajero->getNroDocumento())){ // verifica que no existan dos personas con ese dni
                array_push($lista, $nPasajero);
                $this->setListaPasajero($lista);
            //} else return "Operacion Fallida! ya existe documento";
            //TENIA ESTE DETALLE ANTES, POR SI YA EXISTE EL MISMO PASAJERO 
        }

        public function hayPasajeroDisponible(){
            /**
             * Retorna verdadero si la cantidad de pasajeros del viaje es menor a la cantidad máxima de pasajeros.
             * falso caso contrario.
             */
            $lista = $this->getListaPasajero();
            if (count($lista) < $this->getCantidadMaxima()){ // verifica que el viaje tenga capacidad para uno mas
                return TRUE;
            } else return FALSE;
        }

        public function borrarPasajero($i){
            /* Borra un objeto en el arreglo en la posiscion de $i*/
            $lista = $this->getListaPasajero();
            if (count($lista) > 0){ // Verifica que la lista no este vacia
                if (count($lista) > $i){ // Verifica que $i pueda ser un nuemero del arreglo
                    array_splice($lista,$i,1);
                    $this->setListaPasajero($lista);
                    return "Operacion Exitosa!";
                } else return "Operacion Fallida! Numero no valido";
            } else return "Operacion Fallida! Lista vacia";
        }

        /**
         * MODIFICADORES UN PASAJERO
         */
        public function cambiarNombrePasajero($nNom, $i){
            $lista = $this->getListaPasajero();
            if ($lista[$i]->getNombre()!= $nNom){ // Verifica que sea otro nombre 
                $lista[$i]->setNombre($nNom);
                return "Operacion Exitosa!";
            } else return "Operacion Fallida! mismo nombre";
        }

        public function cambiarApellidoPasajero($nApe, $i){
            $lista = $this->getListaPasajero();
            if ($lista[$i]->getApellido()!= $nApe){ // Verifica que sea otro apellido
                $lista[$i]->setApellido($nApe);
                return "Operacion Exitosa!";
            } else return "Operacion Fallida! mismo apellido";
        }

        public function cambiarNroDocumentoPasajero($nDni, $i){
            $lista = $this->getListaPasajero();
            if (!$this->existeNroDocumentoPasajero($nDni)){ // Verifica que sea otro numero de documento
                $lista[$i]->setNroDocumento($nDni);
                return "Operacion Exitosa!";
            } else return "Operacion Fallida! ya existe documento";
        }

        public function cambiarTelefonoPasajero($nTel, $i){
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
         * MODIFICADORES DEL RESPONSABLE DEL VIAJE
         */
        public function cambiarNombreResponsable($nNom){
            if ($this->getObjResponsable()->getNombre()!= $nNom){ // Verifica que no sea el mismo nombre
                $this->getObjResponsable()->setNombre($nNom);
                return "Operacion Exitosa!";
            } else return "Operacion Fallida! mismo nombre";
        }

        public function cambiarApellidoResponsable($nApe){
            if ($this->getObjResponsable()->getApellido()!= $nApe){ // Verifica que no sea el mismo apellido
                $this->getObjResponsable()->setApellido($nApe);
                return "Operacion Exitosa!";
            } else return "Operacion Fallida! mismo apellido";
        }

        public function cambiarNroLicenciaResponsable($nNLic){
            if ($this->getObjResponsable()->getNroLicencia() != $nNLic){ // Verifica que no sea el mismo numero de licencia
                $this->getObjResponsable()->setNroLicencia($nNLic);
                return "Operacion Exitosa!";
            } else return "Operacion Fallida! mismo numero de licencia";
        }

        public function cambiarNroEmpleadoResponsable($nNEmp){
            if ($this->getObjResponsable()->getNroEmpleado() != $nNEmp){ // Verifica que no sea el mismo numero de empleado
                $this->getObjResponsable()->setNroEmpleado($nNEmp);
                return "Operacion Exitosa!";
            } else return "Operacion Fallida! mismo numero de empleado";
        }
    }