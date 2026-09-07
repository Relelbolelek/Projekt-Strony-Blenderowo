-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Wrz 07, 2026 at 12:45 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `forum`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`) VALUES
(11, 'zsaddddddd', '$2y$10$4xIe4VPPx/4HYfj8aKxkoOXnYRp6UO6JlVaSBKAtqDS2zML7UzKfa', '2026-09-07 10:00:29'),
(12, 'jajo', '$2y$10$QxIUufAW3Use5EXF6Ly6R.x8CAMzP3MMGZdW7KRzaC.mrO7CquMVG', '2026-09-07 10:03:46'),
(15, 'Zdunek', '$2y$10$v2mezZ30Jj20/6bKj/ccFu7qYLGlywgiN0nzPbEv5dlHK2.eDNSPe', '2026-09-07 12:08:37'),
(16, 'Zdunek1', '$2y$10$TPXO7nSAeB2S7bNeTvjjQOxXz6RLBLRzR3ASw0WfO6iacpPCRqSOK', '2026-09-07 12:17:15'),
(17, 'Zdunek2', '$2y$10$2FYXozH7R9cdK7Z52FhtmO9snRvtYvyXutj6tp1aqUhxF2b2CPGsi', '2026-09-07 12:41:02');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

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
