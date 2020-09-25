<?php	
	require_once 'CrudDAO.php';
	require_once 'Venda.php';

	class VendaDAO extends CrudDAO
	{

		public function salvar($venda){	
			$situacao = FALSE;
			try{
				
				if($venda->getId()==0){

					$situacao = $this->incluir($venda);

				}else{	
					$situacao = $this->atualizar($venda);
				}

			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}			

			return $situacao;
		}

		public function incluir($venda){	
			$situacao = FALSE;
			try{
				
				$pdo = parent::conectar();	

				$sql = "INSERT INTO tbvenda(cpf, datavenda, cliente, total) VALUES (:cpf, :datavenda, :cliente, :total)";

				$run = $pdo->prepare($sql);
				$run->bindValue(':cpf', $venda->getCpf(), PDO::PARAM_STR); 
				$run->bindValue(':datavenda', $venda->getDataVenda(), PDO::PARAM_STR); 
				$run->bindValue(':cliente', $venda->getCliente(), PDO::PARAM_STR); 
				$run->bindValue(':total', $venda->getTotal(), PDO::PARAM_INT); 
	  			$run->execute(); 

				if($run->rowCount() > 0){
					$situacao = TRUE;
				}

				$venda->setId($pdo->lastInsertId());
				
			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				parent::desconectar();
			}		

			return $situacao;
		}

		public function atualizar($venda){	
			$situacao = FALSE;
			try{
				
				$pdo = parent::conectar();
					
				$sql = "UPDATE tbvenda SET cpf = :cpf, datavenda = :datavenda, cliente = :cliente, total = :total WHERE id = :id";

				$run = $pdo->prepare($sql);
				$run->bindValue(':id', $venda->getId(), PDO::PARAM_INT); 
				$run->bindValue(':cpf', $venda->getCpf(), PDO::PARAM_STR); 
				$run->bindValue(':datavenda', $venda->getDataVenda(), PDO::PARAM_STR); 
				$run->bindValue(':cliente', $venda->getCliente(), PDO::PARAM_STR); 
				$run->bindValue(':total', $venda->getTotal(), PDO::PARAM_INT); 
	  			$run->execute(); 
				
				if($run->rowCount() > 0){
					$situacao = TRUE;
				}
				
			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				parent::desconectar();
			}			

			return $situacao;
		}						

		public function excluir($venda){

			$situacao = FALSE;
			try{
				
				$pdo = parent::conectar();	
					
				$sql = "DELETE FROM tbvenda WHERE id = :id";

				$run = $pdo->prepare($sql);
	  			$run->bindValue(':id', $venda->getId(), PDO::PARAM_INT);			
				$run->execute(); 

				if($run->rowCount() > 0){
					$situacao = TRUE;
				}
				
			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				parent::desconectar();
			}			

			return $situacao;

		}

		public function excluirPorId($id){

			$situacao = FALSE;
			try{
				
				$pdo = parent::conectar();	
					
				$sql = "DELETE FROM tbvenda WHERE id = :id";

				$run = $pdo->prepare($sql);
	  			$run->bindValue(':id', $id, PDO::PARAM_INT);			
				$run->execute(); 

				if($run->rowCount() > 0){
					$situacao = TRUE;
				}
				
			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				parent::desconectar();
			}			

			return $situacao;

		}					

		public function listar(){

			$objetos = array();	

			try{
				
				$pdo = parent::conectar();
					
				$sql = "SELECT * FROM tbvenda";

				$run = $pdo->prepare($sql);			
				$run->execute(); 
				$resultado = $run->fetchAll();

				foreach ($resultado as $objeto){

					$venda = new Venda();
					$venda->setId($objeto['id']);
					$venda->setCliente($objeto['cliente']);
					$venda->setCpf($objeto['cpf']);
					$venda->setDataVenda($objeto['datavenda']);
					$venda->setTotal($objeto['total']);
					array_push($objetos, $venda);
				}	
				
			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				parent::desconectar();
			}		

			return $objetos;

		}			
		
		public function buscarPorId($id){

			$venda = new Venda();
						
			try{

				$pdo = parent::conectar();

				$sql = "SELECT * FROM tbvenda WHERE id = :id";

				$run = $pdo->prepare($sql);
	  			$run->bindValue(':id', $id, PDO::PARAM_INT);			
				$run->execute(); 
				$resultado = $run->fetch();

				$venda = new Venda();
				$venda->setId($resultado['id']);
				$venda->setCliente($resultado['cliente']);
				$venda->setCpf($resultado['cpf']);
				$venda->setDataVenda($resultado['datavenda']);
				$venda->setTotal($resultado['total']);

			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				parent::desconectar();
			}
			
			return $venda;
		}

		public function filtrar($cliente){
			
			$objetos = array();	

			try{
				$pdo = parent::conectar();
				
				$sql = "SELECT * FROM tbvenda WHERE cliente LIKE :cliente";
				$run = $pdo->prepare($sql);
	  			$run->bindValue(':cliente', '%'.$cliente.'%', PDO::PARAM_STR);
				
				$run->execute(); 
				$resultado = $run->fetchAll();

				foreach ($resultado as $objeto){
					$venda = new Venda();
					$venda->setId($objeto['id']);
					$venda->setCliente($objeto['cliente']);
					$venda->setCpf($objeto['cpf']);
					$venda->setDataVenda($objeto['datavenda']);
					$venda->setTotal($objeto['total']);
					array_push($objetos, $venda);
				}	

			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				parent::desconectar();
			}
			
			return $objetos;
		}
		
	}
	
?> 