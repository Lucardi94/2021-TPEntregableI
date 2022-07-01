<?php
    include_once "../ORM/BaseDatos.php";
    include_once "../ORM/empresa.php";
    include_once "../ORM/viaje.php";
    include_once "../ORM/responsable.php";
    include_once "../ORM/pasajero.php";
    include_once '../AMB/ambEmpresa.php';
    include_once '../AMB/ambResponsable.php';    
    include_once '../AMB/ambViaje.php';
    include_once '../AMB/ambPasajero.php';
    /***
     * MENU CREAR'S
     * Retornan los datos de los objetos en forma de arreglo indexado
     * Para utilizar en la funcion cargar($datos)
     */
     function ingresarDatosEmpresa() {
        echo "-------------------------------------------------------".
        "\nCrear nueva empresa de viajes".
        "\nIngrese nombre de la empresa ";
        $nom = trim(fgets(STDIN));
        echo "Ingrese direccion de la empresa ";
        $dir = trim(fgets(STDIN));
        return array ('idempresa'=>null,'enombre'=>$nom,'edireccion'=>$dir,'listaviaje'=>array());
     }

     function ingresarDatosResponsable() {
        echo "-------------------------------------------------------".
        "\nCrear nueva responsable de viajes".
        "\nIngrese nombre del responsable ";
        $nom = trim(fgets(STDIN));
        echo "Ingrese apellido del responsable ";
        $ape = trim(fgets(STDIN));
        echo "Ingrese numero de licencia del responsable ";
        $nroLic = trim(fgets(STDIN));
        return array ('rnumeroempleado'=>null,'rnombre'=>$nom,'rapellido'=>$ape,'rnumerolicencia'=>$nroLic);
     }

     function ingresarDatosPasajero($objViaje) {
        echo "-------------------------------------------------------".
        "\nCrear nuevo pasajero".
        "\nIngrese numero de dni del pasajero ";
        $dni = trim(fgets(STDIN));
        echo "Ingrese nombre del pasajero ";
        $nom = trim(fgets(STDIN));
        echo "Ingrese apellido del pasajero ";
        $ape = trim(fgets(STDIN));
        echo "Ingrese numero de telefono ";
        $tel = trim(fgets(STDIN));
        return array ('rdocumento'=>$dni,'pnombre'=>$nom,'papellido'=>$ape,'ptelefono'=>$tel,'objviaje'=>$objViaje);
     }

     function ingresarDatosViaje($objEmpresa) {
        $ambResponsable = new abmResponsable();
        echo "-------------------------------------------------------".
        "\nCrear nuevo viaje".
        "\nIngrese destino del viaje ";
        $des = trim(fgets(STDIN));
        echo"Ingrese cantidad maxima de pasajeros del viaje ";
        $canPas = trim(fgets(STDIN));
        echo "Ingrese importe del viaje ";
        $imp = trim(fgets(STDIN));
        $numeroEmpleado = seleccionResponsable();
        $objResponsable = $ambResponsable->buscarResponsable($numeroEmpleado);
        echo "Ingrese tipo de asiento: 1.Semicama 2.Normal ";
        $tipAsi = trim(fgets(STDIN));
        echo "Ingrese si es ida y vuelta: 1.Si 2.No ";
        $idaVue = trim(fgets(STDIN));
        return array ('idviaje'=>null, 'vdestino'=>$des,'vcantmaxpasajeros'=>$canPas,'listapasajero'=>array (),'objempresa'=>$objEmpresa, 'objresponsable'=>$objResponsable, 'vimporte'=>$imp, 'tipoAsiento'=>$tipAsi, 'idayvuelta'=>$tipAsi);
     }


    /***
     * MENUS SELECCION
     */
     function seleccionEmpresa(){
        $ambEmpresa = new abmEmpresa();
        echo "-------------------------------------------------------".
        "\nSelecciones la opcion".
        "\n1. Listar empresas de viajes".
        "\n2. Ingresar numero de empresa\n";
        $resp = trim(fgets(STDIN));
                switch($resp){
                    case 1:
                        echo $ambEmpresa->listarEmpresa();
                        echo "Ingrese numero de empresa ";
                        $numEmp = trim(fgets(STDIN));
                        break;
                    case 2:
                        echo "Ingrese numero de empresa ";                        
                        $numEmp = trim(fgets(STDIN));
                        break;
                    default:
                        echo "¡Opcion no valida!\n";                        
                        $numEmp = null;
                }
        return $numEmp;
     }

     function seleccionPasajero($codigoViaje){
        $ambPasajero = new abmPasajero();
        echo "-------------------------------------------------------".
        "\nSelecciones la opcion".
        "\n1. Listar pasajeros".
        "\n2. Ingresar dni del pasajero\n";
        $resp = trim(fgets(STDIN));
                switch($resp){
                    case 1:
                        echo $ambPasajero->listarPasajero($codigoViaje);
                        echo "Ingrese dni del pasajero ";
                        $dni = trim(fgets(STDIN));
                        break;
                    case 2:
                        echo "Ingrese dni del pasajero ";                        
                        $dni = trim(fgets(STDIN));
                        break;
                    default:
                        echo "¡Opcion no valida!\n";                        
                        $dni = null;
                }
        return $dni;
     }

     function seleccionViaje($numeroEmpresa){
        $ambViaje = new abmViaje();
        echo "-------------------------------------------------------".
        "\nSelecciones la opcion".
        "\n1. Listar viajes".
        "\n2. Ingresar codigo del viaje\n";
        $resp = trim(fgets(STDIN));
                switch($resp){
                    case 1:
                        echo $ambViaje->listarViaje($numeroEmpresa);
                        echo "Ingrese codigo del viaje ";
                        $codigoViaje = trim(fgets(STDIN));
                        break;
                    case 2:
                        echo "Ingrese codigo del viaje ";                        
                        $codigoViaje = trim(fgets(STDIN));
                        break;
                    default:
                        echo "¡Opcion no valida!\n";                        
                        $codigoViaje = null;
                }
        return $codigoViaje;
     }

     function seleccionResponsable(){
        $ambResponsable = new abmResponsable();
        echo "-------------------------------------------------------".
        "\nSelecciones la opcion".
        "\n1. Listar responsables de viajes".
        "\n2. Ingresar numero de empleado\n";
        $resp = trim(fgets(STDIN));
                switch($resp){
                    case 1:
                        echo $ambResponsable->listarResponsable();
                        echo "Ingrese numero de empleado ";
                        $numEmp = trim(fgets(STDIN));
                        break;
                    case 2:
                        echo "Ingrese numero de empleado ";                        
                        $numEmp = trim(fgets(STDIN));
                        break;
                    default:
                        echo "¡Opcion no valida!\n";                        
                        $numEmp = null;
                }
        return $numEmp;
     }
     
    /***
     * MENUS
     */
     function menu0() {
        echo "-------------------------------------------------------".
        "\nSelecciones la opcion".
        "\n1. Crear nueva empresa de viajes".
        "\n2. Borrar empresa de viajes".
        "\n3. Administrar empresa de viajes".
        "\n4. Listar empresas de viajes".
        "\n5. Crear nueva responsable de viajes".
        "\n6. Borrar responsable de viajes".
        "\n7. Modificar responsable de viajes".
        "\n8. Listar responsable de viajes".
        "\ne. Para salir ";
        return trim(fgets(STDIN));
     }

     function menu03() {
        echo "-------------------------------------------------------".
        "\nSelecciones la opcion".
        "\n1. Cambiar nombre de empresa".
        "\n2. Cambiar direccion de empresa".
        "\n3. Administrar viajes de la empresa".
        "\n4. Imprimir datos de la empresa".
        "\ne. Para volver menu principal ";
        return trim(fgets(STDIN));
     }

     function menu07() {
        echo "-------------------------------------------------------".
        "\nSelecciones la opcion".
        "\n1. Cambiar nombre responsable".
        "\n2. Cambiar apellido responasble".
        "\n3. Cambiar numero de licencia".
        "\n4. Imprimir datos del responsable".
        "\ne. Para volver menu principal ";
        return trim(fgets(STDIN));
     }

     function menu033() {
        echo "-------------------------------------------------------".
        "\nSelecciones la opcion".
        "\n1. Crear nuevo viaje".
        "\n2. Borrar viaje".
        "\n3. Administrar viaje".
        "\n4. Imprimir viajes de la empresa".
        "\ne. Para volver menu principal ";
        return trim(fgets(STDIN));
     }

     function menu0333() {
        echo "-------------------------------------------------------".
        "\nSelecciones la opcion".
        "\n1. Cambiar destino del viaje".
        "\n2. Cambiar cantidad maxima de pasajeros del viaje".
        "\n3. Cambiar importe del viaje".
        "\n4. Cambiar ida y vuelta".
        "\n5. Cambiar tipo de asiento".
        "\n6. Administrar pasajeros del viaje".
        "\n7. Cambiar responsable del viaje".
        "\n8. Imprimir datos del viaje".
        "\ne. Para volver menu principal ";
        return trim(fgets(STDIN));
     }

     function menu03336() {
        echo "-------------------------------------------------------".
        "\nSelecciones la opcion".
        "\n1. Ingresar pasajero".
        "\n2. Borrar pasajero".
        "\n3. Modificar pasajero".
        "\n4. Listar pasajero".
        "\ne. Para volver menu principal ";
        return trim(fgets(STDIN));
     }
     function menu033363() {
        echo "-------------------------------------------------------".
        "\nSelecciones la opcion".
        "\n1. Cambiar nombre del pasajero".
        "\n2. Cambiar apellido del pasajero".
        "\n3. Cambiar telefono del pasajero".
        "\n4. Imprimir datos del pasajero".
        "\ne. Para volver menu principal ";
        return trim(fgets(STDIN));
     }

    /***
     * MENUS MODIFICAR DATOS
     */
     function modificarNombreEmpresa(){
        echo "Ingrese nuevo nombre de la empresa ";
        return trim(fgets(STDIN));
     }

     function modificarDireccionEmpresa(){
        echo "Ingrese nueva direccion de la empresa ";
        return trim(fgets(STDIN));
     }

     function modificarNombreResponsable(){
        echo "Ingrese nuevo nombre del responsable ";
        return trim(fgets(STDIN));
     }

     function modificarApellidoResponsable(){
        echo "Ingrese nuevo apellido del responsable ";
        return trim(fgets(STDIN));
     }

     function modificarNumeroLicenciaResponsable(){
        echo "Ingrese nuevo numero de licencia del responsable ";
        return trim(fgets(STDIN));
     }

     function modificarDestinoViaje(){
        echo "Ingrese nuevo destino del viaje ";
        return trim(fgets(STDIN));
     }

     function modificarCantidadPasajerosViaje(){
        echo "Ingrese nueva cantidad maxima de pasajeros del viaje ";
        return trim(fgets(STDIN));
     }

     function modificarImporteViaje(){
        echo "Ingrese nuevo importe del viaje ";
        return trim(fgets(STDIN));
     }

     function modificarNombrePasajero(){
        echo "Ingrese nuevo nombre del pasajero ";
        return trim(fgets(STDIN));
     }
     function modificarApellidoPasajero(){
        echo "Ingrese nuevo apellido del pasajero ";
        return trim(fgets(STDIN));
     }
     function modificarTelefonoPasajero(){
        echo "Ingrese nuevo telefono del pasajero ";
        return trim(fgets(STDIN));
     }


    /***
     * PRINCIPAL
     */

     $ambEmpresa = new abmEmpresa();
     $ambResponsable = new abmResponsable();
     $ambViaje = new abmViaje();
     $ambPasajero = new abmPasajero();

     echo "Bienvenido a la app Estacion Gran Central\n";
     do {
        $resp0 = menu0();
        switch ($resp0){
            case 1:
                // 1. Crear nueva empresa de viajes
                $empresaNew = ingresarDatosEmpresa();
                echo $ambEmpresa->insertarEmpresa($empresaNew);
                break;
            case 2:
                // 2. Borrar empresa de viajes
                $numeroEmpresa = seleccionEmpresa();
                if (!is_null($numeroEmpresa)){
                    $objEmpresa = $ambEmpresa->buscarEmpresa($numeroEmpresa);
                    echo $ambEmpresa->eliminarEmpresa($objEmpresa);
                }
                break;
            case 3:
                // 3. Administrar empresa de viajes
                $numeroEmpresa = seleccionEmpresa();
                if (!is_null($numeroEmpresa)){
                    $objEmpresa = $ambEmpresa->buscarEmpresa($numeroEmpresa);
                    echo $objEmpresa."\n";
                    if (!is_string($objEmpresa)){
                        do {
                            $resp1 = menu03();
                            switch ($resp1){
                                case 1:
                                    // 1. Cambiar nombre de la empresa
                                    $nuevoNombre = modificarNombreEmpresa();
                                    echo $ambEmpresa->modificarNombre($objEmpresa,$nuevoNombre);
                                    $objEmpresa = $ambEmpresa->buscarEmpresa($numeroEmpresa);
                                    break;
                                case 2:
                                    // 2. Cambiar direccion de la empresa
                                    $nuevaDireccion = modificarDireccionEmpresa();
                                    echo $ambEmpresa->modificarDireccion($objEmpresa,$nuevaDireccion);
                                    $objEmpresa = $ambEmpresa->buscarEmpresa($numeroEmpresa);
                                    break;
                                case 3:
                                    // 3. Administrar viajes
                                    do {
                                        $resp2 = menu033();
                                        switch ($resp2){
                                            case 1:
                                                // 1. Crear nuevo viaje
                                                $viajeNew = ingresarDatosViaje($objEmpresa);
                                                echo $ambViaje->insertarViaje($viajeNew);
                                                break;
                                            case 2:
                                                // 2. Borrar viaje
                                                $codigoViaje = seleccionViaje($objEmpresa->getNroEmpresa());
                                                if (!is_null($codigoViaje)){
                                                    $objViaje = $ambViaje->buscarViaje($codigoViaje);
                                                    echo $ambViaje->eliminarViaje($objViaje);
                                                }
                                                break;
                                            case 3:
                                                // 3. Administrar viaje
                                                $codigoViaje = seleccionViaje($objEmpresa->getNroEmpresa());
                                                if (!is_null($codigoViaje)){
                                                    $objViaje = $ambViaje->buscarViaje($codigoViaje);
                                                    echo $objViaje."\n";
                                                    if (!is_string($objViaje)){
                                                        do{
                                                            $resp3 = menu0333();
                                                            switch ($resp3){
                                                                case 1:
                                                                    // 1. Cambiar destino del viaje
                                                                    $nuevoDestino = modificarDestinoViaje();
                                                                    echo $ambViaje->modificarDestino($objViaje,$nuevoDestino);
                                                                    $objViaje = $ambViaje->buscarViaje($codigoViaje);
                                                                    break;
                                                                case 2:
                                                                    // 2. Cambiar cantidad maxima de pasajeros del viaje
                                                                    $nuevoCantidad = modificarCantidadPasajerosViaje();
                                                                    echo $ambViaje->modificarCantidadPasajeros($objViaje,$nuevoCantidad);
                                                                    $objViaje = $ambViaje->buscarViaje($codigoViaje);
                                                                    break;
                                                                case 3:
                                                                    // 3. Cambiar importe del viaje
                                                                    $nuevoImporte = modificarImporteViaje();
                                                                    echo $ambViaje->modificarImporte($objViaje,$nuevoImporte);
                                                                    $objViaje = $ambViaje->buscarViaje($codigoViaje);
                                                                    break;
                                                                case 4:
                                                                    // 4. Cambiar ida y vuelta
                                                                    echo $ambViaje->modificarIdaVuelta($objViaje);
                                                                    $objViaje = $ambViaje->buscarViaje($codigoViaje);
                                                                    break;
                                                                case 5:
                                                                    // 5. Cambiar tipo de asiento
                                                                    echo $ambViaje->modificarTipoAsiento($objViaje);
                                                                    $objViaje = $ambViaje->buscarViaje($codigoViaje);
                                                                    break;
                                                                case 6:
                                                                    // 6. Administrar pasajeros del viaje
                                                                    do {
                                                                        $resp4 = menu03336();
                                                                        switch ($resp4){
                                                                            case 1:
                                                                                // 1. Ingresar pasajero
                                                                                $pasajeroNew = ingresarDatosPasajero($objViaje);
                                                                                echo $ambPasajero->insertarPasajero($pasajeroNew);
                                                                                break;
                                                                            case 2:
                                                                                // 2. Borrar pasajero
                                                                                $dni = seleccionPasajero($objViaje->getCodigo());
                                                                                if (!is_null($dni)){
                                                                                    $objPasajero = $ambPasajero->buscarPasajero($dni);
                                                                                    echo $ambPasajero->eliminarPasajero($objPasajero);
                                                                                }
                                                                            case 3:
                                                                                // 3. Modificar pasajero
                                                                                $dni = seleccionPasajero($objViaje->getCodigo());
                                                                                if (!is_null($dni)){
                                                                                    $objPasajero = $ambPasajero->buscarPasajero($dni);
                                                                                    echo $objPasajero."\n";
                                                                                    if (!is_string($objViaje)){
                                                                                        do{
                                                                                            $resp4 = menu033363();
                                                                                            switch($resp4){
                                                                                                case 1:
                                                                                                    //1. Cambiar nombre del pasajero
                                                                                                    $nuevoNombre = modificarNombrePasajero();
                                                                                                    echo $ambPasajero->modificarNombre($objPasajero,$nuevoNombre);
                                                                                                    $objPasajero = $ambPasajero->buscarPasajero($dni);
                                                                                                    break;
                                                                                                case 2:
                                                                                                    // 2. Cambiar apellido del pasajero
                                                                                                    $nuevoApellido = modificarApellidoPasajero();
                                                                                                    echo $ambPasajero->modificarApellido($objPasajero,$nuevoApellido);
                                                                                                    $objPasajero = $ambPasajero->buscarPasajero($dni);
                                                                                                    break;
                                                                                                case 3:
                                                                                                    // 3. Cambiar telefono del pasajero
                                                                                                    $nuevoTelefono = modificarTelefonoPasajero();
                                                                                                    echo $ambPasajero->modificarTelefono($objPasajero,$nuevoTelefono);
                                                                                                    $objPasajero = $ambPasajero->buscarPasajero($dni);
                                                                                                    break;
                                                                                                case 4:
                                                                                                    //4. Imprimir datos del pasajero
                                                                                                    echo $objPasajero."\n";
                                                                                                    break;
                                                                                                case "e":
                                                                                                    break;
                                                                                                default:
                                                                                            }
                                                                                        } while ($resp4 != "e");
                                                                                    }

                                                                                }
                                                                                break;
                                                                            case 4:
                                                                                // 4. Listar pasajero"
                                                                                echo $ambPasajero->listarPasajero($objViaje->getCodigo());
                                                                                break;
                                                                            default:
                                                                        }
                                                                        $objViaje = $ambViaje->buscarViaje($codigoViaje);
                                                                    } while ($resp4 != "e");
                                                                    break;
                                                                case 7:
                                                                    // 7. Cambiar responsable del viaje
                                                                    $numeroEmpleado = seleccionResponsable();
                                                                    if (!is_null($numeroEmpleado)){
                                                                        $objResponsable = $ambResponsable->buscarResponsable($numeroEmpleado);
                                                                        echo $ambViaje->modificarResponsableViaje($objViaje, $objResponsable);
                                                                        $objViaje = $ambViaje->buscarViaje($codigoViaje);
                                                                    }
                                                                    break;
                                                                case 8:
                                                                    // 8. Imprimir datos del viaje
                                                                    echo $objViaje."\n";
                                                                    break;
                                                                case "e":
                                                                    break;
                                                                default:
                                                                    
                                                            }

                                                        } while ($resp3 != "e");
                                                        $objEmpresa = $ambEmpresa->buscarEmpresa($numeroEmpresa);
                                                    }
                                                }
                                                break;
                                            case 4:
                                                // 4. Imprimir viajes de la empresa
                                                echo $ambViaje->listarViaje($objEmpresa->getNroEmpresa());
                                                break;
                                            case "e":
                                                break;
                                            default:

                                        }
                                        $objEmpresa = $ambEmpresa->buscarEmpresa($numeroEmpresa); 
                                    } while($resp2 != "e");                
                                    break;
                                case 4:
                                    // 4. Imprimir datos de la empresa
                                    echo $objEmpresa."\n";
                                    break;
                                case "e":
                                    break;
                                default:
                                    echo "¡Opcion no valida!\n";                                    
                            }
                        } while($resp1 != "e"); 
                    } 
                }
                break;
            case 4:
                //4. Listar empresas de viajes
                echo $ambEmpresa->listarEmpresa();
                break;
            case 5:
                //5. Crear responsable de viajes
                $responsableNew = ingresarDatosResponsable();
                echo $ambResponsable->insertarResponsable($responsableNew);
                break;
            case 6:
                //6. Borrar responsable de viajes
                $numeroEmpleado = seleccionResponsable();
                if (!is_null($numeroEmpleado)){
                    $objResponsable = $ambResponsable->buscarResponsable($numeroEmpleado);
                    echo $ambResponsable->eliminarResponsable($objResponsable);
                }
                break;
            case 7:
                //7. Modificar responsable de viajes
                $numeroEmpleado = seleccionResponsable();
                if (!is_null($numeroEmpleado)){
                    $objResponsable = $ambResponsable->buscarResponsable($numeroEmpleado);
                    echo $objResponsable."\n";
                    if (!is_string($objResponsable)){
                        do {
                            $resp1 = menu07();
                            switch ($resp1){
                                case 1:
                                    // 1. Cambiar nombre responsable
                                    $nuevoNombre = modificarNombreResponsable();
                                    echo $ambResponsable->modificarNombre($objResponsable,$nuevoNombre);
                                    $objResponsable = $ambResponsable->buscarResponsable($numeroEmpleado);
                                    break;
                                case 2:
                                    // 2. Cambiar apellido responsable
                                    $nuevoApellido = modificarApellidoResponsable();
                                    echo $ambResponsable->modificarApellido($objResponsable,$nuevoApellido);
                                    $objResponsable = $ambResponsable->buscarResponsable($numeroEmpleado);
                                    break;
                                case 3:
                                    // 3. Cambiar numero de licencia
                                    $nuevoNumero = modificarNumeroLicenciaResponsable();
                                    echo $ambResponsable->modificarNumeroLicencia($objResponsable,$nuevoNumero);
                                    $objResponsable = $ambResponsable->buscarResponsable($numeroEmpleado);  
                                    break;
                                case 4:
                                    // 4. Imprimir datos del responsable
                                    echo $objResponsable."\n";
                                    break;
                                case "e":
                                    break;
                                default:
                                    echo "¡Opcion no valida!\n";                                    
                            }
                        } while($resp1 != "e"); 
                    } 
                }
                break;
            case 8:
                //8. Listar responsable de viajes
                echo $ambResponsable->listarResponsable();
                break;
            case "e":
                break;    
            default:
                echo "¡Opcion no valida!\n";
        }
     }  while($resp0 != "e");
