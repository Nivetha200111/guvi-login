-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2023 at 05:35 PM
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
-- Database: `user_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `first_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `last_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `age` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `username` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `phone_number` bigint(20) NOT NULL,
  `password` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Table for storing user registration details.';

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`first_name`, `last_name`, `age`, `id`, `username`, `email`, `phone_number`, `password`, `created_at`) VALUES
('1', '1', 1, 28, '1', '1@W', 11, '$2y$10$b0X52KdOvpKyQR.huJmY5ul/HsQhKKyXChU/vfOFjDPRHDNpo4LjK', '2023-11-27 12:19:05'),
('2', '2', 2, 29, '2', '2@2', 22, '$2y$10$WlIacYfni8oD1Ip6kfizEewBgyBvzvyTf3QImlezAJ6YRJxE255Ya', '2023-11-27 12:20:20'),
('4', '4', 2, 30, '3', '44@4', 434343, '$2y$10$yn5gQc0BP6MuCN/ap33XG.0LYGwUZ0OZ3mDUZ0oF6X/feF51YMAFq', '2023-11-27 12:21:15'),
('Nivetha', 'Sivakumar', 22, 31, 'test', '123@456.com', 435612345, '$2y$10$2WnzK/vnxW0uzm4vS133Ne2BUkkzyPpv84nHnY8F5QpJR7EigKg0q', '2023-11-27 14:10:26'),
('niv', 'ln', 22, 32, 'NIV2023', '123@4567.com', 234567891, '$2y$10$0m8A0pggw5FYI7MIWpVieuXP9.6VgjFd09td/Ud1ZF9adX/cyEK/C', '2023-11-27 14:11:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQUE` (`username`),
  ADD UNIQUE KEY `emailUNIQUE` (`email`),
  ADD UNIQUE KEY `phone_number` (`phone_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
