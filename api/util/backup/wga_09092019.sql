-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.6-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Copiando estrutura do banco de dados para wga
CREATE DATABASE IF NOT EXISTS `wga` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `wga`;

-- Copiando estrutura para tabela wga.atividade
CREATE TABLE IF NOT EXISTS `atividade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idprojeto` int(11) NOT NULL,
  `idprojetousuario` int(11) DEFAULT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `status` enum('STANDBY','DESIGNADA','ANDAMENTO','REVISAO','FINALIZADA','CANCELADA') NOT NULL DEFAULT 'STANDBY',
  `datacadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  `dataedicao` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_atividade_projeto` (`idprojeto`),
  KEY `FK_atividade_projetousuario` (`idprojetousuario`),
  CONSTRAINT `FK_atividade_projeto` FOREIGN KEY (`idprojeto`) REFERENCES `projeto` (`id`),
  CONSTRAINT `FK_atividade_projetousuario` FOREIGN KEY (`idprojetousuario`) REFERENCES `projetousuario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='responsável por salvar todas as atividades de um projeto';

-- Copiando dados para a tabela wga.atividade: ~0 rows (aproximadamente)
DELETE FROM `atividade`;
/*!40000 ALTER TABLE `atividade` DISABLE KEYS */;
/*!40000 ALTER TABLE `atividade` ENABLE KEYS */;

-- Copiando estrutura para tabela wga.atividadefeedback
CREATE TABLE IF NOT EXISTS `atividadefeedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idatividade` int(11) DEFAULT NULL,
  `idprojetousuario` int(11) DEFAULT NULL,
  `mensagem` text DEFAULT NULL,
  `secreta` enum('SIM','NAO') DEFAULT NULL,
  `datacadastro` timestamp NULL DEFAULT current_timestamp(),
  `dataedicao` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK__atividade` (`idatividade`),
  KEY `FK__projetousuario` (`idprojetousuario`),
  CONSTRAINT `FK__atividade` FOREIGN KEY (`idatividade`) REFERENCES `atividade` (`id`),
  CONSTRAINT `FK__projetousuario` FOREIGN KEY (`idprojetousuario`) REFERENCES `projetousuario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='responsável por armazenar comentários de usuários sobre atividades';

-- Copiando dados para a tabela wga.atividadefeedback: ~0 rows (aproximadamente)
DELETE FROM `atividadefeedback`;
/*!40000 ALTER TABLE `atividadefeedback` DISABLE KEYS */;
/*!40000 ALTER TABLE `atividadefeedback` ENABLE KEYS */;

-- Copiando estrutura para tabela wga.atividadefeedbackusuario
CREATE TABLE IF NOT EXISTS `atividadefeedbackusuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idatividadefeedback` int(11) DEFAULT NULL,
  `idprojetousuario` int(11) DEFAULT NULL,
  `datacadastro` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `FK_atividadefeedbackusuario_atividadefeedback` (`idatividadefeedback`),
  KEY `FK_atividadefeedbackusuario_projetousuario` (`idprojetousuario`),
  CONSTRAINT `FK_atividadefeedbackusuario_atividadefeedback` FOREIGN KEY (`idatividadefeedback`) REFERENCES `atividadefeedback` (`id`),
  CONSTRAINT `FK_atividadefeedbackusuario_projetousuario` FOREIGN KEY (`idprojetousuario`) REFERENCES `projetousuario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='salva usuários marcados nas msgs de feedback';

-- Copiando dados para a tabela wga.atividadefeedbackusuario: ~0 rows (aproximadamente)
DELETE FROM `atividadefeedbackusuario`;
/*!40000 ALTER TABLE `atividadefeedbackusuario` DISABLE KEYS */;
/*!40000 ALTER TABLE `atividadefeedbackusuario` ENABLE KEYS */;

-- Copiando estrutura para tabela wga.projeto
CREATE TABLE IF NOT EXISTS `projeto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idusuario` int(11) DEFAULT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `ativo` enum('SIM','NAO') DEFAULT NULL,
  `datacadastro` timestamp NULL DEFAULT current_timestamp(),
  `dataedicao` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_projeto_usuario` (`idusuario`),
  CONSTRAINT `FK_projeto_usuario` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela wga.projeto: ~0 rows (aproximadamente)
DELETE FROM `projeto`;
/*!40000 ALTER TABLE `projeto` DISABLE KEYS */;
/*!40000 ALTER TABLE `projeto` ENABLE KEYS */;

-- Copiando estrutura para tabela wga.projetousuario
CREATE TABLE IF NOT EXISTS `projetousuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idprojeto` int(11) DEFAULT NULL,
  `idusuario` int(11) DEFAULT NULL,
  `ativo` enum('SIM','NAO') DEFAULT NULL,
  `datacadastro` timestamp NULL DEFAULT current_timestamp(),
  `dataedicao` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_projetousuario_projeto` (`idprojeto`),
  KEY `FK_projetousuario_usuario` (`idusuario`),
  CONSTRAINT `FK_projetousuario_projeto` FOREIGN KEY (`idprojeto`) REFERENCES `projeto` (`id`),
  CONSTRAINT `FK_projetousuario_usuario` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela responsável por relacionar todos os usuários de um projeto';

-- Copiando dados para a tabela wga.projetousuario: ~0 rows (aproximadamente)
DELETE FROM `projetousuario`;
/*!40000 ALTER TABLE `projetousuario` DISABLE KEYS */;
/*!40000 ALTER TABLE `projetousuario` ENABLE KEYS */;

-- Copiando estrutura para tabela wga.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `celular1` varchar(50) NOT NULL,
  `celular2` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `ultimoacesso` datetime NOT NULL,
  `datacadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  `dataedicao` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela wga.usuario: ~0 rows (aproximadamente)
DELETE FROM `usuario`;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
