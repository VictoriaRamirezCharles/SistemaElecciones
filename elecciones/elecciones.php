<?php

    class Elecciones{

        public $Id;
        public $Nombre;
        public $Fecha;
        public $Estado;
  

        public function __construct($id,$nombre,$fecha,$estado)
        {

            $this->Id = $id;
            $this->Nombre = $nombre;
            $this->Fecha = $fecha;     
            $this->Estado = $estado;            
                   
        }

        

    }

?>