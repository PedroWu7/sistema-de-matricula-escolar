-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 16/06/2025 às 21:48
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
(5, 'admin', 'admin', '$2y$10$K3cxriXUKfBGW9LkHW/qQuy5QrX0kawqmSn4EryElETzmXjfDj4EK', 'administrador', NULL, '', '0000-00-00'),
(9, 'teste2', 'teste2', '$2y$10$kGIFF6GDjVdkt9qX9QQfDeeMxRyqfgf5Yy1H7rMX3Ju3e/5VA5vSi', 'aluno', NULL, '123.456.789-01', '2025-06-12'),
(10, 'kaue', 'kaue', '$2y$10$pElUfPJi0GiqV5yIcX5Boeuxb2Na3XMxxDXg1FaKNvOjwEgo6RX4q', 'aluno', '3;', '111.111.111-11', '2006-03-11'),
(11, 'teste', 'teste', '$2y$10$t8Iov1J.UsJkxA065rnp8uIhMtZUuARtTF.cFVPouiFUlUQJbgtHO', 'aluno', NULL, '123.456.789-00', '2025-06-16'),
(12, 'pedro', 'pedro', '$2y$10$/YvrYw0sAl9cdYawi5wT6O0EEAOkAMUXsq86vyrHL94zuLxzpJz.u', 'aluno', '2;6;', '123.123.123-12', '2025-06-13');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
