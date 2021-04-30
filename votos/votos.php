<?php

    class Voto{

        public $Id;
        public $IdCandidato;    
        public $IdElector;
        public $Fecha;
        public $Cantidad;
        public $CandidatoNombre;
        public $IdEleccion;
        public $Puesto;

        public function __construct($id,$idcandidato,$idelector, $cantidad, $candidatonombre,$ideleccion)
        {

            $this->Id = $id;
            $this->IdCandidato = $idcandidato;
            $this->IdElector = $idelector;
            $this->Cantidad = $cantidad;
            $this->CandidatoNombre = $candidatonombre;
            $this->IdEleccion = $ideleccion;
            // $this->Fecha = $fecha;            
        }        

    }

?>