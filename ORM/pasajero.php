<?php
    class pasajero{

        // ATRIBUTOS
        private $nombre;
        private $apellido;
        private $nroDocumento;
        private $telefono;
        private $objViaje;
        private $mensajeOperacion;


        // METODO CONSTRUCTOR
        public function __construct(){
            $this->nombre = "";
            $this->apellido = "";
            $this->nroDocumento = 0;
            $this->telefono = 0;
            $this->objViaje = NULL;
        }

        public function cargar($pasajero){
            $this->setNombre($pasajero['pnombre']);
            $this->setApellido($pasajero['papellido']);
            $this->setNroDocumento($pasajero['rdocumento']);
            $this->setTelefono($pasajero['ptelefono']);
            $this->setObjViaje($pasajero['objviaje']);
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
        public function getObjViaje(){
            return $this->objViaje;
        }
        public function getMensajeOperacion(){
            return $this->mensajeOperacion;
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
        public function setObjViaje($nObjViaje){
            $this->objViaje = $nObjViaje;
        }
        public function setMensajeOperacion($nMsj){
            $this->mensajeOperacion=$nMsj;
        }

        public function buscar($id){
            $base=new BaseDatos();
            $consulta="Select * from pasajero where ndocumento=".$id;
            $resp=false;
            if($base->iniciar()){
                if($base->ejecutar($consulta)){
                    if($row2=$base->registro()){
                        $this->cargar($row2);
                        $objViaje=new viaje();
                        $objViaje->buscar($row2['idviaje'], FALSE);
                        $row2['objviaje'] = $objViaje;
                        $this->cargar($row2);                     
                        $resp=true;
                    }                
                } else { $this->setMensajeOperacion($base->getError()); }
            } else { $this->setMensajeOperacion($base->getError()); }		
            return $resp;
        }

        public function listar($condicion=""){
            $colPasajero=null;
            $base=new BaseDatos();
            $consulta="Select * from pasajero ";
            if ($condicion!=""){
                $consulta.=" where ".$condicion;
            }
            $consulta.=" order by rdocumento ";
            if($base->iniciar()){
                if($base->ejecutar($consulta)){
                    $colPasajero=array ();
                    while($row2=$base->registro()){
                        $objPasajero=new pasajero();
                        $objPasajero->buscar($row2['rdocumento']);
                        array_push($colPasajero,$objPasajero);
                    }                
                } else { $this->setMensajeOperacion($base->getError()); }
            } else { $this->setMensajeOperacion($base->getError()); }	
            return $colPasajero;
        }

        public function insertar(){
            $base=new BaseDatos();
            $resp=false;
            $consulta="INSERT INTO pasajero(rdocumento,pnombre,papellido,ptelefono,idviaje) VALUES (".$this->getNroDocumento().",'".$this->getNombre()."','".$this->getApellido()."',".$this->getTelefono().",".$this->getObjViaje()->getCodigo().")";            
            if($base->iniciar()){    
                $resp=true;        
            } else { $this->setMensajeOperacion($base->getError()); }
            return $resp;
        }

        public function modificar(){
            $resp=false; 
            $base=new BaseDatos();
            $consulta="UPDATE pasajero SET rdocumento=".$this->getNroDocumento().",pnombre='".$this->getNombre()."',papellido='".$this->getApellido()."',ptelefono='".$this->getTelefono()."',idviaje=".$this->getObjViaje()->getCodigo()." WHERE rdocumento=".$this->getNroDocumento();
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
                $consulta="DELETE FROM pasajero WHERE rdocumento=".$this->getNroDocumento();
                if($base->ejecutar($consulta)){
                    $resp=true;
                }else{ $this->setMensajeOperacion($base->getError()); }
            }else{ $this->setMensajeOperacion($base->getError()); }
            return $resp; 
        }
        
        // METODO toString()
        public function __toString(){
            return $this->getNombre()." ".$this->getApellido()." - DNI:".$this->getNroDocumento()." - TEL. ".$this->getTelefono();
        }
    }