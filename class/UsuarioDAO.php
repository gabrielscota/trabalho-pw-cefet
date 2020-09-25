<?php	
	require_once 'CrudDAO.php';
	require_once 'GrupoDAO.php';	
	require_once 'Usuario.php';

	class UsuarioDAO extends CrudDAO
	{

		public function salvar($usuario){	
			$situacao = FALSE;
			try{
				
				if($usuario->getIdUsuario()==0){

					$situacao = $this->incluir($usuario);

				}else{	
					$situacao = $this->atualizar($usuario);
				}

			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}			

			return $situacao;
		}

		public function incluir($usuario){	
			$situacao = FALSE;
			try{
				
				$pdo = parent::conectar();	

				$sql = "INSERT INTO tbUsuario(login, nome, senha, email, situacao, foto, idGrupo) VALUES (:login, :nome, :senha, :email, :situacao, :foto, :idGrupo)";

				$run = $pdo->prepare($sql);
				$run->bindValue(':login', $usuario->getLogin(), PDO::PARAM_STR); 
				$run->bindValue(':nome', $usuario->getNome(), PDO::PARAM_STR); 
				$run->bindValue(':senha', $usuario->getSenha(), PDO::PARAM_STR); 
				$run->bindValue(':email', $usuario->getEmail(), PDO::PARAM_STR); 
				$run->bindValue(':situacao', $usuario->getSituacao(), PDO::PARAM_INT); 
				$run->bindValue(':foto', $usuario->getFoto(), PDO::PARAM_STR); 				
				$run->bindValue(':idGrupo', $usuario->getGrupo()->getIdGrupo(), PDO::PARAM_INT); 
	  			$run->execute(); 

				if($run->rowCount() > 0){
					$situacao = TRUE;
				}

				$usuario->setIdUsuario($pdo->lastInsertId());
				
			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				parent::desconectar();
			}		

			return $situacao;
		}

		public function atualizar($usuario){	
			$situacao = FALSE;
			try{
				
				$pdo = parent::conectar();
					
				$sql = "UPDATE tbUsuario SET login = :login, nome = :nome, senha = :senha, email = :email, situacao = :situacao, foto = :foto, idGrupo = :idGrupo WHERE idUsuario = :idUsuario";

				$run = $pdo->prepare($sql);
				$run->bindValue(':idUsuario', $usuario->getIdUsuario(), PDO::PARAM_STR); 
				$run->bindValue(':nome', $usuario->getNome(), PDO::PARAM_STR); 
				$run->bindValue(':login', $usuario->getLogin(), PDO::PARAM_STR); 
				$run->bindValue(':senha', $usuario->getSenha(), PDO::PARAM_STR); 
				$run->bindValue(':email', $usuario->getEmail(), PDO::PARAM_STR); 
				$run->bindValue(':situacao', $usuario->getSituacao(), PDO::PARAM_INT); 
				$run->bindValue(':foto', $usuario->getFoto(), PDO::PARAM_STR);
				$run->bindValue(':idGrupo', $usuario->getGrupo()->getIdGrupo(), PDO::PARAM_INT); 
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

		public function excluir($usuario){

			$situacao = FALSE;
			try{
				
				$pdo = parent::conectar();	
					
				$sql = "DELETE FROM tbUsuario WHERE idUsuario = :idUsuario";

				$run = $pdo->prepare($sql);
	  			$run->bindValue(':idUsuario', $usuario->getIdUsuario(), PDO::PARAM_INT);			
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

		public function excluirPorId($codigo){

			$situacao = FALSE;
			try{
				
				$pdo = parent::conectar();	
					
				$sql = "DELETE FROM tbUsuario WHERE idUsuario = :idUsuario";

				$run = $pdo->prepare($sql);
	  			$run->bindValue(':idUsuario', $codigo, PDO::PARAM_INT);			
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
					
				$sql = "SELECT * FROM tbUsuario";

				$run = $pdo->prepare($sql);			
				$run->execute(); 
				$resultado = $run->fetchAll();

				$grupoDAO = new GrupoDAO();

				foreach ($resultado as $registro){

					$usuario = new Usuario();
					$usuario->setIdUsuario($registro['idUsuario']);
					$usuario->setNome($registro['nome']);
					$usuario->setLogin($registro['login']);
					$usuario->setSenha($registro['senha']);
					$usuario->setEmail($registro['email']);
					$usuario->setUltimoAcesso($registro['ultimoAcesso']);
					$usuario->setSituacao($registro['situacao']);
					$usuario->setFoto($registro['foto']);

					$grupo = $grupoDAO->buscarPorId($registro['idGrupo']);
					$usuario->setGrupo($grupo);

					array_push($objetos, $usuario);
				}	
				
			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				parent::desconectar();
			}		

			return $objetos;

		}			
		
		public function buscarPorId($codigo){

			$usuario = new Usuario();
						
			try{

				$pdo = parent::conectar();

				$sql = "SELECT * FROM tbUsuario WHERE idUsuario = :idUsuario";

				$run = $pdo->prepare($sql);
	  			$run->bindValue(':idUsuario', $codigo, PDO::PARAM_INT);			
				$run->execute(); 
				$registro = $run->fetch();

				$grupoDAO = new GrupoDAO();

				$usuario = new Usuario();
				$usuario->setIdUsuario($registro['idUsuario']);
				$usuario->setNome($registro['nome']);
				$usuario->setLogin($registro['login']);
				$usuario->setSenha($registro['senha']);
				$usuario->setEmail($registro['email']);
				$usuario->setUltimoAcesso($registro['ultimoAcesso']);
				$usuario->setSituacao($registro['situacao']);
				$usuario->setFoto($registro['foto']);

				$grupo = $grupoDAO->buscarPorId($registro['idGrupo']);
				$usuario->setGrupo($grupo);

			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				parent::desconectar();
			}
			
			return $usuario;
		}		

		public function autenticar($login, $senha){

			$usuario = new Usuario();
						
			try{

				$pdo = parent::conectar();

				$sql = "SELECT * FROM tbUsuario WHERE login = :login AND senha = :senha";

				$run = $pdo->prepare($sql);
	  			$run->bindValue(':login', $login, PDO::PARAM_STR);			
	  			$run->bindValue(':senha', $login, PDO::PARAM_STR);	
				$run->execute(); 
				$registro = $run->fetch();

				$grupoDAO = new GrupoDAO();

				$usuario = new Usuario();
				$usuario->setIdUsuario($registro['idUsuario']);
				$usuario->setNome($registro['nome']);
				$usuario->setLogin($registro['login']);
				$usuario->setSenha($registro['senha']);
				$usuario->setEmail($registro['email']);
				$usuario->setUltimoAcesso($registro['ultimoAcesso']);
				$usuario->setSituacao($registro['situacao']);
				$usuario->setFoto($registro['foto']);

				$grupo = $grupoDAO->buscarPorId($registro['idGrupo']);
				$usuario->setGrupo($grupo);

			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				parent::desconectar();
			}
			
			return $usuario;
		}	

		public function verificarLogin($codigo, $login){

			$situacao = TRUE;
			try{
				
				$pdo = parent::conectar();	
					
				$sql = "SELECT * FROM tbUsuario WHERE idUsuario <> :idUsuario AND login = :login";

				$run = $pdo->prepare($sql);
	  			$run->bindValue(':idUsuario', $codigo, PDO::PARAM_INT);			
	  			$run->bindValue(':login', $login, PDO::PARAM_STR);	
				$run->execute(); 

				if($run->rowCount() > 0){
					$situacao = FALSE;
				}
				
			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				parent::desconectar();
			}			

			return $situacao;

		}

		public function registrarAutenticacao($usuario){	
			$situacao = FALSE;
			try{
				
				$pdo = parent::conectar();
					
				$sql = "UPDATE tbUsuario SET ultimoAcesso = NOW() WHERE idUsuario = :idUsuario";

				$run = $pdo->prepare($sql);
				$run->bindValue(':idUsuario', $usuario->getIdUsuario(), PDO::PARAM_INT);  
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


		public function filtrar($nome, $login, $email, $situacao, $idGrupo){

			$objetos = array();	
						
			try{

				$pdo = parent::conectar();

				/*
				$sql = "SELECT * FROM tbUsuario 
						WHERE 
							nome LIKE :nome
						AND login LIKE :login
						AND email LIKE :email
						AND situacao = IFNULL(:situacao, situacao)
						AND idGrupo = IFNULL(:idGrupo, idGrupo)";						
					
				$run = $pdo->prepare($sql);

	  			$run->bindValue(':nome', '%'.$nome.'%');			
	  			$run->bindValue(':login', '%'.$login.'%');		
	  			$run->bindValue(':email', '%'.$email.'%');		
	  			$run->bindValue(':situacao', $situacao);		
	  			$run->bindValue(':idGrupo', $idGrupo);	
	  			*/

				$sql = "SELECT * FROM tbUsuario 
						WHERE 
							nome LIKE '%{$nome}%'
						AND login LIKE '%{$login}%'
						AND email LIKE '%{$email}%'
						AND situacao = IFNULL($situacao, situacao)
						AND idGrupo = IFNULL($idGrupo,idGrupo)";	

				$run = $pdo->prepare($sql);

				$run->execute(); 
				$resultado = $run->fetchAll();
				
				$grupoDAO = new GrupoDAO();

				foreach ($resultado as $registro){

					$usuario = new Usuario();
					$usuario->setIdUsuario($registro['idUsuario']);
					$usuario->setNome($registro['nome']);
					$usuario->setLogin($registro['login']);
					$usuario->setSenha($registro['senha']);
					$usuario->setEmail($registro['email']);
					$usuario->setUltimoAcesso($registro['ultimoAcesso']);
					$usuario->setSituacao($registro['situacao']);
					$usuario->setFoto($registro['foto']);

					$grupo = $grupoDAO->buscarPorId($registro['idGrupo']);
					$usuario->setGrupo($grupo);

					array_push($objetos, $usuario);
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