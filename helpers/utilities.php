<?php

    class Utilities{

    // public $companies = [1=> "DC", 2=>"Marvel"];
 

    public function getLastElement($list){

        $countList = count($list);
        $lastElement = $list[$countList -1];

        return $lastElement;

    }

    public function searchProperty($list,$property,$value){

        $filters = [];

        foreach($list as $item){

            if($item->$property == $value){
                array_push($filters, $item);
            }
        }

        return $filters;
    }

    public function getIndexElement($list,$property,$value){

        foreach($list as $key => $item){

            if($item->$property == $value){             
                return $key;              
               
            }
        }
    }
    public function UploadImage($directory,$name,$tmpFile,$type,$size)
    {
        $isSuccess = false;

        if( 
               ($type == 'image/gif') 
            || ($type == 'image/jpeg') 
            || ($type == 'image/jpg') 
            || ($type == 'image/png') 
            || ($type == 'image/JPG') 
            || ($type == 'image/pjpeg') && ($size < 1000000) ){
            
            if(!file_exists($directory))
            {
                mkdir($directory,0777,true);

                if(file_exists($directory))
                {
                    $this->UploadFile($directory.$name,$tmpFile);
                    $isSuccess = true;
                } 
            } 
            else
            {
                $this->UploadFile($directory.$name,$tmpFile);
                $isSuccess = true;
            }

        } 
        else
        {
            $isSuccess = false;
        }
        return $isSuccess;
    }
    private function UploadFile($name, $tmpFile)
    {
         if(file_exists($name))
         {
             unlink($name);
         }
    move_uploaded_file($tmpFile,$name);
}
    
    public function FormatDateTime($date){
        $format = 'd/m/Y';
        $currentDateTime = new DateTime($date, new DateTimeZone('America/Santo_Domingo'));

        return $currentDateTime->format($format);
       
    }

}
