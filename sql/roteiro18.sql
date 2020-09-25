-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 21-Nov-2018 às 14:31
-- Versão do servidor: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `roteiro18`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbacesso`
--

CREATE TABLE `tbacesso` (
  `idAcesso` int(11) NOT NULL,
  `descricao` varchar(255) CHARACTER SET latin1 NOT NULL,
  `menu` varchar(255) CHARACTER SET latin1 NOT NULL,
  `arquivo` varchar(255) CHARACTER SET latin1 NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `idAcessoPai` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbacesso`
--

INSERT INTO `tbacesso` (`idAcesso`, `descricao`, `menu`, `arquivo`, `tipo`, `idAcessoPai`) VALUES
(1, 'Dashboard', 'Início', 'Menu.php', 'menu', NULL),
(2, 'Tabela de Usuários', 'Usuário', 'UsuarioTabela.php', 'menu', NULL),
(3, 'Formulário de Usuários', 'Usuário', 'UsuarioFormulario.php', 'formulario', NULL),
(4, 'Tabela de Grupos de Usuários', 'Grupo de Usuário', 'GrupoTabela.php', 'menu', NULL),
(5, 'Formulário de Grupos de Usuários', 'Grupo de Usuário', 'GrupoFormulario.php', 'formulario', NULL),
(6, 'Tabela de Categorias', 'Categoria', 'CategoriaTabela.php', 'menu', NULL),
(7, 'Formulário de Categorias', 'Categoria', 'CategoriaFormulario.php', 'formulario', NULL),
(8, 'Tabela de Produtos', 'Produto', 'ProdutoTabela.php', 'menu', NULL),
(9, 'Formulário de Produtos', 'Produto', 'ProdutoFormulario.php', 'formulario', NULL),
(10, 'Tabela de Pedidos', 'Pedido', 'PedidoTabela.php', 'menu', NULL),
(11, 'Formulário de Pedidos', 'Pedido', 'PedidoFormulario.php', 'formulario', NULL),
(12, 'Relatórios', 'Relatórios', '#', 'subMenu', NULL),
(13, 'Relatório de Estoque por Categoria', 'Estoque por Categoria', 'RelatorioProdutoCategoriaFormulario.php', 'itemSubMenu', 12),
(14, 'Relatório de Usuários por Grupo de Acesso', 'Usuários por Grupo de Acesso', '#', 'itemSubMenu', 12),
(15, 'Relatório de Pedidos por Usuário', 'Pedidos por Usuário', '#', 'itemSubMenu', 12),
(16, 'Tabela de Vendas', 'Venda', 'VendaTabela.php', 'menu', NULL),
(17, 'Formulário de Vendas', 'Venda', 'VendaFormulario.php', 'formulario', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbcategoria`
--

CREATE TABLE `tbcategoria` (
  `idCategoria` int(11) NOT NULL,
  `descricao` varchar(255) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbcategoria`
--

INSERT INTO `tbcategoria` (`idCategoria`, `descricao`) VALUES
(1, 'Informática'),
(2, 'Móveis'),
(12, 'Alimentos');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbgrupo`
--

CREATE TABLE `tbgrupo` (
  `idGrupo` int(11) NOT NULL,
  `descricao` varchar(255) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbgrupo`
--

INSERT INTO `tbgrupo` (`idGrupo`, `descricao`) VALUES
(1, 'Administrador'),
(2, 'Gerente');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbgrupoacesso`
--

CREATE TABLE `tbgrupoacesso` (
  `idGrupoAcesso` int(11) NOT NULL,
  `idGrupo` int(11) NOT NULL,
  `idAcesso` int(11) NOT NULL,
  `permissao` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbgrupoacesso`
--

INSERT INTO `tbgrupoacesso` (`idGrupoAcesso`, `idGrupo`, `idAcesso`, `permissao`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 2),
(3, 1, 3, 2),
(4, 1, 4, 2),
(5, 1, 5, 2),
(6, 1, 6, 2),
(7, 1, 7, 2),
(8, 1, 8, 2),
(9, 1, 9, 2),
(10, 1, 10, 2),
(11, 1, 11, 2),
(14, 2, 1, 1),
(15, 2, 2, 1),
(16, 2, 3, 1),
(17, 2, 4, 2),
(18, 2, 5, 2),
(24, 2, 8, 1),
(31, 1, 12, 2),
(32, 1, 13, 2),
(33, 1, 14, 2),
(34, 1, 15, 2),
(38, 1, 16, 2),
(39, 1, 17, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbpedido`
--

CREATE TABLE `tbpedido` (
  `idPedido` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `dataPedido` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbpedido`
--

INSERT INTO `tbpedido` (`idPedido`, `idUsuario`, `dataPedido`) VALUES
(21, 1, '2011-11-30 00:00:00'),
(22, 4, '2012-10-18 00:00:00'),
(23, 7, '2018-11-20 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbpedidoproduto`
--

CREATE TABLE `tbpedidoproduto` (
  `idPedidoProduto` int(11) NOT NULL,
  `idPedido` int(11) DEFAULT NULL,
  `idProduto` int(11) DEFAULT NULL,
  `quantidade` int(11) NOT NULL,
  `valor` decimal(9,2) NOT NULL,
  `valorTotal` decimal(9,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbpedidoproduto`
--

INSERT INTO `tbpedidoproduto` (`idPedidoProduto`, `idPedido`, `idProduto`, `quantidade`, `valor`, `valorTotal`) VALUES
(6, 21, 1, 1, '1.00', '1.00'),
(7, 21, 2, 2, '2.00', '4.00'),
(8, 23, 5, 10, '30.00', '300.00'),
(9, 23, 6, 10, '99.99', '999.90'),
(10, 22, 5, 1, '0.50', '0.50'),
(11, 22, 6, 1, '10.00', '10.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbproduto`
--

CREATE TABLE `tbproduto` (
  `idProduto` int(11) NOT NULL,
  `nome` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `descricao` varchar(3000) CHARACTER SET latin1 NOT NULL,
  `valor` decimal(9,2) NOT NULL,
  `quantidadeEstoque` int(11) NOT NULL,
  `foto` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `idCategoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbproduto`
--

INSERT INTO `tbproduto` (`idProduto`, `nome`, `descricao`, `valor`, `quantidadeEstoque`, `foto`, `idCategoria`) VALUES
(1, 'Notebook Ideapad', 'Foto 6 - Notebook Lenovo Ideapad 330 Intel Core i5-8250u 8GB 1TB  Tela HD 15.6\"  Windows 10 - Prata', '2299.99', 10, '0102_foto_pequena.jpg', 1),
(2, 'Cadeira Presidente', 'Cadeira Presidente MB-C730 Giratória Base Cromada Preto - Travel Max', '509.00', 5, '0101_foto_pequena.jpg', 2),
(3, 'Notebook Positivo', 'Notebook Positivo Stilo XCI7660 Intel Core i3 4GB 1TB Tela LED 14\" Linux - Cinza Escuro', '1496.99', 1, '0103_foto_pequena.png', 1),
(4, 'Poltrona Do Papai', 'Poltrona Do Papai Retrátil E Reclinável Marron Café', '732.00', 10, '5bb6f3d0497a031500348_1GG.jpg', 2),
(5, 'Batata Doce', 'Batata doce para os monstros', '20.00', 99, '5bf55ce2d1262FRESH_ImagemPadrao_HortiFruti_Legumes_4_600x600.png', 12),
(6, 'Frango', 'Frango para monstros', '10.00', 99, '5bf55d422f872receitas-de-file-de-frango.jpg', 12);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbusuario`
--

CREATE TABLE `tbusuario` (
  `idUsuario` int(11) NOT NULL,
  `nome` varchar(255) CHARACTER SET latin1 NOT NULL,
  `login` varchar(255) CHARACTER SET latin1 NOT NULL,
  `senha` varchar(255) CHARACTER SET latin1 NOT NULL,
  `email` varchar(255) CHARACTER SET latin1 NOT NULL,
  `ultimoAcesso` datetime DEFAULT NULL,
  `situacao` tinyint(1) NOT NULL,
  `foto` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `idGrupo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbusuario`
--

INSERT INTO `tbusuario` (`idUsuario`, `nome`, `login`, `senha`, `email`, `ultimoAcesso`, `situacao`, `foto`, `idGrupo`) VALUES
(1, 'admin', 'admin', 'admin', 'admin@admin.com', '2018-11-21 10:22:37', 1, '5b8e0f62795430_foto_pequena.jpg', 1),
(4, 'Paulo Cesar', 'paulo', 'paulo', 'paulo@gmail.com', '2018-11-19 16:30:18', 1, '5bf40ddb78984', 2),
(7, 'Scota', 'scota', 'scota', 'gabrielscota2015@gmail.com', NULL, 1, '5bf40b2470a95', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbvenda`
--

CREATE TABLE `tbvenda` (
  `id` int(11) NOT NULL,
  `cliente` varchar(255) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `datavenda` date NOT NULL,
  `total` decimal(9,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbvenda`
--

INSERT INTO `tbvenda` (`id`, `cliente`, `cpf`, `datavenda`, `total`) VALUES
(1, 'scoteiro2', '125.230.816-79', '2000-02-20', '20.00'),
(2, 'dudu do si', '020.552.976-35', '2018-11-20', '999.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbacesso`
--
ALTER TABLE `tbacesso`
  ADD PRIMARY KEY (`idAcesso`);

--
-- Indexes for table `tbcategoria`
--
ALTER TABLE `tbcategoria`
  ADD PRIMARY KEY (`idCategoria`);

--
-- Indexes for table `tbgrupo`
--
ALTER TABLE `tbgrupo`
  ADD PRIMARY KEY (`idGrupo`);

--
-- Indexes for table `tbgrupoacesso`
--
ALTER TABLE `tbgrupoacesso`
  ADD PRIMARY KEY (`idGrupoAcesso`),
  ADD KEY `FK_tbGrupoAcesso_Ref_tbAcesso` (`idAcesso`),
  ADD KEY `FK_tbGrupoAcesso_Ref_tbGrupo` (`idGrupo`);

--
-- Indexes for table `tbpedido`
--
ALTER TABLE `tbpedido`
  ADD PRIMARY KEY (`idPedido`),
  ADD KEY `FK_tbPed_Ref_tbUsu` (`idUsuario`);

--
-- Indexes for table `tbpedidoproduto`
--
ALTER TABLE `tbpedidoproduto`
  ADD PRIMARY KEY (`idPedidoProduto`),
  ADD KEY `FK_tbPedPro_Ref_tbPed` (`idPedido`),
  ADD KEY `FK_tbPedPro_Ref_tbPro` (`idProduto`);

--
-- Indexes for table `tbproduto`
--
ALTER TABLE `tbproduto`
  ADD PRIMARY KEY (`idProduto`),
  ADD KEY `FK_tbPro_Ref_tbCat` (`idCategoria`);

--
-- Indexes for table `tbusuario`
--
ALTER TABLE `tbusuario`
  ADD PRIMARY KEY (`idUsuario`),
  ADD KEY `FK_tbUsuario_Ref_tbGrupo` (`idGrupo`);

--
-- Indexes for table `tbvenda`
--
ALTER TABLE `tbvenda`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbacesso`
--
ALTER TABLE `tbacesso`
  MODIFY `idAcesso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbcategoria`
--
ALTER TABLE `tbcategoria`
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbgrupo`
--
ALTER TABLE `tbgrupo`
  MODIFY `idGrupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tbgrupoacesso`
--
ALTER TABLE `tbgrupoacesso`
  MODIFY `idGrupoAcesso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `tbpedido`
--
ALTER TABLE `tbpedido`
  MODIFY `idPedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbpedidoproduto`
--
ALTER TABLE `tbpedidoproduto`
  MODIFY `idPedidoProduto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbproduto`
--
ALTER TABLE `tbproduto`
  MODIFY `idProduto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbusuario`
--
ALTER TABLE `tbusuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbvenda`
--
ALTER TABLE `tbvenda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `tbgrupoacesso`
--
ALTER TABLE `tbgrupoacesso`
  ADD CONSTRAINT `FK_tbGrupoAcesso_Ref_tbAcesso` FOREIGN KEY (`idAcesso`) REFERENCES `tbacesso` (`idAcesso`),
  ADD CONSTRAINT `FK_tbGrupoAcesso_Ref_tbGrupo` FOREIGN KEY (`idGrupo`) REFERENCES `tbgrupo` (`idGrupo`);

--
-- Limitadores para a tabela `tbpedido`
--
ALTER TABLE `tbpedido`
  ADD CONSTRAINT `FK_tbPed_Ref_tbUsu` FOREIGN KEY (`idUsuario`) REFERENCES `tbusuario` (`idUsuario`);

--
-- Limitadores para a tabela `tbpedidoproduto`
--
ALTER TABLE `tbpedidoproduto`
  ADD CONSTRAINT `FK_tbPedPro_Ref_tbPed` FOREIGN KEY (`idPedido`) REFERENCES `tbpedido` (`idPedido`),
  ADD CONSTRAINT `FK_tbPedPro_Ref_tbPro` FOREIGN KEY (`idProduto`) REFERENCES `tbproduto` (`idProduto`);

--
-- Limitadores para a tabela `tbproduto`
--
ALTER TABLE `tbproduto`
  ADD CONSTRAINT `FK_tbPro_Ref_tbCat` FOREIGN KEY (`idCategoria`) REFERENCES `tbcategoria` (`idCategoria`);

--
-- Limitadores para a tabela `tbusuario`
--
ALTER TABLE `tbusuario`
  ADD CONSTRAINT `FK_tbUsuario_Ref_tbGrupo` FOREIGN KEY (`idGrupo`) REFERENCES `tbgrupo` (`idGrupo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
