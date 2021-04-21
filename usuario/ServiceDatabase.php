<?php

 class ServiceDatabase{   

    private $context;
    private $directory;

    public function __construct($isRoot = false){

        $prefijo = ($isRoot) ? "" : "../";
        $this->directory = "{$prefijo}database";   
        $this->utilities = new Utilities();
        $this->context = new EleccionesContext($this->directory);
    }

    public function Add($item){

        $stmt = $this->context->db->prepare("insert into usuarios (Nombre,Apellido,Email,Nombre_Usuario,Password,Estado,Rol) values(?,?,?,?,?,?,?)");
        $stmt->bind_param("sssssii", $item->Nombre, $item->Apellido,$item->Email,$item->Nombre_Usuario,$item->Password,$item->Estado,$item->Rol);
        $stmt->execute();
        $stmt->close();

    }

    public function Edit($item){      

        $stmt = $this->context->db->prepare("update usuarios set Nombre = ?,Apellido = ?,Email = ?,Nombre_Usuario = ?,Password = ?, Estado = ?, Rol = ? where Id = ?");
        $stmt->bind_param("sssssiii", $item->Nombre, $item->Apellido,$item->Email,$item->Nombre_Usuario,$item->Password,$item->Estado,$item->Rol,$item->Id);
        $stmt->execute();
        $stmt->close();           
    }

    public function Delete($id){
        $stmt = $this->context->db->prepare("delete from usuarios where Id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();  
    }

    public function GetById($id){

        $usuario = null;

        $stmt = $this->context->db->prepare("select * from usuarios where Id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            return null;
        } else {

          $row = $result->fetch_object();
          $usuario = new Usuario($row->Id,$row->Nombre,$row->Apellido,$row->Email,$row->Nombre_Usuario,$row->Password,$row->Estado, $row->Rol);           
            
        }
        return $usuario;
    }

    public function GetList(){

        $listadoUsuarios = array();

        $stmt = $this->context->db->prepare("select * from usuarios");
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            return array();
        } else {

            while ($row = $result->fetch_object()) {

                $usuario = new Usuario($row->Id,$row->Nombre,$row->Apellido,$row->Email,$row->Nombre_Usuario,$row->Password,$row->Estado, $row->Rol);  
                array_push($listadoUsuarios, $usuario);
            }
        }

        return $listadoUsuarios;
    }  

    public function Login($username,$password){
      
        $usuario = null;

        $stmt = $this->context->db->prepare("select * from usuarios where Nombre_Usuario = ? and Password = ?");
        $stmt->bind_param("ss", $username,$password);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            return null;
        } else {

          $row = $result->fetch_object();
          $usuario = new Usuario($row->Id,$row->Nombre,$row->Apellido,$row->Email,$row->Nombre_Usuario,$row->Password,$row->Estado, $row->Rol);           
         
        }
      
        return $usuario;
    }
   
}