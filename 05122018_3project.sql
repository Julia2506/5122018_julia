-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Мар 29 2019 г., 10:02
-- Версия сервера: 10.1.35-MariaDB
-- Версия PHP: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `05122018_3project`
--
CREATE DATABASE IF NOT EXISTS `05122018_3project` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `05122018_3project`;

-- --------------------------------------------------------

--
-- Структура таблицы `catalogs`
--

CREATE TABLE IF NOT EXISTS `catalogs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `code` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `catalogs`
--

INSERT INTO `catalogs` (`id`, `name`, `code`) VALUES
(1, 'Мужское', 'man'),
(2, 'Женское', 'girl'),
(3, 'Детское', 'child');

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `img_src` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `sku` varchar(50) NOT NULL,
  `price` float NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `img_src`, `name`, `sku`, `price`, `description`) VALUES
(1, '/images/catalog/1.jpg', 'Куртка', '395986', 5499, 'Куртка осенняя, с капюшоном. Не промокнет и под ливнем.'),
(2, '/images/catalog/11.jpg', 'Джинсы', '4069883', 2100, 'Джинсы мужские, стильные модные молодежные.'),
(3, '/images/catalog/10.jpg', 'Очки', '979747', 1047, 'Очки как у Лепса.'),
(4, '/images/catalog/9.jpg', 'Шарф', '364611', 548, 'Шарф из натуральной шерсти, согреет даже в лютую зиму в России.'),
(5, '/images/catalog/8.jpg', 'Сумка', '3336454', 3900, 'Сумка для ноутбука.'),
(6, '/images/catalog/7.jpg', 'Джемпер', '999955', 1999, 'Джемпер с глубоким вырезом.'),
(7, '/images/catalog/2.jpg', 'Куртка 1', '395988', 5499, 'Куртка осенняя, с капюшоном. Не промокнет и под ливнем.'),
(13, '/images/catalog/4.jpg', 'Куртка 2', '395986', 5499, 'Куртка осенняя, из натуральной кожи, чтоб быть крутышкой.'),
(14, '/images/catalog/12.jpg', 'Джинсы 1', '4069882', 2100, 'Джинсы мужские, стильные модные молодежные.'),
(15, '/images/catalog/6.jpg', 'Очки 2', '979748', 1047, 'Очки как у Лепса.'),
(19, '/images/catalog/3.jpg', 'Куртка 1', '395988', 5499, 'Куртка осенняя, с капюшоном. Не промокнет и под ливнем.'),
(25, '/images/catalog/5.jpg', 'Куртка 1', '395988', 5499, 'Куртка осенняя, без капюшона. Бери зонт.'),
(26, '/images/catalog/4.jpg', 'Куртка 2', '395986', 5499, 'Куртка осенняя, из натуральной кожи, чтоб быть крутышкой.'),
(27, '/images/catalog/4.jpg', 'Куртка 2', '395986', 5499, 'Куртка осенняя, из натуральной кожи, чтоб быть крутышкой.');

-- --------------------------------------------------------

--
-- Структура таблицы `product_catalog`
--

CREATE TABLE IF NOT EXISTS `product_catalog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `catalog_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product_catalog`
--

INSERT INTO `product_catalog` (`id`, `product_id`, `catalog_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 2),
(4, 4, 1),
(5, 5, 1),
(6, 6, 3);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
