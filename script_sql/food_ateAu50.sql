-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 21-Ago-2021 às 16:32
-- Versão do servidor: 10.4.20-MariaDB
-- versão do PHP: 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `food`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(3, '2021-08-13-213444', 'App\\Database\\Migrations\\CriaTabelaUsuarios', 'default', 'App', 1628891180, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(5) UNSIGNED NOT NULL,
  `nome` varchar(128) NOT NULL,
  `email` varchar(255) NOT NULL,
  `cpf` varchar(20) DEFAULT NULL,
  `telefone` varchar(20) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `is_ativo` tinyint(1) NOT NULL DEFAULT 0,
  `password_hash` varchar(255) NOT NULL,
  `ativacao_hash` varchar(64) DEFAULT NULL,
  `reset_hash` varchar(64) DEFAULT NULL,
  `reset_expira_em` datetime DEFAULT NULL,
  `criado_em` datetime DEFAULT NULL,
  `atualizado_em` datetime DEFAULT NULL,
  `deletado_em` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `cpf`, `telefone`, `is_admin`, `is_ativo`, `password_hash`, `ativacao_hash`, `reset_hash`, `reset_expira_em`, `criado_em`, `atualizado_em`, `deletado_em`) VALUES
(1, 'Lucio2 Antonio de Souza', 'admin@admin.com', '219.488.760-19', '(41) 99999-9999', 1, 1, '$2y$10$TGv/b5iSjo6yGxwTRhT/YOip3SiGqKs8vyjKkDtGd.KZJ1GMuDONq', NULL, NULL, NULL, '2021-08-13 17:00:42', '2021-08-13 18:11:16', NULL),
(2, 'Fulano de Silva Souza', 'fulanodetal@gmail.com', '929.549.330-38', '(41) 88889-9999', 1, 1, '$2y$10$GmRhQAvo7tvcVuOdops6X.YUGfsVloYDCB1chpT.FZoA1wXAF/sle', NULL, NULL, NULL, '2021-08-13 17:00:42', '2021-08-20 19:05:21', NULL),
(3, 'Bruna', 'bb@gmail.com', '384.042.680-45', '(36) 98521-4785', 1, 1, '$2y$10$HvMU8F11BFecPE59zYpTquxBNLmOmgId/bY/8JjPHmIYcKIUEB8Zm', NULL, NULL, NULL, '2021-08-16 05:57:43', '2021-08-19 17:38:46', NULL),
(4, 'Marcele ', 'mm@gmail.com', '187.090.450-82', '(14) 78523-6985', 0, 1, '$2y$10$iDt05TkFV2eF6IllPqREE.f7joFDLbQ4OJrP/LyVoTHImKqGFiOnu', NULL, NULL, NULL, '2021-08-16 06:00:49', '2021-08-19 17:40:16', NULL),
(5, 'Marcele', 'm2m@gmail.com', '987.456.321-02', '(15) 9874-1269', 0, 1, '$2y$10$xNHYoglTI1mwksCeuuqy3ePqA7PKvZBCVpEBLp.J5rB6v5vLsGdWe', NULL, NULL, NULL, '2021-08-16 06:02:59', '2021-08-21 08:02:46', '2021-08-21 08:02:46'),
(6, 'Ana Paula Silva 2', 'ap@gmail.com', '001.579.840-28', '(15) 9487-3269', 0, 0, '$2y$10$RA5jGKVub.cBaspMoclQgOnPp6tE4yRniks1oBx0eVbtkM0OU5JCC', NULL, NULL, NULL, '2021-08-19 17:09:20', '2021-08-20 19:06:06', NULL),
(7, 'Iraci Medreiro Rocha', 'a11@gmail.com', '214.078.720-01', '(12) 4567-89', 1, 1, '$2y$10$wb6S8EabLOBpxMQaffiOC.LeGZ0JJxCKeSW5khHLEFHOpSYbr7RPq', NULL, NULL, NULL, '2021-08-19 17:44:23', '2021-08-20 19:03:51', NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `cpf` (`cpf`),
  ADD UNIQUE KEY `ativacao_hash` (`ativacao_hash`),
  ADD UNIQUE KEY `reset_hash` (`reset_hash`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
