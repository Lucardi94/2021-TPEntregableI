<?php
    include_once 'empresa.php';
    class viaje{
        // ATRIBUTOS
        private $codigo;
        private $destino;
        private $cantidadMaxima;
        private $listaPasajero;
        private $objEmpresa;
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
            $this->objEmpresa = NULL;
            $this->objResponsable = NULL;
            $this->importe = 0;
            $this->tipoAsiento = NULL;
            $this->idaVuelta = NULL;
        }

        public function cargar($viaje){
            $this->setCodigo($viaje['idviaje']);
            $this->setDestino($viaje['vdestino']);
            $this->setCantidadMaxima($viaje['vcantmaxpasajeros']);
            $this->setListaPasajero($viaje['listapasajero']);
            $this->setObjEmpresa($viaje['objempresa']);
            $this->setObjResponsable($viaje['objresponsable']);
            $this->setImporte($viaje['vimporte']);
            $this->setTipoAsiento($viaje['tipoAsiento']);
            $this->setIdaVuelta($viaje['idayvuelta']);
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
        public function getObjEmpresa(){
            return $this->objEmpresa;
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
        public function setObjEmpresa($nObjEmp){
            $this->objEmpresa = $nObjEmp;
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

        public function buscar($id,$bool){
            $base=new BaseDatos();
            $consulta="Select * from viaje where idviaje=".$id;
            $resp=false;
            if($base->iniciar()){
                if($base->ejecutar($consulta)){
                    if($row2=$base->registro()){
                        $coleccion=array ();
                        if ($bool){                     
                            $objPasajero=new pasajero();
                            $listaTemp=$objPasajero->listar();
                            for ($i=0; $i<count($listaTemp); $i++){
                                $pasajero=$listaTemp[$i];
                                if ($pasajero->getObjViaje()->getCodigo() == $id){
                                    array_push($coleccion, $pasajero);
                                }
                            }
                        }
                        $row2['listapasajero'] = $coleccion;

                        $objResponsable = new responsable();
                        $objResponsable->buscar($row2['rnumeroempleado']);
                        $row2['objresponsable'] = $objResponsable;

                        $objEmpresa = new empresa();
                        $objEmpresa->buscar($row2['idempresa'], FALSE);
                        $row2['objempresa'] = $objEmpresa;

                        $this->cargar($row2);
                        $resp=true;
                    } else { $this->setMensajeOperacion($base->getError()); }               
                } else { $this->setMensajeOperacion($base->getError()); }
            } else { $this->setMensajeOperacion($base->getError()); }		
            return $resp;
        }

        public function listar($condicion=""){
            $colEmpresa=null;
            $base=new BaseDatos();
            $consulta="Select * from viaje ";
            if ($condicion!=""){
                $consulta.=" where ".$condicion;
            }
            $consulta.=" order by idviaje ";
            if($base->iniciar()){
                if($base->ejecutar($consulta)){
                    $colViaje=array ();
                    while($row2=$base->registro()){
                        $objViaje=new viaje();
                        $objViaje->buscar($row2['idviaje'],TRUE);
                        array_push($colViaje,$objViaje);
                    }                
                } else { $this->setMensajeOperacion($base->getError()); }
            } else { $this->setMensajeOperacion($base->getError()); }	
            return $colViaje;
        }

        public function insertar(){
            $base=new BaseDatos();
            $resp=false;
            $consulta="INSERT INTO viaje(vdestino, vcantmaxpasajeros, idempresa, rnumeroempleado, vimporte, tipoAsiento, idayvuelta) VALUES ('".$this->getDestino()."',".$this->getCantidadMaxima().",".$this->getObjEmpresa()->getNroEmpresa().",".$this->getObjResponsable()->getNroEmpleado().",".$this->getImporte().",".$this->getTipoAsiento().",".$this->getIdaVuelta().")";            
            if($base->iniciar()){    
                if($id=$base->devuelveIDInsercion($consulta)){
                    $this->setCodigo($id);
                    $resp=true;    
                } else { $this->setMensajeOperacion($base->getError()); }    
            } else { $this->setMensajeOperacion($base->getError()); }
            return $resp;
        }

        public function modificar(){
            $resp=false; 
            $base=new BaseDatos();
            $consulta="UPDATE viaje SET vdestino='".$this->getDestino()."', vcantmaxpasajeros=".$this->getCantidadMaxima().",idempresa=".$this->getObjEmpresa()->getNroEmpresa().",rnumeroempleado=".$this->getObjResponsable()->getNroEmpleado().",vimporte=".$this->getImporte().",tipoAsiento=".$this->getTipoAsiento().", idayvuelta=".$this->getIdaVuelta()." WHERE idviaje=".$this->getCodigo();
            if($base->iniciar()){
                if($base->ejecutar($consulta)){
                    $resp=true;
                } else{ $this->setMensajeOperacion($base->getError()); }
            } else{ $this->setMensajeOperacion($base->getError()); }
            return $resp;
        }

        public function eliminar(){
            $base=new BaseDatos();
            $resp=false;
            if($base->iniciar()){
                $consulta="DELETE FROM viaje WHERE idviaje=".$this->getCodigo();
                if($base->ejecutar($consulta)){
                    $resp=true;
                }else{ $this->setMensajeOperacion($base->getError()); }
            }else{ $this->setMensajeOperacion($base->getError()); }
            return $resp; 
        }

        // METODO toString()
        public function __toString(){
            return "Codigo: ".$this->getCodigo()."\n".
            "Destino: ".$this->getDestino()."\n".
            "Cantidad de Personas: ".$this->getCantidadMaxima()."\n".
            "Empresa: ".$this->getObjEmpresa()->getNombre()."\n".
            $this->getObjResponsable()."\n".
            "Importe: ".$this->getImporte()."$\n".
            "Semicama: ".$this->textoBoolean($this->getTipoAsiento())."\n".
            "Ida y Vuelta: ".$this->textoBoolean($this->getIdaVuelta())."\n".
            $this->textoListaPasajeros();
        }

        public function textoBoolean($bool){
            /* Retorna un string con un si o no */
            $txt = "NO";
            if ($bool==1){
                $txt = "SI";
            }            
            return $txt;
        }

        public function textoListaPasajeros(){
            /* Retorna un string con los datos de la matrice listaPasajero, en caso que no este vacio */
            $txt = "";
            if (count($this->getListaPasajero())>0){
                $txt = "Pasajeros:\n";
                foreach ($this->getListaPasajero() as $indice => $pasajero){
                    $numero = $indice + 1;
                    $txt = $txt."     ".$numero." - ".$pasajero."\n"; //ejemplo:     1 - Alveal, Julio - 39333999
                }
            }            
            return $txt;
        }        
    }