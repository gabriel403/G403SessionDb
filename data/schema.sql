CREATE TABLE `session` (
	`id` char(32) NOT NULL DEFAULT '',
	`modified` int(11) DEFAULT NULL,
	`lifetime` int(11) DEFAULT NULL,
	`data` text,
	`name` varchar(255) NOT NULL DEFAULT 'PHPSESSID',
	PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;