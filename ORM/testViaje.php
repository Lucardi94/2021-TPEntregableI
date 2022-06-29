<?php
 include 'viaje.php';
 include 'responsable.php';
 include 'pasajero.php';
 include 'viajeAereo.php';
 include 'viajeTerrestre.php';

 /**
 * La empresa de Transporte de Pasajeros “Viaje Feliz” quiere registrar la información referente a sus viajes.
 * 
 * De cada viaje se precisa almacenar 
 *      código
 *      destino
 *      cantidad máxima de pasajeros
 *      pasajeros del viaje
 * 
 * Realice la implementación de la clase Viaje e implemente los métodos necesarios para modificar los atributos de dicha clase (incluso los datos de los pasajeros). 
 * Utilice un array que almacene la información correspondiente a los pasajeros. 
 * 
 * Cada pasajero es un array asociativo con las claves 
 *      “nombre”
 *      “apellido”
 *      “numero de documento”
 * 
 * ----------------------------------------------------------------------------------------------------------------------------------------------------------------
 * 
 * Modificar la clase Viaje para que ahora los pasajeros sean un objeto que tenga los atributos
 *      nombre
 *      apellido
 *      numero de documento
 *      teléfono
 * 
 * El viaje ahora contiene una referencia a una colección de objetos de la clase Pasajero.
 * 
 * También se desea guardar la información de la persona responsable de realizar el viaje, para ello cree una clase ResponsableV que registre el 
 *      número de empleado
 *      número de licencia
 *      nombre
 *      apellido
 * 
 * La clase Viaje debe hacer referencia al responsable de realizar el viaje.
 * Volver a implementar las operaciones que permiten modificar el nombre, apellido y teléfono de un pasajero.
 * Luego implementar la operación que agrega los pasajeros al viaje, solicitando por consola la información de los mismos.
 * Se debe verificar que el pasajero no este cargado mas de una vez en el viaje. 
 * De la misma forma cargue la información del responsable del viaje.
 * Nota: Recuerden que deben enviar el link a la resolución en su repositorio en GitHub.
 * 
 * ----------------------------------------------------------------------------------------------------------------------------------------------------------------
 * 
 * La empresa de transporte desea gestionar la información correspondiente a los Viajes que pueden ser: Terrestres o Aéreos.
 * 	- guardar su importe
 * 	- indicar si el viaje es de ida y vuelta. 
 * 
 * De los viajes aéreos se conoce:
 * 	- el número del vuelo
 * 	- la categoría del asiento (primera clase o no)
 * 	- nombre de la aerolínea
 * 	- la cantidad de escalas del vuelo en caso de tenerlas
 * 
 * De los viajes terrestres se conoce:
 * 	-la comodidad del asiento, si es semicama o cama.
 * 
 * La empresa ahora necesita implementar la venta de un pasaje, para ello debe realizar la función venderPasaje(pasajero) que registra la venta de un viaje al pasajero que es recibido por parámetro.
 * La venta se realiza solo si hayPasajesDisponible. 
 * 
 * Si el viaje es terrestre y el asiento es cama, se incrementa el importe un 25%.
 * 
 * Si el viaje es aéreo :
 * 	- el asiento es primera clase sin escalas, se incrementa un 40%, 
 * 	- el viaje además de ser un asiento de primera clase, el vuelo tiene escalas se incrementa el importe del viaje un 60%.
 * 
 * Tanto para viajes terrestres o aéreos, si el viaje es ida y vuelta, se incrementa el importe del viaje un 50%. 
 * El método retorna el importe del pasaje si se pudo realizar la venta.
 * 
 * Implemente la función hayPasajesDisponible() que retorna verdadero si la cantidad de pasajeros del viaje es menor a la cantidad máxima de pasajeros y falso caso contrario. 
 */
    function textoListaViaje($listaV){
        /* Retorna un string con los datos de la matrice listaViaje, en caso que no este vacio */
        $txt = "SIN VIAJES\n";
        if (count($listaV) > 0){
            $txt = "";
            foreach ($listaV as $indice => $viaje){
                $numero = $indice + 1;
                $txt.= "\nVIAJE ".$numero."\n".$viaje;
            }
        }            
        return $txt;
    }

    function ingresoViajeTerrestre(){
        /**
         * Esta funcion es para crear un nuevo viaje.
         * Retorna una instancia de la clase viaje.
         * Con la lista pasajero vacia.
         */
        echo "INGRESE DATOS DEL VIAJE\n";
        echo "CODIGO ";
        $cod = trim(fgets(STDIN));
        echo "DESTINO ";
        $des = trim(fgets(STDIN));
        echo "CAPACIDAD DEL VIAJE ";
        $canMax = trim(fgets(STDIN));
        echo "IMPORTE ";
        $imp = trim(fgets(STDIN));
        echo "IDA/VUELTA 1.SI 2.NO ";
        $idaVue = trim(fgets(STDIN));
        switch ($idaVue){
            case 1: $idaVue = TRUE;
            break;
            case 2: $idaVue = FALSE;
            break;
        }
        echo "SEMICAMA 1.Si 2.NO ";
        $sem = trim(fgets(STDIN));
        switch ($sem){
            case 1: $sem = TRUE;
            break;
            case 2: $sem = FALSE;
            break;
        }        
        $objRes = ingresoResponsable();
        return new viajeTerrestre($cod,$des,$canMax,array (),$objRes, $imp, $idaVue, $sem);
    }

    function ingresoViajeAereo(){
        /**
         * Esta funcion es para crear un nuevo viaje.
         * Retorna una instancia de la clase viaje.
         * Con la lista pasajero vacia.
         */
        echo "INGRESE DATOS DEL VIAJE\n";
        echo "CODIGO ";
        $cod = trim(fgets(STDIN));
        echo "DESTINO ";
        $des = trim(fgets(STDIN));
        echo "CAPACIDAD DEL VIAJE ";
        $canMax = trim(fgets(STDIN));
        echo "IMPORTE ";
        $imp = trim(fgets(STDIN));
        echo "NUMERO DE VUELO ";
        $nroVue = trim(fgets(STDIN));
        echo "IDA/VUELTA 1.SI 2.NO ";
        $idaVue = trim(fgets(STDIN));
        switch ($idaVue){
            case 1: $idaVue = TRUE;
            break;
            case 2: $idaVue = FALSE;
            break;
        }        
        echo "NUMERO DE VUELO ";
        $nroVue = trim(fgets(STDIN));
        echo "PRIMERA CLASE 1.Si 2.NO ";
        $catAsi = trim(fgets(STDIN));
        switch ($catAsi){
            case 1: $catAsi = TRUE;
            break;
            case 2: $catAsi = FALSE;
            break;
        }
        echo "NOMBRE AEREOLINEAS ";
        $nomAer = trim(fgets(STDIN));
        echo "NUMERO DE ESCALAS ";
        $nroEsc = trim(fgets(STDIN));       
        $objRes = ingresoResponsable();
        return new viajeAereo($cod,$des,$canMax,array (),$objRes, $imp, $idaVue, $nroVue, $catAsi, $nomAer, $nroEsc);
    }

    function ingresoResponsable(){
        /**
         * Esta funcion es para crear un nuevo responsable.
         * Retorna una instancia de la clase responsable.
         */
        echo "INGRESE DATOS DEL RESPONSABLE\n";
        echo "NOMBRE ";
        $nom = trim(fgets(STDIN));
        echo "APELLIDO ";
        $ape = trim(fgets(STDIN));
        echo "N°LICENCIA  ";
        $nLic = trim(fgets(STDIN));
        echo "N°EMPLEADO  ";
        $nEmp = trim(fgets(STDIN));
        return new responsable($nom,$ape,$nLic,$nEmp);
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
        echo "TEL ";
        $tel = trim(fgets(STDIN));
        return new pasajero($nom,$ape,$dni,$tel);
    }

    /**
     * Textos del nuevo menu principal, retorna la opcion seleccionada por consola
     */
    function menuTextoCero(){
        echo "-------------------------------------------------------------\n".
        "1. Imprimir lista de viajes\n".
        "2. Cargar nuevo viaje\n".
        "3. Administrar viaje\n".
        "4. Eliminar viaje\n".
        "9. Salir\n".
        "Seleccione una opcion ";
        return trim(fgets(STDIN));
    }



    /**
     * Textos del menu principal, retorna la opcion seleccionada por consola
     */
    function menuTexto(){
        echo "-------------------------------------------------------------\n".
        "1. Cambiar codigo del viaje\n".
        "2. Cambiar destino del viaje\n".
        "3. Cambiar cantidad Maxima de Pasajeros\n".
        "4. Administrar lista de pasajeros\n".
        "5. Administrar responsable del viaje\n".
        "6. Imprimir viaje\n".        
        "9. Para salir\n".
        "Seleccione una opcion ";
        return trim(fgets(STDIN));
    }

    /**
     * Textos del menu administrar lista de pasajeros, retorna la opcion seleccionada por consola
     */
    function menuTextoCuatro(){
        echo "-------------------------------------------------------------\n".
        "1. Imprimir lista de pasajeros\n".
        "2. Vender pasaje\n".
        "3. Modificar datos de un Pasajeros\n".
        "4. Eliminar pasajero\n".
        "9. Volver menu principal\n".
        "Seleccione una opcion ";
        return trim(fgets(STDIN));
    }



    /**
     * Textos del menu administrar responsable del viaje, retorna la opcion seleccionada por consola
     */
    function menuTextoCinco(){
        echo "-------------------------------------------------------------\n".
        "1. Imprimir datos del responsable\n".
        "2. Modificar datos del responsable\n".
        "9. Volver menu principal\n".
        "Seleccione una opcion ";
        return trim(fgets(STDIN));
    }

    /**
     * Menu modificacion de un pasajero del viaje
     */    
    function menuTextoCuatroTres(){
        echo "-------------------------------------------------------------\n".
        "1. Cambiar nombre del pasajero\n".
        "2. Cambiar apellido del pasajero\n".
        "3. Cambiar dni del pasajero\n".
        "4. Cambiar telefono del pasajero\n".
        "Seleccione una opcion ";
        return trim(fgets(STDIN));
    }
    
    /**
     * Menu modificacion de responsable del viaje
     */
    function menuTextoCincoDos(){
        echo "-------------------------------------------------------------\n".
        "1. Cambiar nombre del responsable\n".
        "2. Cambiar apellido del responsable\n".
        "3. Cambiar numero de empleado del responsable\n".
        "4. Cambiar numero de liciencia del responsable\n".
        "Seleccione una opcion ";
        return trim(fgets(STDIN));
    }

    /**
     * Menu's de ingreso de datos para modificaciones del viaje
     * retorna datos ingresados por consola
     */

    function menuTextoCeroDos(){
        echo "-------------------------------------------------------------\n".
        "1. Viaje Terrestre\n".
        "2. Viaje Aereo\n".
        "Seleccione una opcion ";
        return trim(fgets(STDIN));
    }

    function menuTextoUno(){
        echo "[CAMBIAR CODIGO] Ingrese nuevo codigo ";
        return trim(fgets(STDIN));
    }

    function menuTextoDos(){
        echo "[CAMBIAR DESTINO] Ingrese nuevo destino ";
        return trim(fgets(STDIN));
    }

    function menuTextoTres(){
        echo "[CAMBIAR CANTIDAD MAXIMA DE PASAJEROS] Ingrese nueva cantidad ";
        return trim(fgets(STDIN));
    }

    /**
     * Menus de ingreso de datos para modificaciones de un pasajero del viaje
     * retorna datos ingresados por consola
     */

    function menuTextoCuatroTresUno(){
        echo "[CAMBIAR NOMBRE] Ingrese nuevo nombre ";
        return trim(fgets(STDIN));
    }

    function menuTextoCuatroTresDos(){
        echo "[CAMBIAR APELLIDO] Ingrese nuevo apellido ";
        return trim(fgets(STDIN));
    }

    function menuTextoCuatroTresTres(){
        echo "[CAMBIAR DNI] Ingrese nuevo dni ";
        return trim(fgets(STDIN));
    }
    function menuTextoCuatroTresCuatro(){
        echo "[CAMBIAR TELEFONO] Ingrese nuevo telefono ";
        return trim(fgets(STDIN));
    }

    /**
     * Menu's de ingreso de datos para modificaciones del responsable del viaje
     * Retornan datos ingresados por consola
     */
    function menuTextoCincoDosUno(){
        echo "[CAMBIAR NOMBRE] Ingrese nuevo nombre ";
        return trim(fgets(STDIN));
    }

    function menuTextoCincoDosDos(){
        echo "[CAMBIAR APELLIDO] Ingrese nuevo apellido ";
        return trim(fgets(STDIN));
    }

    function menuTextoCincoDosTres(){
        echo "[CAMBIAR N°EMPLEADO] Ingrese nuevo numero de empleado ";
        return trim(fgets(STDIN));
    }

    function menuTextoCincoDosCuatro(){
        echo "[CAMBIAR N°LICENCIA] Ingrese nuevo numero de licencia ";
        return trim(fgets(STDIN));
    }

    function menuSeleccionarPasajero($v){
        echo "-------------------------------------------------------------\n".
         $v->textoListaPasajeros().
        "Ingrese el numero del pasajero ";
        return trim(fgets(STDIN)) - 1; // -1 Para la posicion del arreglo
    }

    function menuSeleccionarViaje($listaV){
        echo textoListaViaje($listaV).
        "Ingrese el numero del viaje ";
        return trim(fgets(STDIN)) - 1; // -1 Para la posicion del arreglo
    }
    
    /**
     * PROGRAMA PRINCIPAL
     */
    echo "-------------------------------------------------------------\n".
    "Bienvenido La empresa de Transporte de Pasajeros Viaje Feliz\n";
    $listaViaje = array ();

    do{
        $respuesta0 = menuTextoCero();
        switch ($respuesta0){
            //OPCION 1 Imprimir lista de pasajeros             
            case 1: 
                echo textoListaViaje($listaViaje);
            break;
            //OPCION 2 Cargar nuevo viaje
            case 2:
                $respuesta1 = menuTextoCeroDos();
                switch ($respuesta1){
                    case 1: array_push($listaViaje,ingresoViajeTerrestre());
                    break;                    
                    case 2: array_push($listaViaje,ingresoViajeAereo());
                    break;
                    default: echo "Valor no valido\n";
                    break;
                }
            break;
            //OPCION 3 Administrar Viaje
            case 3:
                $indiceViaje = menuSeleccionarViaje($listaViaje);
                $viaje = $listaViaje[$indiceViaje];
                do { //menu interactivo
                    $respuesta = menuTexto();
                    switch ($respuesta){
                        //OPCION 1 Cambiar codigo del viaje           
                        case 1:
                            $nuevoCodigo = menuTextoUno();
                            echo $viaje->cambiarCodigo($nuevoCodigo);
                        break;
                        //OPCION 2 Cambiar destino del viaje
                        case 2:
                            $nuevoDestino = menuTextoDos();
                            echo $viaje->cambiarDestino($nuevoDestino);
                        break;
                        //OPCION 3 Cambiar cantidad Maxima de Pasajeros
                        case 3:
                            $nuevaCantidad = menuTextoTres();
                            echo $viaje->cambiarCantidadMaxima($nuevaCantidad);
                        break;
                        //OPCION 4 Administrar lista de pasajeros
                        case 4:
                            do{
                                $respuesta2 = menuTextoCuatro();            
                                switch ($respuesta2){
                                    //OPCION 4.1 Imprimir lista de pasajeros             
                                    case 1: echo $viaje->textoListaPasajeros();
                                    break;
                                    //OPCION 4.2 Cargar un nuevo pasajero
                                    case 2: if ($viaje->hayPasajeroDisponible()){
                                        $viaje->venderPasaje(ingresoPasajero());
                                        echo "Operacion Exitosa! valor: ".$viaje->darImporte()."$\n";
                                    } else "Operacion Fallida!\n";
                                    break;
                                    //OPCION 4.3 Modificar datos de un Pasajeros
                                    case 3:
                                        $indice = menuSeleccionarPasajero($viaje);
                                        $respuesta3 = menuTextoCuatroTres();
                                        switch ($respuesta3){                                
                                            //OPCION 4.3.1 Cambiar nombre del pasajero
                                            case 1:
                                                $nuevoNombre = menuTextoCuatroTresUno();
                                                echo $viaje->cambiarNombrePasajero($nuevoNombre,$indice)."\n";
                                            break;                                
                                            //OPCION 4.3.2 Cambiar apellido del pasajero
                                            case 2:
                                                $nuevoApellido = menuTextoCuatroTresDos();
                                                echo $viaje->cambiarApellidoPasajero($nuevoApellido,$indice)."\n";
                                            break;                                
                                            //OPCION 4.3.3 Cambiar dni del pasajero
                                            case 3:
                                                $nuevoDni = menuTextoCuatroTresTres();
                                                echo $viaje->cambiarNroDocumentoPasajero($nuevoDni,$indice)."\n";
                                            break;
                                            //OPCION 4.3.4 Cambiar telefono del pasajero
                                            case 4:
                                                $nuevoTelefono = menuTextoCuatroTresCuatro();
                                                echo $viaje->cambiarTelefonoPasajero($nuevoTelefono,$indice)."\n";
                                            break;
                                            default: echo "Valor no valido\n";
                                        }
                                    break;                        
                                    //OPCION 4.4 Eliminar pasajero
                                    case 4:
                                        $indice = menuSeleccionarPasajero($viaje);
                                        echo $viaje->borrarPasajero($indice)."\n";
                                    break;                        
                                    //OPCION 4.5 Volver menu principal
                                    case 9: //sin accion
                                    break;
                                    default: echo "Valor no valido\n";
                                }
                            } while ($respuesta2 != 9);
                        break;
                        //OPCION 5 Administrar responsable
                        case 5:
                            do{
                                $respuesta2 = menuTextoCinco();            
                                switch ($respuesta2){
                                    //OPCION 5.1 Imprimir datos del responsable             
                                    case 1: echo "Responsable: ".$viaje->getObjResponsable()."\n";
                                    break;
                                    //OPCION 5.2 Modificar datos del responsable
                                    case 2:
                                        $respuesta3 = menuTextoCincoDos();
                                        switch (menuTextoCincoDos()){                                
                                            //OPCION 5.2.1 Cambiar nombre del responsable
                                            case 1:
                                                $nuevoNombre = menuTextoCincoDosUno();
                                                echo $viaje->cambiarNombreResponsable($nuevoNombre)."\n";
                                            break;                                
                                            //OPCION 5.2.2 Cambiar apellido del responsable
                                            case 2:
                                                $nuevoApellido = menuTextoCincoDosDos();
                                                echo $viaje->cambiarApellidoResponsable($nuevoApellido)."\n";
                                            break;                                
                                            //OPCION 5.2.3 Cambiar numero de empleado del responsable
                                            case 3:
                                                $nuevoNroEmpleado = menuTextoCincoDosTres();
                                                echo $viaje->cambiarNroEmpleadoResponsable($nuevoNroEmpleado)."\n";
                                            break;
                                            //OPCION 5.2.4 Cambiar numero de liciencia del responsable
                                            case 4:
                                                $nuevoNroLicencia = menuTextoCincoDosCuatro();
                                                echo $viaje->cambiarNroLicenciaResponsable($nuevoNroLicencia)."\n";
                                            break;
                                            default: echo "Valor no valido\n";
                                        }
                                    break;                        
                                    //OPCION 5.9 Volver menu principal
                                    case 9: //sin accion
                                    break;
                                    default: echo "Valor no valido\n";
                                }
                            } while ($respuesta2 != 9);
                        break;
                        //OPCION 5 Imprimir viaje
                        case 6: echo $viaje;
                        break;
                        //OPCION 9 Salir
                        case 9:
                        break;
                        default: echo "Valor no valido\n";
                    }
                } while ($respuesta != 9);
                $listaViaje[$indiceViaje] = $viaje;
            break;
            // Opcion 4: Eliminar viaje
            case 4:
                $indiceViaje = menuSeleccionarViaje($listaViaje);
                if (count($listaViaje) > 0){ // Verifica que la lista no este vacia
                    if (count($listaViaje) > $indiceViaje){ // Verifica que $i pueda ser un nuemero del arreglo
                        array_splice($listaViaje,$indiceViaje,1);
                        echo "Operacion Exitosa!\n";
                    } else echo "Operacion Fallida! Numero no valido\n";
                } else echo "Operacion Fallida! Lista vacia\n";
            break;
            case 9: echo "GOD BYE!";
            break;
            default: echo "Valor no valido\n";
            break;
        }
    } while ($respuesta0 != 9);