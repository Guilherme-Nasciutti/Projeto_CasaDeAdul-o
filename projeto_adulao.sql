-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 01/06/2024 às 22:57
-- Versão do servidor: 8.3.0
-- Versão do PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `projeto_adulao`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `activities`
--

DROP TABLE IF EXISTS `activities`;
CREATE TABLE IF NOT EXISTS `activities` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(220) COLLATE utf8mb4_swedish_ci NOT NULL,
  `initial_date` date NOT NULL,
  `final_date` date NOT NULL,
  `start_time` tinyint NOT NULL,
  `duration` int NOT NULL,
  `created` datetime NOT NULL,
  `person_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_activities_persons1_idx` (`person_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `persons`
--

DROP TABLE IF EXISTS `persons`;
CREATE TABLE IF NOT EXISTS `persons` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(220) COLLATE utf8mb4_swedish_ci NOT NULL,
  `last_name` varchar(220) COLLATE utf8mb4_swedish_ci NOT NULL,
  `birthday` date NOT NULL,
  `civil_status` tinyint NOT NULL,
  `phone` varchar(15) COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `education` tinyint DEFAULT NULL,
  `role_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_persons_roles1_idx` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(220) COLLATE utf8mb4_swedish_ci NOT NULL,
  `type` tinyint NOT NULL,
  `description` text COLLATE utf8mb4_swedish_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Despejando dados para a tabela `roles`
--

INSERT INTO `roles` (`id`, `name`, `type`, `description`) VALUES
(1, 'Instrutor(a)', 1, ''),
(2, 'Hóspede', 2, '');

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `full_name` varchar(220) COLLATE utf8mb4_swedish_ci NOT NULL,
  `email` varchar(220) COLLATE utf8mb4_swedish_ci NOT NULL,
  `password` varchar(180) COLLATE utf8mb4_swedish_ci NOT NULL,
  `password_reset_token` varchar(180) COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `password_reset_token`) VALUES
(1, 'Administrador', 'admin@gmail.com', '$2y$10$quasmLZRRi27NHKsHiSnseX.hojOvT.KFapsCkBXjhBmYhKfefaWq', NULL);

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `activities`
--
ALTER TABLE `activities`
  ADD CONSTRAINT `fk_activities_persons1` FOREIGN KEY (`person_id`) REFERENCES `persons` (`id`);

--
-- Restrições para tabelas `persons`
--
ALTER TABLE `persons`
  ADD CONSTRAINT `fk_persons_roles1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
