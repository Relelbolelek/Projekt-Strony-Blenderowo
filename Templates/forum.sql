-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Lis 09, 2026 at 12:26 PM
-- Wersja serwera: 10.11.16-MariaDB
-- Wersja PHP: 8.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `forum`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `gallery`
--

CREATE TABLE `gallery` (
  `ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Name` text NOT NULL,
  `Discription` text DEFAULT NULL,
  `image_ID` text NOT NULL,
  `Price` int(11) DEFAULT NULL,
  `Website_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Zrzut danych tabeli `gallery`
--

INSERT INTO `gallery` (`ID`, `User_ID`, `Name`, `Discription`, `image_ID`, `Price`, `Website_ID`) VALUES
(44, 16, 'Zdunek', 'asdads', 'Users/16/Gallery/Zdunek/Senko.png', 33, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `image_gallery`
--

CREATE TABLE `image_gallery` (
  `ID` int(11) NOT NULL,
  `Id_Pracy` int(11) NOT NULL,
  `Imiage_name` text NOT NULL,
  `Thumbnail` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Zrzut danych tabeli `image_gallery`
--

INSERT INTO `image_gallery` (`ID`, `Id_Pracy`, `Imiage_name`, `Thumbnail`) VALUES
(1, 44, 'Users/16/Gallery/Zdunek/Senko.png', 1),
(2, 45, 'Users/16/Gallery/asdasdadsdasads/Warstwa_1.png', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rating_gallery`
--

CREATE TABLE `rating_gallery` (
  `ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `ID_Pracy` int(11) NOT NULL,
  `Comment` text NOT NULL,
  `Rating` tinyint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Zrzut danych tabeli `rating_gallery`
--

INSERT INTO `rating_gallery` (`ID`, `User_ID`, `ID_Pracy`, `Comment`, `Rating`) VALUES
(1, 0, 44, 'sss', 2),
(2, 0, 44, 'sss', 2),
(3, 0, 44, 'asdasd', 3),
(4, 0, 44, 'sadasd', 1),
(5, 31, 44, 'sadasdasd', 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `Avatar` text NOT NULL DEFAULT 'templet.png',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `Avatar`, `created_at`) VALUES
(1, 'Zduenk5', '$2y$12$2zwbr7bYtJ80BbWfKctEAOYzrbx6IDpjEhlPrKsblAgTkMW0ncUxO', 'templet.png', '2026-11-09 10:57:31'),
(11, 'zsaddddddd', '$2y$10$4xIe4VPPx/4HYfj8aKxkoOXnYRp6UO6JlVaSBKAtqDS2zML7UzKfa', 'templet.png', '2026-09-07 10:00:29'),
(12, 'jajo', '$2y$10$QxIUufAW3Use5EXF6Ly6R.x8CAMzP3MMGZdW7KRzaC.mrO7CquMVG', 'templet.png', '2026-09-07 10:03:46'),
(15, 'Zdunek', '$2y$10$v2mezZ30Jj20/6bKj/ccFu7qYLGlywgiN0nzPbEv5dlHK2.eDNSPe', 'templet.png', '2026-09-07 12:08:37'),
(16, 'Zdunek1', '$2y$10$TPXO7nSAeB2S7bNeTvjjQOxXz6RLBLRzR3ASw0WfO6iacpPCRqSOK', 'templet.png', '2026-09-07 12:17:15'),
(17, 'Zdunek2', '$2y$10$2FYXozH7R9cdK7Z52FhtmO9snRvtYvyXutj6tp1aqUhxF2b2CPGsi', 'templet.png', '2026-09-07 12:41:02'),
(27, 'Zdunek15', '$2y$10$Pbi8UY3XKY7mdE.jz4pVNutXxo.I4P16c69hOIE.z9DBcj9ALuiMO', 'templet.png', '2026-09-17 09:56:28'),
(28, 'Pacus', '$2y$10$FvyOcRHYrkZag8b/VZSnyOCC8oGYNVrZsbQcwZ4piHQ8GwpgTJsku', 'templet.png', '2026-10-08 08:21:10'),
(29, 'Zduenk4', '$2y$12$YIM7QXyfce3DyHku4thV3ejuisLyof.1xYoC/16mUCrs2nNWUKEyq', 'templet.png', '2026-11-09 11:18:43'),
(30, 'Kacper', '$2y$12$/TwzfDbkYy4mFcm.lGZjReSGXYqfXbUIsQBvLlk3kPdfoXbN4/zQO', 'templet.png', '2026-11-09 11:25:02'),
(31, 'KACPER1', '$2y$12$fPkk83KhVuSOfQe0CGmH2.JVV2o30jwRNNwcZ/rz0IUexhf7J4Khm', 'templet.png', '2026-11-09 11:25:41');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `image_gallery`
--
ALTER TABLE `image_gallery`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `rating_gallery`
--
ALTER TABLE `rating_gallery`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `gallery`
--
ALTER TABLE `gallery`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT dla tabeli `image_gallery`
--
ALTER TABLE `image_gallery`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `rating_gallery`
--
ALTER TABLE `rating_gallery`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
