-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 28-Out-2019 às 16:42
-- Versão do servidor: 10.1.13-MariaDB
-- PHP Version: 5.5.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cumat`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `hybbe_clients`
--

CREATE TABLE `hybbe_clients` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client` enum('0','24','60') DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `hybbe_comentarios`
--

CREATE TABLE `hybbe_comentarios` (
  `id` int(20) NOT NULL,
  `id_post` int(20) NOT NULL,
  `comentario` tinytext,
  `autor` int(11) DEFAULT NULL,
  `data` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `hybbe_curtidas`
--

CREATE TABLE `hybbe_curtidas` (
  `id` int(20) NOT NULL,
  `id_post` int(100) NOT NULL,
  `usercurtiu` int(255) DEFAULT NULL,
  `status` enum('0','1','2') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `hybbe_eventos`
--

CREATE TABLE `hybbe_eventos` (
  `id` int(11) NOT NULL,
  `title` varchar(25) DEFAULT NULL,
  `description` varchar(40) DEFAULT NULL,
  `type` enum('atividade','evento') DEFAULT NULL,
  `link` varchar(500) DEFAULT NULL,
  `image` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `hybbe_formularios`
--

CREATE TABLE `hybbe_formularios` (
  `id` int(11) NOT NULL,
  `id_post` int(11) DEFAULT NULL,
  `user_send` int(11) DEFAULT NULL,
  `usernames` text,
  `data` int(11) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `message` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `hybbe_geral`
--

CREATE TABLE `hybbe_geral` (
  `id` int(6) NOT NULL,
  `hotelname` varchar(255) NOT NULL DEFAULT 'Habbo',
  `site` varchar(255) NOT NULL DEFAULT 'http://localhost/',
  `host` varchar(30) DEFAULT NULL,
  `port` int(10) DEFAULT NULL,
  `external_variables` text,
  `external_override_variables` text,
  `external_flash_texts` text,
  `external_flash_override_texts` text,
  `figuredata` text,
  `figuremap` text,
  `furnidata` text,
  `flash_client_url` text,
  `productdata` text,
  `avatarimage` varchar(255) NOT NULL DEFAULT 'http://www.habbo.fr/habbo-imaging/',
  `manutencao` enum('true','false') NOT NULL DEFAULT 'false',
  `facebook` text NOT NULL,
  `twitter` text NOT NULL,
  `discord` text NOT NULL,
  `recaptcha` varchar(255) NOT NULL,
  `moedas` varchar(255) NOT NULL DEFAULT '5000',
  `gemas` int(11) NOT NULL DEFAULT '0',
  `rubis` int(11) NOT NULL DEFAULT '0',
  `missao` text,
  `rank` int(11) NOT NULL DEFAULT '1',
  `figure` varchar(300) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `hybbe_geral`
--

INSERT INTO `hybbe_geral` (`id`, `hotelname`, `site`, `host`, `port`, `external_variables`, `external_override_variables`, `external_flash_texts`, `external_flash_override_texts`, `figuredata`, `figuremap`, `furnidata`, `flash_client_url`, `productdata`, `avatarimage`, `manutencao`, `facebook`, `twitter`, `discord`, `recaptcha`, `moedas`, `gemas`, `rubis`, `missao`, `rank`, `figure`) VALUES
(1, 'Hybbe Hotel', 'http://hybbe.top', '149.56.228.59', 30000, 'http://hybbe.top/swfs/gamedata/external_variables.txt', 'http://hybbe.top/swfs/gamedata/override/external_override_variables.txt', 'http://hybbe.top/swfs/gamedata/external_flash_texts.txt', 'http://hybbe.top/swfs/gamedata/override/external_override_texts.txt', 'http://hybbe.top/swfs/gamedata/figuredata.xml', 'http://hybbe.top/swfs/gamedata/figuremap.xml', 'http://hybbe.top/swfs/gamedata/furnidatar.xml', 'http://hybbe.top/swfs/gordon/PRODUCTION-201611291003-338511768', 'http://hybbe.top/swfs/gamedata/productdata.txt', 'https://habbo.city/habbo-imaging/avatarimage?', 'false', '', '', '', '6LeithcUAAAAALOJSL9xA3eZADvfYcyzI6NUIfxE', '5000', 0, 0, 'Acabei de chegar no Hybbe Hotel!', 1, 'ea-990000128-153640-153640.wa-990000069-94-85.ch-877-81-1408.hd-180-1.ha-990000132-63-153640.he-990000148-153640.sh-987462842-81.ca-990000126-153640-153640.fa-990000146-153640.hr-990000131-39-158639.lg-275-81.cc-987462858-153638');

-- --------------------------------------------------------

--
-- Estrutura da tabela `hybbe_logs_loja`
--

CREATE TABLE `hybbe_logs_loja` (
  `id` int(11) NOT NULL,
  `user_comprou` int(11) DEFAULT NULL,
  `pacote` varchar(5000) DEFAULT NULL,
  `valor` int(11) DEFAULT NULL,
  `data` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `hybbe_recados`
--

CREATE TABLE `hybbe_recados` (
  `id` int(11) NOT NULL,
  `user_deixou` varchar(11) DEFAULT NULL,
  `para_user` varchar(11) DEFAULT NULL,
  `time_recado` int(11) DEFAULT NULL,
  `recado` varchar(5000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hybbe_clients`
--
ALTER TABLE `hybbe_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hybbe_comentarios`
--
ALTER TABLE `hybbe_comentarios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hybbe_curtidas`
--
ALTER TABLE `hybbe_curtidas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hybbe_eventos`
--
ALTER TABLE `hybbe_eventos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hybbe_formularios`
--
ALTER TABLE `hybbe_formularios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hybbe_geral`
--
ALTER TABLE `hybbe_geral`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hybbe_logs_loja`
--
ALTER TABLE `hybbe_logs_loja`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hybbe_recados`
--
ALTER TABLE `hybbe_recados`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hybbe_clients`
--
ALTER TABLE `hybbe_clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hybbe_comentarios`
--
ALTER TABLE `hybbe_comentarios`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hybbe_curtidas`
--
ALTER TABLE `hybbe_curtidas`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hybbe_eventos`
--
ALTER TABLE `hybbe_eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hybbe_formularios`
--
ALTER TABLE `hybbe_formularios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hybbe_geral`
--
ALTER TABLE `hybbe_geral`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `hybbe_logs_loja`
--
ALTER TABLE `hybbe_logs_loja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hybbe_recados`
--
ALTER TABLE `hybbe_recados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
