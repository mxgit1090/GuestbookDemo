-- DBNAME: GuestbookDemo --

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
	`updatedDateTime` datetime COMMENT '更新日期',
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS GuestbookCategoryMapping;

CREATE TABLE GuestbookCategoryMapping (
	`guestbookId`  int(11) COMMENT '文章 ID',
	`categoryId`   int(11) COMMENT '分類 ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;