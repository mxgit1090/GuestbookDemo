-- DBNAME: GuestbookDemo --
SET NAMES 'UTF8';

CREATE DATABASE IF NOT EXISTS GuestbookDemo;
USE GuestbookDemo;

DROP TABLE IF EXISTS Guestbook;

CREATE TABLE Guestbook (
	`id`      int(11) NOT NULL AUTO_INCREMENT COMMENT '文章 ID',
	`userId`  int(11) NOT NULL DEFAULT 0 COMMENT '作者 ID',
	`title`   varchar(35) COMMENT '文章標題',
	`content` longtext    COMMENT '文章內容',
	`createdDateTime` datetime COMMENT '建立日期',
	`updatedDateTime` datetime COMMENT '更新日期',
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE  IF EXISTS Category;

CREATE TABLE Category (
	`id`       int(11) NOT NULL AUTO_INCREMENT COMMENT '分類 ID',
	`category` varchar(20) COMMENT '分類名稱',
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE  IF EXISTS Comment;

CREATE TABLE Comment (
	`id`          int(11) NOT NULL AUTO_INCREMENT COMMENT '評論 ID',
	`guestbookId` int(11) NOT NULL DEFAULT 0 COMMENT '文章 ID',
	`userId`      int(11) NOT NULL DEFAULT 0 COMMENT '作者 ID',
	`content` longtext    COMMENT '文章內容',
	`isPublic` int(1) NOT NULL DEFAULT 0 COMMENT '是否公開',
	`updatedDateTime` datetime COMMENT '更新日期',
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS GuestbookCategoryMapping;

CREATE TABLE GuestbookCategoryMapping (
	`guestbookId`  int(11) COMMENT '文章 ID',
	`categoryId`   int(11) COMMENT '分類 ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS User;

CREATE TABLE `User` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '使用者 ID',
  `username` text NOT NULL COMMENT '使用者名稱',
  `password` varchar(34) NOT NULL COMMENT '密碼',
  `type` int(11) DEFAULT '0' COMMENT '使用者類別',
  `profile` mediumtext COMMENT '使用者資訊',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `User` VALUES (1,'admin','21232f297a57a5a743894a0e4a801fc3',999,NULL);