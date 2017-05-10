-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 30-Abr-2017 às 23:02
-- Versão do servidor: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cadernocolaborativo`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `comentario`
--

CREATE TABLE `comentario` (
  `comentario_id` int(11) NOT NULL,
  `comentario_conteudo` varchar(140) NOT NULL,
  `comentario_pub_dt` datetime NOT NULL,
  `status` tinyint(1) NOT NULL,
  `publicacao_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `denuncia`
--

CREATE TABLE `denuncia` (
  `denuncia_id` int(11) NOT NULL,
  `denuncia_motivo` int(3) NOT NULL,
  `denuncia_dt` datetime NOT NULL,
  `usuario_id_autor` int(11) NOT NULL,
  `usuario_id_avaliador` int(11) NOT NULL,
  `publicacao_id` int(11) NOT NULL,
  `comentario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `iftag`
--

CREATE TABLE `iftag` (
  `iftag_id` int(11) NOT NULL,
  `iftag_nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `likes_relacionamento`
--

CREATE TABLE `likes_relacionamento` (
  `usuario_id` int(11) NOT NULL,
  `publicacao_id` int(11) NOT NULL,
  `comentario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `midia`
--

CREATE TABLE `midia` (
  `midia_id` int(11) NOT NULL,
  `midia_tipo` int(3) NOT NULL,
  `midia_href` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `publicacao`
--

CREATE TABLE `publicacao` (
  `publicacao_id` int(11) NOT NULL,
  `publicacao_status` tinyint(1) NOT NULL,
  `publicacao_dt` datetime NOT NULL,
  `usuario_id_autor` int(11) NOT NULL,
  `usuario_id_professor` int(11) NOT NULL,
  `publicacao_area` varchar(50) NOT NULL,
  `publicacao_descricao` varchar(675) NOT NULL,
  `publicacao_tags` varchar(100) NOT NULL,
  `midia_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `relacionamento_interesses`
--

CREATE TABLE `relacionamento_interesses` (
  `usuario_id` int(11) NOT NULL,
  `iftag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `relacionamento_seguidores`
--

CREATE TABLE `relacionamento_seguidores` (
  `usuario_id_seguidor` int(11) NOT NULL,
  `usuario_id_seguindo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `usuario_id` int(11) NOT NULL,
  `usuario_nome` varchar(25) NOT NULL,
  `usuario_sobrenome` varchar(50) NOT NULL,
  `usuario_data_nasc` date DEFAULT NULL,
  `usuario_data_cadastro` datetime DEFAULT NULL,
  `usuario_prontuario` varchar(8) NOT NULL,
  `usuario_email` varchar(50) NOT NULL,
  `usuario_senha` varchar(41) NOT NULL,
  `usuario_descricao` varchar(140) NOT NULL,
  `usuario_cargo` tinyint(1) NOT NULL,
  `usuario_experiencia` int(11) NOT NULL,
  `usuario_estado_acesso` tinyint(1) NOT NULL,
  `media_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`usuario_id`, `usuario_nome`, `usuario_sobrenome`, `usuario_data_nasc`, `usuario_data_cadastro`, `usuario_prontuario`, `usuario_email`, `usuario_senha`, `usuario_descricao`, `usuario_cargo`, `usuario_experiencia`, `usuario_estado_acesso`, `media_id`) VALUES
(3, 'giovani', 'fonseca', '1990-12-12', '2017-04-30 00:00:00', '123456', 'g@ifsp.edu.br', '5f4dcc3b5aa765d61d8327deb882cf99', 'oieee', 3, 0, 1, NULL),
(4, 'password', 'password', '0000-00-00', '0000-00-00 00:00:00', '', 'password@password.com', '5f4dcc3b5aa765d61d8327deb882cf99', '1', 2, 2, 1, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`comentario_id`),
  ADD KEY `fk_publicacao_comentario` (`publicacao_id`),
  ADD KEY `fk_usuario_comentario` (`usuario_id`);

--
-- Indexes for table `denuncia`
--
ALTER TABLE `denuncia`
  ADD PRIMARY KEY (`denuncia_id`),
  ADD KEY `fk_denuncia_autor` (`usuario_id_autor`),
  ADD KEY `fk_denuncia_avaliador` (`usuario_id_avaliador`),
  ADD KEY `fk_publicacao` (`publicacao_id`),
  ADD KEY `fk_comentario` (`comentario_id`);

--
-- Indexes for table `iftag`
--
ALTER TABLE `iftag`
  ADD PRIMARY KEY (`iftag_id`);

--
-- Indexes for table `likes_relacionamento`
--
ALTER TABLE `likes_relacionamento`
  ADD KEY `fk_usuario_likes` (`usuario_id`),
  ADD KEY `fk_publicacao_likes` (`publicacao_id`),
  ADD KEY `fk_comentario_likes` (`comentario_id`);

--
-- Indexes for table `midia`
--
ALTER TABLE `midia`
  ADD PRIMARY KEY (`midia_id`);

--
-- Indexes for table `publicacao`
--
ALTER TABLE `publicacao`
  ADD PRIMARY KEY (`publicacao_id`),
  ADD KEY `fk_usuario_publicacao_autor` (`usuario_id_autor`),
  ADD KEY `fk_usuario_publicacao_professor` (`usuario_id_professor`);

--
-- Indexes for table `relacionamento_interesses`
--
ALTER TABLE `relacionamento_interesses`
  ADD KEY `fk_usuario_interesses` (`usuario_id`),
  ADD KEY `fk_iftag_interesse` (`iftag_id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `iftag_id` (`iftag_id`),
  ADD KEY `usuario_id_2` (`usuario_id`);

--
-- Indexes for table `relacionamento_seguidores`
--
ALTER TABLE `relacionamento_seguidores`
  ADD KEY `fk_usuario_seguidor` (`usuario_id_seguidor`),
  ADD KEY `fk_usuario_seguindo` (`usuario_id_seguindo`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usuario_id`),
  ADD UNIQUE KEY `prontuario` (`usuario_prontuario`),
  ADD UNIQUE KEY `email` (`usuario_email`),
  ADD KEY `fk_media` (`media_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comentario`
--
ALTER TABLE `comentario`
  MODIFY `comentario_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `denuncia`
--
ALTER TABLE `denuncia`
  MODIFY `denuncia_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `iftag`
--
ALTER TABLE `iftag`
  MODIFY `iftag_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `midia`
--
ALTER TABLE `midia`
  MODIFY `midia_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `publicacao`
--
ALTER TABLE `publicacao`
  MODIFY `publicacao_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usuario_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `comentario_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`),
  ADD CONSTRAINT `comentario_ibfk_2` FOREIGN KEY (`publicacao_id`) REFERENCES `publicacao` (`publicacao_id`);

--
-- Limitadores para a tabela `denuncia`
--
ALTER TABLE `denuncia`
  ADD CONSTRAINT `denuncia_ibfk_1` FOREIGN KEY (`comentario_id`) REFERENCES `comentario` (`comentario_id`),
  ADD CONSTRAINT `denuncia_ibfk_2` FOREIGN KEY (`publicacao_id`) REFERENCES `publicacao` (`publicacao_id`),
  ADD CONSTRAINT `denuncia_ibfk_3` FOREIGN KEY (`usuario_id_autor`) REFERENCES `usuario` (`usuario_id`),
  ADD CONSTRAINT `denuncia_ibfk_4` FOREIGN KEY (`usuario_id_avaliador`) REFERENCES `usuario` (`usuario_id`);

--
-- Limitadores para a tabela `likes_relacionamento`
--
ALTER TABLE `likes_relacionamento`
  ADD CONSTRAINT `likes_relacionamento_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`),
  ADD CONSTRAINT `likes_relacionamento_ibfk_2` FOREIGN KEY (`publicacao_id`) REFERENCES `publicacao` (`publicacao_id`),
  ADD CONSTRAINT `likes_relacionamento_ibfk_3` FOREIGN KEY (`comentario_id`) REFERENCES `comentario` (`comentario_id`);

--
-- Limitadores para a tabela `publicacao`
--
ALTER TABLE `publicacao`
  ADD CONSTRAINT `publicacao_ibfk_1` FOREIGN KEY (`usuario_id_autor`) REFERENCES `usuario` (`usuario_id`),
  ADD CONSTRAINT `publicacao_ibfk_2` FOREIGN KEY (`usuario_id_professor`) REFERENCES `usuario` (`usuario_id`);

--
-- Limitadores para a tabela `relacionamento_interesses`
--
ALTER TABLE `relacionamento_interesses`
  ADD CONSTRAINT `relacionamento_interesses_ibfk_1` FOREIGN KEY (`iftag_id`) REFERENCES `iftag` (`iftag_id`),
  ADD CONSTRAINT `relacionamento_interesses_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`);

--
-- Limitadores para a tabela `relacionamento_seguidores`
--
ALTER TABLE `relacionamento_seguidores`
  ADD CONSTRAINT `relacionamento_seguidores_ibfk_1` FOREIGN KEY (`usuario_id_seguidor`) REFERENCES `usuario` (`usuario_id`),
  ADD CONSTRAINT `relacionamento_seguidores_ibfk_2` FOREIGN KEY (`usuario_id_seguindo`) REFERENCES `usuario` (`usuario_id`);

--
-- Limitadores para a tabela `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`media_id`) REFERENCES `midia` (`midia_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
