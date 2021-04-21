<?php

    class Candidato{

        public $Id;
        public $Nombre;
        public $Apellido;
        public $PartidoId;
        public $PuestoId;
        public $FotoPerfil;
        public $Estado;
        public $PuestoNombre;
        public $PartidoNombre;


        public function initializeData($id,$nombre,$apellido,$partidoId,$puestoId,$estado)
        {

            $this->Id = $id;
            $this->Nombre = $nombre;
            $this->Apellido = $apellido;
            $this->PartidoId = $partidoId;
            $this->PuestoId = $puestoId;                    
            $this->Estado = $estado;                      
        }

        public function Set($element){
            foreach($element as $key => $value){
                $this->{$key} = $value;
            }
        }

    }

?>