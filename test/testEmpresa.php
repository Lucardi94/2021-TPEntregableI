<?php
    include_once "../ORM/BaseDatos.php";
    include_once "../ORM/empresa.php";
    include_once "../ORM/viaje.php";
    include_once "../ORM/responsable.php";
    include_once "../ORM/pasajero.php";

    //CARGAR()
    $objEmpresa=new empresa();
	$empresa=array ('idempresa'=>null,'enombre'=>'Italbus','edireccion'=>'Chocon 111','listaviaje'=>array());
    $objEmpresa->cargar($empresa);
    
    // INSERTAR()
	if ($objEmpresa->insertar()){
		echo "OP INSERCION EXITOSA\n";
	} else echo $objEmpresa->getmensajeoperacion();
    
    // MODIFICAR()
	$objEmpresa->setNombre("Nombre Modificado");
    $objEmpresa->setDireccion("Direccion Modificada");
	if ($objEmpresa->modificar()){
        echo "OP MODIFICACION EXITOSA\n";	
	}else echo $objEmpresa->getmensajeoperacion();
    
    // ELIMINAR()
	if ($objEmpresa->eliminar()){
		echo "OP ELIMINACION EXITOSA\n";
	} else echo $objEmpresa->getmensajeoperacion();
    
    
    //LISTAR()
	$colEmpresa =$objEmpresa->listar();
	foreach ($colEmpresa as $unaEmpresa){	
		echo $unaEmpresa.
        "\n-------------------------------------------------------\n";
	}

    //BUSCAR()
    echo "Seleccione el id de la funcion deseada ";
    if ($objEmpresa->buscar(trim(fgets(STDIN)), TRUE)){
        echo $objEmpresa;
    } else echo $objEmpresa->getMensajeOperacion();