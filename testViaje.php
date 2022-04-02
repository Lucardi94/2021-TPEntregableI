<?php
    include 'viaje.php';

    /**
    * Implementar un script testViaje.php que cree una instancia de la clase Viaje y presente un menú que permita cargar la información del viaje, modificar y ver sus datos.
    */

    function ingresoViaje(){
        /**
         * Esta funcion es para crear un nuevo viaje.
         * Retorna una instancia de la clase viaje.
         * Con la lista pasajero vacia.
         */
        echo "Ingrese codigo del viaje ";
        $cod = trim(fgets(STDIN));
        echo "Ingrese destino del viaje ";
        $des = trim(fgets(STDIN));
        echo "Ingrese cantidad maxima de pasajeros ";
        $canMax = trim(fgets(STDIN));

        return new viaje($cod,$des,$canMax,array ());
    }

    function ingresoPasajero(){
        /**
         * Esta funcion es para ingresar datos de pasajeros.
         * Retorna una matrice de Pasajero (nombre, apellido, dni).
         * Con la lista pasajero vacia.
         */
        echo "INGRESE DATOS DEL NUEVO PASAJERO\n";
        echo "NOMBRE ";
        $nom = trim(fgets(STDIN));
        echo "APELLIDO ";
        $ape = trim(fgets(STDIN));
        echo "DNI ";
        $dni = trim(fgets(STDIN));

        $pas = array("nombre"=>$nom,"apellido"=>$ape,"dni"=>$dni);
        return $pas;
    }
    
    /**
     * Textos de menus, retorna la opcion seleccionada
     */

    function menuTextoUno(){
        echo "-------------------------------------------------------------\n".
        "1. Cambiar codigo del viaje\n".
        "2. Cambiar destino del viaje\n".
        "3. Cambiar cantidad Maxima de Pasajeros\n".
        "4. Administrar lista de pasajeros\n".
        "5. Imprimir viaje\n".        
        "9. Para salir\n".
        "Seleccione una opcion ";
        return trim(fgets(STDIN));
    }

    function menuTextoDos(){
        echo "[CAMBIAR CODIGO] Ingrese nuevo codigo ";
        return trim(fgets(STDIN));
    }

    function menuTextoTres(){
        echo "[CAMBIAR DESTINO] Ingrese nuevo destino ";
        return trim(fgets(STDIN));
    }

    function menuTextoCuatro(){
        echo "[CAMBIAR CANTIDAD MAXIMA DE PASAJEROS] Ingrese nueva cantidad ";
        return trim(fgets(STDIN));
    }

    function menuTextoCinco(){
        echo "-------------------------------------------------------------\n".
        "1. Imprimir lista de pasajeros\n".
        "2. Cargar un nuevo pasajero\n".
        "3. Modificar datos de un Pasajeros\n".
        "4. Eliminar pasajero\n".
        "9. Volver menu principal\n".
        "Seleccione una opcion ";
        return trim(fgets(STDIN));
    }

    function menuTextoSeis($v){
        echo "-------------------------------------------------------------\n".
         $v->textoListaPasajeros().
        "Ingrese el numero del pasajero ";
        return trim(fgets(STDIN)) - 1; // -1 Para la posicion del arreglo
    }

    function menuTextoSiete(){
        echo "-------------------------------------------------------------\n".
        "1. Cambiar nombre del pasajero\n".
        "2. Cambiar apellido del pasajero\n".
        "3. Cambiar dni del pasajero\n".
        "Seleccione una opcion ";
        return trim(fgets(STDIN));
    }

    function menuTextoOcho(){
        echo "[CAMBIAR NOMBRE] Ingrese nuevo nombre ";
        return trim(fgets(STDIN));
    }

    function menuTextoNueve(){
        echo "[CAMBIAR APELLIDO] Ingrese nuevo apellido ";
        return trim(fgets(STDIN));
    }

    function menuTextoDiez(){
        echo "[CAMBIAR DNI] Ingrese nuevo dni ";
        return trim(fgets(STDIN));
    }

    /**
     * PROGRAMA PRINCIPAL
     */

    $viaje = ingresoViaje();
    echo "-------------------------------------------------------------\n".
    "Bienvenido La empresa de Transporte de Pasajeros Viaje Feliz\n";

    do { //menu interactivo

        $respuesta = menuTextoUno();
        switch ($respuesta){

            //OPCION 1 Cambiar codigo del viaje           
            case 1:
                $nuevoCodigo = menuTextoDos();
                if ($viaje->cambiarCodigo($nuevoCodigo)){ // Verifica que sea otro codigo 
                    echo "Exitoso nuevo codigo ".$viaje->getCodigo()."\n";
                } else echo "Mismo codigo...\n";
            break;

            //OPCION 2 Cambiar destino del viaje
            case 2:
                $nuevoDestino = menuTextoTres();
                if ($viaje->cambiarDestino($nuevoDestino)){ // Verifica que sea otro destino 
                    echo "Exitoso nuevo destino ".$viaje->getDestino()."\n";
                } else echo "Mismo destino...\n";
            break;

            //OPCION 3 Cambiar cantidad Maxima de Pasajeros
            case 3:
                $nuevaCantidad = menuTextoCuatro();
                if ($viaje->cambiarCantidadMaxima($nuevaCantidad)){ // Verifica que sea otra cantidad
                    echo "Exitoso nueva capacidad ".$viaje->getCantidadMaxima()." pasajeros\n";
                } else echo "Misma capacidad...\n";
            break;

            //OPCION 4 Administrar lista de pasajeros
            case 4:
                do{
                    $respuesta2 = menuTextoCinco();            
                    switch ($respuesta2){

                        //OPCION 4.1 Imprimir lista de pasajeros             
                        case 1:
                            echo "Pasajeros: ".$viaje->textoListaPasajeros();
                        break;

                        //OPCION 4.2 Cargar un nuevo pasajero
                        case 2:
                            if ($viaje->agregarPasajero(ingresoPasajero())){
                                echo "Pasajero cargado con exito\n";
                            } else echo "No entra un alma mas\n";
                        break;

                        //OPCION 4.3 Modificar datos de un Pasajeros
                        case 3:
                            $indice = menuTextoSeis($viaje);
                            $respuesta3 = menuTextoSiete();
                            switch ($respuesta3){
                                
                                //OPCION 4.3.1 Cambiar nombre del pasajero
                                case 1:
                                    $nuevoNombre = menuTextoOcho();
                                    if ($viaje->cambiarNombrePasajero($nuevoNombre,$indice)){ // Verifica que sea otro codigo 
                                        echo "Exitoso nuevo nombre ".$viaje->getListaPasajero()[$indice]["nombre"]."\n";
                                    } else echo "Mismo nombre...\n";
                                break;
                                
                                //OPCION 4.3.2 Cambiar apellido del pasajero
                                case 2:
                                    $nuevoApellido = menuTextoNueve();
                                    if ($viaje->cambiarApellidoPasajero($nuevoApellido,$indice)){ // Verifica que sea otro codigo 
                                        echo "Exitoso nuevo apellido ".$viaje->getListaPasajero()[$indice]["apellido"]."\n";
                                    } else echo "Mismo apellido...\n";
                                break;
                                
                                //OPCION 4.3.3 Cambiar dni del pasajero
                                case 3:
                                    $nuevoDni = menuTextoDiez();
                                    if ($viaje->cambiarDNIPasajero($nuevoDni,$indice)){ // Verifica que sea otro codigo 
                                        echo "Exitoso nuevo dni ".$viaje->getListaPasajero()[$indice]["dni"]."\n";
                                    } else echo "Mismo dni...\n";
                                break;
                            }
                        break;
                        
                        //OPCION 4.4 Eliminar pasajero
                        case 4:
                            $indice = menuTextoSeis($viaje);
                            if ($viaje->borrarPasajero($indice)){ // Verifica que sea otro codigo 
                                echo "Exitoso Borrado\n";
                            } else echo "No fue posible chavito...\n"; 
                        break;
                        
                        //OPCION 4.5 Volver menu principal
                        case 9: echo "Good bye";
                        break;

                        default: echo "Valor no valido\n";
                    }
                } while ($respuesta2 != 9);
            break;

            //OPCION 5 Imprimir viaje
            case 5: 
                echo $viaje."\n";
            break;

            //OPCION 9 Salir
            case 9: echo "Good bye";
            break;

            default: echo "Valor no valido\n";
        }
     } while ($respuesta != 9);