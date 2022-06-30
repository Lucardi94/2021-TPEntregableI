<?php
    include_once "../ORM/BaseDatos.php";
    include_once "../ORM/empresa.php";
    include_once "../ORM/viaje.php";
    include_once "../ORM/responsable.php";
    include_once "../ORM/pasajero.php";

    $objResponsable = new responsable();
    $objResponsable->buscar(4);
    $objResponsable2 = new responsable();
    $objResponsable2->buscar(7);
    $objEmpresa = new empresa();
    $objEmpresa->buscar(1,false);
    $objEmpresa2 = new empresa();
    $objEmpresa2->buscar(4,false);

    //CARGAR()
    $objViaje=new viaje();
	$viaje=array ('idviaje'=>null,'vdestino'=>'centenario','vcantmaxpasajeros'=>5,'listapasajero'=>array (),'objempresa'=>$objEmpresa, 'objresponsable'=>$objResponsable, 'vimporte'=>10000, 'tipoAsiento'=>TRUE, 'idayvuelta'=>TRUE);
    $objViaje->cargar($viaje);

    // INSERTAR()
	if ($objViaje->insertar()){
		echo "OP INSERCION EXITOSA\n";
	} else echo $objViaje->getmensajeoperacion();
    
    // MODIFICAR()
    $objViaje->setDestino("Destino Ramdom");
    $objViaje->setCantidadMaxima(999);
    $objViaje->setListaPasajero(array ());
    $objViaje->setObjEmpresa($objEmpresa2);
    $objViaje->setObjResponsable($objResponsable2);
    $objViaje->setImporte(100000);
    $objViaje->setTipoAsiento(TRUE);    
    $objViaje->setIdaVuelta(TRUE);

	if ($objViaje->modificar()){
        echo "OP MODIFICACION EXITOSA\n";	
	}else echo $objViaje->getmensajeoperacion();
    
    // ELIMINAR()
	if ($objViaje->eliminar()){
		echo "OP ELIMINACION EXITOSA\n";
	} else echo $objViaje->getmensajeoperacion();
    
    
    //LISTAR()
    $objViaje=new viaje();
	$colViaje =$objViaje->listar();
	foreach ($colViaje as $unViaje){	
		echo $unViaje.
        "\n-------------------------------------------------------\n";
	}
    
    //BUSCAR()
    echo "Seleccione el id de la funcion deseada ";
    if ($objViaje->Buscar(trim(fgets(STDIN)), TRUE)){
        echo $objViaje;
    } else echo $objViaje->getMensajeOperacion();

