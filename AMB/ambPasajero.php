<?php
    include_once "../ORM/BaseDatos.php";
    include_once "../ORM/empresa.php";
    include_once "../ORM/viaje.php";
    include_once "../ORM/responsable.php";
    include_once "../ORM/pasajero.php";
    class abmPasajero {        
        public function insertarPasajero($pasajero){
            $objPasajero= new pasajero();
            $objPasajero->cargar($pasajero);
            $objViaje = new viaje();
            $objViaje->buscar($objPasajero->getObjViaje()->getCodigo(),TRUE);
            $posible=false;
            $txt = "Viaje completo\n";
            if (count($objViaje->getListaPasajero()) < $objViaje->getCantidadMaxima()){
                $posible = true;
            }
            $colPasajero =$objPasajero->listar();            
            $i=0;
            while ($i<count($colPasajero) && $posible){
                if ($colPasajero[$i]->getNroDocumento() == $objPasajero->getNroDocumento()){
                    $txt="Numero de dni utilizado\n";
                    $posible=false;
                } 
                $i++;
            }            
            if ($posible){
                if ($objPasajero->insertar()){
                    $txt = "Pasajero creado\n";
                } else $txt = "Error: ".$objPasajero->getMensajeOperacion();
            }
            return $txt;
        }

        public function modificarNombre($objPasajero,$nuevoNombre){
            $posible = true;
            if ($objPasajero->getNombre() == $nuevoNombre){
                $txt = "Mismo nombre\n";
                $posible = false;
            }
            if ($posible){
                $objPasajero->setNombre($nuevoNombre);            
                if ($objPasajero->modificar()){
                    $txt = "Nombre modificado\n";
                } else $txt = "Error: ".$objPasajero->getMensajeOperacion();
            }
            return $txt;
        }

        public function modificarApellido($objPasajero,$nuevoApellido){
            $posible = true;
            if ($objPasajero->getApellido() == $nuevoApellido){
                $txt = "Mismo apellido\n";
                $posible = false;
            }
            if ($posible){
                $objPasajero->setApellido($nuevoApellido);            
                if ($objPasajero->modificar()){
                    $txt = "Apellido modificado\n";
                } else $txt = "Error: ".$objPasajero->getMensajeOperacion();
            }
            return $txt;
        }

        public function modificarTelefono($objPasajero,$nuevoTelefono){
            $posible = true;
            if ($objPasajero->getTelefono() == $nuevoTelefono){
                $txt = "Mismo telefono\n";
                $posible = false;
            }
            if ($posible){
                $objPasajero->setTelefono($nuevoTelefono);            
                if ($objPasajero->modificar()){
                    $txt = "Telefono modificado\n";
                } else $txt = "Error: ".$objPasajero->getMensajeOperacion();
            }
            return $txt;
        }       

        public function listarPasajero($codigoViaje){
            $objPasajero=new pasajero();
            $colPasajero =$objPasajero->listar();
            $txt="PASAJEROS";
	        foreach ($colPasajero as $unPasajero){
                if ($unPasajero->getObjViaje()->getCodigo() == $codigoViaje){
                   $txt.= "\n-------------------------------------------------------\n".$unPasajero;
                }
	        }
            return $txt."\n";
        }
        
        public function eliminarPasajero($objPasajero){  
            if ($objPasajero->eliminar()){
                return "Pasajero eliminado\n";
            } else return "Error: ".$objPasajero->getMensajeOperacion();
        }
        
        public function buscarPasajero($dni){
            $objPasajero=new pasajero();               
            $colPasajero =$objPasajero->listar();
            $i=0;
            $encontro = false;
            while ($i<count($colPasajero) && !$encontro){
                if ($colPasajero[$i]->getNroDocumento() == $dni){
                    $encontro = true;
                } 
                $i++;
            }
            if ($encontro){
                if ($objPasajero->buscar($dni)){
                    return $objPasajero;
                } else return "Error: ".$objPasajero->getMensajeOperacion();
            } else return "Error: nuemero de dni no valido\n";
        }
    }