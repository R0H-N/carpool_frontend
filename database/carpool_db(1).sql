-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2024 at 01:53 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `carpool_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `rides`
--

CREATE TABLE `rides` (
  `id` int(11) NOT NULL,
  `departure_location` varchar(255) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `car_name` varchar(255) NOT NULL,
  `seats_available` int(11) NOT NULL,
  `luggage_available` enum('yes','no') NOT NULL,
  `departure_date` date NOT NULL,
  `departure_time` time NOT NULL,
  `additional_info` text DEFAULT NULL,
  `booking_status` tinyint(1) NOT NULL DEFAULT 0,
  `booked_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `rides`
--

INSERT INTO `rides` (`id`, `departure_location`, `destination`, `user_email`, `car_name`, `seats_available`, `luggage_available`, `departure_date`, `departure_time`, `additional_info`, `booking_status`, `booked_by`, `created_at`) VALUES
(1, 'boisar', 'palghar', 'user21@gmail.com', 'tuktuk', 2, 'yes', '2024-02-16', '15:00:00', '', 1, 'jangalerohan0@gmail.com', '2024-02-15 01:23:06'),
(2, 'boisar', 'palghar', 'user22@gmail.com', 'buggy', 2, 'yes', '2024-02-19', '01:02:00', '', 1, 'jangalerohan0@gmail.com', '2024-02-16 19:02:42'),
(3, 'boisar', 'palghar', 'user22@gmail.com', 'buggy', 2, 'yes', '2024-02-21', '03:04:00', '', 1, '121rohan2028@sjcem.edu.in', '2024-02-16 19:03:47'),
(4, 'mumbai', 'delhi', 'user22@gmail.com', 'polo', 3, 'yes', '2024-02-22', '02:03:00', '', 1, NULL, '2024-02-16 19:07:19'),
(5, 'mumbai', 'delhi', 'user22@gmail.com', 'polo', 3, 'yes', '2024-02-22', '02:03:00', '', 1, '121rohan2028@sjcem.edu.in', '2024-02-16 19:15:45'),
(6, 'palghar ', 'boisar ', 'user22@gmail.com', 'ferrari', 3, 'yes', '2024-02-17', '14:30:00', '', 1, '121rohan2028@sjcem.edu.in', '2024-02-16 22:15:25'),
(7, 'palghar', 'boisar', 'user22@gmail.com', 'Kia Seltos', 3, 'no', '2024-02-28', '11:23:00', '', 1, 'sherwinmurzello25@gmail.com', '2024-02-17 00:09:43'),
(8, 'palghar', 'boisar', 'fir@gmail.com', 'kia', 2, 'yes', '2024-02-23', '02:03:00', '', 1, '121rohan2028@sjcem.edu.in', '2024-02-17 00:32:34'),
(9, 'boisar', 'palghar', 'user22@gmail.com', 'nano', 2, 'yes', '2024-03-11', '14:22:00', '', 1, '121rohan2028@sjcem.edu.in', '2024-03-04 01:06:50'),
(10, 'palghar', 'boisar', 'user22@gmail.com', 'nano', 2, 'yes', '2024-03-25', '11:21:00', '', 0, NULL, '2024-03-04 01:13:10'),
(11, 'thane', 'boisar', 'user22@gmail.com', 'sumo', 3, 'yes', '2024-04-09', '22:02:00', '', 0, NULL, '2024-04-01 17:57:31'),
(12, 'goa', 'thane', 'user22@gmail.com', 'maruti', 2, 'yes', '2024-04-23', '22:02:00', '', 0, NULL, '2024-04-01 18:03:54'),
(13, 'virar', 'boisar', 'user22@gmail.com', 'toyo', 2, 'yes', '2024-04-23', '22:22:00', '', 1, 'jangalerohan0@gmail.com', '2024-04-02 08:24:18'),
(14, 'virar', 'boisar', 'user22@gmail.com', 'toyo', 2, 'yes', '2024-04-23', '22:22:00', '', 1, '121rohan2028@sjcem.edu.in', '2024-04-02 08:28:20'),
(15, 'road', 'house', 'user22@gmail.com', 'wheel', 3, 'yes', '2024-04-25', '03:33:00', '', 1, 'jangalerohan0@gmail.com', '2024-04-02 08:28:54'),
(16, 'york', 'boisar', 'user22@gmail.com', 'priyus', 2, 'yes', '2222-02-22', '22:22:00', '', 1, 'jangalerohan0@gmail.com', '2024-04-19 11:47:09'),
(17, 'york', 'boisar', 'user22@gmail.com', 'priyus', 2, 'yes', '2222-02-22', '22:22:00', '', 1, '121rohan2028@sjcem.edu.in', '2024-04-19 11:47:47'),
(18, 'saphale', 'nagasaki', 'user22@gmail.com', 'the car', 2, 'yes', '2222-02-22', '22:22:00', '', 1, '121rohan2028@sjcem.edu.in', '2024-04-19 11:55:41'),
(19, 'virar', 'beach', 'user22@gmail.com', 'onecar', 2, 'yes', '1111-11-11', '22:01:00', '', 1, 'jangalerohan0@gmail.com', '2024-04-19 12:12:10'),
(20, 'palghar', 'boisar', 'user22@gmail.com', 'nano', 3, 'yes', '2024-04-26', '22:02:00', '', 1, '121rohan2028@sjcem.edu.in', '2024-04-20 04:30:31'),
(21, 'banglore', 'boisar', 'user22@gmail.com', 'temp', 2, 'yes', '0022-02-22', '22:22:00', '', 1, '121rohan2028@sjcem.edu.in', '2024-05-05 10:08:45'),
(22, 'goa', 'mumbai', 'jangalerohan0@gmail.com', 'sonata', 1, 'yes', '0121-02-11', '11:11:00', '', 1, '121rohan2028@sjcem.edu.in', '2024-05-05 10:45:11'),
(23, 'aplace', 'bplace', 'jangalerohan0@gmail.com', 'ab', 2, 'yes', '2222-02-22', '22:22:00', '', 1, '121rohan2028@sjcem.edu.in', '2024-05-06 04:44:33'),
(24, 'aplace1', 'bplace2', 'jangalerohan0@gmail.com', 'ab1', 1, 'yes', '2024-03-03', '13:33:00', '', 1, '121rohan2028@sjcem.edu.in', '2024-05-06 05:18:09'),
(25, 'aplace2', 'bplace2', 'jangalerohan0@gmail.com', 'ab3', 1, 'yes', '1111-12-12', '11:21:00', '', 1, '121rohan2028@sjcem.edu.in', '2024-05-06 05:25:47'),
(26, 'abplace4', 'abplace4', '121rohan2028@sjcem.edu.in', 'ab4', 3, 'yes', '0323-02-11', '23:22:00', '', 1, 'jangalerohan0@gmail.com', '2024-05-06 05:30:25'),
(27, 'ab6', 'ba6', 'jangalerohan0@gmail.com', 'abb6', 4, 'yes', '1111-11-11', '22:22:00', '', 1, '121rohan2028@sjcem.edu.in', '2024-05-06 05:35:32'),
(28, 'alocation', 'blocation', 'jangalerohan0@gmail.com', 'abloc', 2, 'yes', '1211-02-11', '23:23:00', '', 1, '121rohan2028@sjcem.edu.in', '2024-05-06 06:31:49'),
(29, 'virar', 'vasai', 'sherwinmurzello25@gmail.com', 'z1', 2, 'no', '2024-11-14', '07:00:00', '', 1, '121rohan2028@sjcem.edu.in', '2024-05-06 14:40:52');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `bio` text DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`email`, `password`, `name`, `bio`, `profile_pic`, `created_at`) VALUES
('rohan@gmail.com', 'rohan10', '', NULL, NULL, '2023-10-17 15:22:16'),
('some@gmail.com', '1111', '', NULL, NULL, '2023-10-17 16:29:56'),
('sherwin@gmail.com', '$2y$10$Ky.XJODRk1aIUaFSXGni1.Y1KBScDuEdF1sG5hLAOpdz7s.hwWLni', '', NULL, NULL, '2023-10-17 16:55:52'),
('nilaksh@gmail.com', '$2y$10$oScfG4FMPIaHR6aNEhMGv.k.2pw0wlz./2F0aRB5AYHt7SkMzy5d6', '', NULL, NULL, '2023-10-19 15:04:08'),
('yash@gmail.com', '$2y$10$mspE5F5u2USnsgMErKfweuxQ/XnPN8iJUfI422rtX9pXs/OIYM2oa', '', NULL, NULL, '2023-10-19 15:07:47'),
('team@gmail.com', '$2y$10$U8bKHo.Bf3B4HNgrTFDUcuiS.I7eg6G3an.D8OFSa1NAU9Wus6ek6', '', NULL, NULL, '2023-10-19 15:08:32'),
('ayush@gmail.com', '$2y$10$rpI98ZC6.rcXYZiC7TPiduPLLJHxqgzkgv39sX2HdwU0Oo8YlnHda', '', NULL, NULL, '2023-10-20 05:35:39'),
('yash1@gmail.com', '$2y$10$aaAVLY/r.UzucTeq7mOH2O//MLyOZiXuyX.qI.CAeoOzAnWtmOX5K', '', NULL, NULL, '2023-11-10 09:43:29'),
('shakila@gmail.com', '$2y$10$6UNWxcUEFquC1kgzKB1mU.x4MeNhwT8P1.eNBJVEWp0POEDYQnbcu', '', NULL, NULL, '2023-11-10 10:12:43'),
('shakila@gmail.com', '$2y$10$/CrU.CUuqr/.C2WHOypkJukLgb6UhQnwEeyZKbiKWIVCN2.2eSDzi', '', NULL, NULL, '2024-02-11 23:46:39'),
('user21@gmail.com', '$2y$10$aTEfhbdmLhxoI8xfdS8Bte2Ij.ENR3J9L3palmkrc7O.gpqd.VFGS', '', NULL, NULL, '2024-02-15 00:59:37'),
('user22@gmail.com', '$2y$10$mhj.TZpb0wX4D55lZ78xteKgXmtCUphe6t9SK1h0wUNKwvbvUB0QS', 'one', 'the one', NULL, '2024-02-16 18:33:19'),
('fir@gmail.com', '$2y$10$1rxM5SgL46OrSLFnhdADa.u2BTHG5ad4Qbqq01EkTCy2JJg45GDeW', '', NULL, NULL, '2024-02-17 00:30:38'),
('user21@gmail.com', '$2y$10$sLQqbSVI/3emuKolGxg1aeMYuUPkEVKSqu21dd5IAamlHx7kUVKSy', '', NULL, NULL, '2024-04-20 04:14:56'),
('jangalerohan0@gmail.com', '$2y$10$dTsHn4Rr/a9wPxwDzSh.ReGuu6ciU1P1CYG9OjTb8D1hwRIDheNCG', 'someone2', 'something2', 'uploads/370706.jpg', '2024-05-05 10:08:07'),
('121rohan2028@sjcem.edu.in', '$2y$10$MfLyW/IChRQtSfYaF/KZ0ePPFEuifBBYmUuoUazMfKajJxkeQF7he', 'dd', 'jj', 'uploads/h_MjUJTa.jpeg', '2024-05-05 10:09:48'),
('sherwinmurzello25@gmail.com', '$2y$10$EkIMqcX9yLaLR0AHvKFG9.jlKtGT12IlmjMR8YGIfr5zUVob8Nk.W', 'sheriwn murzello', 'driver', 'uploads/wp6878111-4k-berserk-phone-wallpapers.jpg', '2024-05-06 14:37:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `rides`
--
ALTER TABLE `rides`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_email` (`user_email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD KEY `email_index` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rides`
--
ALTER TABLE `rides`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `rides`
--
ALTER TABLE `rides`
  ADD CONSTRAINT `rides_ibfk_1` FOREIGN KEY (`user_email`) REFERENCES `users` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
