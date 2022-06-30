<?php
    include_once "../ORM/BaseDatos.php";
    include_once "../ORM/empresa.php";
    include_once "../ORM/viaje.php";
    include_once "../ORM/responsable.php";
    include_once "../ORM/pasajero.php";
    include_once '../AMB/ambEmpresa.php';
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

     
    /***
     * MENUS
     */
     function menu0() {
        echo "-------------------------------------------------------".
        "\nSelecciones la opcion".
        "\n1. Crear nueva empresa de viajes".
        "\n2. Borrar empresa de viajes".
        "\n3. Modificar empresa de viajes".
        "\n4. Listar empresas de viajes".
        "\ne. Para salir ";
        return trim(fgets(STDIN));
     }


    /***
     * PRINCIPAL
     */

     $ambEmpresa = new abmEmpresa();

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
                // 3. Modificar empresa de viajes
                break;
            case 4:
                //4. Listar empresas de viajes
                break;
            default:
                echo "¡Chau que ande bien!\n";
        }
     }  while($resp0 != "e");
