<?php
    include_once "../ORM/BaseDatos.php";
    include_once "../ORM/empresa.php";
    include_once "../ORM/viaje.php";
    include_once "../ORM/responsable.php";
    include_once "../ORM/pasajero.php";
    class abmViaje {
        
        public function insertarViaje($viaje){
            $objViaje=new viaje();
            $objViaje->cargar($viaje);
            $colViaje = $objViaje->listar();            
            $i=0;
            $encontro = false;
            while ($i<count($colViaje) && !$encontro){
                if ($colViaje[$i]->getDestino() == $objViaje->getDestino() && $colViaje[$i]->getObjEmpresa()->getNroEmpresa() == $objViaje->getObjEmpresa()->getNroEmpresa()){
                    $txt="La empresa ya tiene ese destino\n";
                    $encontro = true;
                }
                $i++;
            }            
            if (!$encontro){
                if ($objViaje->insertar()){
                    $txt = "Viaje creado\n";
                } else $txt = "Error: ".$objViaje->getMensajeOperacion();
            }
            return $txt;
        }

        public function modificarDestino($objViaje,$nuevoDestino){
            $posible = true;
            if ($objViaje->getDestino() == $nuevoDestino){
                $txt = "Mismo destino\n";
                $posible = false;
            }
            $colViaje = $objViaje->listar();            
            $i=0;
            while ($i<count($colViaje) && $posible){
                if ($colViaje[$i]->getDestino() == $nuevoDestino && $colViaje[$i]->getObjEmpresa()->getNroEmpresa() == $objViaje->getObjEmpresa()->getNroEmpresa()){
                    $txt="La empresa ya tiene ese destino\n";
                    $posible = false;
                }
                $i++;
            }  
            if ($posible){
                $objViaje->setDestino($nuevoDestino);            
                if ($objViaje->modificar()){
                    $txt = "Destino modificado\n";
                } else $txt = "Error: ".$objViaje->getMensajeOperacion();
            }
            return $txt;
        }

        public function modificarCantidadPasajeros($objViaje,$nuevaCantidad){
            $posible = true;
            if (count($objViaje->getListaPasajero()) > $nuevaCantidad){
                $txt = "La cantidad de pasajeros es mayor que esa cantidad \n";
                $posible = false;
            }
            if ($objViaje->getCantidadMaxima() == $nuevaCantidad){
                $txt = "Es la misma capacidad \n";
                $posible = false;
            }
            if ($posible){
                $objViaje->setCantidadMaxima($nuevaCantidad);            
                if ($objViaje->modificar()){
                    $txt = "Capacidad modificada\n";
                } else $txt = "Error: ".$objViaje->getMensajeOperacion();
            }
            return $txt;
        }

        public function modificarImporte($objViaje,$nuevoImporte){
            $posible = true;
            if ($objViaje->getImporte() == $nuevoImporte){
                $txt = "Es el mismo importe \n";
                $posible = false;
            }
            if ($nuevoImporte<0){
                $txt = "Valor no valido \n";
                $posible = false;
            }
            if ($posible){
                $objViaje->setImporte($nuevoImporte);            
                if ($objViaje->modificar()){
                    $txt = "Importe modificada\n";
                } else $txt = "Error: ".$objViaje->getMensajeOperacion();
            }
            return $txt;
        }

        public function modificarIdaVuelta($objViaje){
            if ($objViaje->getIdaVuelta() == 1){
                $objViaje->setIdaVuelta(2);
            } else $objViaje->setIdaVuelta(1);           
            if ($objViaje->modificar()){
                $txt = "Ida y vuelta modificado\n";
            } else $txt = "Error: ".$objViaje->getMensajeOperacion();
            return $txt;
        }

        public function modificarTipoAsiento($objViaje){
            if ($objViaje->getTipoAsiento() == 1){
                $objViaje->setTipoAsiento(2);
            } else $objViaje->setTipoAsiento(1);           
            if ($objViaje->modificar()){
                $txt = "Tipo de asiento modificado\n";
            } else $txt = "Error: ".$objViaje->getMensajeOperacion();
            return $txt;
        }

        public function modificarResponsableViaje($objViaje,$objResponsable){
            $posible = true;
            if ($objViaje->getObjResponsable() == $objResponsable){
                $txt = "Es el mismo responsable \n";
                $posible = false;
            }
            if ($posible){
                $objViaje->setObjResponsable($objResponsable);            
                if ($objViaje->modificar()){
                    $txt = "Responsable modificado\n";
                } else $txt = "Error: ".$objViaje->getMensajeOperacion();
            }
            return $txt;
        }


        public function listarViaje($numeroEmpresa){
            $objViaje=new viaje();
            $colViaje =$objViaje->listar();
            $txt="VIAJES";
	        foreach ($colViaje as $unViaje){
                if ($unViaje->getObjEmpresa()->getNroEmpresa() == $numeroEmpresa){
                    $txt.= "\n-------------------------------------------------------\n".$unViaje;
                }
	        }
            return $txt."\n";
        }
        public function eliminarViaje($objViaje){
            $pudo=true;
            if (count($objViaje->getListaPasajero())>0){
                foreach ($objViaje->getListaPasajero() as $pasajero){
                    if (!$pasajero->eliminar()){
                        $pudo = false;
                    }
                }
            } 
            if ($objViaje->eliminar() && $pudo){
                return "Viaje eliminado\n";
            } else return "Error: ".$objViaje->getMensajeOperacion();
        }

        public function buscarViaje($codigoViaje){
            $objViaje=new viaje();   
            $colViaje = $objViaje->listar();
            $i=0;
            $encontro = false;
            while ($i<count($colViaje) && !$encontro){
                if ($colViaje[$i]->getCodigo() == $codigoViaje){
                    $encontro = true;
                } 
                $i++;
            }
            if ($encontro){
                if ($objViaje->buscar($codigoViaje, TRUE)){
                    return $objViaje;
                } else return "Error: ".$objViaje->getMensajeOperacion();
            } else return "Error: codigo de viaje no valido\n";
        }
    }
