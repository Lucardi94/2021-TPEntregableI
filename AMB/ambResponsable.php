<?php
    include_once "../ORM/BaseDatos.php";
    include_once "../ORM/empresa.php";
    include_once "../ORM/viaje.php";
    include_once "../ORM/responsable.php";
    include_once "../ORM/pasajero.php";
    class abmResponsable {        
        public function insertarResponsable($responsable){
            $objResponsable=new responsable();
            $objResponsable->cargar($responsable);
            $colResponsable =$objResponsable->listar();            
            $i=0;
            $encontro = false;
            while ($i<count($colResponsable) && !$encontro){
                if ($colResponsable[$i]->getNroLicencia() == $objResponsable->getNroLicencia()){
                    $txt="Numero de licencia utilizado\n";
                    $encontro = true;
                } 
                $i++;
            }            
            if (!$encontro){
                if ($objResponsable->insertar()){
                    $txt = "Responsable creada\n";
                } else $txt = "Error: ".$objResponsable->getMensajeOperacion();
            }
            return $txt;
        }

        public function modificarNombre($objResponsable,$nuevoNombre){
            $posible = true;
            if ($objResponsable->getNombre() == $nuevoNombre){
                $txt = "Mismo nombre\n";
                $posible = false;
            }
            if ($posible){
                $objResponsable->setNombre($nuevoNombre);            
                if ($objResponsable->modificar()){
                    $txt = "Nombre modificado\n";
                } else $txt = "Error: ".$objResponsable->getMensajeOperacion();
            }
            return $txt;
        }

        public function modificarApellido($objResponsable,$nuevoApellido){
            $posible = true;
            if ($objResponsable->getApellido() == $nuevoApellido){
                $txt = "Mismo apellido\n";
                $posible = false;
            }
            if ($posible){
                $objResponsable->setApellido($nuevoApellido);            
                if ($objResponsable->modificar()){
                    $txt = "Apellido modificado\n";
                } else $txt = "Error: ".$objResponsable->getMensajeOperacion();
            }
            return $txt;
        }

        public function modificarNumeroLicencia($objResponsable,$nuevoNumero){
            $posible = true;
            if ($objResponsable->getNroLicencia() == $nuevoNumero){
                $txt = "Mismo numero de licencia\n";
                $posible = false;
            }
            if ($posible){
                $colResponsable = $objResponsable->listar();           
                $i=0;
                while ($i<count($colResponsable) && $posible){
                    if ($colResponsable[$i]->getNroLicencia() == $nuevoNumero){
                        $txt="Numero de licencia utilizado\n";
                        $posible = false;
                    }
                    $i++;
                }
            }
            if ($posible){
                $objResponsable->setNroEmpleado($nuevoNumero);            
                if ($objResponsable->modificar()){
                    $txt = "Numero de liciencia modificado\n";
                } else $txt = "Error: ".$objResponsable->getMensajeOperacion();
            }  
            return $txt;
        }

        public function listarResponsable(){
            $objResponsable=new responsable();   
            $colResponsable =$objResponsable->listar();
            $txt="RESPONSABLES";
            foreach ($colResponsable as $unResponsable){	
                $txt.="\n-------------------------------------------------------\n".
                $unResponsable;
            }
            return $txt."\n";
        }
        
        public function eliminarResponsable($objResponsable){
            $esta=false;
            $objViaje=new viaje();
            $colViaje = $objViaje->listar();
            $i=0;
            while ($i<count($colViaje) && !$esta){
                if ($colViaje[$i]->getObjResponsable() == $objResponsable){
                    $esta = true;
                }
                $i++;
            }
            if (!$esta){
                if ($objResponsable->eliminar() && !$esta){
                    return "Responsable eliminado\n";
                } else return "Error: ".$objResponsable->getMensajeOperacion();
            } else return "Responsable asignado a un o mas viajes\n";
        }

        public function buscarResponsable($numeroEmpleado){
            $objResponsable=new responsable();               
            $colResponsable =$objResponsable->listar();
            $i=0;
            $encontro = false;
            while ($i<count($colResponsable) && !$encontro){
                if ($colResponsable[$i]->getNroEmpleado() == $numeroEmpleado){
                    $encontro = true;
                } 
                $i++;
            }
            if ($encontro){
                if ($objResponsable->buscar($numeroEmpleado)){
                    return $objResponsable;
                } else return "Error: ".$objResponsable->getMensajeOperacion();
            } else return "Error: nuemero de empleado no valido\n";
        }
    }