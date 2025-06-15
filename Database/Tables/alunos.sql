-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 13/06/2025 às 00:11
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
-- Banco de dados: `sistema_escolar`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `alunos`
--

CREATE TABLE `alunos` (
  `id` int(11) NOT NULL,
  `nome` varchar(64) NOT NULL,
  `usuario` varchar(32) NOT NULL,
  `senha` varchar(256) NOT NULL,
  `nivel_acesso` varchar(32) NOT NULL,
  `cursos_matriculados` varchar(1024) DEFAULT NULL,
  `cpf` varchar(14) NOT NULL,
  `data_nasc` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `alunos`
--

INSERT INTO `alunos` (`id`, `nome`, `usuario`, `senha`, `nivel_acesso`, `cursos_matriculados`, `cpf`, `data_nasc`) VALUES
(4, 'teste', 'teste', '$2y$10$75mvCtqrd6pup.DKWE4cdeziWcm8hudXjwcIjIqNyoCZ2LhStEYDi', 'aluno', '2;', '', '0000-00-00'),
(5, 'admin', 'admin', '$2y$10$K3cxriXUKfBGW9LkHW/qQuy5QrX0kawqmSn4EryElETzmXjfDj4EK', 'administrador', NULL, '', '0000-00-00'),
(9, 'teste2', 'teste2', '$2y$10$k0Vhm4/AUofUC2EWb2sX/OVLDYxvQpaONojVC13n9TeCf2tOks4tO', 'aluno', NULL, '123.456.789-00', '2025-06-12');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `alunos`
--
ALTER TABLE `alunos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `alunos`
--
ALTER TABLE `alunos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
