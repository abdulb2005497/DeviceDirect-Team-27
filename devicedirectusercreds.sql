-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2024 at 07:31 PM
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
-- Database: `devicedirectusercreds`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `First_name` varchar(50) NOT NULL,
  `Last_name` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Phone` varchar(20) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'client',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `First_name`, `Last_name`, `Email`, `Phone`, `Address`, `password`, `role`, `created_at`) VALUES
(1, 'Anas', 'Ige', 'igeanas3@gmail.com', '', '', '$2y$10$ed2wwNv/feUExTKkIjynC.JbFXxG549UeuUGSDPnHedUZumfq2J5G', 'user', '2024-12-05 19:16:38'),
(3, 'Anasl', 'Igl', 'igeanas3l@gmail.com', '', '', '$2y$10$z3rDiYb7aiS3yhsUtWBh9unzYpgEXMs/SjemiJ6a4DFgP99quRlXG', 'user', '2024-12-05 19:18:15'),
(5, 'asd', 'asd', 'igeanas3@gmail.comc', 'asd', 'asd', '$2y$10$nMUfKaR6f8//4iKYw5VEZ.5gSrm0KY6NwSHuySfSklFYK6qBUT0q.', 'user', '2024-12-05 19:22:04'),
(12, 'Anas', 'Ige', 'igeanas3@gmaihgfl.com', '07827702198', '86 Grosvenor Road, Aston, Birmingham, B67NA', '$2y$10$lYNwXP8ZuRCetLxB09.DQuHb0sQrIH.ns64mUVcOVa2JItFuBre0C', 'user', '2024-12-05 19:56:52'),
(14, 'Anas', 'Ige', 'igeanas3@gmahgfkgfil.com', '07827702198', '86 Grosvenor Road, Aston, Birmingham, B67NA', '$2y$10$mDWsbF5/k8e2NKRuSdiFw.kWBn28dI6fmSX.JV3g.FiF16iP.8SB6', 'user', '2024-12-05 19:58:48'),
(15, 'test', 'lol', 'test@test.com', '09', '86 Grosvenor Road, Aston, Birmingham, B67NA', '$2y$10$/OIiSu72p.YFYU8KImAxcujeKPFMSWLLEKkDHfA.lRexk28DS2gXC', 'user', '2024-12-06 14:12:09'),
(16, 'pussloy', 'Ige', 'op@gmail.com', '07827702198', '86 Grosvenor Road, Aston, Birmingham, B67NA', '$2y$10$E96til197OuliX4MzAi1.uWKlv3Kxn4SBo1mBvDBFYkzJG/3XZmoO', 'user', '2024-12-06 17:21:59'),
(17, 'Anas', 'Ige', 'igeanas33@gmail.com', '07827702198', '86 Grosvenor Road, Aston, Birmingham, B67NA', '$2y$10$mtphl04npp8KSsxCBzknGeeb0HCiTrT3qUMzFipYhea6QUHix7yOC', 'user', '2024-12-06 17:34:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
