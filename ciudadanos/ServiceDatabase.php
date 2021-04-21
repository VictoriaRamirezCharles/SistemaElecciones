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

        $stmt = $this->context->db->prepare("insert into ciudadanos (Documento_Identidad,Nombre,Apellido,Email,Estado) values(?,?,?,?,?)");
        $stmt->bind_param("ssssi", $item->Documento_Identidad, $item->Nombre,$item->Apellido,$item->Email,$item->Estado);
        $stmt->execute();
        $stmt->close();

    }

    public function Edit($item){      

        $stmt = $this->context->db->prepare("update ciudadanos set Documento_Identidad = ?,Nombre = ?,Apellido = ?,Email = ?, Estado = ? where Id = ?");
        $stmt->bind_param("ssssii", $item->Documento_Identidad, $item->Nombre,$item->Apellido,$item->Email,$item->Estado,$item->Id);
        $stmt->execute();
        $stmt->close();           
    }

    public function Delete($id){
        $stmt = $this->context->db->prepare("delete from ciudadanos where Id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();  
    }

    public function GetById($id){

        $ciudadano = null;

        $stmt = $this->context->db->prepare("select * from ciudadanos where Id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            return null;
        } else {

          $row = $result->fetch_object();
          $ciudadano = new Ciudadano($row->Id,$row->Documento_Identidad,$row->Nombre,$row->Apellido,$row->Email,$row->Estado);           
            
        }
        return $ciudadano;
    }

    public function GetList(){

        $listadoCiudadanos = array();

        $stmt = $this->context->db->prepare("select * from ciudadanos");
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            return array();
        } else {

            while ($row = $result->fetch_object()) {

                $ciudadano = new Ciudadano($row->Id,$row->Documento_Identidad,$row->Nombre,$row->Apellido,$row->Email,$row->Estado);  
                array_push($listadoCiudadanos, $ciudadano);
            }
        }

        return $listadoCiudadanos;
    }  

 
   
}