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
-- Índices de tabela `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
