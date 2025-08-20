-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 05/07/2025 às 01:29
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `showdomilhao`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `questoes`
--

CREATE TABLE `questoes` (
  `id` int(11) NOT NULL,
  `questao` varchar(200) NOT NULL,
  `alternativa1` varchar(50) NOT NULL,
  `alternativa2` varchar(50) NOT NULL,
  `alternativa3` varchar(50) NOT NULL,
  `alternativa4` varchar(50) NOT NULL,
  `correta` varchar(50) NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `dificuldade` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `questoes`
--

INSERT INTO `questoes` (`id`, `questao`, `alternativa1`, `alternativa2`, `alternativa3`, `alternativa4`, `correta`, `categoria`, `dificuldade`) VALUES
(1, 'Teste', '1', '2', '3', '4', '1', 'teste', 'facil'),
(2, 'A funÃ§Ã£o printf serve para:', 'Imprimir dados no console', 'Ler dados do usuÃ¡rio', 'Acessar arquivos', 'Criptografar senhas', 'Imprimir dados no console', 'ComputaÃ§Ã£o', 'facil'),
(3, ' A funÃ§Ã£o scanf:', 'Escreve dados na tela', 'LÃª dados da entrada padrÃ£o', 'Renderiza modelos 3D', 'NÃ£o existe', 'LÃª dados da entrada padrÃ£o', 'ComputaÃ§Ã£o', 'facil');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `questoes`
--
ALTER TABLE `questoes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `questoes`
--
ALTER TABLE `questoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
