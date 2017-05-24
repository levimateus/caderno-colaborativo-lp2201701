-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.1.16-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win32
-- HeidiSQL Versão:              9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Copiando estrutura do banco de dados para cadernocolaborativo
CREATE DATABASE IF NOT EXISTS `cadernocolaborativo` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `cadernocolaborativo`;

-- Copiando estrutura para tabela cadernocolaborativo.comentario
CREATE TABLE IF NOT EXISTS `comentario` (
  `comentario_id` int(11) NOT NULL AUTO_INCREMENT,
  `comentario_conteudo` varchar(140) NOT NULL,
  `comentario_pub_dt` datetime NOT NULL,
  `status` tinyint(1) NOT NULL,
  `publicacao_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  PRIMARY KEY (`comentario_id`),
  KEY `fk_publicacao_comentario` (`publicacao_id`),
  KEY `fk_usuario_comentario` (`usuario_id`),
  CONSTRAINT `comentario_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`),
  CONSTRAINT `comentario_ibfk_2` FOREIGN KEY (`publicacao_id`) REFERENCES `publicacao` (`publicacao_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela cadernocolaborativo.comentario: ~8 rows (aproximadamente)
/*!40000 ALTER TABLE `comentario` DISABLE KEYS */;
INSERT IGNORE INTO `comentario` (`comentario_id`, `comentario_conteudo`, `comentario_pub_dt`, `status`, `publicacao_id`, `usuario_id`) VALUES
	(1, 'aaaaaa', '2017-05-23 22:55:09', 1, 9, 3),
	(2, 'aaaaaaaaaaa', '2017-05-23 22:55:14', 1, 9, 3),
	(3, 'Vmo comenta aqui manooo', '2017-05-23 22:55:55', 1, 10, 3),
	(4, 'aaaa', '2017-05-23 22:57:10', 1, 9, 3),
	(5, 'aaaaaaa', '2017-05-23 23:05:24', 1, 11, 3),
	(6, 'aaaaaaaaaaaa', '2017-05-23 23:05:27', 1, 11, 3),
	(7, 'aaaaaaaaaaaaaaa', '2017-05-23 23:05:31', 1, 11, 3),
	(8, 'aaa', '2017-05-23 23:22:47', 1, 9, 3),
	(9, 'aaaaa', '2017-05-24 00:22:48', 1, 12, 3);
/*!40000 ALTER TABLE `comentario` ENABLE KEYS */;

-- Copiando estrutura para tabela cadernocolaborativo.denuncia
CREATE TABLE IF NOT EXISTS `denuncia` (
  `denuncia_id` int(11) NOT NULL AUTO_INCREMENT,
  `denuncia_motivo` tinytext NOT NULL,
  `denuncia_dt` datetime NOT NULL,
  `usuario_id_autor` int(11) NOT NULL,
  `usuario_id_avaliador` int(11) NOT NULL,
  `publicacao_id` int(11) DEFAULT NULL,
  `comentario_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`denuncia_id`),
  KEY `fk_denuncia_autor` (`usuario_id_autor`),
  KEY `fk_denuncia_avaliador` (`usuario_id_avaliador`),
  KEY `fk_publicacao` (`publicacao_id`),
  KEY `fk_comentario` (`comentario_id`),
  CONSTRAINT `denuncia_ibfk_1` FOREIGN KEY (`comentario_id`) REFERENCES `comentario` (`comentario_id`),
  CONSTRAINT `denuncia_ibfk_2` FOREIGN KEY (`publicacao_id`) REFERENCES `publicacao` (`publicacao_id`),
  CONSTRAINT `denuncia_ibfk_3` FOREIGN KEY (`usuario_id_autor`) REFERENCES `usuario` (`usuario_id`),
  CONSTRAINT `denuncia_ibfk_4` FOREIGN KEY (`usuario_id_avaliador`) REFERENCES `usuario` (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela cadernocolaborativo.denuncia: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `denuncia` DISABLE KEYS */;
INSERT IGNORE INTO `denuncia` (`denuncia_id`, `denuncia_motivo`, `denuncia_dt`, `usuario_id_autor`, `usuario_id_avaliador`, `publicacao_id`, `comentario_id`) VALUES
	(1, 'aaaaa', '2017-05-24 00:03:43', 3, 3, 10, NULL),
	(2, 'aaaaaaaaaa', '2017-05-24 00:22:13', 3, 3, 11, NULL),
	(3, 'Odiei', '2017-05-24 00:22:57', 3, 3, 12, NULL);
/*!40000 ALTER TABLE `denuncia` ENABLE KEYS */;

-- Copiando estrutura para tabela cadernocolaborativo.iftag
CREATE TABLE IF NOT EXISTS `iftag` (
  `iftag_id` int(11) NOT NULL AUTO_INCREMENT,
  `iftag_nome` varchar(50) NOT NULL,
  PRIMARY KEY (`iftag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela cadernocolaborativo.iftag: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `iftag` DISABLE KEYS */;
/*!40000 ALTER TABLE `iftag` ENABLE KEYS */;

-- Copiando estrutura para tabela cadernocolaborativo.likes_relacionamento
CREATE TABLE IF NOT EXISTS `likes_relacionamento` (
  `usuario_id` int(11) NOT NULL,
  `publicacao_id` int(11) NOT NULL,
  `comentario_id` int(11) NOT NULL,
  KEY `fk_usuario_likes` (`usuario_id`),
  KEY `fk_publicacao_likes` (`publicacao_id`),
  KEY `fk_comentario_likes` (`comentario_id`),
  CONSTRAINT `likes_relacionamento_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`),
  CONSTRAINT `likes_relacionamento_ibfk_2` FOREIGN KEY (`publicacao_id`) REFERENCES `publicacao` (`publicacao_id`),
  CONSTRAINT `likes_relacionamento_ibfk_3` FOREIGN KEY (`comentario_id`) REFERENCES `comentario` (`comentario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela cadernocolaborativo.likes_relacionamento: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `likes_relacionamento` DISABLE KEYS */;
/*!40000 ALTER TABLE `likes_relacionamento` ENABLE KEYS */;

-- Copiando estrutura para tabela cadernocolaborativo.midia
CREATE TABLE IF NOT EXISTS `midia` (
  `midia_id` int(11) NOT NULL AUTO_INCREMENT,
  `midia_tipo` int(3) NOT NULL,
  `midia_href` varchar(250) NOT NULL,
  PRIMARY KEY (`midia_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela cadernocolaborativo.midia: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `midia` DISABLE KEYS */;
INSERT IGNORE INTO `midia` (`midia_id`, `midia_tipo`, `midia_href`) VALUES
	(7, 1, 'publicacoes/MzzTxVHJCSFXQyc6HUVzo6ojvtP3Xx6OcoYMytt1.jpeg'),
	(8, 1, 'publicacoes/ZxjWwmPXj1GUlvoCZzR6eZeUe9SEwNRdbb8eXea9.jpeg'),
	(9, 1, 'usuarios/hK5pUrlOOqiB64RDpl2F8WR8MRDnsxLmPWxGFU8J.jpeg'),
	(10, 1, 'publicacoes/wuorTsid6qqlXK64fpN4jHGAPRx1ejFJnoAyjsth.jpeg'),
	(11, 1, 'publicacoes/iaAaF9NmmFPRxi2yDEbTzGF33QqaekCKKgFVfxKW.jpeg');
/*!40000 ALTER TABLE `midia` ENABLE KEYS */;

-- Copiando estrutura para tabela cadernocolaborativo.publicacao
CREATE TABLE IF NOT EXISTS `publicacao` (
  `publicacao_id` int(11) NOT NULL AUTO_INCREMENT,
  `publicacao_status` tinyint(1) NOT NULL,
  `publicacao_dt` datetime NOT NULL,
  `usuario_id_autor` int(11) NOT NULL,
  `usuario_id_professor` int(11) NOT NULL,
  `publicacao_area` varchar(50) NOT NULL,
  `publicacao_descricao` varchar(675) NOT NULL,
  `publicacao_tags` varchar(100) NOT NULL,
  `midia_id` int(11) NOT NULL,
  PRIMARY KEY (`publicacao_id`),
  KEY `fk_usuario_publicacao_autor` (`usuario_id_autor`),
  KEY `fk_usuario_publicacao_professor` (`usuario_id_professor`),
  CONSTRAINT `publicacao_ibfk_1` FOREIGN KEY (`usuario_id_autor`) REFERENCES `usuario` (`usuario_id`),
  CONSTRAINT `publicacao_ibfk_2` FOREIGN KEY (`usuario_id_professor`) REFERENCES `usuario` (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela cadernocolaborativo.publicacao: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `publicacao` DISABLE KEYS */;
INSERT IGNORE INTO `publicacao` (`publicacao_id`, `publicacao_status`, `publicacao_dt`, `usuario_id_autor`, `usuario_id_professor`, `publicacao_area`, `publicacao_descricao`, `publicacao_tags`, `midia_id`) VALUES
	(9, 2, '2017-05-23 22:55:05', 3, 3, 'ADS', 'aaaaaaaaa', 'aaaaaa', 7),
	(10, 1, '2017-05-23 22:55:46', 3, 3, 'ADS', 'aaaaaaaaaaaa', 'aaaaaaaaaaa', 8),
	(11, 1, '2017-05-23 23:05:16', 3, 3, 'ADS', 'aaaaaaaaaa', 'aaaaaaaaaaaaa', 10),
	(12, 1, '2017-05-24 00:22:42', 3, 3, 'ADS', 'sales', 'aaaaaaaaaaa', 11);
/*!40000 ALTER TABLE `publicacao` ENABLE KEYS */;

-- Copiando estrutura para tabela cadernocolaborativo.relacionamento_interesses
CREATE TABLE IF NOT EXISTS `relacionamento_interesses` (
  `usuario_id` int(11) NOT NULL,
  `iftag_id` int(11) NOT NULL,
  KEY `fk_usuario_interesses` (`usuario_id`),
  KEY `fk_iftag_interesse` (`iftag_id`),
  KEY `usuario_id` (`usuario_id`),
  KEY `iftag_id` (`iftag_id`),
  KEY `usuario_id_2` (`usuario_id`),
  CONSTRAINT `relacionamento_interesses_ibfk_1` FOREIGN KEY (`iftag_id`) REFERENCES `iftag` (`iftag_id`),
  CONSTRAINT `relacionamento_interesses_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela cadernocolaborativo.relacionamento_interesses: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `relacionamento_interesses` DISABLE KEYS */;
/*!40000 ALTER TABLE `relacionamento_interesses` ENABLE KEYS */;

-- Copiando estrutura para tabela cadernocolaborativo.relacionamento_seguidores
CREATE TABLE IF NOT EXISTS `relacionamento_seguidores` (
  `usuario_id_seguidor` int(11) NOT NULL,
  `usuario_id_seguindo` int(11) NOT NULL,
  KEY `fk_usuario_seguidor` (`usuario_id_seguidor`),
  KEY `fk_usuario_seguindo` (`usuario_id_seguindo`),
  CONSTRAINT `relacionamento_seguidores_ibfk_1` FOREIGN KEY (`usuario_id_seguidor`) REFERENCES `usuario` (`usuario_id`),
  CONSTRAINT `relacionamento_seguidores_ibfk_2` FOREIGN KEY (`usuario_id_seguindo`) REFERENCES `usuario` (`usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela cadernocolaborativo.relacionamento_seguidores: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `relacionamento_seguidores` DISABLE KEYS */;
/*!40000 ALTER TABLE `relacionamento_seguidores` ENABLE KEYS */;

-- Copiando estrutura para tabela cadernocolaborativo.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `usuario_id` int(11) NOT NULL AUTO_INCREMENT,
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
  `media_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`usuario_id`),
  UNIQUE KEY `prontuario` (`usuario_prontuario`),
  UNIQUE KEY `email` (`usuario_email`),
  KEY `fk_media` (`media_id`),
  CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`media_id`) REFERENCES `midia` (`midia_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela cadernocolaborativo.usuario: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT IGNORE INTO `usuario` (`usuario_id`, `usuario_nome`, `usuario_sobrenome`, `usuario_data_nasc`, `usuario_data_cadastro`, `usuario_prontuario`, `usuario_email`, `usuario_senha`, `usuario_descricao`, `usuario_cargo`, `usuario_experiencia`, `usuario_estado_acesso`, `media_id`) VALUES
	(3, 'giovani', 'fonseca', '1990-12-12', '2017-04-30 00:00:00', '123456', 'g@ifsp.edu.br', '5f4dcc3b5aa765d61d8327deb882cf99', 'oieee', 3, 0, 1, 9),
	(4, 'password', 'password', '0000-00-00', '0000-00-00 00:00:00', '', 'password@password.com', '5f4dcc3b5aa765d61d8327deb882cf99', '1', 2, 2, 1, NULL);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
