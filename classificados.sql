-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 10/08/2020 às 18:06
-- Versão do servidor: 10.4.13-MariaDB
-- Versão do PHP: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `classificados`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `anuncios`
--

CREATE TABLE `anuncios` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `valor` float DEFAULT NULL,
  `estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `anuncios`
--

INSERT INTO `anuncios` (`id`, `id_usuario`, `id_categoria`, `titulo`, `descricao`, `valor`, `estado`) VALUES
(1, 1, 1, 'Technos', 'Relógio em bom estado, com nota fiscal.', 50, 1),
(2, 1, 4, 'Etios hatch 1.3L', 'Conservado, baixa kilometragem.', 1000, 1),
(3, 1, 2, 'Camisa social', 'Camisa social, com abotoadura gold nos punhos, e colarinho italiano.\r\nProduto novo.', 120, 2),
(4, 2, 3, 'Celular Samsung', 'Muito conservado, em perfeito funcionamento.', 300, 2),
(5, 2, 1, 'Casio', 'Novo, na caixa', 200, 2),
(6, 2, 2, 'Calça Levis 505', 'Nova, original, na embalagem, ficou pequena.', 80, 2),
(7, 2, 4, 'Polo 1.6S', 'Ótimo estado de conservação, km 80 mil, todas as revisões realizadas, com nota fiscal e único dono.', 900, 2),
(8, 1, 3, 'Notebook Dell', 'Processador I7, memória 16 gbyte de ram, tela 14\\\", novo na caixa.', 1000, 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `anuncios_imagens`
--

CREATE TABLE `anuncios_imagens` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_anuncio` int(11) NOT NULL,
  `url_foto` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `anuncios_imagens`
--

INSERT INTO `anuncios_imagens` (`id`, `id_anuncio`, `url_foto`) VALUES
(1, 1, 'public/assets/images/anuncios/1597007897_0333edc35fa5c7ae3df7.jpg'),
(2, 2, 'public/assets/images/anuncios/1597065949_24f7126b5ffe5f66b190.jpg'),
(3, 3, 'public/assets/images/anuncios/1597066003_0b92a0c887b335f1eb0e.jpg'),
(4, 4, 'public/assets/images/anuncios/1597066231_ae1aca5f99e514358f85.jpg'),
(5, 5, 'public/assets/images/anuncios/1597066355_5c3e72f125b3b9c77fb4.jpg'),
(6, 6, 'public/assets/images/anuncios/1597068219_228c3776e624184f3863.jpg'),
(7, 7, 'public/assets/images/anuncios/1597068537_10a397cbebb4a1535e83.jpg'),
(8, 7, 'public/assets/images/anuncios/1597068555_8d1b93dd71158e25ae81.jpg');

-- --------------------------------------------------------

--
-- Estrutura para tabela `categorias`
--

CREATE TABLE `categorias` (
  `id` int(10) UNSIGNED NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `categorias`
--

INSERT INTO `categorias` (`id`, `nome`) VALUES
(1, 'Relógios'),
(2, 'Roupas'),
(3, 'Eletrônicos'),
(4, 'Carros');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `telefone` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `telefone`) VALUES
(1, 'teste', 'teste@gmail.com', '202cb962ac59075b964b07152d234b70', '(11)999997777'),
(2, 'admin', 'admin@gmail.com', '202cb962ac59075b964b07152d234b70', '(11)999996666');

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `anuncios`
--
ALTER TABLE `anuncios`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `anuncios_imagens`
--
ALTER TABLE `anuncios_imagens`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `anuncios`
--
ALTER TABLE `anuncios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `anuncios_imagens`
--
ALTER TABLE `anuncios_imagens`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
