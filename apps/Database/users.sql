-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2024 at 11:05 AM
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
-- Database: `apps`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `User_Id` int(11) NOT NULL,
  `Names` varchar(255) NOT NULL,
  `Username` varchar(100) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Tel_Number` varchar(20) DEFAULT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`User_Id`, `Names`, `Username`, `Email`, `Tel_Number`, `Password`) VALUES
(1, 'ishi', 'braver', 'braver@gmail.com', '098765', '$2y$10$Ck74.pJIAg2eaJ7exjegFeHnylazA8V.Dm0AU15U5s6Up3IVyl1vq'),
(2, 'Alice kazungu', 'kazungu', 'kazungu@gmail.com', '1234567890', '$2y$10$ouNBzYT2tf9fKV9UnFcHhekaAu9cnpNFoQmeAhyIt5sxc8EersGlO'),
(3, 'aline esther', 'aline', 'esther@gmail.com', '675533221134', '$2y$10$RLZuC.PTTbHTYPk10jctuOOr9ReD2NFc6JuFDz5lYfXs5mOglr7A.'),
(4, 'dady', 'papa', 'da@gmail.com', '234567', '$2y$10$V/8ATAXZDT0NI2f36Gqtqu9.Xc0CTbyy9xTNtAQcAFdtgMZM6KyfW'),
(5, 'mumy', 'mama', 'ma@gmail.com', '456789', '$2y$10$T9Y1yvNunIp7AocWqgtZJ.FddToz41NdPg9wq7yC8Q4ysjZ.gDtDK'),
(6, 'sezerano', 'alice', 'sezerano@gmail.com', '0789670590', '$2y$10$KV9.UscjP6vRoqY/3uOm/.kWc4JqtcsZZbDU.B2oi4PhhhJ5hTkzu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`User_Id`),
  ADD UNIQUE KEY `Username` (`Username`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `User_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
