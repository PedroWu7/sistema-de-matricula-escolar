-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 13/06/2025 às 00:12
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

-- --------------------------------------------------------

--
-- Estrutura para tabela `comentarios`
--

CREATE TABLE `comentarios` (
  `id` int(11) NOT NULL,
  `curso_id` int(11) NOT NULL,
  `autor` varchar(100) NOT NULL,
  `texto` text NOT NULL,
  `horario` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `comentarios`
--

INSERT INTO `comentarios` (`id`, `curso_id`, `autor`, `texto`, `horario`) VALUES
(1, 2, 'teste', 'oi', '2025-06-12 16:19:11'),
(2, 2, 'teste', 'dsa', '2025-06-12 16:53:58'),
(3, 2, 'teste', 'dsa', '2025-06-12 16:54:21');

-- --------------------------------------------------------

--
-- Estrutura para tabela `cursos`
--

CREATE TABLE `cursos` (
  `id` int(11) NOT NULL,
  `nome` varchar(64) NOT NULL,
  `imagem` varchar(256) NOT NULL,
  `descricao` varchar(512) NOT NULL,
  `alunos` varchar(255) DEFAULT NULL,
  `professor` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cursos`
--

INSERT INTO `cursos` (`id`, `nome`, `imagem`, `descricao`, `alunos`, `professor`) VALUES
(2, 'Curso de PHP', 'https://www.cursoemvideo.com/wp-content/uploads/2019/08/php.jpg', 'Curso muito bom de PHP', 'teste;', NULL),
(3, 'Curso de C#', 'https://i.ytimg.com/vi/oTivhgjbhIg/maxresdefault.jpg', 'Curso topzeira de C#', NULL, NULL),
(4, 'Curso de Java', 'https://i.ytimg.com/vi/mxDMTtCEPAY/hq720.jpg?sqp=-oaymwEhCK4FEIIDSFryq4qpAxMIARUAAAAAGAElAADIQj0AgKJD&rs=AOn4CLAbxR_ldk5IsxV2dVUPhcyJrksDTA', 'Melhor curso de Java', NULL, NULL),
(6, 'Fazer bolos', 'https://aprender.buzzero.com/buzzers/enfermeiro-coelho/67883/HotSiteImage.jpg', 'melhor curso de bolos', NULL, '0');

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
-- Índices de tabela `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `alunos`
--
ALTER TABLE `alunos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
