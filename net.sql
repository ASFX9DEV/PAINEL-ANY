-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 14/07/2023 às 12:50
-- Versão do servidor: 8.0.33-cll-lve
-- Versão do PHP: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `grhgrkyk_anymod`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `configsany`
--

CREATE TABLE `configsany` (
  `id` int NOT NULL,
  `nome` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `valor` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `configsany`
--

INSERT INTO `configsany` (`id`, `nome`, `valor`) VALUES
(1, 'versao', '1'),
(2, 'notas', 'Nova atualização'),
(3, 'Saudacao', 'Bem-vindo'),
(4, 'update', 'http://LINK-UPDATE/any/update.php'),
(5, 'contato', ''),
(6, 'LinkBanner', 'http://fundo.com.br/'),
(7, 'LinkBackground', 'http://logo.com.br/'),
(8, 'termos', 'link-termos'),
(9, 'checkuser', 'true'),
(10, 'msg', 'teste');

-- --------------------------------------------------------

--
-- Estrutura para tabela `configuracoes`
--

CREATE TABLE `configuracoes` (
  `id` int NOT NULL,
  `id_owner` int NOT NULL,
  `versao` int NOT NULL DEFAULT '2',
  `notas` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `sms` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `att` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contato` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `termos` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `checkuser` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mensagem` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `att_msg` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `login`
--

CREATE TABLE `login` (
  `id` int NOT NULL,
  `id_cad` int NOT NULL DEFAULT '0',
  `acesso` int NOT NULL DEFAULT '3',
  `nome` varchar(250) DEFAULT NULL,
  `login` varchar(250) DEFAULT NULL,
  `senha` varchar(250) DEFAULT NULL,
  `senha2` varchar(250) DEFAULT NULL,
  `expiredate` varchar(250) DEFAULT NULL,
  `cota` varchar(250) NOT NULL DEFAULT '0',
  `operadora` varchar(250) DEFAULT NULL,
  `derrubado` varchar(250) DEFAULT '0',
  `bloqueado` varchar(11) NOT NULL DEFAULT 'N',
  `LimiteTeste` varchar(250) NOT NULL DEFAULT '-1',
  `data` varchar(250) DEFAULT NULL,
  `ValorCobrado` varchar(250) DEFAULT NULL,
  `msginterna` longtext,
  `email` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `login`
--

INSERT INTO `login` (`id`, `id_cad`, `acesso`, `nome`, `login`, `senha`, `senha2`, `expiredate`, `cota`, `operadora`, `derrubado`, `bloqueado`, `LimiteTeste`, `data`, `ValorCobrado`, `msginterna`, `email`) VALUES
(1, 1, 1, 'administrador', 'admin', '21232f297a57a5a743894a0e4a801fc3', '87216675', '', '999999999999999995', 'Uny Serve', '0', 'N', '', NULL, '', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `payloadsany`
--

CREATE TABLE `payloadsany` (
  `id` int NOT NULL,
  `Name` varchar(200) DEFAULT NULL,
  `Servidor` varchar(300) NOT NULL DEFAULT '',
  `SPort` varchar(300) NOT NULL DEFAULT '',
  `Prox` varchar(300) NOT NULL DEFAULT '192.168.0.1:80',
  `Payload` varchar(900) NOT NULL DEFAULT '',
  `Direct` varchar(900) NOT NULL DEFAULT '',
  `Sni` varchar(200) NOT NULL DEFAULT '',
  `Payssl` varchar(900) NOT NULL DEFAULT '',
  `Certopen` varchar(300) NOT NULL DEFAULT '',
  `Dns1` varchar(100) NOT NULL DEFAULT '8.8.8.8',
  `Dns2` varchar(100) NOT NULL DEFAULT '8.8.4.4',
  `UrlPainel` varchar(500) NOT NULL DEFAULT '',
  `VPNMod` varchar(100) NOT NULL DEFAULT '0',
  `VPNTunMod` varchar(100) NOT NULL DEFAULT '1',
  `Info` varchar(300) NOT NULL DEFAULT 'CloudFlare:tim',
  `DefaultProxy` varchar(100) NOT NULL DEFAULT 'true',
  `CustomSquid` varchar(100) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `payloadsany`
--

INSERT INTO `payloadsany` (`id`, `Name`, `Servidor`, `SPort`, `Prox`, `Payload`, `Direct`, `Sni`, `Payssl`, `Certopen`, `Dns1`, `Dns2`, `UrlPainel`, `VPNMod`, `VPNTunMod`, `Info`, `DefaultProxy`, `CustomSquid`) VALUES
(14, 'Muquifo 2', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(15, 'Muquifo 22', 'rrrrr', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Estrutura para tabela `servidores`
--

CREATE TABLE `servidores` (
  `id` int NOT NULL,
  `Name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `TYPE` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'premium',
  `FLAG` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'br.png',
  `ServerIP` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `CheckUser` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ServerPort` int NOT NULL DEFAULT '22',
  `SSLPort` int NOT NULL,
  `USER` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `PASS` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `configsany`
--
ALTER TABLE `configsany`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `configuracoes`
--
ALTER TABLE `configuracoes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `payloadsany`
--
ALTER TABLE `payloadsany`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `configsany`
--
ALTER TABLE `configsany`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `login`
--
ALTER TABLE `login`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50135;

--
-- AUTO_INCREMENT de tabela `payloadsany`
--
ALTER TABLE `payloadsany`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
