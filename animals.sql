-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2025 at 11:49 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zoo`
--

-- --------------------------------------------------------

--
-- Table structure for table `animals`
--

CREATE TABLE `animals` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `type_alimentaire` varchar(50) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `Id_habitat` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `animals`
--

INSERT INTO `animals` (`id`, `name`, `type_alimentaire`, `image`, `Id_habitat`) VALUES
(9, 'Zebra', 'Carnivore', 'https://cdn8.futura-sciences.com/a1080/images/zebre.jpg', 15),
(13, 'Lion', 'Carnivore', 'https://www.imagesdoc.com/wp-content/uploads/sites/33/2021/05/Capture-de%CC%81cran-2021-04-21-a%CC%80-11.32.37.png', 15),
(19, 'Jugare', 'Carnivore', 'https://media.istockphoto.com/id/949472768/photo/tiger-portrait.jpg?s=612x612&w=0&k=20&c=cPI-hIwXxLwRYcGW3HaC_3C6J_MMIE_BbMjI9Ac0XNE=', 15),
(21, 'Zebra', 'Herbivore', 'https://www.monde-animal.fr/wp-content/uploads/2020/05/fiche-animale-monde-animal-zebre-de-montagne.jpg.webp', 16),
(23, 'Foret', 'Omnivore', 'https://i.pinimg.com/736x/0b/08/74/0b08742ceba2204506225af561e7e387.jpg', 16);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `animals`
--
ALTER TABLE `animals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Id_habitat` (`Id_habitat`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `animals`
--
ALTER TABLE `animals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `animals`
--
ALTER TABLE `animals`
  ADD CONSTRAINT `animals_ibfk_1` FOREIGN KEY (`Id_habitat`) REFERENCES `habitas` (`Id_h`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
