<?php

    class Ciudadano{

        public $Id;
        public $Documento_Identidad;
        public $Nombre;
        public $Apellido;
        public $Email;
        public $Estado;

        public function __construct($id,$documento_identidad,$nombre,$apellido,$email,$estado)
        {

            $this->Id = $id;
            $this->Documento_Identidad = $documento_identidad;
            $this->Nombre = $nombre;
            $this->Apellido = $apellido;
            $this->Email = $email;
            $this->Estado = $estado;            
          
        }

        

    }

?>