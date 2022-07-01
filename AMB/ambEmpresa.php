<?php
    include_once "../ORM/BaseDatos.php";
    include_once "../ORM/empresa.php";
    include_once "../ORM/viaje.php";
    include_once "../ORM/responsable.php";
    include_once "../ORM/pasajero.php";
    class abmEmpresa {
        
        public function insertarEmpresa($empresa){
            $objEmpresa=new empresa();
            $objEmpresa->cargar($empresa);
            $colEmpresa =$objEmpresa->listar();            
            $i=0;
            $encontro = false;
            while ($i<count($colEmpresa) && !$encontro){
                if ($colEmpresa[$i]->getNombre() == $objEmpresa->getNombre() && $colEmpresa[$i]->getDireccion() == $objEmpresa->getDireccion()){
                    $txt="Nombre y direccion utilizados\n";
                    $encontro = true;
                } elseif ($colEmpresa[$i]->getNombre() == $objEmpresa->getNombre() ){
                    $txt="Nombre utilizado\n";
                    $encontro = true;
                } elseif ($colEmpresa[$i]->getDireccion() == $objEmpresa->getDireccion()){
                    $txt="Direccion utilizada\n";
                    $encontro = true;
                }
                $i++;
            }            
            if (!$encontro){
                if ($objEmpresa->insertar()){
                    $txt = "Empresa creada\n";
                } else $txt = "Error: ".$objEmpresa->getMensajeOperacion();
            }
            return $txt;
        }

        public function modificarNombre($objEmpresa,$nuevoNombre){
            $posible = true;
            if ($objEmpresa->getNombre() == $nuevoNombre){
                $txt = "Mismo nombre\n";
                $posible = false;
            }
            $colEmpresa =$objEmpresa->listar();            
            $i=0;
            while ($i<count($colEmpresa) && $posible){
                if ($colEmpresa[$i]->getNombre() == $nuevoNombre){
                    $txt="Nombre utilizado\n";
                    $posible = false;
                }
                $i++;
            }  
            if ($posible){
                $objEmpresa->setNombre($nuevoNombre);            
                if ($objEmpresa->modificar()){
                    $txt = "Nombre modificado\n";
                } else $txt = "Error: ".$objEmpresa->getMensajeOperacion();
            }
            return $txt;
        }

        public function modificarDireccion($objEmpresa,$nuevoDireccion){
            $posible = true;
            if ($objEmpresa->getDireccion() == $nuevoDireccion){
                $txt = "Misma direccion\n";
                $posible = false;
            }
            $colEmpresa =$objEmpresa->listar();            
            $i=0;
            while ($i<count($colEmpresa) && $posible){
                if ($colEmpresa[$i]->getDireccion() == $nuevoDireccion){
                    $txt="Direccion utilizado\n";
                    $posible = false;
                }
                $i++;
            }  
            if ($posible){
                $objEmpresa->setDireccion($nuevoDireccion);            
                if ($objEmpresa->modificar()){
                    $txt = "Direccion modificada\n";
                } else $txt = "Error: ".$objEmpresa->getMensajeOperacion();
            }
            return $txt;
        }

        public function listarEmpresa(){
            $objEmpresa=new empresa();
            $colEmpresa =$objEmpresa->listar();
            $txt="EMPRESAS";
	        foreach ($colEmpresa as $unaEmpresa){	
		        $txt.= "\n-------------------------------------------------------\n".$unaEmpresa;
	        }
            return $txt."\n";
        }
        /*
        public function eliminarFuncion($id){
            $objFuncion=new Funcion();
            $objFuncion->Buscar($id);   
            if ($objFuncion->eliminar()){
                return "Funcion Eliminada";
            } else return "Error: ".$objFuncion->getMensajeOperacion();
        }
        */

        public function buscarEmpresa($numeroEmpresa){
            $objEmpresa=new empresa();   
            $colEmpresa = $objEmpresa->listar();
            $i=0;
            $encontro = false;
            while ($i<count($colEmpresa) && !$encontro){
                if ($colEmpresa[$i]->getNroEmpresa() == $numeroEmpresa){
                    $encontro = true;
                } 
                $i++;
            }
            if ($encontro){
                if ($objEmpresa->buscar($numeroEmpresa, TRUE)){
                    return $objEmpresa;
                } else return "Error: ".$objEmpresa->getMensajeOperacion();
            } else return "Error: nuemero de empresa no valido\n";
        }
    }
