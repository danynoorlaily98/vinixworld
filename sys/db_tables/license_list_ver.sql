-- phpMyAdmin SQL Dump
-- version 2.11.9.5
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Авг 30 2009 г., 14:04
-- Версия сервера: 5.0.81
-- Версия PHP: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `dcmssu_test`
--

-- --------------------------------------------------------

--
-- Структура таблицы `license_list_ver`
--

CREATE TABLE IF NOT EXISTS `license_list_ver` (
  `id` int(11) NOT NULL,
  `ver_1` int(2) NOT NULL default '6',
  `ver_2` int(2) NOT NULL default '0',
  `ver_3` int(2) NOT NULL default '0',
  `delete` text,
  `sql` text,
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
