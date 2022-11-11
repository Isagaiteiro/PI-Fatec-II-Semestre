-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.24-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.0.0.6468
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para swe
CREATE DATABASE IF NOT EXISTS `swe` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `swe`;

-- Copiando estrutura para tabela swe.postagem
CREATE TABLE IF NOT EXISTS `postagem` (
  `idpostagem` int(11) NOT NULL AUTO_INCREMENT,
  `tema` varchar(50) NOT NULL,
  `url` varchar(200) DEFAULT NULL,
  `conteudo` mediumtext DEFAULT NULL,
  `postdate` datetime NOT NULL DEFAULT database(),
  `tipo` varchar(80) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`idpostagem`),
  KEY `FK_Id_Usuario` (`id_usuario`),
  CONSTRAINT `FK_Id_Usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela swe.postagem: ~0 rows (aproximadamente)
INSERT INTO `postagem` (`idpostagem`, `tema`, `url`, `conteudo`, `postdate`, `tipo`, `id_usuario`) VALUES
	(1, 'Curso de Orientação a Objeto em PHP', 'https://www.youtube.com/playlist?list=PLHz_AreHm4dmGuLII3tsvryMMD7VgcT7x', 'Curso muito legal do Gustavo Gaunabara onde ele explora atraves de aulas teoricas e práticas a programação orientada a objeto, com boa didática e conteúdo muito fácil de aprender Programação Orientada ao Objeto (POO) dessa forma', '2022-11-11 10:25:30', 'Vídeo', 3);

-- Copiando estrutura para tabela swe.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(80) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `foto` varchar(250) DEFAULT NULL,
  `senha` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela swe.usuario: ~3 rows (aproximadamente)
INSERT INTO `usuario` (`id`, `nome`, `email`, `foto`, `senha`) VALUES
	(1, 'Witer Xavier Mendonça', 'witer.mendonca@fatec.sp.gov.br', 'https://avatars.githubusercontent.com/u/73801483?v=4', '123mudar'),
	(2, 'Orlando Saraiva', 'orlando.saraiva@fatec.sp.gov.br', 'https://avatars.githubusercontent.com/u/2480421?v=4', '123mudar'),
	(3, 'Daniel França', 'daniel.franca@fatec.sp.gov.br', 'https://avatars.githubusercontent.com/u/102123924?v=4', '123mudar');

-- Copiando estrutura para tabela swe._like
CREATE TABLE IF NOT EXISTS `_like` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) DEFAULT NULL,
  `id_postagem` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_Id_Usuario_Table_Like` (`id_usuario`),
  KEY `FK_Id_Postagem` (`id_postagem`),
  CONSTRAINT `FK_Id_Postagem` FOREIGN KEY (`id_postagem`) REFERENCES `postagem` (`idpostagem`),
  CONSTRAINT `FK_Id_Usuario_Table_Like` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela swe._like: ~0 rows (aproximadamente)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
