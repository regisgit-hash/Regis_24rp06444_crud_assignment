-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2025 at 05:05 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `employee_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `age` int(11) NOT NULL,
  `department` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `firstname`, `lastname`, `age`, `department`, `address`, `created_at`) VALUES
(1, 'nkusi', '123', 1211, 'ICT', 'KIGALI', '2025-11-14 17:50:07'),
(2, 'IBYIMANA', 'Ikora ubalide', 12, 'MEH', 'MUHANGA', '2025-11-14 17:51:50'),
(3, 'NDAYISHIMIYE', 'Igiranezaregis', 23, 'IT', 'huye', '2025-11-14 17:52:23'),
(5, 'UWIMBABAZI', 'Oliva', 23, 'Renewable', 'kigali', '2025-11-14 18:54:02'),
(6, 'baba', 'bikorimana', 12, 'ict', 'huye', '2025-11-14 19:25:30'),
(7, 'Elisiusi', 'Soso', 23, 'MEC', 'RUSIZI', '2025-11-14 21:46:27'),
(8, 'byiringiro', 'shadracka', 24, 'MECH', 'kimisagara', '2025-11-15 07:26:58'),
(9, 'sekamana', 'Theogene', 30, 'EET', 'Huye', '2025-11-15 07:41:47'),
(10, 'CHATGPT', 'SAMUEL', 23, 'ICT', 'MUHANGA', '2025-11-15 09:32:59'),
(11, 'sekamana', 'janvier', 12, 'MECH', 'Tumba', '2025-11-15 16:01:44');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `task_title` varchar(255) NOT NULL,
  `task_description` text NOT NULL,
  `deadline` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `employee_id`, `task_title`, `task_description`, `deadline`) VALUES
(7, 7, 'Engineer', 'Guhinga', '2025-11-23'),
(8, 8, 'agricalcuture', 'agriculcure is the process', '2025-11-21'),
(9, 9, 'Security', 'TO manage and controling our properties', '2025-11-12'),
(10, 10, 'security', 'umuhinzi', '2025-11-05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('manager','employee') NOT NULL DEFAULT 'employee',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `created_at`) VALUES
(2, 'muragijimana', '', '$2y$10$o82baxjMfGT4wL2cB67yw.o7VS/8/Xl6.JRYW2RZiw/5h9H1gEHZG', 'manager', '2025-11-14 17:24:57'),
(9, 'soso', 'sos@gmai.com', '$2y$10$ry8RjaU78eIjjn3lo..AdeUOm1puGIMc.k3/BJrbRZhFfH7ONH1Mi', 'employee', '2025-11-14 21:54:13'),
(10, 'SEKAMANA', 'sekamana@gmail.com', '$2y$10$Y3ZsLFY2OPLJeRJF1jxlTeF79Qbk1/9uWTXsXXL4yq20VhfYFSDhe', 'employee', '2025-11-15 07:40:21'),
(13, 'byiringiro', 'mj604192566@gmail.com', '$2y$10$I0KYISueVErABPGVtU.bsOXt9LHco5sAJL1Lc.frj20AagKd9uVAq', 'employee', '2025-11-15 09:42:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
