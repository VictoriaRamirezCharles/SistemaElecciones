<?php

    class Usuario{

        public $Id;
        public $Nombre;
        public $Apellido;
        public $Email;
        public $Nombre_Usuario;
        public $Password;
        public $Estado;
        public $Rol;

        public function __construct($id,$nombre,$apellido,$email,$nombre_usuario,$password,$estado,$rol)
        {

            $this->Id = $id;
            $this->Nombre = $nombre;
            $this->Apellido = $apellido;
            $this->Email = $email;
            $this->Nombre_Usuario = $nombre_usuario;            
            $this->Password = $password;            
            $this->Estado = $estado;            
            $this->Rol = $rol;            
        }

        

    }

?>