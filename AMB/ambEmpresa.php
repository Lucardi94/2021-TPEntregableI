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

        /*
        public function modificarFuncion($id,$funcion){
            $objFuncion=new Funcion();
            $objFuncion->Buscar($id);   
            $objFuncion->cargar($funcion);            
            if ($objFuncion->modificar()){
                return "Funcion Modificada";
            } else return "Error: ".$objFuncion->getMensajeOperacion();
        }

        public function listarFuncion(){
            $objFuncion=new Funcion();   
            $colFuncion =$objFuncion->listar();
            $txt="[FUNCIONES]".
            "\n-------------------------------------------------------\n";
	        foreach ($colFuncion as $unaFuncion){	
		        $txt.= $unaFuncion.
                "\n-------------------------------------------------------\n";
	        }
            return $txt;
        }

        public function eliminarFuncion($id){
            $objFuncion=new Funcion();
            $objFuncion->Buscar($id);   
            if ($objFuncion->eliminar()){
                return "Funcion Eliminada";
            } else return "Error: ".$objFuncion->getMensajeOperacion();
        }

        public function buscarFuncion($id){
            $objFuncion=new Funcion();   
            if ($objFuncion->Buscar($id)){
                return $objFuncion;
            } else return "Error: ".$objFuncion->getMensajeOperacion();
        }

        //FUNCIONES
        public function darCosto($id){
            $objFuncion=new Funcion();   
            if ($objFuncion->Buscar($id)){
                return $objFuncion->getPrecio()*1.45;
            } else return "Error: ".$objFuncion->getMensajeOperacion();
        }*/
    }
