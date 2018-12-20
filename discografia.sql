-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2018 at 06:48 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `discografia`
--

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE `album` (
  `codigo` int(7) NOT NULL,
  `titulo` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `discografica` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `formato` enum('vinilo','cd','dvd','mp3') CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `fechaLanzamiento` date DEFAULT NULL,
  `fechaCompra` date DEFAULT NULL,
  `precio` float(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`codigo`, `titulo`, `discografica`, `formato`, `fechaLanzamiento`, `fechaCompra`, `precio`) VALUES
(1, 'Black', 'Metalica', 'cd', '1995-11-01', '1997-10-10', 10.00),
(2, 'Disco 2', 'Texaas', 'cd', '2018-11-01', '2018-08-16', 198.00),
(3, 'Disco 3', 'Texaas', 'cd', '2018-11-01', '2018-08-16', 198.00),
(4, 'Disco 4', 'Texaas', 'cd', '2018-11-01', '2018-08-16', 198.00);

-- --------------------------------------------------------

--
-- Table structure for table `cancion`
--

CREATE TABLE `cancion` (
  `titulo` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `album` int(7) NOT NULL,
  `posicion` tinyint(2) UNSIGNED DEFAULT NULL,
  `duracion` time DEFAULT NULL,
  `genero` enum('Acustica','BSO','Blues','Folk Jazz','New age','Pop','Rock','Electronica') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cancion`
--

INSERT INTO `cancion` (`titulo`, `album`, `posicion`, `duracion`, `genero`) VALUES
('asdf', 1, NULL, '00:00:01', 'Folk Jazz'),
('d', 2, NULL, '00:00:00', 'Blues'),
('da', 3, NULL, '00:00:00', 'Acustica'),
('taneddlaedf', 4, NULL, '00:00:11', ''),
('Unforgiven', 1, 1, '16:57:18', 'Rock');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`codigo`);

--
-- Indexes for table `cancion`
--
ALTER TABLE `cancion`
  ADD PRIMARY KEY (`titulo`,`album`),
  ADD KEY `album` (`album`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cancion`
--
ALTER TABLE `cancion`
  ADD CONSTRAINT `cancion_ibfk_1` FOREIGN KEY (`album`) REFERENCES `album` (`codigo`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
