-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Tempo de geração: 16/06/2025 às 14:00
-- Versão do servidor: 10.4.21-MariaDB
-- Versão do PHP: 8.0.12

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `alunos`
--

INSERT INTO `alunos` (`id`, `nome`, `usuario`, `senha`, `nivel_acesso`, `cursos_matriculados`, `cpf`, `data_nasc`) VALUES
(4, 'teste', 'teste', '$2y$10$75mvCtqrd6pup.DKWE4cdeziWcm8hudXjwcIjIqNyoCZ2LhStEYDi', 'aluno', '2;', '', '0000-00-00'),
(5, 'admin', 'admin', '$2y$10$K3cxriXUKfBGW9LkHW/qQuy5QrX0kawqmSn4EryElETzmXjfDj4EK', 'administrador', NULL, '', '0000-00-00'),
(9, 'teste2', 'teste2', '$2y$10$k0Vhm4/AUofUC2EWb2sX/OVLDYxvQpaONojVC13n9TeCf2tOks4tO', 'aluno', NULL, '123.456.789-00', '2025-06-12'),
(10, 'kaue', 'kaue', '$2y$10$pElUfPJi0GiqV5yIcX5Boeuxb2Na3XMxxDXg1FaKNvOjwEgo6RX4q', 'aluno', '3;', '111.111.111-11', '2006-03-11');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
