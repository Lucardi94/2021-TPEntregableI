<?php
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
    class pasajero{

        // ATRIBUTOS
        private $nombre;
        private $apellido;
        private $nroDocumento;
        private $telefono;

        // METODO CONSTRUCTOR
        public function __construct($nom, $ape, $dni, $tel){
            $this->nombre = $nom;
            $this->apellido = $ape;
            $this->nroDocumento = $dni;
            $this->telefono = $tel;
        }

        // METODOS DE ACCESO
        public function getNombre(){
            return $this->nombre;
        }
        public function getApellido(){
            return $this->apellido;
        }
        public function getNroDocumento(){
            return $this->nroDocumento;
        }
        public function getTelefono(){
            return $this->telefono;
        }

        public function setNombre($nNom){
            $this->nombre = $nNom;
        }
        public function setApellido($nApe){
            $this->apellido = $nApe;
        }
        public function setNroDocumento($nDni){
            $this->nroDocumento = $nDni;
        }
        public function setTelefono($nTel){
            $this->telefono = $nTel;
        }

        // METODO toString()
        public function __toString(){
            return $this->getNombre()." ".$this->getApellido()." - DNI:".$this->getNroDocumento()." - TEL. ".$this->getTelefono();
        }
    }