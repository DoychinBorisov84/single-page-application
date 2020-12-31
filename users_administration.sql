-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 01, 2021 at 01:52 AM
-- Server version: 8.0.22-0ubuntu0.20.04.3
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `users_administration`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `firstName` varchar(40) NOT NULL,
  `lastName` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `logged` varchar(50) DEFAULT NULL,
  `password` varchar(99) NOT NULL,
  `reset_string` varchar(55) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `created_at` varchar(30) DEFAULT NULL,
  `updated_at` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `email`, `logged`, `password`, `reset_string`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'Admin', 'admin@gmail.com', '1609433912.2288_admin@gmail.com', '$2y$10$3q0OOnpxNphbin80HL6GvuuOyzBjAuNhGkIq6pvY6oOu/CwiBd7jC', NULL, 'images/users/administrator.jpg', '2020-06-10 13:16:30', '2020-12-29 09:07:42'),
(4, 'Jimmy', 'Rivera', 'user1@gmail.com', '1594485303.7265_user1@gmail.com', '$2y$10$zuU830fWAY7enRopd.lLQOGN/wiWLpDRgmT2jPpRhHs1SKamu3Kuu', 'lmm.ros!$%ceigau11594569872', 'images/users/jimmy.jpg', '2020-06-10 13:16:30', '2020-06-17 11:35:47'),
(5, 'Anna', 'Maria', 'user2@gmail.com', '1592312061.0413_user@gmail.com', '$2y$10$3q0OOnpxNphbin80HL6GvuuOyzBjAuNhGkIq6pvY6oOu/CwiBd7jC', NULL, 'images/users/anna.jpg', '2020-06-10 13:16:30', '2020-06-10 13:16:30'),
(7, 'Jenna', 'Smith', 'jenna@gmail.com', '1609281817.8346_jenna@gmail.com', '$2y$10$UcV8XDhKCsexGR0dRl7a6eqySstndFjuGJ0cx/vjWtMX.g.F4do36', NULL, 'images/users/jenna.jpg', '2020-07-18 18:16:49', '2020-07-18 18:16:49'),
(8, 'George', 'Brimas', 'george@gmail.com', '1609340506.6966_george@gmail.com', '$2y$10$JTiKNBMG5i2e.eBdeEhNC./VSKyvPiBUCTd.2ek5hwh/J9QZjDK4a', 'eacgooemi!$%gmglr.1609340525', 'images/users/george.jpg', '2020-12-30 01:17:52', '2020-12-30 01:57:47'),
(9, 'Hector', 'Bronson', 'hector@gmail.com', '1609438210.0967_hector@gmail.com', '$2y$10$mAWxMbYlnZJx6DKbOb9ltuta3LQ6yG1GF8nvz0daLkKaIOgXK7rPy', 'm!$%.imeahocrgtloc1609438033', 'images/users/hector.jpg', '2020-12-31 19:54:18', '2020-12-31 08:11:07');

-- --------------------------------------------------------

--
-- Table structure for table `user_counter`
--

CREATE TABLE `user_counter` (
  `id` int NOT NULL,
  `user_liked` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_counter`
--

INSERT INTO `user_counter` (`id`, `user_liked`, `user_id`, `created_at`) VALUES
(114, 'Jenna', 4, '2020-12-22 18:06:19'),
(118, 'Admin', 7, '2020-12-29 22:43:51'),
(138, 'Admin', 8, '2020-12-29 23:24:03'),
(139, 'Admin', 1, '2020-12-30 22:25:18'),
(145, 'Anna', 9, '2020-12-31 18:17:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_counter`
--
ALTER TABLE `user_counter`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_counter`
--
ALTER TABLE `user_counter`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_counter`
--
ALTER TABLE `user_counter`
  ADD CONSTRAINT `user_counter_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
