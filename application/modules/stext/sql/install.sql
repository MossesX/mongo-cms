-- phpMyAdmin SQL Dump
-- version 3.3.5
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Окт 09 2010 г., 23:06
-- Версия сервера: 5.1.49
-- Версия PHP: 5.3.3

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `cms4`
--

-- --------------------------------------------------------

--
-- Структура таблицы `stext_block`
--

DROP TABLE IF EXISTS `stext_block`;
CREATE TABLE IF NOT EXISTS `stext_block` (
  `core_block_id` int(5) unsigned NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`core_block_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `stext_block`
--
ALTER TABLE `stext_block`
  ADD CONSTRAINT `fk_stext_block_core_block` FOREIGN KEY (`core_block_id`) REFERENCES `core_block` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
