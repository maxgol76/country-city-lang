-- phpMyAdmin SQL Dump
-- version 4.0.10.10
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 12 2016 г., 19:03
-- Версия сервера: 5.6.26
-- Версия PHP: 5.5.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `countrycitylang`
--

-- --------------------------------------------------------

--
-- Структура таблицы `city`
--

CREATE TABLE IF NOT EXISTS `city` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name_city` varchar(60) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_city` (`name_city`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Дамп данных таблицы `city`
--

INSERT INTO `city` (`id`, `name_city`) VALUES
(8, 'Berlin'),
(11, 'Bremen'),
(3, 'Brisbane'),
(19, 'Chicago'),
(20, 'Dallas'),
(14, 'Dnipropetrovsk'),
(9, 'Hamburg'),
(13, 'Kharkiv'),
(12, 'Kyiv'),
(18, 'Los Angeles'),
(16, 'Lviv'),
(6, 'Lyon'),
(5, 'Marseille'),
(1, 'Melbourne'),
(10, 'Munich'),
(17, 'New York'),
(7, 'Nice'),
(4, 'Paris'),
(2, 'Sydney'),
(15, 'Zaporizhia');

-- --------------------------------------------------------

--
-- Структура таблицы `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name_country` varchar(60) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_country` (`name_country`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=57 ;

--
-- Дамп данных таблицы `country`
--

INSERT INTO `country` (`id`, `name_country`) VALUES
(44, 'Australia'),
(2, 'France'),
(30, 'Germany'),
(4, 'Ukraine'),
(5, 'United States');

-- --------------------------------------------------------

--
-- Структура таблицы `lang`
--

CREATE TABLE IF NOT EXISTS `lang` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name_lang` varchar(60) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_lang` (`name_lang`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Дамп данных таблицы `lang`
--

INSERT INTO `lang` (`id`, `name_lang`) VALUES
(6, 'Deu'),
(1, 'Eng'),
(2, 'Fra'),
(4, 'Rus'),
(3, 'Spa'),
(5, 'Ukr');

-- --------------------------------------------------------

--
-- Структура таблицы `population`
--

CREATE TABLE IF NOT EXISTS `population` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_country` int(10) unsigned NOT NULL,
  `id_city` int(10) unsigned NOT NULL,
  `id_lang` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_country` (`id_country`,`id_city`,`id_lang`),
  KEY `id_city` (`id_city`),
  KEY `id_lang` (`id_lang`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Дамп данных таблицы `population`
--

INSERT INTO `population` (`id`, `id_country`, `id_city`, `id_lang`) VALUES
(4, 2, 4, 2),
(5, 2, 5, 2),
(6, 2, 6, 2),
(7, 2, 7, 2),
(12, 4, 12, 5),
(13, 4, 13, 5),
(14, 4, 14, 5),
(15, 4, 15, 5),
(16, 4, 16, 5),
(17, 5, 17, 1),
(18, 5, 18, 1),
(19, 5, 19, 1),
(20, 5, 20, 1),
(8, 30, 8, 6),
(9, 30, 9, 6),
(10, 30, 10, 6),
(11, 30, 11, 6),
(1, 44, 1, 1),
(2, 44, 2, 1),
(3, 44, 3, 1);

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `population`
--
ALTER TABLE `population`
  ADD CONSTRAINT `population_ibfk_1` FOREIGN KEY (`id_country`) REFERENCES `country` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `population_ibfk_2` FOREIGN KEY (`id_city`) REFERENCES `city` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `population_ibfk_3` FOREIGN KEY (`id_lang`) REFERENCES `lang` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
