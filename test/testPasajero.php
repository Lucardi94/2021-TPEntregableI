<?php
    include_once "../ORM/BaseDatos.php";
    include_once "../ORM/empresa.php";
    include_once "../ORM/viaje.php";
    include_once "../ORM/responsable.php";
    include_once "../ORM/pasajero.php";

    $objViaje = new viaje();
    $objViaje->buscar(1,FALSE);
    $objViaje2 = new viaje();
    $objViaje2->buscar(2,FALSE);

    //CARGAR()
    $objPasajero=new pasajero();
	$pasajero=array ('rdocumento'=>101,'pnombre'=>'Lucas','papellido'=>'Brandao','ptelefono'=>999,'objviaje'=>$objViaje);
    $objPasajero->cargar($pasajero);

    // INSERTAR()
	if ($objPasajero->insertar()){
		echo "OP INSERCION EXITOSA\n";
	} else echo $objPasajero->getmensajeoperacion();

    // MODIFICAR()
	$objPasajero->setNombre("Nombre asdasdasdasd");
    $objPasajero->setApellido("Apellido asdasdasd");
    $objPasajero->setTelefono(0303456);
    $objPasajero->setObjViaje($objViaje2);
	if ($objPasajero->modificar()){
        echo "OP MODIFICACION EXITOSA\n";	
	}else echo $objPasajero->getmensajeoperacion();

    // ELIMINAR()
	if ($objPasajero->eliminar()){
		echo "OP ELIMINACION EXITOSA\n";
	} else echo $objPasajero->getmensajeoperacion();
    

    //LISTAR()
    $objPasajero=new pasajero();
	$colPasajero =$objPasajero->listar();
	foreach ($colPasajero as $unPasajero){	
		echo $unPasajero.
        "\n-------------------------------------------------------\n";
	}

    //BUSCAR()
    echo "Seleccione el id de la funcion deseada ";
    if ($objPasajero->Buscar(trim(fgets(STDIN)))){
        echo $objPasajero;
    } else echo $objPasajero->getMensajeOperacion();