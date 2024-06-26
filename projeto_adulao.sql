-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 26/06/2024 às 16:55
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
  `title` varchar(220) COLLATE utf8mb4_swedish_ci NOT NULL,
  `description` text COLLATE utf8mb4_swedish_ci,
  `initial_date` date NOT NULL,
  `final_date` date NOT NULL,
  `start_time` tinyint NOT NULL,
  `duration` int NOT NULL,
  `created` datetime NOT NULL,
  `instructor_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_activities_instructors1_idx` (`instructor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `guests`
--

DROP TABLE IF EXISTS `guests`;
CREATE TABLE IF NOT EXISTS `guests` (
  `id` int NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `person_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_guests_persons_idx` (`person_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `guests_activities`
--

DROP TABLE IF EXISTS `guests_activities`;
CREATE TABLE IF NOT EXISTS `guests_activities` (
  `id` int NOT NULL AUTO_INCREMENT,
  `guest_id` int NOT NULL,
  `activity_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_guests_has_activities_activities1_idx` (`activity_id`),
  KEY `fk_guests_has_activities_guests1_idx` (`guest_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `instructors`
--

DROP TABLE IF EXISTS `instructors`;
CREATE TABLE IF NOT EXISTS `instructors` (
  `id` int NOT NULL AUTO_INCREMENT,
  `phone` varchar(15) COLLATE utf8mb4_swedish_ci NOT NULL,
  `other_phone` varchar(15) COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `education` tinyint NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `person_id` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `phone_UNIQUE` (`phone`),
  KEY `fk_instructors_persons1_idx` (`person_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

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
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

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
(1, 'Administrador', 'admin@gmail.com', '$2y$10$RtuNcd3u7X76XzkpG9Ohx.nFI4IgGabvI9DOwMYH3pnV7mQ/sDyIa', NULL);

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `activities`
--
ALTER TABLE `activities`
  ADD CONSTRAINT `fk_activities_instructors1` FOREIGN KEY (`instructor_id`) REFERENCES `instructors` (`id`);

--
-- Restrições para tabelas `guests`
--
ALTER TABLE `guests`
  ADD CONSTRAINT `fk_guests_persons` FOREIGN KEY (`person_id`) REFERENCES `persons` (`id`);

--
-- Restrições para tabelas `guests_activities`
--
ALTER TABLE `guests_activities`
  ADD CONSTRAINT `fk_guests_has_activities_activities1` FOREIGN KEY (`activity_id`) REFERENCES `activities` (`id`),
  ADD CONSTRAINT `fk_guests_has_activities_guests1` FOREIGN KEY (`guest_id`) REFERENCES `guests` (`id`);

--
-- Restrições para tabelas `instructors`
--
ALTER TABLE `instructors`
  ADD CONSTRAINT `fk_instructors_persons1` FOREIGN KEY (`person_id`) REFERENCES `persons` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
