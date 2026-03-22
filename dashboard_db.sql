-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Εξυπηρετητής: localhost:8889
-- Χρόνος δημιουργίας: 22 Μαρ 2026 στις 14:42:41
-- Έκδοση διακομιστή: 8.0.44
-- Έκδοση PHP: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Βάση δεδομένων: `dashboard_db`
--

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `tasks`
--

CREATE TABLE `tasks` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `title` varchar(155) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Άδειασμα δεδομένων του πίνακα `tasks`
--

INSERT INTO `tasks` (`id`, `user_id`, `title`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Test Task 1', 'First dummy task', 1, '2026-03-19 22:00:00', '2026-03-19 22:00:00'),
(2, 1, 'Test Task 2', 'Second dummy task.', 0, '2026-03-19 22:00:00', '2026-03-19 22:00:00'),
(5, 3, 'testing testing testing', 'this is a test from create.php if this is working i ll see it on database.', 0, '2026-03-21 18:53:15', '2026-03-22 02:07:31'),
(6, 3, 'testing security', 'testing for security issues', 0, '2026-03-21 20:11:53', '2026-03-22 02:05:04'),
(7, 3, 'jhgfjhgfjh', 'jhgkhjgljh', 0, '2026-03-22 01:59:50', '2026-03-22 02:05:26'),
(8, 3, 'fasdfasdgas', 'fasdfasdasasdfa', 1, '2026-03-22 02:00:12', '2026-03-22 14:13:50'),
(9, 3, 'testing bug', 'testing a bug about the task status!!!!', 1, '2026-03-22 02:09:49', '2026-03-22 12:39:32'),
(10, 3, 'testing the whole site', 'fsdosfsdfoskfmasdopompasdf', 0, '2026-03-22 14:14:07', '2026-03-22 14:14:07');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Άδειασμα δεδομένων του πίνακα `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`) VALUES
(1, 'test', 'test@gmail.com', '$2y$10$gCY9C.93wXyoOX7QuxqzL.zCqxF2aUx9xqQUOLYdJce/YgSwi2lYO', '2026-03-18'),
(3, 'test1', 'test1@gmail.com', '$2y$10$R3ATGG06tJzuzAOgd5QzsuIRKoVoeligpu1mb1mtksG5Jl/gRcITG', '2026-03-19'),
(4, 'test2', 'fsdf@gmail.com', '$2y$10$mz.2f9OO6WpUtmh5Lb1TZ.9hT/5s7KbVAi.I9dCR5bYQV9aN9wsX.', '2026-03-22');

--
-- Ευρετήρια για άχρηστους πίνακες
--

--
-- Ευρετήρια για πίνακα `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Ευρετήρια για πίνακα `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT για άχρηστους πίνακες
--

--
-- AUTO_INCREMENT για πίνακα `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT για πίνακα `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
