<?php

    require_once("./mpdf/mpdf.php");
    require_once '../class/UsuarioDAO.php';
    require_once '../class/ProdutoDAO.php';
    require_once '../class/PedidoDAO.php';
    require_once '../class/PedidoProdutoDAO.php';

    $mpdf = new mPDF();
    $mpdf->SetDisplayMode("fullpage");


    $usuarioDAO = new UsuarioDAO();
    $listaUsuario = $usuarioDAO->listar();

    $produtoDAO = new ProdutoDAO();
    $listaProduto = $produtoDAO->listar();

    $pedidoProdutoDAO = new PedidoProdutoDAO();
    $listaPedidoProduto = $pedidoProdutoDAO->listar();

    $pedidoDAO = new PedidoDAO();
    $listaPedido = $pedidoDAO->listar();
        
	$somaTotal = 0;
	
    $html = "<div id='area01'>
				<img class='figura' src='imagens/logo.jpg'>
			</div>	
			<div id='area02'>	
				<h1 class='titulo'>Pedido por Usuário</h1>
			</div>	
			
			";

    $html = $html . "<div id='area03'> <hr>";

    foreach ($listaUsuario as $usuario) {
        $html = $html ."
					<label class='negrito'>Usuário:</label>
					<label>{$usuario->getNome()}</label>

					<hr>
					<table class='tabela'>
						<thead>
							<tr>
								<th width='60%'>Produto</th>
								<th width='7%'>Quant.</th>								
								<th width='15%'>Valor</th>
								<th width='18%'>Valor Total </th>
							</tr>
						</thead>
						<tbody>";
        
        $somaUsuario = 0;

        foreach ($listaPedidoProduto as $pedidoProduto) {
            if ($pedidoProduto->getPedido()->getUsuario()->getIdUsuario() == $usuario->getIdUsuario()) {
                $html = $html . "<tr>";
                $html = $html .	"<td>{$pedidoProduto->getProduto()->getNome()}</td>";
                $html = $html . "<td class='centralizar'>{$pedidoProduto->getQuantidade()}</td>";
                $html = $html .	"<td>R$ ".number_format($pedidoProduto->getValor(), 2, ',', '.')."</td>";
                $subTotal = $pedidoProduto->getQuantidade() * $pedidoProduto->getValor();
                $html = $html .	"<td>R$ ".number_format($subTotal, 2, ',', '.')."</td>";
                $html = $html . "</tr>";

				$somaUsuario = $somaUsuario +  $subTotal;
            }
		}
		
		$somaTotal += $somaUsuario;
                        
        $html = $html . "</tbody>";

        $html = $html . "<tfoot>
							<tr>
								<td></td>
								<td></td>
								<td class='direita negrito'>Total</td>
								<td class='negrito'>R$ ".number_format($somaUsuario, 2, ',', '.')."</td>
							</tr>
						</tfoot>";

        $html = $html . "</table> </div> <hr>";
    }

    $html = $html . "<div id='area02'><h3>Total: ".number_format($somaTotal, 2, ',', '.')."</h3></div>";
    

    $dataEmissao = date("d/m/Y H:i:s");
    
    $css = file_get_contents('css/RelatorioPedidoUsuarioImpressao.css');
    
    $mpdf->WriteHTML($css, 1);
    $mpdf->SetHeader("Programação para Web |  | Emissão: {$dataEmissao}");
    $mpdf->setFooter("{PAGENO} de {nb}");
    $mpdf->WriteHTML($html, 2);
    
    $mpdf->Output('RelatorioPedidoUsuarioImpressao.pdf', I);

    exit();
