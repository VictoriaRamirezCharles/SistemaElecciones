<?php

    class Puesto_Electivo{

        public $Id;
        public $Nombre;
        public $Descripcion;
        public $Estado;
 

        public function __construct($id,$nombre,$descripcion,$estado)
        {

            $this->Id = $id;
            $this->Nombre = $nombre;
            $this->Descripcion = $descripcion;
            $this->Estado = $estado;            
             
        }

        

    }

?>