-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: cadernocolaborativo
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.21-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `comentario`
--

DROP TABLE IF EXISTS `comentario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comentario` (
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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `denuncia`
--

DROP TABLE IF EXISTS `denuncia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `denuncia` (
  `denuncia_id` int(11) NOT NULL AUTO_INCREMENT,
  `denuncia_motivo` tinytext NOT NULL,
  `denuncia_dt` datetime NOT NULL,
  `usuario_id_autor` int(11) NOT NULL,
  `usuario_id_avaliador` int(11) NOT NULL,
  `publicacao_id` int(11) DEFAULT NULL,
  `comentario_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `gamificacao_acao`
--

DROP TABLE IF EXISTS `gamificacao_acao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gamificacao_acao` (
  `gacao_id` int(11) NOT NULL,
  `gacao_descricao` varchar(250) DEFAULT NULL,
  `gacao_pontos` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`gacao_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='armazena as acoes e valor de pontos para cada acao';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `gamificacao_nivel`
--

DROP TABLE IF EXISTS `gamificacao_nivel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gamificacao_nivel` (
  `gnivel_id` int(11) NOT NULL,
  `gnivel_nivel` decimal(10,0) DEFAULT '0',
  `gnivel_pontos` decimal(10,0) DEFAULT '0',
  `gnivel_nome` varchar(250) DEFAULT NULL,
  `gnivel_descricao` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`gnivel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='tabela que contem relaciona os pontos e seus equivalentes em niveis';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `iftag`
--

DROP TABLE IF EXISTS `iftag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `iftag` (
  `iftag_id` int(11) NOT NULL AUTO_INCREMENT,
  `iftag_nome` varchar(50) NOT NULL,
  PRIMARY KEY (`iftag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `likes_relacionamento`
--

DROP TABLE IF EXISTS `likes_relacionamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `likes_relacionamento` (
  `like_id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `publicacao_id` int(11) NOT NULL,
  `comentario_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`like_id`),
  KEY `fk_usuario_likes` (`usuario_id`),
  KEY `fk_publicacao_likes` (`publicacao_id`),
  KEY `fk_comentario_likes` (`comentario_id`),
  CONSTRAINT `likes_relacionamento_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`),
  CONSTRAINT `likes_relacionamento_ibfk_2` FOREIGN KEY (`publicacao_id`) REFERENCES `publicacao` (`publicacao_id`),
  CONSTRAINT `likes_relacionamento_ibfk_3` FOREIGN KEY (`comentario_id`) REFERENCES `comentario` (`comentario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `midia`
--

DROP TABLE IF EXISTS `midia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `midia` (
  `midia_id` int(11) NOT NULL AUTO_INCREMENT,
  `midia_tipo` int(3) NOT NULL,
  `midia_href` varchar(250) NOT NULL,
  PRIMARY KEY (`midia_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `publicacao`
--

DROP TABLE IF EXISTS `publicacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `publicacao` (
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
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `relacionamento_interesses`
--

DROP TABLE IF EXISTS `relacionamento_interesses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `relacionamento_interesses` (
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `relacionamento_seguidores`
--

DROP TABLE IF EXISTS `relacionamento_seguidores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `relacionamento_seguidores` (
  `usuario_id_seguidor` int(11) NOT NULL,
  `usuario_id_seguindo` int(11) NOT NULL,
  KEY `fk_usuario_seguidor` (`usuario_id_seguidor`),
  KEY `fk_usuario_seguindo` (`usuario_id_seguindo`),
  CONSTRAINT `relacionamento_seguidores_ibfk_1` FOREIGN KEY (`usuario_id_seguidor`) REFERENCES `usuario` (`usuario_id`),
  CONSTRAINT `relacionamento_seguidores_ibfk_2` FOREIGN KEY (`usuario_id_seguindo`) REFERENCES `usuario` (`usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `usuario_id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_nome` varchar(25) NOT NULL,
  `usuario_sobrenome` varchar(50) NOT NULL,
  `usuario_data_nasc` date DEFAULT NULL,
  `usuario_data_cadastro` datetime DEFAULT NULL,
  `usuario_prontuario` varchar(8) NOT NULL,
  `usuario_email` varchar(50) NOT NULL,
  `usuario_senha` varchar(41) NOT NULL,
  `usuario_descricao` varchar(140) NOT NULL,
  `usuario_cargo` tinyint(1) NOT NULL COMMENT '2=admin, 3=professor, 1=aluno',
  `usuario_experiencia` int(11) NOT NULL,
  `usuario_estado_acesso` tinyint(1) NOT NULL,
  `media_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`usuario_id`),
  UNIQUE KEY `prontuario` (`usuario_prontuario`),
  UNIQUE KEY `email` (`usuario_email`),
  KEY `fk_media` (`media_id`),
  CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`media_id`) REFERENCES `midia` (`midia_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `usuario_gamificacao`
--

DROP TABLE IF EXISTS `usuario_gamificacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario_gamificacao` (
  `usuario_gamificacao_id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `gacao_id` int(11) NOT NULL,
  `data` datetime DEFAULT NULL,
  `usuario_acao_id` int(11) DEFAULT NULL COMMENT 'acao feita pelo usuario (qual foi o post, like, comentario, etc, que ele realmente fez)',
  `pontos` int(11) DEFAULT NULL,
  PRIMARY KEY (`usuario_gamificacao_id`),
  KEY `usuario_fk_idx` (`usuario_id`),
  KEY `gobjetivo_fk_idx` (`gacao_id`),
  CONSTRAINT `gobjetivo_fk` FOREIGN KEY (`gacao_id`) REFERENCES `gamificacao_acao` (`gacao_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `usuario_fk` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1 COMMENT='tabela que armazena as acoes gamificadas feitas pelo usuario';
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

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

-- Copiando estrutura para tabela cadernodigitalcolaborativo.relacionamento_publicacao_tags
DROP TABLE IF EXISTS `relacionamento_publicacao_tags`;
CREATE TABLE IF NOT EXISTS `relacionamento_publicacao_tags` (
  `iftag_id` int(11) DEFAULT NULL,
  `publicacao_id` int(11) DEFAULT NULL,
  KEY `iftag_id` (`iftag_id`),
  KEY `publicacao_id` (`publicacao_id`),
  CONSTRAINT `iftag_id` FOREIGN KEY (`iftag_id`) REFERENCES `iftag` (`iftag_id`),
  CONSTRAINT `publicacao_id` FOREIGN KEY (`publicacao_id`) REFERENCES `publicacao` (`publicacao_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;


-- Dump completed on 2017-06-25 12:43:19




/***************************************************************************************************************************************************************************
******************************************************************* DADOS A PARTIR DAQUI ***********************************************************************************
****************************************************************************************************************************************************************************
****************************************************************************************************************************************************************************/





-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: cadernocolaborativo
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.21-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Dumping data for table `gamificacao_acao`
--

LOCK TABLES `gamificacao_acao` WRITE;
/*!40000 ALTER TABLE `gamificacao_acao` DISABLE KEYS */;
INSERT INTO `gamificacao_acao` VALUES (1,'comentario',2),(2,'publicacao',5),(3,'like',1),(4,'denuncia',3);
/*!40000 ALTER TABLE `gamificacao_acao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `gamificacao_nivel`
--

LOCK TABLES `gamificacao_nivel` WRITE;
/*!40000 ALTER TABLE `gamificacao_nivel` DISABLE KEYS */;
INSERT INTO `gamificacao_nivel` VALUES (0,0,0,'nivel 0','nivel 0'),(1,1,10,'nivel 1','nivel 1'),(2,2,20,'nivel 2','nivel 2'),(3,3,30,'nivel 3','nivel 3');
/*!40000 ALTER TABLE `gamificacao_nivel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'admin','admin','1990-12-12','2017-04-10 00:00:00','admin','admin@admin.com','5f4dcc3b5aa765d61d8327deb882cf99','admin',2,0,1,NULL),(13,'password','password','0000-00-00','0000-00-00 00:00:00','1111','password@password.com','5f4dcc3b5aa765d61d8327deb882cf99','1',1,0,1,NULL),(14,'giovani','fonseca','1990-12-12','2017-04-30 00:00:00','123456','g@ifsp.edu.br','5f4dcc3b5aa765d61d8327deb882cf99','oieee',3,0,1,NULL);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-06-25 12:44:58
