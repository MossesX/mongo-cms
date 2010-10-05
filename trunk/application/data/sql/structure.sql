-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Окт 05 2010 г., 16:15
-- Версия сервера: 5.1.47
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
-- Структура таблицы `core_area`
--

DROP TABLE IF EXISTS `core_area`;
CREATE TABLE IF NOT EXISTS `core_area` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `core_template_id` int(5) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_core_area_core_template` (`core_template_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `core_block`
--

DROP TABLE IF EXISTS `core_block`;
CREATE TABLE IF NOT EXISTS `core_block` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `core_module_id` int(5) unsigned NOT NULL,
  `core_area_id` int(5) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_core_block_core_module` (`core_module_id`),
  KEY `fk_core_block_core_area` (`core_area_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `core_block_scheme`
--

DROP TABLE IF EXISTS `core_block_scheme`;
CREATE TABLE IF NOT EXISTS `core_block_scheme` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `core_block_id` int(5) unsigned NOT NULL,
  `core_site_id` int(5) unsigned DEFAULT NULL,
  `core_page_id` int(5) unsigned DEFAULT NULL,
  `inherit` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_core_block_scheme_core_block` (`core_block_id`),
  KEY `fk_core_block_scheme_core_site` (`core_site_id`),
  KEY `fk_core_block_scheme_core_page` (`core_page_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `core_module`
--

DROP TABLE IF EXISTS `core_module`;
CREATE TABLE IF NOT EXISTS `core_module` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `core_page`
--

DROP TABLE IF EXISTS `core_page`;
CREATE TABLE IF NOT EXISTS `core_page` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `core_page_id` int(5) unsigned DEFAULT NULL,
  `core_template_id` int(5) unsigned DEFAULT NULL,
  `core_site_id` int(5) unsigned NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_core_page_core_site` (`core_site_id`),
  KEY `fk_core_page_core_template` (`core_template_id`),
  KEY `fk_core_page_core_page` (`core_page_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Структура таблицы `core_site`
--

DROP TABLE IF EXISTS `core_site`;
CREATE TABLE IF NOT EXISTS `core_site` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `name` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Структура таблицы `core_template`
--

DROP TABLE IF EXISTS `core_template`;
CREATE TABLE IF NOT EXISTS `core_template` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `core_site_id` int(5) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `filename` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_core_template_core_site` (`core_site_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `core_area`
--
ALTER TABLE `core_area`
  ADD CONSTRAINT `fk_core_area_core_template` FOREIGN KEY (`core_template_id`) REFERENCES `core_template` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `core_block`
--
ALTER TABLE `core_block`
  ADD CONSTRAINT `fk_core_block_core_area` FOREIGN KEY (`core_area_id`) REFERENCES `core_area` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_core_block_core_module` FOREIGN KEY (`core_module_id`) REFERENCES `core_module` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `core_block_scheme`
--
ALTER TABLE `core_block_scheme`
  ADD CONSTRAINT `fk_core_block_scheme_core_block` FOREIGN KEY (`core_block_id`) REFERENCES `core_block` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_core_block_scheme_core_page` FOREIGN KEY (`core_page_id`) REFERENCES `core_page` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_core_block_scheme_core_site` FOREIGN KEY (`core_site_id`) REFERENCES `core_site` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `core_page`
--
ALTER TABLE `core_page`
  ADD CONSTRAINT `fk_core_page_core_page` FOREIGN KEY (`core_page_id`) REFERENCES `core_page` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_core_page_core_site` FOREIGN KEY (`core_site_id`) REFERENCES `core_site` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_core_page_core_template` FOREIGN KEY (`core_template_id`) REFERENCES `core_template` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `core_template`
--
ALTER TABLE `core_template`
  ADD CONSTRAINT `fk_core_template_core_site` FOREIGN KEY (`core_site_id`) REFERENCES `core_site` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

SET FOREIGN_KEY_CHECKS=1;
