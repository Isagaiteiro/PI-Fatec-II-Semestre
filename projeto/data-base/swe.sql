-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.13-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Copiando estrutura do banco de dados para swe
CREATE DATABASE IF NOT EXISTS `swe` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `swe`;

-- Copiando estrutura para procedure swe.atualiza_curtida
DELIMITER //
CREATE PROCEDURE `atualiza_curtida`(IN idpost INT)
BEGIN 

	UPDATE postagem
	SET curtir = (SELECT COUNT(id_usuario) FROM _like WHERE id_postagem = idpost)
	WHERE idpostagem = idpost;
	
END//
DELIMITER ;

-- Copiando estrutura para tabela swe.postagem
CREATE TABLE IF NOT EXISTS `postagem` (
  `idpostagem` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(200) NOT NULL,
  `tema` varchar(100) DEFAULT NULL,
  `url` varchar(300) DEFAULT NULL,
  `conteudo` mediumtext DEFAULT NULL,
  `postdate` datetime NOT NULL DEFAULT database(),
  `tipo` varchar(80) DEFAULT NULL,
  `curtir` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`idpostagem`),
  KEY `FK_Id_Usuario` (`id_usuario`),
  CONSTRAINT `FK_Id_Usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela swe.postagem: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `postagem` DISABLE KEYS */;
INSERT INTO `postagem` (`idpostagem`, `titulo`, `tema`, `url`, `conteudo`, `postdate`, `tipo`, `curtir`, `id_usuario`) VALUES
	(1, 'Curso de Orientação a Objeto em PHP', 'PHP', 'https://www.youtube.com/playlist?list=PLHz_AreHm4dmGuLII3tsvryMMD7VgcT7x', 'Curso muito legal do Gustavo Gaunabara onde ele explora atraves de aulas teoricas e práticas a programação orientada a objeto, com boa didática e conteúdo muito fácil de aprender Programação Orientada ao Objeto (POO) dessa forma', '2022-11-11 10:25:30', 'Vídeo', 4, 3),
	(2, 'Curso Java', 'JAVA', 'https://www.youtube.com/watch?v=sTX0UEplF54', 'Curso de Java #01 - História do Java - Gustavo Guanabara', '2022-11-21 10:25:31', 'Vídeo', 4, 1),
	(3, 'Curso C++', 'C++', 'https://www.youtube.com/watch?v=5W9YsbqnX0U', 'Curso C++ - Aula 01 - Abertura', '2022-11-21 10:25:32', 'Livro', 3, 2),
	(4, 'O curso completo de Banco de Dados e SQL, sem mistérios!', 'Banco de Dados', 'https://www.udemy.com/course/bancos-de-dados-relacionais-basico-avancado/', 'Bem vindo ao curso completo de Banco de Dados e SQL!\r\nSabe por que esse curso é o único Best Seller da área de Bancos de Dados da Udemy e também o mais bem avaliado?\r\nPorque ele é simples! Simples como um iniciante deseja. A metodologia utilizada é gradativa e nós explicamos tudo do absoluto zero. Sim, você não precisa saber nada! Você deseja aprender banco de dados? Então você vai aprender banco de dados!\r\nAqui você verá 3 bancos de dados diferentes: MySQL, SQL Server e Oracle e também será introduzido às linguagens T-SQL e PLSQL. Você verá além das diferenças na linguagem SQL, as tarefas de infraestrutura e instalação. Como regra de negócios, você aprenderá a diferença entre ambientes OLTP, OLAP e também o que é um Datawarehouse. Sim, você será apresentado à sequencia natural de Bancos de Dados Relacionais: Business Intelligence.\r\nO curso é totalmente focado no mercado de trabalho, e para isso conto com a minha experiência em projetos de grandes empresas juntando aos anos de trabalho também no mercado acadêmico. O resultado é simples:\r\nMERCADO COORPORATIVO + MERCADO ACADÊMICO = EFETIVIDADE NO ENSINO.\r\nVocê vai aprender MAIS em um curto espaço de tempo porque nosso curso é TOTALMENTE mão na massa, sem leitura de slides. Mas e a teoria que também é importante?\r\nEla é passada na prática, conforme vamos desenvolvendo os nossos códigos, dessa forma você nunca mais esquece! Além disso, nosso método inovador de lousa branca e explicações em desenho animado lhe fará fixar todo o conteúdo.\r\n', '2022-11-22 21:08:23', 'Vídeo', 0, 4),
	(7, 'Javascript: Básico ao Avançado: Guia completo para iniciantes', 'JavaScript', 'https://www.amazon.com.br/Javascript-Avan%C3%A7ado-Kelvin-Baumhardt-Biffi-ebook/dp/B07F36KXNW/ref=sr_1_11?keywords=livro+programa%C3%A7%C3%A3o+javascript&qid=1669162217&qu=eyJxc2MiOiIyLjA0IiwicXNhIjoiMC4wMCIsInFzcCI6IjAuMDAifQ%3D%3D&sprefix=livro+programa%C3%A7%C3%A3o%2Caps%2C192&sr=8-11', 'Este é um livro para iniciantes na área de programação que explica a linguagem de programação Javascript desde os comandos mais básicos até os conceitos mais complexos, da versão ES5, com o auxilio de diversos exemplos práticos.\r\nDurante o percurso da leitura deste livro você verá os princípios da lógica de programação, passando por conceitos básicos necessários para que se possa ter um total entendimento do que se trata a programação em seu todo. Após saber como funciona a linguagem e tendo um conhecimento básico sobre a mesma você começará a entrar no mundo do Javascript e verá como ele realmente trabalha por baixo dos panos.\r\nChegando neste ponto você já estará apto a criar a lógica de seu próprios aplicativos e sites, porém não terá o conhecimento completo da linguagem ainda, pois é aqui, que as coisas esquentam de verdade e entramos no coração da linguagem para nos aprofundamos nos conceitos mais fortes da linguagem que são os objetos e funções, passando por Closures, IIFE, Prototype. No final você terá uma total compreensão de o porque que o Javascript é a linguagem de programação que está dominando o mercado de TI.', '2022-11-22 21:19:50', 'Livro', 0, 2);
/*!40000 ALTER TABLE `postagem` ENABLE KEYS */;

-- Copiando estrutura para tabela swe.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(80) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `foto` varchar(250) DEFAULT NULL,
  `senha` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela swe.usuario: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`id`, `nome`, `email`, `foto`, `senha`) VALUES
	(1, 'Witer Xavier Mendonça', 'witer.mendonca@fatec.sp.gov.br', 'https://avatars.githubusercontent.com/u/73801483?v=4', '123mudar'),
	(2, 'Orlando Saraiva', 'orlando.saraiva@fatec.sp.gov.br', 'https://avatars.githubusercontent.com/u/2480421?v=4', '123mudar'),
	(3, 'Daniel França', 'daniel.franca@fatec.sp.gov.br', 'https://avatars.githubusercontent.com/u/102123924?v=4', '123mudar'),
	(4, 'Regis Ferreira', 'regis.ferreira@fatec.sp.gov.br', 'NULL', '123mudar');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;

-- Copiando estrutura para view swe.visao_curtidas
-- Criando tabela temporária para evitar erros de dependência de VIEW
CREATE TABLE `visao_curtidas` (
	`id` INT(11) NOT NULL,
	`nome` VARCHAR(80) NOT NULL COLLATE 'utf8mb4_general_ci',
	`tema` VARCHAR(100) NULL COLLATE 'utf8mb4_general_ci'
) ENGINE=MyISAM;

-- Copiando estrutura para view swe.visao_geral
-- Criando tabela temporária para evitar erros de dependência de VIEW
CREATE TABLE `visao_geral` (
	`titulo` VARCHAR(200) NOT NULL COLLATE 'utf8mb4_general_ci',
	`tema` VARCHAR(100) NULL COLLATE 'utf8mb4_general_ci',
	`conteudo` MEDIUMTEXT NULL COLLATE 'utf8mb4_general_ci',
	`url` VARCHAR(300) NULL COLLATE 'utf8mb4_general_ci',
	`postdate` DATETIME NOT NULL,
	`nome` VARCHAR(80) NOT NULL COLLATE 'utf8mb4_general_ci',
	`tipo` VARCHAR(80) NULL COLLATE 'utf8mb4_general_ci',
	`curtir` INT(11) NULL,
	`id` INT(11) NOT NULL,
	`idpostagem` INT(11) NOT NULL
) ENGINE=MyISAM;

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela swe._like: ~11 rows (aproximadamente)
/*!40000 ALTER TABLE `_like` DISABLE KEYS */;
INSERT INTO `_like` (`id`, `id_usuario`, `id_postagem`) VALUES
	(1, 1, 1),
	(2, 2, 2),
	(3, 3, 3),
	(4, 4, 1),
	(6, 1, 3),
	(7, 2, 1),
	(8, 3, 2),
	(9, 4, 2),
	(10, 1, 2),
	(11, 1, 3),
	(12, 2, 1);
/*!40000 ALTER TABLE `_like` ENABLE KEYS */;

-- Copiando estrutura para trigger swe.trg_contar_curtidas
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER trg_contar_curtidas
	AFTER INSERT ON _like
FOR EACH ROW
BEGIN 
	CALL atualiza_curtida(NEW.id_postagem);

END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Copiando estrutura para trigger swe.trg_delete_contar_curtidas
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER trg_delete_contar_curtidas
	AFTER DELETE ON _like
FOR EACH ROW
BEGIN 
	CALL atualiza_curtida(OLD.id_postagem);

END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Copiando estrutura para view swe.visao_curtidas
-- Removendo tabela temporária e criando a estrutura VIEW final
DROP TABLE IF EXISTS `visao_curtidas`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `visao_curtidas` AS SELECT l.id, u.nome, p.tema
FROM _like l
INNER JOIN postagem p
ON l.id_postagem = p.idpostagem
INNER JOIN usuario u
ON l.id_usuario = u.id ;

-- Copiando estrutura para view swe.visao_geral
-- Removendo tabela temporária e criando a estrutura VIEW final
DROP TABLE IF EXISTS `visao_geral`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `visao_geral` AS SELECT p.titulo, p.tema, p.conteudo, p.url,  p.postdate, u.nome, p.tipo, p.curtir, u.id, p.idpostagem  
	FROM usuario u, postagem p
	WHERE u.id = p.id_usuario ;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
