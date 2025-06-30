-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 30/06/2025 às 15:37
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `login`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `contracheque`
--

CREATE TABLE `contracheque` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `salario` decimal(10,2) DEFAULT NULL,
  `descontos` decimal(10,2) DEFAULT NULL,
  `beneficios` decimal(10,2) DEFAULT NULL,
  `data_referencia` date DEFAULT NULL,
  `funcao` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `contracheque`
--

INSERT INTO `contracheque` (`id`, `usuario_id`, `salario`, `descontos`, `beneficios`, `data_referencia`, `funcao`) VALUES
(17, 1, 6542.00, 658.43, 142.52, '2025-06-11', 'Admin'),
(22, 55, 6528.00, 478.00, 102.00, '2025-06-11', 'Gerente'),
(24, 61, 4325.00, 227.00, 89.00, '2025-06-11', 'Testador');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `cpf` varchar(15) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `tipo` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `cpf`, `senha`, `nome`, `tipo`) VALUES
(1, '369258147', '$2y$10$6VM/SKPdPBdR.VOUHXcQmO8zluiVeVzDPulVRjhecmrwiIZyGoOnm', 'Jean Anjos', 'admin'),
(55, '14725836921', '$2y$10$0CXe5Fk95QlRtLSmg2Uw5uQ7tbntFkdlEszn.3Whfb0T/9d0yIMWa', 'Mateus Carneiro', 'comum'),
(61, '123456789', '$2y$10$Ql5xXokG73DR0LP7ebidaedZ4qrBCyUa.293H.6zIqpw.yus05Aiy', '(Usuario Teste)', 'admin');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `contracheque`
--
ALTER TABLE `contracheque`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `contracheque`
--
ALTER TABLE `contracheque`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `contracheque`
--
ALTER TABLE `contracheque`
  ADD CONSTRAINT `contracheque_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
