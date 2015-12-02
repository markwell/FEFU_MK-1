-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Ноя 22 2015 г., 22:16
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `users`
--

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `staff_id` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `parent_id` (`staff_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `name`, `staff_id`) VALUES
(1, 'Первая группа', 1),
(2, 'Вторая группа', 1),
(3, 'Третья группа', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `event`
--

CREATE TABLE IF NOT EXISTS `event` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `description` varchar(9999) NOT NULL,
  `task` varchar(9999) NOT NULL,
  `group_id` int(5) NOT NULL,
  `staff_id` int(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`staff_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `event`
--

INSERT INTO `event` (`id`, `name`, `date`, `description`, `task`, `group_id`, `staff_id`) VALUES
(1, 'Занятие', '2015-11-16', 'Описание', 'Задание', 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `info`
--

CREATE TABLE IF NOT EXISTS `info` (
  `user_login` varchar(30) NOT NULL,
  `name` varchar(100) NOT NULL,
  `family_name` varchar(30) NOT NULL,
  `middle_name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone_number` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `info`
--

INSERT INTO `info` (`user_login`, `name`, `family_name`, `middle_name`, `email`, `phone_number`) VALUES
('mashnev', 'Михаил', 'Машнев', '', 'mashn@gmail.com', '89502878412'),
('alexa', 'Сашуля', 'Стефанюк', '', 'Zyzazy@gmail.com', '+79089780378'),
('migdalskiy', 'Артур', 'Мигдальский', '', 'a.migdalskiy@gmail.com', '89502878411'),
('sushkova', 'Дарья', 'Сушкова', '', 'sush@mail.ru', '890875623482'),
('admin', 'Aadmin', 'Admin', '', 'admin@admin.admin', '4232'),
('cirkunova', 'Юлия', 'Циркунова', '', 'cirk@uno.va', '89502878411'),
('makeev', 'Александр', 'Макеев', 'Григорьевич', 'mak@ee.v', '293489283498239'),
('shlandakov', 'Алексей', 'Шландаков', 'Алексеевич', 'shl@and.akov', '8950287124'),
('koltunov', 'Марк', 'Колтунов', 'Игоревич', 'mrak@mk.com', '89502996500');

-- --------------------------------------------------------

--
-- Структура таблицы `marks`
--

CREATE TABLE IF NOT EXISTS `marks` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `user_id` int(5) NOT NULL,
  `event_id` int(5) NOT NULL,
  `mark` int(2) NOT NULL,
  `visited` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `marks`
--

INSERT INTO `marks` (`id`, `user_id`, `event_id`, `mark`, `visited`) VALUES
(1, 36, 3, 0, 0),
(2, 36, 2, 0, 0),
(3, 36, 30, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `staff`
--

CREATE TABLE IF NOT EXISTS `staff` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `login` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  `name` varchar(100) NOT NULL,
  `family_name` varchar(30) NOT NULL,
  `category_id` int(5) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `hash` varchar(32) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `staff`
--

INSERT INTO `staff` (`id`, `login`, `password`, `name`, `family_name`, `category_id`, `status`, `hash`) VALUES
(1, 'klenina', 'klenina', 'Надежда Викторовна', 'Кленина', 1, 1, '');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_status` tinyint(1) NOT NULL DEFAULT '0',
  `user_login` varchar(30) NOT NULL,
  `user_password` varchar(32) NOT NULL,
  `user_hash` varchar(32) NOT NULL,
  `group_id` int(11) NOT NULL,
  `user_rating` int(3) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=66 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `user_status`, `user_login`, `user_password`, `user_hash`, `group_id`, `user_rating`) VALUES
(58, 0, 'migdalskiy', 'bde509190e9a85f7739939d094640c81', '7fb75dd31e74327e90078e9d5b1bd496', 1, 0),
(60, 0, 'admin', '77e2edcc9b40441200e31dc57dbb8829', '538a8535d17fcbbf50324c432f4a5a34', 0, 0),
(62, 0, 'cirkunova', 'd4150827195a690efb2a09549e7b75f0', '', 3, 80),
(63, 0, 'makeev', '0501269ba9ae92441fe7ef878b06b3ed', '', 0, 0),
(64, 0, 'shlandakov', '2b3bbf42bcbf168c1011ea5bd0548dff', '', 1, 0),
(65, 0, 'koltunov', '094a74c8d2fb78838e22c7291a6610a6', '3148338ea6d908cd537276d91b06d732', 3, 0),
(55, 0, 'mashnev', 'eec0f58cea9de915be2a86aca55b3451', 'a17bf38ac6af57fa1dacf7d2845575d8', 2, 50),
(59, 0, 'sushkova', '9ababa0614a0968511d8a7ed07c0c598', 'b01af15a8095b2bd62474af83831e223', 1, 21),
(57, 0, 'alexa', '3cd8aa6e0e0c6ec8191a97dc2ce21c8e', '93350b931975087515a17bdb676f6950', 2, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
