<?php
 include 'viaje.php';
 include 'responsable.php';
 include 'pasajero.php';

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
        $objRes = ingresoResponsable();

        return new viaje($cod,$des,$canMax,array (),$objRes);
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
     * Textos de menus, retorna la opcion seleccionada
     */

    function menuTexto(){
        echo "\n-------------------------------------------------------------\n".
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

    function menuTextoCuatro(){
        echo "-------------------------------------------------------------\n".
        "1. Imprimir lista de pasajeros\n".
        "2. Cargar un nuevo pasajero\n".
        "3. Modificar datos de un Pasajeros\n".
        "4. Eliminar pasajero\n".
        "9. Volver menu principal\n".
        "Seleccione una opcion ";
        return trim(fgets(STDIN));
    }

    function menuTextoCinco(){
        echo "-------------------------------------------------------------\n".
        "1. Imprimir datos del responsable\n".
        "2. Modificar datos del responsable\n".
        "9. Volver menu principal\n".
        "Seleccione una opcion ";
        return trim(fgets(STDIN));
    }

    function menuSeleccionarPasajero($v){
        echo "-------------------------------------------------------------\n".
         $v->textoListaPasajeros().
        "Ingrese el numero del pasajero ";
        return trim(fgets(STDIN)) - 1; // -1 Para la posicion del arreglo
    }

    function menuTextoCuatroTres(){
        echo "-------------------------------------------------------------\n".
        "1. Cambiar nombre del pasajero\n".
        "2. Cambiar apellido del pasajero\n".
        "3. Cambiar dni del pasajero\n".
        "4. Cambiar telefono del pasajero\n".
        "Seleccione una opcion ";
        return trim(fgets(STDIN));
    }

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

    function menuTextoCincoDos(){
        echo "-------------------------------------------------------------\n".
        "1. Cambiar nombre del responsable\n".
        "2. Cambiar apellido del responsable\n".
        "3. Cambiar numero de empleado del responsable\n".
        "4. Cambiar numero de liciencia del responsable\n".
        "Seleccione una opcion ";
        return trim(fgets(STDIN));
    }

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

    /**
     * PROGRAMA PRINCIPAL
     */

    $viaje = ingresoViaje();
    echo "-------------------------------------------------------------\n".
    "Bienvenido La empresa de Transporte de Pasajeros Viaje Feliz";

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
                        case 1:
                            echo $viaje->textoListaPasajeros();
                        break;

                        //OPCION 4.2 Cargar un nuevo pasajero
                        case 2:
                            echo $viaje->agregarPasajero(ingresoPasajero())."\n";
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
                        case 1:
                            echo "Responsable: ".$viaje->getObjResponsable()."\n";
                        break;

                        //OPCION 5.2 Modificar datos del responsable
                        case 2:
                            $respuesta3 = menuTextoCincoDos();
                            switch ($respuesta3){                                
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
            case 6: 
                echo $viaje;
            break;

            //OPCION 9 Salir
            case 9: echo "Good bye";
            break;

            default: echo "Valor no valido\n";
        }
     } while ($respuesta != 9);