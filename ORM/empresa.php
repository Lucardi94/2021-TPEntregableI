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

        public function cargar($empresa){
            $this->setNroEmpresa($empresa['idempresa']);
            $this->setNombre($empresa['enombre']);
            $this->setDireccion($empresa['edireccion']);
            $this->setListaViaje($empresa['listaviaje']);
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

        public function setNroEmpresa($nNEmp){
            $this->nroEmpresa = $nNEmp;
        }
        public function setNombre($nNom){
            $this->nombre = $nNom;
        }
        public function setDireccion($nDir){
            $this->direccion = $nDir;
        }
        public function setListaViaje($nLisVia){
            $this->listaViaje = $nLisVia;
        }
        public function setMensajeOperacion($nMsj){
            $this->mensajeOperacion=$nMsj;
        }

        public function buscar($id,$bool){
            $base=new BaseDatos();
            $consulta="Select * from empresa where idempresa=".$id;
            $resp=false;
            if($base->iniciar()){
                if($base->ejecutar($consulta)){
                    if($row2=$base->registro()){
                        $coleccion=array ();
                        if ($bool){                     
                            $objViaje=new viaje();
                            $listaTemp=$objViaje->listar();
                            for ($i=0; $i<count($listaTemp); $i++){
                                $viaje=$listaTemp[$i];
                                if ($viaje->getObjEmpresa()->getNroEmpresa() == $id){
                                    array_push($coleccion, $viaje);
                                }
                            }
                        }                      
                        $this->setNroEmpresa($row2['idempresa']);
                        $this->setNombre($row2['enombre']);
                        $this->setDireccion($row2['edireccion']);
                        $this->setListaViaje($coleccion);                    
                        $resp=true;
                    }                
                } else { $this->setMensajeOperacion($base->getError()); }
            } else { $this->setMensajeOperacion($base->getError()); }		
            return $resp;
        }

        public function listar($condicion=""){
            $colEmpresa=null;
            $base=new BaseDatos();
            $consulta="Select * from empresa ";
            if ($condicion!=""){
                $consulta.=" where ".$condicion;
            }
            $consulta.=" order by idempresa ";
            if($base->iniciar()){
                if($base->ejecutar($consulta)){
                    $colEmpresa=array ();
                    while($row2=$base->registro()){
                        $objEmpresa=new empresa();
                        $objEmpresa->buscar($row2['idempresa'],FALSE);
                        array_push($colEmpresa,$objEmpresa);
                    }                
                } else { $this->setMensajeOperacion($base->getError()); }
            } else { $this->setMensajeOperacion($base->getError()); }	
            return $colEmpresa;
        }

        public function insertar(){
            $base=new BaseDatos();
            $resp=false;
            $consulta="INSERT INTO empresa(enombre,edireccion) VALUES ('".$this->getNombre()."','".$this->getDireccion()."')";            
            if($base->iniciar()){    
                if($id=$base->devuelveIDInsercion($consulta)){
                    $this->setNroEmpresa($id);
                    $resp=true;    
                } else { $this->setMensajeOperacion($base->getError()); }    
            } else { $this->setMensajeOperacion($base->getError()); }
            return $resp;
        }

        public function modificar(){
            $resp=false; 
            $base=new BaseDatos();
            $consulta="UPDATE empresa SET enombre='".$this->getNombre()."',edireccion='".$this->getDireccion()."' WHERE  idempresa=".$this->getNroEmpresa();
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
                $consulta="DELETE FROM empresa WHERE idempresa=".$this->getNroEmpresa();
                if($base->ejecutar($consulta)){
                    $resp=true;
                }else{ $this->setMensajeOperacion($base->getError()); }
            }else{ $this->setMensajeOperacion($base->getError()); }
            return $resp; 
        }

        // METODO toString()
        public function __toString(){
            return $this->getNombre()."\n".
            "N° EMPRESA: ".$this->getNroEmpresa()."\n".
            "DIRECCION: ".$this->getDireccion().
            $this->textoListaEmpresa();
        }

        public function textoListaEmpresa(){
            /* Retorna un string con los datos de la matrice lista, en caso que no este vacio */
            $txt = "";
            if (count($this->getListaViaje())>0){
                $txt = "EMPRESA:\n";
                foreach ($this->getListaViaje() as $indice => $empresa){
                    $numero = $indice + 1;
                    $txt = $txt."     ".$numero." - ".$empresa."\n"; 
                }
            }            
            return $txt;
        }
    }