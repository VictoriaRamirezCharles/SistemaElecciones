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

        $stmt = $this->context->db->prepare("insert into elecciones (Nombre,Fecha,Estado) values(?,?,?)");
        $stmt->bind_param("ssi", $item->Nombre, $item->Fecha,$item->Estado);
        $stmt->execute();
        $stmt->close();

    }

    public function Edit($item){      

        $stmt = $this->context->db->prepare("update elecciones set Nombre = ?,Fecha = ?, Estado = ? where Id = ?");
        $stmt->bind_param("sdii", $item->Nombre, $item->Fecha,$Estado,$item->Id);
        $stmt->execute();
        $stmt->close();           
    }

    public function Delete($id){
        $stmt = $this->context->db->prepare("delete from elecciones where Id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();  
    }

    public function GetById($id){

        $eleccion = null;

        $stmt = $this->context->db->prepare("select * from elecciones where Id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            return null;
        } else {

          $row = $result->fetch_object();
          $eleccion = new Elecciones($row->Id,$row->Nombre,$row->Fecha,$row->Estado);           
            
        }
        return $eleccion;
    }

    public function GetList(){

        $listadoElecciones = array();

        $stmt = $this->context->db->prepare("select * from elecciones");
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            return array();
        } else {

            while ($row = $result->fetch_object()) {

                $eleccion = new Elecciones($row->Id,$row->Nombre,$row->Fecha,$row->Estado);  
                array_push($listadoElecciones, $eleccion);
            }
        }

        return $listadoElecciones;
    }  

   
}