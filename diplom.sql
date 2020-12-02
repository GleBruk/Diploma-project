-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 02 2020 г., 15:11
-- Версия сервера: 10.3.13-MariaDB-log
-- Версия PHP: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `diplom`
--

-- --------------------------------------------------------

--
-- Структура таблицы `links`
--

CREATE TABLE `links` (
  `id` int(11) UNSIGNED NOT NULL,
  `long_link` varchar(255) NOT NULL,
  `short_link` varchar(50) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `links`
--

INSERT INTO `links` (`id`, `long_link`, `short_link`, `user_id`) VALUES
(10, 'https://www.youtube.com', 'ютуб', 1),
(9, 'https://www.youtube.com', 'youtube', 1),
(12, 'https://www.youtube.com', 'ютя', 4),
(13, 'https://www.youtube.com/', 'YT', 5),
(26, 'https://www.youtube.com', 'смотрюка', 8),
(28, 'https://www.youtube.com', 'проверка', 10),
(29, 'https://www.youtube.com', '12', 11),
(30, 'https://www.youtube.com', 'youtub', 15);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `login` varchar(50) NOT NULL,
  `pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `login`, `pass`) VALUES
(1, 'gleb-ruksha@rambler.ru', 'Ноль Целковович', '$2y$10$9OovzphgrJCxF4qdwj5DVOJNfGaYz3pUFH65PlNiAcCqmLEQcaJju'),
(4, 'gleb-ruksha@rambler.ru', 'Van', '$2y$10$30Z.Cq4jWkrI7Q/9rWB1ZeNOQbMWuuhD0Rv80yt8GkossHdT5nQU2'),
(5, 'gleb-ruksha@rambler.ru', 'Loui', '$2y$10$eFEFfFSMFOSk3tabxtgh3ufjaJFfWeERJ.ylD7pnKPL6XG6sLcRx.'),
(6, 'gleb-ruksha@rambler.ru', 'Harrington', '$2y$10$KgRwdmdPElCRdSoqz2Wmju5iUm1Nyq5.86s0IiDa.8RCvqtMThFsW'),
(8, 'gleb-ruksha@rambler.ru', 'GleBruk', '$2y$10$LzNO34bmJcDU4puxKNBX1OdKaRHJiH9ttXXf9ppLDVxs24P1/467S'),
(10, 'gleb-ruksha@rambler.ru', 'Chel', '$2y$10$rVyCCXHz6UC3O5G4o4izAO9N0QUdMuWV3Na.E63SJYu9iyR23Li.C'),
(11, 'glebruksha@rambler.ru', 'Dude', '$2y$10$HlfT10thhoD9MSdIWmtHm.pUiwfLJUDpBmAvlijav6rqStDOnC5Ki'),
(14, 'gleb-ruhas@rambler.run', 'Louis', '$2y$10$bF9yv5tBoC575QuXcG9fX.uUb0xv.lhlKYqj8/y8jIT5WRHO22q56'),
(15, 'gleb-ruksha@rambler.ru', 'Chelovek', '$2y$10$b3Bb5P3/Kr5mPY.bVMEhQewEB7dzDlyu98CvM7cvqdrxuMcJiHm0a');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `links`
--
ALTER TABLE `links`
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `links`
--
ALTER TABLE `links`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
