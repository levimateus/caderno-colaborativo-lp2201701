-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 10-Maio-2017 às 02:57
-- Versão do servidor: 10.1.16-MariaDB
-- PHP Version: 7.0.9

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
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `usuario_id` int(11) NOT NULL,
  `usuario_nome` varchar(25) NOT NULL,
  `usuario_sobrenome` varchar(50) NOT NULL,
  `usuario_data_nasc` datetime NOT NULL,
  `usuario_data_cadastro` datetime NOT NULL,
  `usuario_prontuario` varchar(8) NOT NULL,
  `usuario_email` varchar(50) DEFAULT NULL,
  `usuario_senha` varchar(41) NOT NULL,
  `usuario_descricao` varchar(140) DEFAULT NULL,
  `usuario_cargo` tinyint(1) DEFAULT NULL,
  `usuario_experiencia` int(11) DEFAULT NULL,
  `usuario_estado_acesso` tinyint(1) DEFAULT NULL,
  `media_id` int(11) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`usuario_id`, `usuario_nome`, `usuario_sobrenome`, `usuario_data_nasc`, `usuario_data_cadastro`, `usuario_prontuario`, `usuario_email`, `usuario_senha`, `usuario_descricao`, `usuario_cargo`, `usuario_experiencia`, `usuario_estado_acesso`, `media_id`, `remember_token`) VALUES
(1, 'Jose', 'Silva', '1997-05-09 00:00:00', '2017-05-09 00:00:00', '1234567', 'email@email.com', 'e10adc3949ba59abbe56e057f20f883e', NULL, 0, 0, 0, NULL, NULL);

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usuario_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`media_id`) REFERENCES `midia` (`midia_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
