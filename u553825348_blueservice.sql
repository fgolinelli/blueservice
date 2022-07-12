-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 12, 2022 at 02:43 PM
-- Server version: 10.5.12-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u553825348_blueservice`
--

-- --------------------------------------------------------

--
-- Table structure for table `TB_Categoria`
--

CREATE TABLE `TB_Categoria` (
  `id_categoria` int(11) NOT NULL COMMENT 'Id da categoria',
  `descricao_categoria` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Descrição da categoria'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `TB_Categoria`
--

INSERT INTO `TB_Categoria` (`id_categoria`, `descricao_categoria`) VALUES
(1, 'Escritório'),
(2, 'Alimento');

-- --------------------------------------------------------

--
-- Table structure for table `TB_Cliente`
--

CREATE TABLE `TB_Cliente` (
  `id_cliente` int(11) NOT NULL,
  `nome` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cpf` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `endereco` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ccredito` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `TB_ListaPedido`
--

CREATE TABLE `TB_ListaPedido` (
  `id_lista_pedido` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `preco_unitario` decimal(10,2) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `TB_Pedido`
--

CREATE TABLE `TB_Pedido` (
  `id_pedido` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `preco_total` decimal(10,2) NOT NULL,
  `dth_pgth` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `TB_Produto`
--

CREATE TABLE `TB_Produto` (
  `id_produto` int(11) NOT NULL,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Nome do produto',
  `descricao_produto` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Descrição do produto',
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `preco` decimal(10,2) NOT NULL COMMENT 'Preço unitário do produto',
  `quantidade` int(11) NOT NULL COMMENT 'Quantidade restante',
  `id_categoria` int(11) NOT NULL COMMENT 'Id da categoria do produto'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `TB_Produto`
--

INSERT INTO `TB_Produto` (`id_produto`, `nome`, `descricao_produto`, `foto`, `preco`, `quantidade`, `id_categoria`) VALUES
(1, 'Lápis preto HB #2', 'Lápis com grafite macio. Próprio para sombrear desenhos.', 'https://img.kalunga.com.br/fotosdeprodutos/414335z_2.jpg', '5.99', 10, 1),
(2, 'Açúcar mascavo', 'Produto natural com nenhum conservante.', 'http://cdn.shopify.com/s/files/1/0946/5368/products/573b31cc5be84fc9a14c9a7682cff6cc_grande.jpg?v=1628296380', '5.99', 20, 2),
(3, 'Caneta azul', 'Caneta esferográfica na cor azul.', 'https://digitonet.com.br/home/image/data/Escritorio/CANETA%20AZUL%20COMPACTOR%2007.jpg', '6.99', 10, 1),
(5, 'Leite Ninho Integral', 'Leite integral com percentual de gordura normal', 'https://m.media-amazon.com/images/I/81j00XpMTHS._AC_SL1500_.jpg', '19.99', 23, 2),
(6, 'Leite Ninho Levinho', 'Leite com percentual de gordura reduzido em 50%', 'https://m.media-amazon.com/images/I/819e81gochL._AC_SL1500_.jpg', '17.99', 21, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `TB_Categoria`
--
ALTER TABLE `TB_Categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indexes for table `TB_Cliente`
--
ALTER TABLE `TB_Cliente`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indexes for table `TB_ListaPedido`
--
ALTER TABLE `TB_ListaPedido`
  ADD PRIMARY KEY (`id_lista_pedido`);

--
-- Indexes for table `TB_Pedido`
--
ALTER TABLE `TB_Pedido`
  ADD PRIMARY KEY (`id_pedido`);

--
-- Indexes for table `TB_Produto`
--
ALTER TABLE `TB_Produto`
  ADD PRIMARY KEY (`id_produto`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `TB_Categoria`
--
ALTER TABLE `TB_Categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id da categoria', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `TB_Cliente`
--
ALTER TABLE `TB_Cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `TB_ListaPedido`
--
ALTER TABLE `TB_ListaPedido`
  MODIFY `id_lista_pedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `TB_Pedido`
--
ALTER TABLE `TB_Pedido`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `TB_Produto`
--
ALTER TABLE `TB_Produto`
  MODIFY `id_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
