-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 21/07/2025 às 14:39
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
-- Banco de dados: `bd_soft_livr`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `discos`
--

CREATE TABLE `discos` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `cantor` varchar(255) NOT NULL,
  `faixas` int(11) NOT NULL,
  `gravadora` varchar(255) NOT NULL,
  `ano_lancamento` date NOT NULL,
  `quantidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `discos`
--

INSERT INTO `discos` (`id`, `titulo`, `cantor`, `faixas`, `gravadora`, `ano_lancamento`, `quantidade`) VALUES
(3, 'A Turma do Balão Mágico (Volume 1)', 'A Turma do Balão Mágico', 13, 'CBS (atualmente Sony Music)', '1982-01-01', 4),
(4, 'Os Grandes Sucessos', 'Chitãozinho & Xororó', 13, 'Nova (provavelmente selo da Continental ou da Copacabana)', '1987-01-01', 2),
(5, 'Mel (álbum)', 'Maria Bethânia', 13, 'Philips / Polygram', '1979-01-01', 7),
(6, 'Roberto Carlos – 1971', 'Roberto Carlos', 13, 'CBS/Columbia (futura Sony Music)', '1971-01-01', 4),
(7, 'Leandro & Leonardo (Volume 5)', 'Leandro & Leonardo', 12, 'Chantecler', '1991-01-01', 3),
(8, 'Zezé di Camargo & Luciano º', 'Zezé di Camargo & Luciano', 10, 'Columbia / Sony Music', '1991-01-01', 1),
(9, 'Talismã º', 'Maria Bethânia', 12, 'Philips / PolyGram', '1980-01-01', 4);

-- --------------------------------------------------------

--
-- Estrutura para tabela `livros`
--

CREATE TABLE `livros` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `autor` varchar(255) NOT NULL,
  `paginas` int(11) NOT NULL,
  `editora` varchar(255) NOT NULL,
  `ano_publicacao` date NOT NULL,
  `quantidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `livros`
--

INSERT INTO `livros` (`id`, `titulo`, `autor`, `paginas`, `editora`, `ano_publicacao`, `quantidade`) VALUES
(8, 'Jantar Secreto', 'Raphael Montes', 368, 'Companhia das Letras', '2016-10-14', 10),
(9, 'Suicidas', 'Raphael Montes', 342, 'Companhia das Letras', '2017-08-07', 5),
(10, 'Os segredos da mente milionaria', 'T. Harv Eker', 176, 'Editora Sextante', '2006-07-26', 10),
(11, 'A psicologia financeira', 'Morgan Housel', 304, 'HarperCollins', '2021-03-15', 15),
(12, 'Pai Rico, pai Pobre', 'Robert T. Kiyosaki', 336, 'Alta Books', '2017-07-26', 2),
(13, 'Café com Deus Pai 2025', 'Morgan Housel', 424, 'Editora Vélos', '2024-09-17', 8),
(14, 'O cálice dos Deuses: Série Percy Jackson e os olimpianos', 'Rick Riordan', 272, 'Intrínseca', '2023-09-26', 7);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `ID` int(11) NOT NULL,
  `EMAIL` varchar(100) NOT NULL,
  `SENHA` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`ID`, `EMAIL`, `SENHA`) VALUES
(4, 'eduardo.rufino@rgk4it.com', '1234567UEM'),
(5, 'akirajaones@gmail.com', '1234567JAPONES'),
(6, 'andreobrabo@gmail.com', 'andreobrabo');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `discos`
--
ALTER TABLE `discos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `livros`
--
ALTER TABLE `livros`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `unique-senha` (`SENHA`),
  ADD UNIQUE KEY `unique-email` (`EMAIL`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `discos`
--
ALTER TABLE `discos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `livros`
--
ALTER TABLE `livros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
