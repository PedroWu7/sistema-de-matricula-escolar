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
(4, 3, 'kaue', 'bom', '2025-06-16 08:55:15'),
(6, 4, 'kaue', 'curso lixo', '2025-06-16 08:57:49'),
(7, 2, 'pedro', 'muito boa as aulas do professor', '2025-06-16 09:45:54');

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
(2, 'Curso de PHP', 'https://www.cursoemvideo.com/wp-content/uploads/2019/08/php.jpg', 'Aprenda PHP do zero e crie sites e sistemas dinâmicos com banco de dados.\r\n\r\n', 'pedro;', ''),
(3, 'Curso de C#', 'https://i.ytimg.com/vi/oTivhgjbhIg/maxresdefault.jpg', 'Domine os fundamentos do C# e programe aplicações com orientação a objetos.\r\n\r\n', 'kaue;', ''),
(4, 'Curso de Java', 'https://i.ytimg.com/vi/mxDMTtCEPAY/hq720.jpg?sqp=-oaymwEhCK4FEIIDSFryq4qpAxMIARUAAAAAGAElAADIQj0AgKJD&rs=AOn4CLAbxR_ldk5IsxV2dVUPhcyJrksDTA', 'Aprenda Java do básico à orientação a objetos e desenvolva aplicações robustas e seguras.\r\n\r\n', NULL, ''),
(6, 'Fazer bolos', 'https://aprender.buzzero.com/buzzers/enfermeiro-coelho/67883/HotSiteImage.jpg', 'Aprenda receitas práticas e técnicas para fazer bolos fofinhos, recheados e prontos para vender ou encantar a família.\r\n\r\n', 'pedro;', ''),
(7, 'Inglês Rápido para Viagens', 'https://i.ytimg.com/vi/rUP8vFRB-YY/maxresdefault.jpg', 'Um curso prático com frases-chave, vocabulário e simulações para quem vai viajar e precisa se comunicar bem.\r\n\r\n', '', ''),
(8, 'Marketing Digital para Iniciantes', 'https://static.dinamize.com.br/dinamizeszmsdg3x/uploads/2024/06/marketing-digital-para-iniciantes-5.png', 'Conheça os pilares do marketing digital: redes sociais, tráfego pago, SEO e funil de vendas.\r\n\r\n', NULL, ''),
(9, 'Design Gráfico para Iniciantes', 'https://i.ytimg.com/vi/EkdVg9u88-0/maxresdefault.jpg', 'Descubra os princípios básicos do design gráfico e comece a criar artes profissionais com ferramentas gratuitas.\r\n\r\n', NULL, '');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
