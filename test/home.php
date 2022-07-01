<?php
    include_once "../ORM/BaseDatos.php";
    include_once "../ORM/empresa.php";
    include_once "../ORM/viaje.php";
    include_once "../ORM/responsable.php";
    include_once "../ORM/pasajero.php";
    include_once '../AMB/ambEmpresa.php';
    include_once '../AMB/ambResponsable.php';
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


    /***
     * PRINCIPAL
     */

     $ambEmpresa = new abmEmpresa();
     $ambResponsable = new abmResponsable();

     echo "Bienvenido a la Terminal Locion Tamal\n";
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
                                    $objEmpresa = $ambEmpresa->buscarEmpresa($numeroEmpresa);  
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
