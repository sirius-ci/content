-- ----------------------------
-- Table structure for `contents`
-- ----------------------------
CREATE TABLE `contents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parentId` int(10) unsigned DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `summary` text,
  `detail` longtext,
  `image` varchar(255) DEFAULT NULL,
  `reserved` varchar(255) DEFAULT NULL,
  `metaTitle` varchar(255) DEFAULT NULL,
  `metaDescription` text,
  `metaKeywords` text,
  `order` int(10) unsigned NOT NULL DEFAULT '0',
  `language` varchar(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_contents_parentId` (`parentId`),
  CONSTRAINT `fk_contents_parentId` FOREIGN KEY (`parentId`) REFERENCES `contents` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

