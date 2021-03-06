<?php	
	session_start();
	require_once 'ControleAcesso.php';

	require_once 'class/VendaDAO.php';
?>

<html>
    <head>
		<meta charset="utf-8">
		<title>Venda</title>
		<link type="text/css" rel="stylesheet" href="css/bootstrap.css"/>
		<link type="text/css" rel="stylesheet" href="css/datatables.css"/>
		<link type="text/css" rel="stylesheet" href="css/venda.css"/>
		
    </head>

    <body>	
		
		<div class="cabecalho">	
			<?php 
				include_once("Cabecalho.php");  	
			?>
		</div>		
		
		<div id="corpoTabela" class="container">

				<h5 class="cabecalho"> <?php echo $menu; ?> </h5>		
			
				<div class="mb-2 clearfix">
					<p><button type="button" class="btn btn-primary float-left" data-toggle="modal" data-target="#modalFiltro">Filtrar</button></p>	
					
					<?php
						if(isset($_GET["operacao"])=="filtrar"){
							echo "<a class='mx-2 btn btn-warning float-left' href='VendaTabela.php'>Limpar</a>";
						}

						if($permissao == 2){
							echo "<p><a class='btn btn-primary float-right' href='VendaFormulario.php?operacao=novo'>Novo</a></p>";
						}					
					?>
				
				</div>
							
				<table id="tabelaVenda" class="table table-striped">
					<thead>			
						<tr>
							<th class="col-md-3">Cliente</th>
							<th class="col-md-2">CPF</th>
							<th class="col-md-2">Data Veda</th>
							<th class="col-md-2">Total</th>
							<th class="col-md-1"></th>
							<th class="col-md-1"></th>
							<th class="col-md-1"></th>
						</tr>
					</thead>
					<tbody>
						<?php

							$vendaDAO = new VendaDAO();
							
							if(isset($_GET["operacao"])=="filtrar"){							
								$cliente = "";
								if(isset($_POST["cliente"])){
									$cliente = $_POST["cliente"];
								}

								$lista = $vendaDAO->filtrar($cliente);
							}else{
								$lista = $vendaDAO->listar();
							}

							foreach($lista as $venda){
			
								echo"<tr>";			
								echo"<td>{$venda->getCliente()}</td>";
								echo"<td>{$venda->getCpf()}</td>";
								echo"<td>{$venda->getDataVenda()}</td>";
								echo"<td>{$venda->getTotal()}</td>";
								
								if($permissao == 2){	
								echo"<td> <a class='btn btn-danger'  href='VendaControlador.php?operacao=excluir&id={$venda->getId()}'> excluir </a> </td>";	

								echo"<td> <a class='btn btn-success' href='VendaFormulario.php?operacao=editar&id={$venda->getId()}'> editar </a> </td>";	

								}else{
									echo"<td></td>";
									echo"<td></td>";						
								}

								echo"<td> <a class='btn btn-secondary'  href='VendaFormulario.php?operacao=visualizar&id={$venda->getId()}'> Visualizar </a> </td>";			
								echo"</tr>";					
							}
							
						?>		
							
					</tbody>
				</table>
		</div>	
						
		<!-- Modal -->	
		<div class="modal fade" id="modalFiltro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
				<form id="formFiltroVenda" action="VendaTabela.php?operacao=filtrar" 
					method="post">
				  <div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Filtro</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <div class="modal-body">
					 <label for="cliente">Cliente</label>  
					 <input class="form-control campo" name="cliente" 
						id="cliente" type="text" value="" >
				  </div>
				  <div class="modal-footer">
					<button type="reset" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-primary">Aplicar</button>
				  </div>
				</form>
			</div>
		  </div>
		</div>

		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/bootstrap.js"></script>
		<script type="text/javascript" src="js/datatables.js"></script>
		<script type="text/javascript" src="js/vendaTabela.js"></script>
		
    </body>
</html>