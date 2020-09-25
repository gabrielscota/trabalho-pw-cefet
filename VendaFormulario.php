<?php	
	session_start();
	require_once 'ControleAcesso.php';

	require_once 'class/VendaDAO.php';

	$venda = new Venda();

	$operacao = "visualizar";

	if(isset($_GET["operacao"])){
		$operacao = $_GET["operacao"];
	}

		
	if(isset($_GET["id"])){
		
		$id = $_GET["id"];

		$vendaDAO = new VendaDAO();
		$venda = $vendaDAO->buscarPorId($id);
	}
			
?>

<html>
    <head>
		<meta charset="utf-8">
		<title>Venda</title>
		<link type="text/css" rel="stylesheet" href="css/bootstrap.css"/>
		<link type="text/css" rel="stylesheet" href="css/venda.css"/>
    </head>

    <body>

		<div class="cabecalho">	
			<?php
				include_once("Cabecalho.php");  	
			?>
		</div>		
						
		<div class="container">	

			<h5 class="cabecalho"> <?php echo $menu; ?> </h5>	

			<div class="mb-2 clearfix">
				<p><a class="btn btn-primary float-right" href="VendaTabela.php">Voltar</a></p>	
			</div>	
			
			<form id="formVenda" action="VendaControlador.php?operacao=salvar" method="post">
				<fieldset <?php if($operacao=="visualizar"){echo 'disabled';} ?> >

						<div class="row form-group">
							<div class="col-md-12">
								<label for="cliente">Cliente</label>  
								<input type="hidden" name="id" id="id" value="<?php echo $venda->getId() ?>" >
								<input class="form-control" name="cliente" id="cliente" type="text" value="<?php echo $venda->getCliente() ?>">
							</div>			
						</div>

						<div class="row form-group">
							<div class="col-md-12">
								<label for="cpf">CPF</label>
								<input class="form-control" id="cpf" name="cpf" type="text" value="<?php echo $venda->getCpf() ?>">
							</div>			
						</div>

						<div class="row form-group">
							<div class="col-md-12">
								<label for="datavenda">Data Venda</label>
								<input class="form-control" id="datavenda" name="datavenda" type="date" value="<?php echo $venda->getDataVenda() ?>">
							</div>			
						</div>

						<div class="row form-group">
							<div class="col-md-12">
								<label for="total">Total</label>
								<input class="form-control" id="total" name="total" type="number" value="<?php echo $venda->getTotal() ?>">
							</div>			
						</div>					
						
						<?php 
							if($operacao=="visualizar"){
								echo "<div class='row form-group ocultar'>";
							}else{
								echo "<div class='row form-group'>";
							}
						?>
						<div class="col-md-11">
							<?php 
								if($permissao == 2){
									echo "<button class='btn btn-success' type='submit' name='salvar' id='salvar' value='salvar'>Salvar</button>";
									echo "<button class='btn btn-primary mx-2' type='submit' name='salvarVoltar' id='salvarVoltar' value='salvarVoltar'>Salvar + Voltar</button>";
									echo "<button class='btn btn-dark' type='reset' id='cancelar'>Cancelar</button>";					
								}
							?>
						</div>																																			
					</div>	<!-- fechamento da div dos botões -->
				</fieldset>
			</form >
		</div>
	
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/bootstrap.js"></script>
		<script type="text/javascript" src="js/jquery.validate.js"></script>
		<script type="text/javascript" src="js/vendaFormulario.js"></script>
    </body>
</html>