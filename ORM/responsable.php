<?php
    class responsable{
        // ATRIBUTOS
        private $nombre;
        private $apellido;
        private $nroEmpleado;
        private $nroLicencia;
        private $mensajeOperacion;

        // METODO CONSTRUCTOR
        public function __construct(){
            $this->nombre = "";
            $this->apellido = "";
            $this->nroEmpleado = 0;
            $this->nroLicencia = 0;
        }

        public function cargar($responsable){
            $this->setNombre($responsable['rnombre']);
            $this->setApellido($responsable['rapellido']);
            $this->setNroEmpleado($responsable['rnumeroempleado']);
            $this->setNroLicencia($responsable['rnumerolicencia']);
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
        public function getMensajeOperacion(){
            return $this->mensajeOperacion;
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
        public function setMensajeOperacion($nMsj){
            $this->mensajeOperacion=$nMsj;
        }

        public function buscar($id){
            $base=new BaseDatos();
            $consulta="Select * from responsable where rnumeroempleado=".$id;
            $resp=false;
            if($base->iniciar()){
                if($base->ejecutar($consulta)){
                    if($row2=$base->registro()){
                        $this->cargar($row2);                   
                        $resp=true;
                    }                
                } else { $this->setMensajeOperacion($base->getError()); }
            } else { $this->setMensajeOperacion($base->getError()); }		
            return $resp;
        }

        public function listar($condicion=""){
            $colResponsable=null;
            $base=new BaseDatos();
            $consulta="Select * from responsable ";
            if ($condicion!=""){
                $consulta.=" where ".$condicion;
            }
            $consulta.=" order by rnumeroempleado ";
            if($base->iniciar()){
                if($base->ejecutar($consulta)){
                    $colResponsable=array ();
                    while($row2=$base->registro()){
                        $objResponsalbe=new responsable();
                        $objResponsalbe->buscar($row2['rnumeroempleado']);
                        array_push($colResponsable,$objResponsalbe);
                    }                
                } else { $this->setMensajeOperacion($base->getError()); }
            } else { $this->setMensajeOperacion($base->getError()); }	
            return $colResponsable;
        }

        public function insertar(){
            $base=new BaseDatos();
            $resp=false;
            $consulta="INSERT INTO responsable(rnumerolicencia,rnombre,rapellido) VALUES (".$this->getNroLicencia().",'".$this->getNombre()."','".$this->getApellido()."')";            
            if($base->iniciar()){    
                if($id=$base->devuelveIDInsercion($consulta)){
                    $this->setNroEmpleado($id);
                    $resp=true;    
                } else { $this->setMensajeOperacion($base->getError()); }    
            } else { $this->setMensajeOperacion($base->getError()); }
            return $resp;
        }

        public function modificar(){
            $resp=false; 
            $base=new BaseDatos();
            $consulta="UPDATE responsable SET rnumerolicencia=".$this->getNroLicencia().",rnombre='".$this->getNombre()."',rapellido='".$this->getApellido()."' WHERE rnumeroempleado=".$this->getNroEmpleado();
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
                $consulta="DELETE FROM responsable WHERE rnumeroempleado=".$this->getNroEmpleado();
                if($base->ejecutar($consulta)){
                    $resp=true;
                }else{ $this->setMensajeOperacion($base->getError()); }
            }else{ $this->setMensajeOperacion($base->getError()); }
            return $resp; 
        }

        // METODO toString()
        public function __toString(){
            return "##########################\n".
            "Responsable: ".$this->getNombre()." ".$this->getApellido()."\n".
            "N° EMPLEADO: ".$this->getNroEmpleado()."\n".
            "N° LICENCIA: ".$this->getNroLicencia()."\n".
            "##########################";
        }
    }