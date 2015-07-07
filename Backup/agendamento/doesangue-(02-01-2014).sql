-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           5.6.12-log - MySQL Community Server (GPL)
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              8.1.0.4545
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Copiando estrutura do banco de dados para doesangue
CREATE DATABASE IF NOT EXISTS `doesangue` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `doesangue`;


-- Copiando estrutura para tabela doesangue.campanhas
CREATE TABLE IF NOT EXISTS `campanhas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dia` date DEFAULT NULL,
  `cidade_fk` int(11) DEFAULT NULL,
  `num_vagas` int(11) DEFAULT NULL,
  `hora_inicio` time DEFAULT NULL,
  `hora_final` time DEFAULT NULL,
  `ativa` int(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `cidade_fk` (`cidade_fk`),
  CONSTRAINT `cidade_fk` FOREIGN KEY (`cidade_fk`) REFERENCES `cidades` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Tabela que contem as campanhas com as datas específicas e as cidades relacionadas atraves da PK na tabela cidades';

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para view doesangue.campanhas_ativas
-- Criando tabela temporária para evitar erros de dependência de VIEW
CREATE TABLE `campanhas_ativas` (
	`id` INT(11) NOT NULL,
	`dia` DATE NULL,
	`cidade_fk` INT(11) NULL,
	`num_vagas` INT(11) NULL,
	`hora_inicio` TIME NULL,
	`hora_final` TIME NULL,
	`ativa` INT(1) NULL,
	`nome` VARCHAR(50) NULL COLLATE 'utf8_unicode_ci'
) ENGINE=MyISAM;


-- Copiando estrutura para tabela doesangue.cidades
CREATE TABLE IF NOT EXISTS `cidades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Nome` (`nome`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Tabela que contem as cidades disponíveis para doação';

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para view doesangue.cidades_ativas
-- Criando tabela temporária para evitar erros de dependência de VIEW
CREATE TABLE `cidades_ativas` (
	`id` INT(11) NOT NULL,
	`nome` VARCHAR(50) NULL COLLATE 'utf8_unicode_ci'
) ENGINE=MyISAM;


-- Copiando estrutura para tabela doesangue.doadores
CREATE TABLE IF NOT EXISTS `doadores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cpf` bigint(20) NOT NULL DEFAULT '0',
  `nome` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `telefone` varchar(13) COLLATE utf8_unicode_ci NOT NULL DEFAULT '00000000000',
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `CPF` (`cpf`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='tabela com registro de informações dos doadores';

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para view doesangue.doadores_totais
-- Criando tabela temporária para evitar erros de dependência de VIEW
CREATE TABLE `doadores_totais` (
	`id` INT(11) NOT NULL,
	`cpf` BIGINT(20) NOT NULL,
	`nome` VARCHAR(100) NOT NULL COLLATE 'utf8_unicode_ci',
	`telefone` VARCHAR(13) NOT NULL COLLATE 'utf8_unicode_ci'
) ENGINE=MyISAM;


-- Copiando estrutura para tabela doesangue.reservas
CREATE TABLE IF NOT EXISTS `reservas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `campanha_fk` int(11) NOT NULL DEFAULT '0',
  `doador_fk` int(11) NOT NULL DEFAULT '0',
  `horario` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `campanha_fk` (`campanha_fk`),
  KEY `doador_fk` (`doador_fk`),
  CONSTRAINT `campanha_fk` FOREIGN KEY (`campanha_fk`) REFERENCES `campanhas` (`id`),
  CONSTRAINT `doador_fk` FOREIGN KEY (`doador_fk`) REFERENCES `doadores` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='tabela que relaciona campanhas com doadores';

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para view doesangue.reservas_horarios_doadores
-- Criando tabela temporária para evitar erros de dependência de VIEW
CREATE TABLE `reservas_horarios_doadores` (
	`horario` INT(11) NOT NULL,
	`nome` VARCHAR(100) NOT NULL COLLATE 'utf8_unicode_ci',
	`telefone` VARCHAR(13) NOT NULL COLLATE 'utf8_unicode_ci',
	`email` VARCHAR(100) NULL COLLATE 'utf8_unicode_ci',
	`cpf` BIGINT(20) NOT NULL,
	`doador_fk` INT(11) NOT NULL,
	`campanha_fk` INT(11) NOT NULL
) ENGINE=MyISAM;


-- Copiando estrutura para view doesangue.reserva_horarios
-- Criando tabela temporária para evitar erros de dependência de VIEW
CREATE TABLE `reserva_horarios` (
	`id` INT(11) NOT NULL,
	`campanha_fk` INT(11) NOT NULL,
	`doador_fk` INT(11) NOT NULL,
	`horario` INT(11) NOT NULL,
	`cpf` BIGINT(20) NOT NULL
) ENGINE=MyISAM;


-- Copiando estrutura para tabela doesangue.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `login` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `senha` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `funcao` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`login`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Exportação de dados foi desmarcado.


-- Copiando estrutura para view doesangue.campanhas_ativas
-- Removendo tabela temporária e criando a estrutura VIEW final
DROP TABLE IF EXISTS `campanhas_ativas`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` VIEW `campanhas_ativas` AS SELECT campanhas.*, cidades.nome FROM campanhas INNER JOIN cidades ON campanhas.cidade_fk = cidades.id ;


-- Copiando estrutura para view doesangue.cidades_ativas
-- Removendo tabela temporária e criando a estrutura VIEW final
DROP TABLE IF EXISTS `cidades_ativas`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` VIEW `cidades_ativas` AS SELECT cidades.id , cidades.nome FROM cidades, campanhas WHERE campanhas.ativa = 1 AND campanhas.cidade_fk = cidades.id ;


-- Copiando estrutura para view doesangue.doadores_totais
-- Removendo tabela temporária e criando a estrutura VIEW final
DROP TABLE IF EXISTS `doadores_totais`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` VIEW `doadores_totais` AS SELECT * from doadores ;


-- Copiando estrutura para view doesangue.reservas_horarios_doadores
-- Removendo tabela temporária e criando a estrutura VIEW final
DROP TABLE IF EXISTS `reservas_horarios_doadores`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` VIEW `reservas_horarios_doadores` AS SELECT reserva_horarios.horario, doadores.nome, doadores.telefone, doadores.email, doadores.cpf, reserva_horarios.doador_fk, reserva_horarios.campanha_fk from reserva_horarios INNER JOIN doadores ON reserva_horarios.doador_fk = doadores.id ;


-- Copiando estrutura para view doesangue.reserva_horarios
-- Removendo tabela temporária e criando a estrutura VIEW final
DROP TABLE IF EXISTS `reserva_horarios`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` VIEW `reserva_horarios` AS select reservas.*, doadores.cpf from reservas inner join doadores on reservas.doador_fk = doadores.id ;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
