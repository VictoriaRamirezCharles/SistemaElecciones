<?php

 class ServiceDatabasePartidos{   

    private $context;
    private $directory;

    public function __construct($isRoot = false){

        $prefijo = ($isRoot) ? "" : "../";
        $this->directory = "{$prefijo}database";   
        $this->utilities = new Utilities();
        $this->context = new EleccionesContext($this->directory);
  
    }

    public function Add($item)
    {

        $partidos = $this->GetList();
        $id = 1;
        if(!empty($partidos)){
            $lastElement  = $this->utilities->getLastElement($partidos);
            $id = $lastElement->Id + 1;
       
        }
       
        $item->Logo = '';

        if(isset($_FILES['Logo']))
        {
            $photoFile = $_FILES['Logo'];
         

            if($photoFile['error'] == 4)
            {
                $item->Logo = '';
            } 
            else
            {
                $typeReplace = str_replace("image/","",$photoFile['type']);
                $type = $photoFile['type'];
                $size = $photoFile['size'];
                $tmp = $photoFile['tmp_name'];
                $name = $id  . '.' . $typeReplace; 
                $isSuccess = $this->utilities->UploadImage('../assets/img/partidos/',$name,$tmp,$type,$size);

                if($isSuccess)
                {
                    $item->Logo = $name;
                }
            }

        }
        $stmt = $this->context->db->prepare("insert into partidos (Nombre,Descripcion,Logo,Estado) values(?,?,?,?)");
        $stmt->bind_param("sssi", $item->Nombre, $item->Descripcion,$item->Logo,$item->Estado);
        $stmt->execute();
        $stmt->close();

    }

    public function Edit($item){      

        $partidos = $this->GetList();

        $partido = $this->GetById($item->Id);

        $index = $this->utilities->getIndexElement($partidos,"Id",$item->Id);

        if(isset($_FILES['Logo']))
        {

           $photoFile = $_FILES['Logo'];

           if($photoFile['error'] == 4)
           {

               $item->Logo = $partido->Logo;
           } 
           else
           {
               $typeReplace = str_replace("image/","",$photoFile['type']);
               $type = $photoFile['type'];
               $size = $photoFile['size'];
               $tmp = $photoFile['tmp_name'];
               $name = $item->Id . '.' . $typeReplace; 
               $isSuccess = $this->utilities->UploadImage('../assets/img/partidos/',$name,$tmp,$type,$size);

               if($isSuccess)
               {
                   $item->Logo = $name;
               }
           }
           
       }

        $stmt = $this->context->db->prepare("update partidos set Nombre = ?,Descripcion = ?,Logo = ?, Estado = ? where Id = ?");
        $stmt->bind_param("sssii", $item->Nombre, $item->Descripcion,$item->Logo,$item->Estado,$item->Id);
        $stmt->execute();
        $stmt->close();           
    }

    public function Delete($id){
        $stmt = $this->context->db->prepare("delete from partidos where Id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();  
    }

    public function GetById($id){

          $listadoPartidos = $this->GetList();
        
                  
          $partido = $this->utilities->searchProperty($listadoPartidos,"Id",$id);
        
        return $partido[0];
    }

    public function GetList(){

        $listadoPartidos = array();

        $stmt = $this->context->db->prepare("select * from partidos");
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            return array();
        } else {

            while ($row = $result->fetch_object()) {
                $element = new Partido();
                $element->Set($row);
                array_push($listadoPartidos, $element);
            }
        }

        return $listadoPartidos;
    }  


   
}