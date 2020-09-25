<?php
	class Venda
	{
        private  $id;
        private  $cpf;
        private  $datavenda;
        private  $cliente;
        private  $total;
        
        function __construct() {
            $this->setId(0);
            $this->setCpf("");
            $this->setDataVenda("");
            $this->setCliente("");
            $this->setTotal(0);
        }

		function __toString() 
		{
			return $this->getCliente();
		}

        function getId(){
            return $this->id;
        }
        function setId($id){
            $this->id = intval($id);
        }

        function getCliente(){
            return $this->cliente;
        }
        function setCliente($cliente){
            $this->cliente = $cliente;
        }        

        function getCpf(){
            return $this->cpf;
        }
        function setCpf($cpf){
            $this->cpf = $cpf;
        }   

        function getDataVenda(){
            return $this->datavenda;
        }
        function setDataVenda($datavenda){
            $this->datavenda = $datavenda;
        }  

        function getTotal(){
            return $this->total;
        }
        function setTotal($total){
            $this->total = doubleval($total);
        }
     		
	}
?>
