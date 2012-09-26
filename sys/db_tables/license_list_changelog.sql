-- phpMyAdmin SQL Dump
-- version 2.11.9.5
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Авг 30 2009 г., 14:05
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
-- Структура таблицы `license_list_changelog`
--

CREATE TABLE IF NOT EXISTS `license_list_changelog` (
  `ver_1` int(2) NOT NULL,
  `ver_2` int(2) NOT NULL,
  `ver_3` int(2) NOT NULL,
  `text` varchar(512) NOT NULL,
  KEY `ver_1` (`ver_1`,`ver_2`,`ver_3`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
