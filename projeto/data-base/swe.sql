
-- Copiando estrutura para tabela swe.postagem
CREATE TABLE IF NOT EXISTS `postagem` (
  `idpostagem` int NOT NULL AUTO_INCREMENT,
  `tema` varchar(50) NOT NULL,
  `url` varchar(80) DEFAULT NULL,
  `conteudo` mediumtext,
  `postdate` datetime DEFAULT NULL,
  `id_tipo` int DEFAULT NULL,
  `id_usuario` int DEFAULT NULL,
  PRIMARY KEY (`idpostagem`),
  KEY `FK_Id_Usuario` (`id_usuario`),
  KEY `FK_Id_Tipo` (`id_tipo`),
  CONSTRAINT `FK_Id_Tipo` FOREIGN KEY (`id_tipo`) REFERENCES `tipo` (`idtipo`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_Id_Usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


CREATE DATABASE IF NOT EXISTS `swe`;
USE `swe`;

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
);