<?php
    include_once "../ORM/BaseDatos.php";
    include_once "../ORM/responsable.php";

    //CARGAR()
    $objResponsable=new responsable();
	$responsable=array ('rnumeroempleado'=>null,'rnombre'=>'Roco','rapellido'=>'Moderno','rnumerolicencia'=>999);
    $objResponsable->cargar($responsable);
    
    // INSERTAR()
	if ($objResponsable->insertar()){
		echo "OP INSERCION EXITOSA\n";
	} else echo $objResponsable->getmensajeoperacion();

    // MODIFICAR()
	$objResponsable->setNombre("Nombre asdasdasdasd");
    $objResponsable->setApellido("Apellido asdasdasd");
    $objResponsable->setNroLicencia(66);
	if ($objResponsable->modificar()){
        echo "OP MODIFICACION EXITOSA\n";	
	}else echo $objResponsable->getmensajeoperacion();

    // ELIMINAR()
	if ($objResponsable->eliminar()){
		echo "OP ELIMINACION EXITOSA\n";
	} else echo $objResponsable->getmensajeoperacion();


    //LISTAR()
	$colResponsable =$objResponsable->listar();
	foreach ($colResponsable as $unResponsable){	
		echo $unResponsable.
        "\n-------------------------------------------------------\n";
	}

    //BUSCAR()
    echo "Seleccione el id de la funcion deseada ";
    if ($objResponsable->Buscar(trim(fgets(STDIN)))){
        echo $objResponsable;
    } else echo $objResponsable->getMensajeOperacion();
