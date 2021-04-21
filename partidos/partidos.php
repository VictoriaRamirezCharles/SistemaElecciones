<?php

    class Partido{

        public $Id;
        public $Nombre;
        public $Descripcion;
        public $Logo;
        public $Estado;

        public function initializeData($id,$nombre,$descripcion,$estado)
        {

            $this->Id = $id;
            $this->Nombre = $nombre;
            $this->Descripcion = $descripcion;
            $this->Estado = $estado;                      
        }

        public function Set($element){
            foreach($element as $key => $value){
                $this->{$key} = $value;
            }
        }

    }

?>