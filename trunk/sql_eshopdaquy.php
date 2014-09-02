<?php
$arrSql = array();
if($username ==='' and $password === '' )
{
	$arrSql[]="CREATE DATABASE IF NOT EXISTS `".$namedatabase."` /*!40100 DEFAULT CHARACTER SET utf8 */;";
	$arrSql[]="USE `".$namedatabase."`;";
}
$arrSql[] ="CREATE TABLE IF NOT EXISTS `eshop_advertisements` (
		`id` int(11) NOT NULL AUTO_INCREMENT,
		`eshop_id` int(50) NOT NULL DEFAULT '0',
		`name` varchar(256) CHARACTER SET utf8 NOT NULL,
		`link` varchar(256) CHARACTER SET ucs2 NOT NULL,
		`images` varchar(256) CHARACTER SET utf8 NOT NULL,
		`display` int(2) NOT NULL,
		`created` date NOT NULL,
		`modified` date NOT NULL,
		`status` int(2) NOT NULL,
		PRIMARY KEY (`id`),
		UNIQUE KEY `id` (`id`)
		) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;";

$arrSql[] ="INSERT INTO `eshop_advertisements` (`id`, `eshop_id`, `name`, `link`, `images`, `display`, `created`, `modified`, `status`) VALUES
(37,$shop_id, '2', '', 'img/data/b6531b0ef70a4edace2c11242596d0dd.png', 0, '2012-10-15', '2014-08-13', 0),
(36,$shop_id, '1', '', 'img/data/b6531b0ef70a4edace2c11242596d0dd.png', 1, '2012-10-15', '2014-08-13', 0);";


$arrSql[] ="CREATE TABLE IF NOT EXISTS `eshop_answerquestions` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`eshop_id` int(50) NOT NULL DEFAULT '0',
			`name` varchar(256) CHARACTER SET utf8 NOT NULL,
			`name_en` varchar(256) NOT NULL,
			`email` varchar(100) CHARACTER SET utf8 NOT NULL,
			`mobile` varchar(256) CHARACTER SET utf8 NOT NULL,
			`address` varchar(225) CHARACTER SET utf8 NOT NULL,
			`title` varchar(225) CHARACTER SET utf8 NOT NULL,
			`introduction` text CHARACTER SET utf8 NOT NULL,
			`content` text CHARACTER SET utf8 NOT NULL,
			`content_en` text NOT NULL,
			`answer` text CHARACTER SET utf8 NOT NULL,
			`created` datetime NOT NULL,
			`status` int(2) NOT NULL,
			PRIMARY KEY (`id`)
			) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;";

$arrSql[] ="CREATE TABLE IF NOT EXISTS `eshop_backgrounds` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`eshop_id` int(50) NOT NULL DEFAULT '0',
			`color` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
			`images` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
			`display` int(2) NOT NULL,
			`created` date NOT NULL,
			`status` int(2) NOT NULL,
			PRIMARY KEY (`id`)
			) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;";

$arrSql[] ="INSERT INTO `eshop_backgrounds` (`id`, `eshop_id`, `color`, `images`, `display`, `created`, `status`) VALUES
            (4,$shop_id, '7f003f', '/businessadmin/webroot/upload/image/files/Hydrangeas.jpg', 0, '2012-05-23', 0);";

$arrSql[] ="CREATE TABLE IF NOT EXISTS `eshop_banners` (
			`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
			`eshop_id` int(50) unsigned NOT NULL DEFAULT '0',
			`name` varchar(250) NOT NULL,
			`images` varchar(250) NOT NULL,
			`created` datetime NOT NULL,
			`status` int(2) NOT NULL,
			PRIMARY KEY (`id`)
			) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;";

$arrSql[] ="INSERT INTO `eshop_banners` (`id`, `eshop_id`, `name`, `images`, `created`, `status`) VALUES
            (1,$shop_id, 'Banner', 'img/gallery/96e1d7f83e9ce43860e265916ed9c6e6.swf', '2011-10-02 18:16:41', 0);";

$arrSql[] ="CREATE TABLE IF NOT EXISTS `eshop_bgmenus` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`eshop_id` int(50) NOT NULL DEFAULT '0',
			`color` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
			`images` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
			`width` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
			`height` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
			`created` date NOT NULL,
			`status` int(2) NOT NULL,
			PRIMARY KEY (`id`)
			) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;";

$arrSql[] ="INSERT INTO `eshop_bgmenus` (`id`, `eshop_id`, `color`, `images`, `width`, `height`, `created`, `status`) VALUES
			(5,$shop_id, 'aa8a8a', '/businessadmin/webroot/upload/image/files/Lighthouse.jpg', '10px', '10px', '2012-05-23', 1);";

$arrSql[] ="CREATE TABLE IF NOT EXISTS `eshop_cartmanagements` (
			`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
			`eshop_id` int(50) unsigned NOT NULL DEFAULT '0',
			`product_name` varchar(250) CHARACTER SET utf8 NOT NULL,
			`images` varchar(250) CHARACTER SET utf8 NOT NULL,
			`price` int(20) NOT NULL,
			`total` int(20) NOT NULL,
			`number` int(20) NOT NULL,
			`name` varchar(100) NOT NULL,
			`email` varchar(100) CHARACTER SET utf8 NOT NULL,
			`phone` varchar(20) CHARACTER SET utf8 NOT NULL,
			`address` varchar(250) CHARACTER SET utf8 NOT NULL,
			`title` varchar(250) CHARACTER SET utf8 NOT NULL,
			`content` varchar(400) CHARACTER SET utf8 NOT NULL,
			`created` date NOT NULL,
			`status` int(2) NOT NULL,
			PRIMARY KEY (`id`)
			) ENGINE=MyISAM DEFAULT CHARSET=latin1;";

$arrSql[] ="CREATE TABLE IF NOT EXISTS `eshop_categories` (
			`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
			`eshop_id` int(50) unsigned NOT NULL DEFAULT '0',
			`order` int(10) DEFAULT NULL,
			`alias` varchar(250) NOT NULL,
			`parent_id` int(10) DEFAULT NULL,
			`lft` int(10) DEFAULT NULL,
			`rght` int(10) DEFAULT NULL,
			`name` varchar(255) DEFAULT NULL,
			`name_en` varchar(255) DEFAULT NULL,
			`title` varchar(250) NOT NULL,
			`title_en` varchar(250) NOT NULL,
			`description` varchar(250) NOT NULL,
			`description_en` varchar(250) NOT NULL,
			`keywords` varchar(250) NOT NULL,
			`created` date NOT NULL,
			`modified` date NOT NULL,
			`status` int(2) NOT NULL,
			PRIMARY KEY (`id`)
			) ENGINE=MyISAM AUTO_INCREMENT=214 DEFAULT CHARSET=utf8;";

$arrSql[] ="INSERT INTO `eshop_categories` (`id`, `eshop_id`, `order`, `alias`, `parent_id`, `lft`, `rght`, `name`, `name_en`, `title`, `title_en`, `description`, `description_en`, `keywords`, `created`, `modified`, `status`) VALUES
			(201,$shop_id, 0, '', NULL, 3, 6, 'Tin tức', 'News', 'Tranh da Quy', 'Gemstone Paintings', 'Tranh da Quy', 'Gemstone Paintings', 'Tranh da Quy', '2011-11-23', '2012-10-17', 1),
			(200,$shop_id, NULL, '', NULL, 1, 2, 'Giới thiệu', 'Introduction', '', '', '', '', '', '2011-11-22', '2012-10-12', 0),
			(210,$shop_id, 0, 'co-so-san-xuat', NULL, 9, 10, 'CƠ SỞ SẢN XUẤT', 'Production facilities', '', '', '', '', '', '2012-10-12', '2012-10-12', 1),
			(209,$shop_id, 0, 'dich-vu', NULL, 7, 8, 'DỊCH VỤ', 'Services', '', '', '', '', '', '2012-10-12', '2012-10-12', 1),
			(211,$shop_id, 0, 'tu-van-phong-thuy', NULL, 11, 12, 'TƯ VẤN PHONG THỦY', 'Feng shui consultant', '', '', '', '', '', '2012-10-12', '2012-10-12', 1),
			(212,$shop_id, 0, 'tuyen-dung', NULL, 13, 14, 'TUYỂN DỤNG', 'Recruitment', 'Tranh da Quy', 'Gemstone Paintings', 'Tranh da quy', 'Gemstone Paintings', 'Tranh da Quy', '2012-10-12', '2012-10-17', 1),
			(213,$shop_id, 0, 'tranh-da-quy-ns', 201, 4, 5, 'Tranh Đá Quý  ', ' Gemstone Paintings', 'tranh da Quy', 'Gemstone Paintings', 'tranh da quy', 'Gemstone Paintings', 'tranh da quy ', '2012-10-17', '2012-10-17', 1);";

$arrSql[] ="CREATE TABLE IF NOT EXISTS `eshop_catproducts` (
			`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
			`eshop_id` int(50) unsigned NOT NULL DEFAULT '0',
			`parent_id` int(10) DEFAULT NULL,
			`lft` int(10) DEFAULT NULL,
			`rght` int(10) DEFAULT NULL,
			`name` varchar(250) CHARACTER SET utf8 NOT NULL,
			`name_en` varchar(250) NOT NULL,
			`title_seo` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
			`alias` varchar(250) CHARACTER SET utf8 NOT NULL,
			`created` date NOT NULL,
			`modified` datetime NOT NULL,
			`status` int(2) NOT NULL,
			`order` int(11) NOT NULL DEFAULT '0',
			`level` int(10) NOT NULL DEFAULT '0',
			`meta_key` mediumtext CHARACTER SET utf8,
			`meta_des` mediumtext CHARACTER SET utf8,
			PRIMARY KEY (`id`)
			) ENGINE=MyISAM AUTO_INCREMENT=85 DEFAULT CHARSET=latin1;";

$arrSql[] ="INSERT INTO `eshop_catproducts` (`id`, `eshop_id`, `parent_id`, `lft`, `rght`, `name`, `name_en`, `title_seo`, `alias`, `created`, `modified`, `status`, `order`, `level`, `meta_key`, `meta_des`) VALUES
			(70,$shop_id, NULL, 1, 12, 'TRANH ĐÁ QUÝ', 'Gemstone Painting', NULL, 'tranh-da-quy', '2012-10-12', '2012-10-12 15:03:57', 1, 0, 0, NULL, NULL),
			(71,$shop_id, NULL, 13, 16, 'ĐÁ QUÝ THÔ', 'Crude Gemstone', NULL, 'da-quy-tho', '2012-10-12', '2012-10-12 15:04:13', 1, 0, 0, NULL, NULL),
			(72,$shop_id, NULL, 17, 20, 'ĐÁ PHONG THỦY', 'Feng Shui Gemstone', NULL, 'da-phong-thuy', '2012-10-12', '2012-10-12 15:04:29', 1, 0, 0, NULL, NULL),
			(73,$shop_id, NULL, 21, 26, 'TRANG SỨC', 'Jewelry', NULL, 'trang-suc', '2012-10-12', '2012-10-12 15:04:39', 1, 0, 0, NULL, NULL),
			(74,$shop_id, 70, 2, 3, 'Phong cảnh', 'Scenery  Painting', NULL, 'phong-canh', '2012-10-12', '2012-10-12 15:06:19', 1, 0, 0, NULL, NULL),
			(75,$shop_id, 70, 4, 5, 'Tranh chân dung', 'Portrait Painting', NULL, 'tranh-chan-dung', '2012-10-12', '2012-10-12 15:06:36', 1, 0, 0, NULL, NULL),
			(76,$shop_id, 70, 6, 7, 'Tranh chữ', 'Calligraphy Painting', NULL, 'tranh-chu', '2012-10-12', '2012-10-12 15:06:49', 1, 0, 0, NULL, NULL),
			(77,$shop_id, 70, 8, 9, 'Tranh hoa', 'Flowers Painting', NULL, 'tranh-hoa', '2012-10-12', '2012-10-12 15:07:00', 1, 0, 0, NULL, NULL),
			(78,$shop_id, 70, 10, 11, 'Tranh muông thú', 'Animals Painting', NULL, 'tranh-muong-thu', '2012-10-12', '2012-10-12 15:07:18', 1, 0, 0, NULL, NULL),
			(79,$shop_id, 71, 14, 15, 'Ngọc Miên Điện', 'Myanmar Gem', NULL, 'ngoc-mien-dien', '2012-10-16', '2012-10-16 18:20:49', 1, 0, 0, NULL, NULL),
			(80,$shop_id, 72, 18, 19, 'Bát tự bảo', 'Quartz and Aagate', NULL, 'bat-tu-bao', '2012-10-16', '2012-10-16 18:25:56', 1, 0, 0, NULL, NULL),
			(81,$shop_id, 73, 22, 23, 'Lắc Tay', 'Bangle', NULL, 'lac-tay', '2012-10-16', '2012-10-16 18:29:02', 1, 0, 0, NULL, NULL),
			(82,$shop_id, 73, 24, 25, 'Mặt dây', 'Pendant', NULL, 'mat-day', '2012-10-16', '2012-10-16 18:29:23', 1, 0, 0, NULL, NULL),
			(83,$shop_id, NULL, 27, 30, 'TRANH ĐỒNG ', 'Copper Embossed Painting', NULL, 'tranh-dong', '2012-12-11', '2012-12-11 17:17:06', 1, 4, 0, NULL, NULL),
			(84,$shop_id, 83, 28, 29, 'Tranh đồng đá quý', 'Gemstone-Copper  Painting', NULL, 'tranh-dong-da-quy', '2012-12-11', '2012-12-11 17:21:59', 1, 1, 0, NULL, NULL);";

$arrSql[] ="CREATE TABLE IF NOT EXISTS `eshop_comments` (
			`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
			`eshop_id` int(50) unsigned NOT NULL DEFAULT '0',
			`title` varchar(100) NOT NULL,
			`content` text NOT NULL,
			`id_news` int(10) NOT NULL,
			`email` varchar(50) NOT NULL,
			`created` datetime NOT NULL,
			`status` int(2) NOT NULL,
			PRIMARY KEY (`id`)
			) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;";

 $arrSql[] ="CREATE TABLE IF NOT EXISTS `eshop_contacts` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`eshop_id` int(50) NOT NULL DEFAULT '0',
			`name` varchar(50) NOT NULL,
			`email` varchar(50) NOT NULL,
			`mobile` varchar(20) NOT NULL,
			`fax` varchar(20) DEFAULT NULL,
			`company` varchar(200) DEFAULT NULL,
			`title` varchar(200) NOT NULL,
			`content` text NOT NULL,
			`content_send` text,
			`created` date NOT NULL,
			`modified` date NOT NULL,
			`status` int(1) NOT NULL,
			PRIMARY KEY (`id`)
			) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;";


$arrSql[] ="INSERT INTO `eshop_contacts` (`id`, `eshop_id`, `name`, `email`, `mobile`, `fax`, `company`, `title`, `content`, `content_send`, `created`, `modified`, `status`) VALUES
			(4,$shop_id, 'Hoang Phuc', 'phuca4@gmail.com', '01688504263', '09487547584', 'Công ty abc', 'Chúc may mắn', 'dang test mail', '<p>\r\n	you are me and i am you</p>\r\n', '2011-07-04', '2011-07-04', 1);";

$arrSql[] ="CREATE TABLE IF NOT EXISTS `eshop_galleries` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`eshop_id` int(50) NOT NULL DEFAULT '0',
			`name` varchar(50) DEFAULT NULL,
			`display` int(2) NOT NULL,
			`images` varchar(255) NOT NULL,
			`created` date NOT NULL,
			`modified` date NOT NULL,
			`status` int(1) NOT NULL,
			PRIMARY KEY (`id`)
			) ENGINE=MyISAM AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;";

$arrSql[] ="INSERT INTO `eshop_galleries` (`id`, `eshop_id`, `name`, `display`, `images`, `created`, `modified`, `status`) VALUES
			(51,$shop_id, 'Anh 1', 0, 'img/gallery/4535d3077435975b6369e71da356bd5c.jpg', '2012-03-25', '2012-03-26', 1),
			(52,$shop_id, 'Anh 2', 0, 'img/gallery/8831b9719b67a0585e1fd4943325375c.jpg', '2012-03-25', '2012-03-26', 1);";


$arrSql[] ="CREATE TABLE IF NOT EXISTS `eshop_helps` (
			`id` int(10) NOT NULL AUTO_INCREMENT,
			`eshop_id` int(50) NOT NULL DEFAULT '0',
			`name` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
			`title` varchar(256) CHARACTER SET utf8 NOT NULL,
			`sdt` varchar(20) DEFAULT NULL,
			`yahoo` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
			`skype` varchar(256) DEFAULT NULL,
			`created` datetime NOT NULL,
			`modified` datetime NOT NULL,
			`status` int(1) NOT NULL,
			`email` varchar(50) DEFAULT NULL,
			PRIMARY KEY (`id`)
			) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;";

$arrSql[] ="INSERT INTO `eshop_helps` (`id`, `eshop_id`, `name`, `title`, `sdt`, `yahoo`, `skype`, `created`, `modified`, `status`, `email`) VALUES
			(28,$shop_id, 'Tư Vấn 1', '', '0983933518', 'phuca478', 'adv.globalmedia2', '2012-05-27 15:52:25', '2012-10-17 14:27:44', 1, 'phuca4@gmail.com');";

$arrSql[] ="CREATE TABLE IF NOT EXISTS `eshop_menus` (
			`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
			`eshop_id` int(50) unsigned NOT NULL DEFAULT '0',
			`name` varchar(250) NOT NULL,
			`name_en` varchar(250) NOT NULL,
			`alias` varchar(250) NOT NULL,
			`title` varchar(300) NOT NULL,
			`title_en` varchar(300) NOT NULL,
			`description` varchar(300) NOT NULL,
			`description_en` varchar(300) NOT NULL,
			`parent_id` int(10) DEFAULT NULL,
			`lft` int(10) DEFAULT NULL,
			`rght` int(11) DEFAULT NULL,
			`keywords` varchar(250) NOT NULL,
			`menu_id` int(11) NOT NULL,
			`order` int(11) NOT NULL,
			`created` date NOT NULL,
			`status` int(2) NOT NULL,
			PRIMARY KEY (`id`)
			) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;";

$arrSql[] ="INSERT INTO `eshop_menus` (`id`, `eshop_id`, `name`, `name_en`, `alias`, `title`, `title_en`, `description`, `description_en`, `parent_id`, `lft`, `rght`, `keywords`, `menu_id`, `order`, `created`, `status`) VALUES
			(7,$shop_id, 'Tin tức & Sự kiện', 'News & Events', 'tin-tuc', '', '', '', '', NULL, 1, 2, '', 0, 2, '2012-05-29', 1),
			(8,$shop_id, 'Khách hàng', 'Custommer', 'khach-hang', '', '', '', '', NULL, 3, 4, '', 0, 3, '2012-05-29', 1),
			(12,$shop_id, 'Liên hệ', 'Contact', 'lien-he', '', '', '', '', NULL, 5, 6, '', 0, 4, '2012-05-30', 1);";

$arrSql[] ="CREATE TABLE IF NOT EXISTS `eshop_modules` (
			`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
			`eshop_id` int(50) unsigned NOT NULL DEFAULT '0',
			`name` varchar(250) CHARACTER SET utf8 NOT NULL,
			`name_en` varchar(250) NOT NULL,
			`display` int(2) NOT NULL,
			`status` int(2) NOT NULL,
			`created` date NOT NULL,
			PRIMARY KEY (`id`)
			) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;";

$arrSql[] ="INSERT INTO `eshop_modules` (`id`, `eshop_id`, `name`, `name_en`, `display`, `status`, `created`) VALUES
			(1,$shop_id, 'Giỏ hàng', 'Shopping cart', 0, 1, '2012-05-27'),
			(2,$shop_id, 'Thống kê truy cập', 'Visitor Statistics', 0, 1, '2012-05-27');";

$arrSql[] ="CREATE TABLE IF NOT EXISTS `eshop_news` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`eshop_id` int(50) NOT NULL DEFAULT '0',
			`title` varchar(256) NOT NULL,
			`title_en` varchar(256) NOT NULL,
			`alias` varchar(250) NOT NULL,
			`introduction` text NOT NULL,
			`introduction_en` text NOT NULL,
			`content` text,
			`content_en` text,
			`images` varchar(256) NOT NULL,
			`category_id` int(11) NOT NULL,
			`source` varchar(200) NOT NULL,
			`view` int(50) NOT NULL,
			`meta_key` varchar(300) NOT NULL,
			`meta_des` varchar(300) NOT NULL,
			`homenews` int(2) NOT NULL,
			`news` int(2) NOT NULL,
			`created` date NOT NULL,
			`modified` datetime NOT NULL,
			`status` int(1) DEFAULT '0',
			PRIMARY KEY (`id`)
			) ENGINE=MyISAM AUTO_INCREMENT=105 DEFAULT CHARSET=utf8;";


$arrSql[] ="INSERT INTO `eshop_news` (`id`, `eshop_id`, `title`, `title_en`, `alias`, `introduction`, `introduction_en`, `content`, `content_en`, `images`, `category_id`, `source`, `view`, `meta_key`, `meta_des`, `homenews`, `news`, `created`, `modified`, `status`) VALUES
			(100,$shop_id, 'TRANH ĐÁ QUÝ ', 'Gemstone Paintings', 'tranh-da-quy-ngoc-son', '<p>\r\n	tranh đ&aacute; qu&yacute;  </p>\r\n', ' Gemstone Paintings', '<p style=\"text-align: center; \">\r\n	<img alt=\"tranh da quy ngoc son\" src=\"/admin/webroot/upload/image/images/tranh da quy (1).jpg\" style=\"width: 500px; height: 250px; \" /></p>\r\n<h2>\r\n	Với th&acirc;m ni&ecirc;n 20 năm trong nghề đ&aacute;!</h2>\r\n<p>\r\n	Từ những ng&agrave;y đầu th&agrave;nh lập, <a href=\"http://freemobileweb.mobi/\">tranh da quy </a> chỉ hoạt động tr&ecirc;n c&aacute;c mỏ đ&aacute; qu&yacute;, đến nay đ&atilde; mở rộng hệ thống cửa h&agrave;ng ra khắp c&aacute;c tỉnh th&agrave;nh trong nước v&agrave; cũng đ&atilde; mở rộng ra nước ngo&agrave;i. Văn ph&ograve;ng c&ocirc;ng ty tại: Số 6 Phạm Ngũ L&atilde;o - Ho&agrave;n Kiếm - H&agrave; Nội.</p>\r\n<h2>\r\n	<a href=\"http://freemobileweb.mobi/\">TRANH Đ&Aacute; QU&Yacute;  </a>&nbsp;c&oacute; 2 mục ti&ecirc;u ch&iacute;nh:</h2>\r\n<p>\r\n	Thứ nhất, trở th&agrave;nh một trong những nh&agrave; cung cấp đ&aacute; qu&yacute; lớn nhất Việt Nam, v&agrave; tạo điều kiện cho mỗi người y&ecirc;u đ&aacute; c&oacute; một vật hộ mệnh bằng đ&aacute;.<br />\r\n	Thứ hai, đưa t&agrave;i nguy&ecirc;n đ&aacute; qu&yacute; v&agrave; b&aacute;n qu&yacute; đến tay người ti&ecirc;u d&ugrave;ng Việt Nam, với ti&ecirc;u ch&iacute; &quot;người Việt ưu ti&ecirc;n d&ugrave;ng h&agrave;ng Việt&quot; để tr&aacute;nh chảy m&aacute;u t&agrave;i nguy&ecirc;n sang nước ngo&agrave;i.</p>\r\n<h2>\r\n	Tổng quan</h2>\r\n<p>\r\n	<a href=\"http://freemobileweb.mobi/\">tranh da quy choi &ndash; &ldquo;Tranh đ&aacute; qu&yacute;   &rdquo;</a></p>\r\n<p>\r\n	l&agrave; hệ thống cửa h&agrave;ng đ&aacute; phong thủy c&oacute; những sản phẩm v&agrave; dịch vụ sau:</p>\r\n<p>\r\n	Đ&aacute; cảnh phong thủy Đ&aacute; qu&yacute; hộ mệnh Tư vấn phong thủy miễn ph&iacute; Đặt h&agrave;ng VIP theo y&ecirc;u cầu Đ&aacute; qu&yacute; của <a href=\"http://freemobileweb.mobi/\">tranh da quy choi &ndash; &ldquo;Tranh đ&aacute; qu&yacute;   &rdquo;</a> đa số l&agrave; những tinh thể nguy&ecirc;n bản tourmaline v&agrave; aquamarine. Ch&uacute;ng t&ocirc;i cũng c&oacute; rất nhiều ruby, saphire, topaz, amethyst, v.v... đ&atilde; m&agrave;i th&agrave;nh mặt đ&aacute; trang sức.<br />\r\n	Ng&ograve;ai ra <a href=\"http://freemobileweb.mobi/\">tranh da quy choi &ndash; &ldquo;Tranh đ&aacute; qu&yacute;   &rdquo;</a></p>\r\n<p>\r\n	&nbsp;c&ograve;n c&oacute; rất nhiều c&aacute;c loại đ&aacute; b&aacute;n qu&yacute; như thạch anh (đủ loại), m&atilde; n&atilde;o, chalcedony, gỗ h&oacute;a thạch, v.v... Những sản phẩm n&agrave;y c&oacute; từ th&ocirc;, cảnh, tới những bức tượng được chế t&aacute;c từ ch&iacute;nh b&agrave;n tay nghệ thuật của nghệ nh&acirc;n Việt Nam.<br />\r\n	Tranh đ&aacute; qu&yacute;   &nbsp;b&aacute;n nhiều loại đ&aacute; qu&yacute; từ những vi&ecirc;n ngọc đ&atilde; m&agrave;i sẵn để l&agrave;m trang sức, đến những vi&ecirc;n đ&aacute; th&ocirc;, những vi&ecirc;n đ&aacute; cảnh, đ&aacute; phong thủy, đến những bức tranh đ&aacute; qu&yacute; đầy t&iacute;nh nghệ thuật. Ngo&agrave;i ra cửa h&agrave;ng c&ograve;n c&oacute; một bộ sưu tập Đ&ocirc;ng dược qu&yacute; hiếm như c&aacute;c loại cao xương, mật, rươu thuốc, v&agrave; sừng.</p>\r\n<p>\r\n	&nbsp;</p>\r\n', NULL, 'img/upload/b669888a8bf311ec64efa07bad501d34.jpg', 201, '', 0, 'tranh da quy ', 'tranh da quy ', 0, 0, '2012-10-17', '2012-10-17 14:27:27', 1),
			(101,$shop_id, 'đá quý  ', ' Gemstone', 'da-quy-ns', '<p>\r\n	tranh da quy ngoc son</p>\r\n', 'gemstone paintings', '<p style=\"text-align: center; \">\r\n	tranh d&aacute; qu&yacute;  </p>\r\n<p style=\"text-align: center; \">\r\n	<img alt=\"tranh da quy ngoc son\" src=\"/admin/webroot/upload/image/images/tranh da quy .jpg\" style=\"width: 500px; height: 250px; \" /></p>\r\n<p>\r\n	&nbsp;</p>\r\n', NULL, 'img/upload/b669888a8bf311ec64efa07bad501d34.jpg', 201, '', 0, 'tranh da quy ', 'tranh da quy', 0, 0, '2012-10-17', '2012-10-17 14:23:33', 1),
			(102,$shop_id, 'Cơ sở 1', 'Production facilities No.1', 'co-so-1', '<p>tranh đa Quy</p>\r\n', 'Gemstone Paintings', '<p>tranh da Quy</p>\r\n', NULL, 'img/upload/b669888a8bf311ec64efa07bad501d34.jpg', 210, '', 0, 'tranh da quy', 'tranh da quy', 0, 0, '2012-10-17', '2012-10-17 14:31:10', 1),
			(103,$shop_id, 'Đang Cập Nhập', 'Updating', 'dang-cap-nhap', '<p>tranh da quy</p>\r\n', 'Gemstone Paintings', '<p>tranh da quy</p>\r\n', NULL, 'img/upload/b669888a8bf311ec64efa07bad501d34.jpg', 212, '', 0, 'tranh da quy', 'tranh da quy', 0, 0, '2012-10-17', '2012-10-17 14:29:25', 1),
			(104,$shop_id, 'Đang Cập Nhập', 'Updating', 'dang-cap-nhap', '<p>\r\n	tranh da quy ngoc son</p>\r\n', 'gemstone paintings', '<p>\r\n	tranh da quy ngoc son</p>\r\n', NULL, 'img/upload/b669888a8bf311ec64efa07bad501d34.jpg', 209, '', 0, 'tranh da quy', 'tranh da quy ', 0, 0, '2012-10-17', '2012-10-17 14:28:03', 1),
			(97,$shop_id, 'Giới thiệu tranh đá quý  ', 'Introduction about  Gemstone Paintings', 'gioi-thieu-tranh-da-quy-ns', '<p>\r\n	Từ những ng&agrave;y đầu th&agrave;nh lập, Tranh da quy &nbsp;chỉ hoạt động tr&ecirc;n c&aacute;c mỏ đ&aacute; qu&yacute;, đến nay đ&atilde; mở rộng hệ thống cửa h&agrave;ng ra khắp c&aacute;c tỉnh th&agrave;nh trong nước v&agrave; cũng đ&atilde; mở rộng ra nước ngo&agrave;i. Văn ph&ograve;ng c&ocirc;ng ty tại: Số 6 Phạm Ngũ L&atilde;o - Ho&agrave;n Kiếm - H&agrave; Nội</p>\r\n', 'Since the early days, ngocsonchoithu Gemstone Paintings has only worked in the gemstone mines, now we have expanded  our store system to all provinces in Vietnam and overseas market also. Company headquarters: No.6, Pham Ngu Lao Street, Hoan Kiem District, Hanoi.', '<div class=\"content\">\r\n	<h2>\r\n		&nbsp;</h2>\r\n	<h2>\r\n		<span style=\"font-family: Arial; \">Với th&acirc;m ni&ecirc;n 20 năm trong nghề đ&aacute;!<o:p></o:p></span></h2>\r\n	<p>\r\n		<span style=\"font-size: 13pt; font-family: Arial; \">Từ những ng&agrave;y đầu th&agrave;nh lập, </span><span style=\"font-size:13.0pt;\r\nfont-family:Tahoma;color:black\"><a href=\"http://freemobileweb.mobi/\">tranh da quy </a> </span><span style=\"font-size: 13pt; font-family: Arial; \">chỉ hoạt động tr&ecirc;n c&aacute;c mỏ đ&aacute; qu&yacute;, đến nay đ&atilde; mở rộng hệ thống cửa h&agrave;ng ra khắp c&aacute;c tỉnh th&agrave;nh trong nước v&agrave; cũng đ&atilde; mở rộng ra nước ngo&agrave;i. Văn ph&ograve;ng c&ocirc;ng ty tại: Số 6 Phạm Ngũ L&atilde;o - Ho&agrave;n Kiếm - H&agrave; Nội.<o:p></o:p></span></p>\r\n	<h2>\r\n		<span style=\"font-size:13.0pt;font-family:Tahoma;\r\ncolor:black\"><a href=\"http://freemobileweb.mobi/\">TRANH Đ&Aacute; QU&Yacute;  </a>&nbsp;</span><span style=\"font-family: Arial; \">c&oacute; 2 mục ti&ecirc;u ch&iacute;nh:<o:p></o:p></span></h2>\r\n	<p>\r\n		<span style=\"font-size: 13pt; font-family: Arial; \">Thứ nhất, trở th&agrave;nh một trong những nh&agrave; cung cấp đ&aacute; qu&yacute; lớn nhất Việt <st1:country-region w:st=\"on\"><st1:place w:st=\"on\">Nam</st1:place></st1:country-region>, v&agrave; tạo điều kiện cho mỗi người y&ecirc;u đ&aacute; c&oacute; một vật hộ mệnh bằng đ&aacute;.<br />\r\n		Thứ hai, đưa t&agrave;i nguy&ecirc;n đ&aacute; qu&yacute; v&agrave; b&aacute;n qu&yacute; đến tay người ti&ecirc;u d&ugrave;ng Việt Nam, với ti&ecirc;u ch&iacute; &quot;người Việt ưu ti&ecirc;n d&ugrave;ng h&agrave;ng Việt&quot; để tr&aacute;nh chảy m&aacute;u t&agrave;i nguy&ecirc;n sang nước ngo&agrave;i.<o:p></o:p></span></p>\r\n	<h2>\r\n		<span style=\"font-family: Arial; \">Tổng quan<o:p></o:p></span></h2>\r\n	<p style=\"margin:0in;margin-bottom:.0001pt;line-height:19.35pt\">\r\n		<span style=\"font-size:13.0pt;font-family:Tahoma;color:black\"><a href=\"http://freemobileweb.mobi/\">tranh da quy choi &ndash; &ldquo;Tranh đ&aacute; qu&yacute;   &rdquo;</a><o:p></o:p></span></p>\r\n	<p>\r\n		<span style=\"font-size: 13pt; font-family: Arial; \">l&agrave; hệ thống cửa h&agrave;ng đ&aacute; phong thủy c&oacute; những sản phẩm v&agrave; dịch vụ sau:<o:p></o:p></span></p>\r\n	<p style=\"margin:0in;margin-bottom:.0001pt;line-height:19.35pt\">\r\n		<span style=\"font-size: 13pt; font-family: Arial; \">Đ&aacute; cảnh phong thủy Đ&aacute; qu&yacute; hộ mệnh Tư vấn phong thủy miễn ph&iacute; Đặt h&agrave;ng VIP theo y&ecirc;u cầu Đ&aacute; qu&yacute; của </span><span style=\"font-size:13.0pt;font-family:Tahoma;color:black\"><a href=\"http://freemobileweb.mobi/\">tranh da quy choi &ndash; &ldquo;Tranh đ&aacute; qu&yacute;   &rdquo;</a> </span><span style=\"font-size: 13pt; font-family: Arial; \">đa số l&agrave; những tinh thể nguy&ecirc;n bản tourmaline v&agrave; aquamarine. Ch&uacute;ng t&ocirc;i cũng c&oacute; rất nhiều ruby, saphire, topaz, amethyst, v.v... đ&atilde; m&agrave;i th&agrave;nh mặt đ&aacute; trang sức.<br />\r\n		Ng&ograve;ai ra </span><span style=\"font-size:13.0pt;font-family:Tahoma;color:black\"><a href=\"http://freemobileweb.mobi/\">tranh da quy choi &ndash; &ldquo;Tranh đ&aacute; qu&yacute;   &rdquo;</a><o:p></o:p></span></p>\r\n	<p style=\"margin:0in;margin-bottom:.0001pt;line-height:19.35pt\">\r\n		<span style=\"font-size: 13pt; font-family: Arial; \">&nbsp;c&ograve;n c&oacute; rất nhiều c&aacute;c loại đ&aacute; b&aacute;n qu&yacute; như thạch anh (đủ loại), m&atilde; n&atilde;o, chalcedony, gỗ h&oacute;a thạch, v.v... Những sản phẩm n&agrave;y c&oacute; từ th&ocirc;, cảnh, tới những bức tượng được chế t&aacute;c từ ch&iacute;nh b&agrave;n tay nghệ thuật của nghệ nh&acirc;n Việt <st1:country-region w:st=\"on\"><st1:place w:st=\"on\">Nam</st1:place></st1:country-region>.<br />\r\n		Tranh đ&aacute; qu&yacute;   &nbsp;b&aacute;n nhiều loại đ&aacute; qu&yacute; từ những vi&ecirc;n ngọc đ&atilde; m&agrave;i sẵn để l&agrave;m trang sức, đến những vi&ecirc;n đ&aacute; th&ocirc;, những vi&ecirc;n đ&aacute; cảnh, đ&aacute; phong thủy, đến những bức tranh đ&aacute; qu&yacute; đầy t&iacute;nh nghệ thuật. Ngo&agrave;i ra cửa h&agrave;ng c&ograve;n c&oacute; một bộ sưu tập Đ&ocirc;ng dược qu&yacute; hiếm như c&aacute;c loại cao xương, mật, rươu thuốc, v&agrave; sừng.</span><span style=\"font-size:13.0pt;\r\nfont-family:Tahoma;color:black\"><o:p></o:p></span></p>\r\n</div>\r\n', NULL, 'img/upload/b669888a8bf311ec64efa07bad501d34.jpg', 200, '', 0, 'Tranh da quy ', 'Tranh Đá Quý ', 1, 1, '2012-10-12', '2012-10-17 14:31:23', 1),
			(99,$shop_id, 'TRANH ĐÁ QUÝ  ', 'GEMSTONE PAINTINGS', 'tranh-da-quy-ns', '<p>\r\n	TRANH Đ&Aacute; QU&Yacute;   - tranh da quy </p>\r\n', ' GEMSTONE PAINTINGS', '<p>\r\n	&nbsp;</p>\r\n<p>\r\n	<strong>GIỚI THIỆU VỀ TRANH Đ&Aacute; QU&Yacute;  </strong></p>\r\n<p>\r\n	K&iacute;nh gửi qu&yacute; kh&aacute;ch h&agrave;ng!</p>\r\n<p>\r\n	<strong>TRANH Đ&Aacute; QU&Yacute;  </strong>&nbsp;xin được giới thiệu với qu&yacute; kh&aacute;ch một loại tranh nghệ thuật v&ocirc; c&ugrave;ng đặc sắc được tạo n&ecirc;n từ chất liệu rất đặc biệt,đ&oacute; l&agrave; đ&aacute; qu&yacute; thi&ecirc;n nhi&ecirc;n được lấy trực tiếp từ v&ugrave;ng mỏ Lục Y&ecirc;n của tỉnh Y&ecirc;n B&aacute;i.</p>\r\n<p>\r\n	<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;Dưới b&agrave;n tay kh&eacute;o l&eacute;o v&agrave; tinh tế <a href=\"http://freemobileweb.mobi/\">tranh da quy </a>, những vi&ecirc;n đ&aacute; &oacute;ng &aacute;nh lung linh với mu&ocirc;n v&agrave;n sắc m&agrave;u kỳ diệu đ&atilde; được dệt l&ecirc;n th&agrave;nh những bức tranh tuyệt mỹ. Sản phẩm tranh đ&aacute; qu&yacute; của ch&uacute;ng t&ocirc;i được l&agrave;m ho&agrave;n to&agrave;n từ đ&aacute; qu&yacute; thi&ecirc;n nhi&ecirc;n với sự kết hợp tuyệt vời của c&aacute;c lọai đ&aacute; qu&yacute; v&agrave; đ&aacute; b&aacute;n qu&yacute; như: ruby, sapphire,tourmaline,opal,garmet&hellip;<a href=\"http://freemobileweb.mobi/\">tranh da quy </a> n&ecirc;n tranh c&oacute; m&agrave;u sắc vĩnh cửu kh&ocirc;ng bị t&aacute;c động bởi m&ocirc;i trường v&agrave; nhiệt độ.</p>\r\n<p>\r\n	<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;Quy tr&igrave;nh l&agrave;m tranh phải trải qua nhiều c&ocirc;ng đọan phức tạp v&agrave; tinh tế như: đập đ&aacute; ,ph&acirc;n lọai ,tẩy rửa, s&agrave;ng sẩy ,vẽ tranh v&agrave; cuối c&ugrave;ng l&agrave; gắn đ&aacute;.Do đ&oacute; n&eacute;t độc d&aacute;o của tranh kh&ocirc;ng chỉ ở chất liệu qu&yacute; bền l&acirc;u c&ugrave;ng thời gian m&agrave; c&ograve;n ở gi&aacute; trị sức lao động nghệ thuật kết tinh trong tranh.</p>\r\n<p>\r\n	&nbsp;&nbsp;&nbsp;&nbsp;Sản phẩm của ch&uacute;ng t&ocirc;i đạt chất lượng v&agrave; thẩm mỹ của những người khắt khe nhất. tranh da quy choi &ndash; &ldquo;<a href=\"http://freemobileweb.mobi/\">Tranh đ&aacute; qu&yacute;  </a> &rdquo;</p>\r\n<p>\r\n	<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;tranh da quy choi &ndash; &ldquo;Tranh đ&aacute; qu&yacute;   &rdquo;</p>\r\n<p>\r\n	&nbsp;nhận chế t&aacute;c tranh theo y&ecirc;u cầu của qu&yacute; kh&aacute;ch. Hy vọng rằng qu&yacute; kh&aacute;ch h&agrave;ng sẽ chọn được những bức tranh v&ocirc; c&ugrave;ng &yacute; ngĩa để d&agrave;nh tặng cho gia đ&igrave;nh ,người th&acirc;n v&agrave; bạn b&egrave; m&igrave;nh.</p>\r\n<p>\r\n	Xin ch&acirc;n th&agrave;nh cảm ơn. <a href=\"http://freemobileweb.mobi/\">tranh da quy choi &ndash; &ldquo;Tranh đ&aacute; qu&yacute;   &rdquo;</a></p>\r\n<p>\r\n	TRANH Đ&Aacute; QU&Yacute;  .</p>\r\n<p>\r\n	&nbsp;</p>\r\n', NULL, 'img/upload/b669888a8bf311ec64efa07bad501d34.jpg', 201, '', 0, 'tranh da quy', 'tranh da quy  - TRANH ĐÁ QUÝ  ', 1, 1, '2012-10-17', '2012-10-17 14:31:44', 1);";

$arrSql[] ="CREATE TABLE IF NOT EXISTS `eshop_partners` (
			`id` int(10) NOT NULL AUTO_INCREMENT,
			`eshop_id` int(50) NOT NULL DEFAULT '0',
			`name` varchar(256) NOT NULL,
			`phone` varchar(15) NOT NULL,
			`email` varchar(256) NOT NULL,
			`website` varchar(256) DEFAULT NULL,
			`fax` varchar(15) DEFAULT NULL,
			`address` varchar(256) NOT NULL,
			`images` varchar(256) NOT NULL,
			`content` text,
			`created` date NOT NULL,
			`modified` date NOT NULL,
			`status` int(1) NOT NULL,
			PRIMARY KEY (`id`)
			) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;";


$arrSql[] ="INSERT INTO `eshop_partners` (`id`, `eshop_id`, `name`, `phone`, `email`, `website`, `fax`, `address`, `images`, `content`, `created`, `modified`, `status`) VALUES
			(18,$shop_id, 'Quảng cáo vip', '0912 211 945', 'trung vip@gmail.com', 'dsf.com', NULL, 'Hà Nội', 'img/gallery/b669888a8bf311ec64efa07bad501d34.jpg', NULL, '2012-05-27', '2012-10-17', 1),
			(19,$shop_id, 'phuc', '0912 211 945', 'phucaagas@gmail.com', 'http://freemobileweb.mobi', NULL, 'Phú Viên', 'img/gallery/b669888a8bf311ec64efa07bad501d34.jpg', NULL, '2012-10-17', '2012-10-17', 1);";

$arrSql[] ="CREATE TABLE IF NOT EXISTS `eshop_polls` (
			`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
			`eshop_id` int(50) unsigned NOT NULL DEFAULT '0',
			`count` int(10) NOT NULL,
			`name` varchar(250) NOT NULL,
			`created` date NOT NULL,
			`status` int(2) NOT NULL,
			PRIMARY KEY (`id`)
			) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;";


$arrSql[] ="INSERT INTO `eshop_polls` (`id`, `eshop_id`, `count`, `name`, `created`, `status`) VALUES
			(1,$shop_id, 13, '   Rất Xấu', '2011-12-01', 1),
			(2,$shop_id, 1, 'Xấu', '2011-12-01', 1),
			(3,$shop_id, 3, '   Bình thường', '2011-12-01', 1),
			(4,$shop_id, 15, 'Đẹp', '2011-12-01', 1),
			(6,$shop_id, 1, 'Quá đẹp', '2012-05-27', 1);";

$arrSql[] ="CREATE TABLE IF NOT EXISTS `eshop_products` (
			`id` int(10) NOT NULL AUTO_INCREMENT,
			`eshop_id` int(50) NOT NULL DEFAULT '0',
			`title` varchar(256) NOT NULL,
			`title_en` varchar(256) NOT NULL,
			`alias` varchar(250) NOT NULL,
			`order` int(11) DEFAULT NULL,
			`price` varchar(20) DEFAULT NULL,
			`manufacturer` varchar(256) NOT NULL COMMENT 'hang sx',
			`content` text NOT NULL,
			`content_en` text NOT NULL,
			`images` varchar(256) DEFAULT NULL,
			`images1` varchar(250) DEFAULT NULL,
			`images2` varchar(250) DEFAULT NULL,
			`images3` varchar(250) NOT NULL,
			`images4` varchar(250) DEFAULT NULL,
			`detail` varchar(400) DEFAULT NULL,
			`catproduct_id` int(10) NOT NULL,
			`homeproduct` int(2) NOT NULL,
			`newsproduct` int(2) NOT NULL COMMENT 'san pham moi',
			`featuredproducts` int(2) NOT NULL COMMENT 'sp tieu bieu',
			`saleoff` int(2) NOT NULL,
			`meta_key` varchar(250) DEFAULT NULL,
			`meta_des` varchar(250) DEFAULT NULL,
			`created` datetime DEFAULT NULL,
			`modified` datetime DEFAULT NULL,
			`status` int(2) NOT NULL,
			`speproduct` int(2) DEFAULT NULL,
			`tranhdaquy` int(2) DEFAULT NULL,
			`daquytho` int(2) DEFAULT NULL,
			`daphongthuy` int(2) DEFAULT NULL,
			`trangsuc` int(2) DEFAULT NULL,
			PRIMARY KEY (`id`)
			) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;";


$arrSql[] ="INSERT INTO `eshop_products` (`id`, `eshop_id`, `title`, `title_en`, `alias`, `order`, `price`, `manufacturer`, `content`, `content_en`, `images`, `images1`, `images2`, `images3`, `images4`, `detail`, `catproduct_id`, `homeproduct`, `newsproduct`, `featuredproducts`, `saleoff`, `meta_key`, `meta_des`, `created`, `modified`, `status`, `speproduct`, `tranhdaquy`, `daquytho`, `daphongthuy`, `trangsuc`) VALUES
			(32,$shop_id, 'Hạc trắng', 'White crane', 'hac-trang', NULL, '', '', '<div class=\"content left\">\r\n	<div class=\"info_p\">\r\n		<div class=\"tr\">\r\n			<span style=\"color:#ff0000;\"><span>&diams; M&atilde; sản phẩm: </span>#1</span></div>\r\n		<div class=\"tr\">\r\n			<span style=\"color:#ff0000;\"><span>&diams; Gi&aacute; sản phẩm: </span> Li&ecirc;n hệ</span></div>\r\n		<div class=\"tr\">\r\n			<span style=\"color:#ff0000;\"><span>&diams; Trong kho: </span><span>Hết h&agrave;ng</span></span></div>\r\n		<div class=\"tr\">\r\n			<span style=\"color:#ff0000;\"><span>&diams; Th&ocirc;ng tin: </span></span></div>\r\n	</div>\r\n</div>\r\n', '', 'img/upload/bd0b4508ffc932e2b349707332889171.jpg', '', '', '', '', NULL, 74, 0, 0, 0, 0, NULL, NULL, '2012-10-12 15:09:03', '2012-10-15 14:47:54', 1, 0, 1, 1, 1, 1),
			(33,$shop_id, 'Đôi chim công', 'Two peacocks', 'doi-chim-cong', NULL, '', '', '<div class=\"content left\">\r\n	<div class=\"info_p\">\r\n		<div class=\"tr\">\r\n			<span>&diams; M&atilde; sản phẩm: </span>#2</div>\r\n		<div class=\"tr\">\r\n			<span>&diams; Gi&aacute; sản phẩm: </span> Li&ecirc;n hệ</div>\r\n		<div class=\"tr\">\r\n			<span>&diams; Trong kho: </span><span>Hết h&agrave;ng</span></div>\r\n		<div class=\"tr\">\r\n			<span>&diams; Th&ocirc;ng tin: </span></div>\r\n	</div>\r\n</div>\r\n', '', 'img/upload/12f2fcfede7445d8de9bdb494a2ab5b2.jpg', '', '', '', '', NULL, 74, 0, 0, 0, 0, NULL, NULL, '2012-10-12 15:09:46', '2012-10-12 16:06:23', 1, 1, 1, 0, 0, 0),
			(34,$shop_id, 'Thác hạc', 'Fall - cranes', 'thac-hac', NULL, '', '', '<div class=\"content left\">\r\n	<div class=\"info_p\">\r\n		<div class=\"tr\">\r\n			<span>&diams; M&atilde; sản phẩm: </span>#12</div>\r\n		<div class=\"tr\">\r\n			<span>&diams; Gi&aacute; sản phẩm: </span> Li&ecirc;n hệ</div>\r\n		<div class=\"tr\">\r\n			<span>&diams; Trong kho: </span><span>Hết h&agrave;ng</span></div>\r\n		<div class=\"tr\">\r\n			<span>&diams; Th&ocirc;ng tin: </span></div>\r\n	</div>\r\n</div>\r\n', '', 'img/upload/3d262c53f145536bd80fdecc7e29fc6a.jpg', '', '', '', '', NULL, 74, 0, 0, 0, 0, NULL, NULL, '2012-10-12 15:10:21', '2012-10-12 16:06:31', 1, 1, 1, 0, 0, 0),
			(35,$shop_id, 'Vịnh', 'Bay', 'vinh', NULL, '', '', '<div class=\"content left\">\r\n	<div class=\"info_p\">\r\n		<div class=\"tr\">\r\n			<span>&diams; M&atilde; sản phẩm: </span>#12</div>\r\n		<div class=\"tr\">\r\n			<span>&diams; Gi&aacute; sản phẩm: </span> Li&ecirc;n hệ</div>\r\n		<div class=\"tr\">\r\n			<span>&diams; Trong kho: </span><span>Hết h&agrave;ng</span></div>\r\n		<div class=\"tr\">\r\n			<span>&diams; Th&ocirc;ng tin: </span></div>\r\n	</div>\r\n</div>\r\n', '', 'img/upload/9085e8a9b725acb1765610a8b48af6c0.jpg', '', '', '', '', NULL, 74, 0, 0, 0, 0, NULL, NULL, '2012-10-12 15:11:00', '2012-10-12 16:06:39', 1, 1, 1, 0, 0, 0),
			(36,$shop_id, 'Tranh đá quý', 'Gemstone painting', 'tranh-da-quy', NULL, '', '', '<div class=\"content left\">\r\n	<div class=\"info_p\">\r\n		<div class=\"tr\">\r\n			<span>&diams; M&atilde; sản phẩm: </span>#12</div>\r\n		<div class=\"tr\">\r\n			<span>&diams; Gi&aacute; sản phẩm: </span> Li&ecirc;n hệ</div>\r\n		<div class=\"tr\">\r\n			<span>&diams; Trong kho: </span><span>Hết h&agrave;ng</span></div>\r\n		<div class=\"tr\">\r\n			<span>&diams; Th&ocirc;ng tin: </span></div>\r\n	</div>\r\n</div>\r\n', '', 'img/upload/f88487b1babf04c4dd4d62c8cc465a72.jpg', '', '', '', '', NULL, 74, 0, 0, 0, 0, NULL, NULL, '2012-10-12 15:11:33', '2012-10-12 16:06:47', 1, 1, 1, 0, 0, 0),
			(37,$shop_id, 'Rừng cây lá đỏ', 'Red-leaved forest', 'rung-cay-la-do', NULL, '', '', '<div class=\"content left\">\r\n	<div class=\"info_p\">\r\n		<div class=\"tr\">\r\n			<span>&diams; M&atilde; sản phẩm: </span>#12</div>\r\n		<div class=\"tr\">\r\n			<span>&diams; Gi&aacute; sản phẩm: </span> Li&ecirc;n hệ</div>\r\n		<div class=\"tr\">\r\n			<span>&diams; Trong kho: </span><span>Hết h&agrave;ng</span></div>\r\n		<div class=\"tr\">\r\n			<span>&diams; Th&ocirc;ng tin: </span></div>\r\n	</div>\r\n</div>\r\n', '', 'img/upload/bbda08fdcee568a700c85c18e4f7db28.jpg', '', '', '', '', NULL, 74, 0, 0, 0, 0, NULL, NULL, '2012-10-12 15:12:05', '2012-10-12 16:06:54', 1, 1, 1, 0, 0, 0),
			(38,$shop_id, 'Tranh đá quý', 'Gemstone painting', 'tranh-da-quy', NULL, '', '', '<div class=\"content left\">\r\n	<div class=\"info_p\">\r\n		<div class=\"tr\">\r\n			<span>&diams; M&atilde; sản phẩm: </span>#12</div>\r\n		<div class=\"tr\">\r\n			<span>&diams; Gi&aacute; sản phẩm: </span> Li&ecirc;n hệ</div>\r\n		<div class=\"tr\">\r\n			<span>&diams; Trong kho: </span><span>Hết h&agrave;ng</span></div>\r\n		<div class=\"tr\">\r\n			<span>&diams; Th&ocirc;ng tin: </span></div>\r\n	</div>\r\n</div>\r\n', '', 'img/upload/6fd88997cfb57b9fa3adaa098e3ff5cf.jpg', '', '', '', '', NULL, 74, 0, 0, 0, 0, NULL, NULL, '2012-10-12 15:12:43', '2012-10-12 16:07:01', 1, 1, 1, 0, 0, 0),
			(39,$shop_id, 'Tranh đá quý', 'Gemstone painting', 'tranh-da-quy', NULL, '', '', '<div class=\"content left\">\r\n	<div class=\"info_p\">\r\n		<div class=\"tr\">\r\n			<span>&diams; M&atilde; sản phẩm: </span>#12</div>\r\n		<div class=\"tr\">\r\n			<span>&diams; Gi&aacute; sản phẩm: </span> Li&ecirc;n hệ</div>\r\n		<div class=\"tr\">\r\n			<span>&diams; Trong kho: </span><span>Hết h&agrave;ng</span></div>\r\n		<div class=\"tr\">\r\n			<span>&diams; Th&ocirc;ng tin: </span></div>\r\n	</div>\r\n</div>\r\n', '', 'img/upload/84ab5ecfca2ab94e3d78acc0516eb9fd.jpg', '', '', '', '', NULL, 74, 0, 0, 0, 0, NULL, NULL, '2012-10-12 15:13:19', '2012-10-12 15:13:19', 0, 0, 0, 1, 0, 1),
			(40,$shop_id, 'Tranh đá quý', 'Gemstone painting', 'tranh-da-quy', NULL, '', '', '<p>\r\n	sdfsdf</p>\r\n', '', 'img/upload/9085e8a9b725acb1765610a8b48af6c0.jpg', '', '', '', '', NULL, 74, 0, 0, 0, 0, NULL, NULL, '2012-10-12 15:47:23', '2012-10-12 16:07:08', 1, 1, 1, 0, 0, 0),
			(41,$shop_id, 'Tranh đá quý', 'Gemstone painting', 'tranh-da-quy', NULL, '', '', '<p>\r\n	sdcvbcvb cvbcvb</p>\r\n', '', 'img/upload/bd0b4508ffc932e2b349707332889171.jpg', '', '', '', '', NULL, 74, 0, 0, 0, 0, NULL, NULL, '2012-10-12 15:49:33', '2012-10-12 16:07:15', 1, 1, 1, 0, 0, 0),
			(42,$shop_id, 'Tranh đá quý', 'Gemstone painting', 'tranh-da-quy', NULL, '', '', '<p>\r\n	sdfcv xcvxcvxc</p>\r\n', '', 'img/upload/84ab5ecfca2ab94e3d78acc0516eb9fd.jpg', '', '', '', '', NULL, 74, 0, 0, 0, 0, NULL, NULL, '2012-10-12 15:50:07', '2012-10-12 15:50:07', 1, 1, 1, 0, 0, 0),
			(43,$shop_id, 'Rừng cây lá đỏ', 'Red-leaved forest', 'rung-cay-la-do', NULL, 'Liên Hệ', '', '<p>\r\n	<strong>Rừng c&acirc;y l&aacute; đỏ</strong></p>\r\n<p>\r\n	<strong>&diams;</strong><strong>M&atilde; sản phẩm:&nbsp;</strong>#66</p>\r\n<p>\r\n	<strong>&diams;</strong><strong>Trong kho:&nbsp;Hết h&agrave;ng</strong></p>\r\n<p>\r\n	<strong>&diams;</strong><strong>Th&ocirc;ng tin:&nbsp;</strong>k&iacute;ch thước: 70*100(cm)</p>\r\n<p>\r\n	Tranh da quy - <a href=\"http:// ngocsonchoithu.com.vn\"><strong>Tranh đ&aacute; qu&yacute; </strong></a></p>\r\n', '', 'img/upload/5f2e58be0aef2fac48d8cffd95961cfe.png', '', '', '', '', NULL, 74, 0, 0, 0, 0, NULL, NULL, '2012-10-15 14:37:16', '2012-10-15 14:48:01', 1, 1, 0, 0, 0, 0),
			(44,$shop_id, 'Tranh đồng quý', ' Gemstone - copper  painting', 'tranh-dong-quy', NULL, 'liên hệ', '', '<p>\r\n	đang cap nhat</p>\r\n', '', 'img/upload/11f3afe30cdd8c5bd2414ce4aaf67388.jpg', '', '', '', '', NULL, 83, 0, 0, 0, 0, NULL, NULL, '2012-12-11 17:18:53', '2012-12-11 17:18:53', 1, 1, 0, 0, 0, 0),
			(45,$shop_id, 'Tranh đồng đá quý Loại 1', 'Gemstone - copper  painting type 1', 'tranh-dong-da-quy-loai-1', NULL, '10000000', '', '<p>\r\n	sản phẩm đang cạp nhật &nbsp;.&nbsp;sản phẩm đang cạp nhật &nbsp;.&nbsp;sản phẩm đang cạp nhật .&nbsp;sản phẩm đang cạp nhật .&nbsp;sản phẩm đang cạp nhật&nbsp;</p>\r\n<p>\r\n	sản phẩm đang cạp nhật .&nbsp;sản phẩm đang cạp nhật .&nbsp;sản phẩm đang cạp nhật .&nbsp;sản phẩm đang cạp nhật .&nbsp;sản phẩm đang cạp nhật&nbsp;</p>\r\n', '', 'img/upload/665b15ef86abe35eb0302901d300b376.jpg', '', '', '', '', NULL, 84, 0, 0, 0, 0, NULL, NULL, '2012-12-11 17:23:40', '2012-12-11 17:23:40', 1, 1, 0, 0, 0, 0),
			(46,$shop_id, 'tranh da thu hoang phuc', 'Thu Hoang Phuc gemstone painting', 'tranh-da-thu-hoang-phuc', NULL, '306000', '', '', '', 'img/upload/3b20e17a4e19e318b5aa9a7b80518b85.jpg', '', '', '', '', NULL, 70, 0, 0, 0, 0, NULL, NULL, '2012-12-11 20:23:14', '2012-12-11 20:23:14', 1, 0, 1, 0, 0, 0);";

$arrSql[] ="CREATE TABLE IF NOT EXISTS `eshop_settings` (
			`id` int(10) NOT NULL AUTO_INCREMENT,
			`eshop_id` int(50) NOT NULL DEFAULT '0',
			`name` varchar(256) CHARACTER SET utf8 NOT NULL,
			`map` text CHARACTER SET utf8 NOT NULL,
			`name_en` varchar(256) NOT NULL,
			`title` varchar(250) CHARACTER SET utf8 NOT NULL,
			`title_en` varchar(250) NOT NULL,
			`introduction` text CHARACTER SET utf8 NOT NULL,
			`introduction_en` text NOT NULL,
			`address` varchar(256) CHARACTER SET utf8 NOT NULL,
			`address_en` varchar(256) NOT NULL,
			`phone` varchar(100) NOT NULL,
			`mobile` varchar(15) NOT NULL,
			`email` varchar(256) CHARACTER SET utf8 NOT NULL,
			`username` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
			`password` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
			`url` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
			`keyword` varchar(500) CHARACTER SET utf8 NOT NULL,
			`content` text CHARACTER SET utf8 NOT NULL,
			`content_en` text NOT NULL,
			`description` text CHARACTER SET utf8 NOT NULL,
			`created` date NOT NULL,
			`modified` text NOT NULL,
			PRIMARY KEY (`id`)
			) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;";

$arrSql[] ="INSERT INTO `eshop_settings` (`id`, `eshop_id`, `name`, `map`, `name_en`, `title`, `title_en`, `introduction`, `introduction_en`, `address`, `address_en`, `phone`, `mobile`, `email`, `username`, `password`, `url`, `keyword`, `content`, `content_en`, `description`, `created`, `modified`) VALUES
			(1,$shop_id, 'CÔNG TY ĐÁ QUÝ ', '<iframe width=\"260\" height=\"200\" frameborder=\"0\" scrolling=\"no\" marginheight=\"0\" marginwidth=\"0\" src=\"https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=vi&amp;geocode=&amp;q=128c+dai+lav-+ha+noi&amp;aq=&amp;sll=33.989561,-118.108582&amp;sspn=0.370629,0.617294&amp;ie=UTF8&amp;hq=&amp;hnear=128+%C4%90%E1%BA%A1i+La,+%C4%90%E1%BB%93ng+T%C3%A2m,+Hai+B%C3%A0+Tr%C6%B0ng,+H%C3%A0+N%E1%BB%99i,+Vi%E1%BB%87t+Nam&amp;t=m&amp;z=14&amp;ll=20.997202,105.842956&amp;output=embed\"></iframe><br /><small><a href=\"https://maps.google.com/maps?f=q&amp;source=embed&amp;hl=vi&amp;geocode=&amp;q=128c+dai+lav-+ha+noi&amp;aq=&amp;sll=33.989561,-118.108582&amp;sspn=0.370629,0.617294&amp;ie=UTF8&amp;hq=&amp;hnear=128+%C4%90%E1%BA%A1i+La,+%C4%90%E1%BB%93ng+T%C3%A2m,+Hai+B%C3%A0+Tr%C6%B0ng,+H%C3%A0+N%E1%BB%99i,+Vi%E1%BB%87t+Nam&amp;t=m&amp;z=14&amp;ll=20.997202,105.842956\" style=\"color:#0000FF;text-align:left\">Xem Bản đồ cỡ lớn hơn</a></small>', 'Gemstone Company', 'Tranh Đá Quý ', ' Gemstone Paintings ', '<div class=\"info_company\">\r\n	<div style=\"font-size:17px; font-weight:bold; color:#F00\">\r\n		C&Ocirc;NG TY Đ&Aacute; QU&Yacute;</div>\r\n	<div>\r\n		<span style=\"color:#000000;\">ĐC:&nbsp;</span>ĐC: Số nh&agrave; 6 &nbsp;- Long Bi&ecirc;n - H&agrave; Nội</div>\r\n	<div>\r\n		<span style=\"color: rgb(0, 0, 0);\">ĐT:&nbsp;</span>099878890 - 09090989</div>\r\n	<div>\r\n		<span style=\"color: rgb(0, 0, 0);\">Email:&nbsp;</span>phuca4@gmail.com<span style=\"color: rgb(0, 0, 0);\">&nbsp;Website:&nbsp;</span>http://daquydep.com.vn</div>\r\n	<div>\r\n		&nbsp;</div>\r\n	<div>\r\n		&nbsp;</div>\r\n</div>\r\n', 'GEMSTONE COMPANY Address: 236-218 Phu Vien Street, Long Bien District, Hanoi Telephone number:  Le Van Choi: 0912.211.945 0983933518 NguyenThi Thu: 0973.986.673 Email: lengoc29992@gmail.com Website: ngocsonchoithu.com.vn  ', 'ĐC: Số nhà 6  - Long Biên - Hà Nội', 'Address: 236-218 Phu Vien Street, Long Bien District, Hanoi', '099878890 - 09090989', '0912 217890', 'phuca4@gmail.com', NULL, NULL, 'http://daquydep.com.vn', 'tranh da quy ngoc son', '<div style=\"font-size: 17px; font-weight: bold; color: rgb(255, 0, 0);\">\r\n	C&Ocirc;NG TY Đ&Aacute; QU&Yacute;</div>\r\n<div>\r\n	<span style=\"color: rgb(0, 0, 0);\">ĐC:&nbsp;</span>ĐC: Số nh&agrave; 6 &nbsp;- Long Bi&ecirc;n - H&agrave; Nội</div>\r\n<div>\r\n	<span style=\"color: rgb(0, 0, 0);\">ĐT:&nbsp;</span>099878890 - 09090989</div>\r\n<div>\r\n	<span style=\"color: rgb(0, 0, 0);\">Email:&nbsp;</span>phuca4@gmail.com<span style=\"color: rgb(0, 0, 0);\">&nbsp;Website:&nbsp;</span>http://daquydep.com.vn</div>\r\n', '', 'tranh da quy  ', '2012-06-05', '1407923019');";

$arrSql[] ="CREATE TABLE IF NOT EXISTS `eshop_slideshows` (
			`id` int(10) NOT NULL AUTO_INCREMENT,
			`eshop_id` int(50) NOT NULL DEFAULT '0',
			`name` varchar(250) CHARACTER SET utf8 NOT NULL,
			`name_en` varchar(250) NOT NULL,
			`images` varchar(250) CHARACTER SET utf8 NOT NULL,
			`created` datetime NOT NULL,
			`status` int(2) NOT NULL,
			PRIMARY KEY (`id`)
			) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;";


$arrSql[] ="INSERT INTO `eshop_slideshows` (`id`, `eshop_id`, `name`, `name_en`, `images`, `created`, `status`) VALUES
			(23,$shop_id, 'tranh đá quý ', '', 'img/gallery/e34c16f993ef4eaf31658bf43760c20d.jpg', '2012-06-05 12:12:59', 1),
			(28,$shop_id, 'tranh đá quý ', '', 'img/gallery/5e0cbe848f02a23657eecb9001ae8b5d.jpg', '2012-10-14 10:25:30', 1),
			(29,$shop_id, 'tranh da quy ', '', 'img/gallery/17a612d3863369eb766af9e91896ae52.jpg', '2012-10-16 08:59:41', 1);";

$arrSql[] ="CREATE TABLE IF NOT EXISTS `eshop_templates` (
			`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
			`eshop_id` int(50) unsigned NOT NULL DEFAULT '0',
			`name` varchar(250) CHARACTER SET utf8 NOT NULL,
			`url` varchar(250) CHARACTER SET utf8 NOT NULL,
			`images` varchar(250) CHARACTER SET utf8 NOT NULL,
			`created` date NOT NULL,
			`display` int(2) NOT NULL,
			`status` int(2) NOT NULL,
			PRIMARY KEY (`id`)
			) ENGINE=MyISAM DEFAULT CHARSET=latin1;";

$arrSql[] ="CREATE TABLE IF NOT EXISTS `eshop_users` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`eshop_id` int(50) NOT NULL DEFAULT '0',
			`password` varchar(200) NOT NULL,
			`name` varchar(200) NOT NULL,
			`email` varchar(50) NOT NULL,
			`phone` int(15) NOT NULL,
			`birth_date` varchar(200) NOT NULL,
			`sex` varchar(20) NOT NULL,
			`images` varchar(256) NOT NULL,
			`created` datetime NOT NULL,
			`modified` datetime NOT NULL,
			`active_key` varchar(50) DEFAULT NULL,
			`status` int(1) NOT NULL,
			PRIMARY KEY (`id`)
			) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;";

$arrSql[] ="INSERT INTO `eshop_users` (`id`, `eshop_id`, `password`, `name`, `email`, `phone`, `birth_date`, `sex`, `images`, `created`, `modified`, `active_key`, `status`) VALUES
			(17,$shop_id, '61c303060b45b10eb2335be80d2b854a', 'admin', 'admin@admin.com', 2147483647, '18-11-1968', '1', '', '2011-05-17 14:33:04', '2012-10-18 14:59:59', '70c639df5e30bdee440e4cdf599fec2b', 1),
			(41,$shop_id, '61c303060b45b10eb2335be80d2b854a', 'phuca4', 'phuca4@gmail.com', 0, '', '', '', '2012-10-18 15:15:20', '2012-10-18 15:15:20', NULL, 0),
			(40,$shop_id, 'e3bab86dfa204eba2bfa8fd06884621d', 'hoangthang', 'hoangthangacer87@gmail.com', 0, '', '', '', '2012-10-18 14:59:34', '2012-10-18 14:59:34', NULL, 0);";

$arrSql[] ="CREATE TABLE IF NOT EXISTS `eshop_videos` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`eshop_id` int(50) NOT NULL DEFAULT '0',
			`name` varchar(250) CHARACTER SET utf8 NOT NULL,
			`name_en` varchar(250) NOT NULL,
			`video` varchar(250) CHARACTER SET utf8 NOT NULL,
			`created` datetime NOT NULL,
			`status` int(2) NOT NULL,
			PRIMARY KEY (`id`)
			) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;";

$arrSql[] ="INSERT INTO `eshop_videos` (`id`, `eshop_id`, `name`, `name_en`, `video`, `created`, `status`) VALUES
			(2,$shop_id, 'Tranh đá quý', '', 'video/upload/d1cf85d0be87844bb3ff5144fe45c00a.flv', '2012-10-11 12:25:30', 1),
			(3,$shop_id, 'New tranh da quy', '', 'video/upload/d1cf85d0be87844bb3ff5144fe45c00a.flv', '2012-10-18 08:38:09', 1);";

$arrSql[] ="CREATE TABLE IF NOT EXISTS `eshop_wards` (
			`id` int(10) NOT NULL AUTO_INCREMENT,
			`eshop_id` int(50) NOT NULL DEFAULT '0',
			`name` varchar(256) CHARACTER SET utf8 NOT NULL,
			`district_id` int(10) NOT NULL,
			`status` int(1) NOT NULL,
			PRIMARY KEY (`id`)
			) ENGINE=MyISAM DEFAULT CHARSET=latin1;";

$arrSql[] ="CREATE TABLE IF NOT EXISTS `eshop_weblinks` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`eshop_id` int(50) NOT NULL DEFAULT '0',
			`name` varchar(256) CHARACTER SET utf8 NOT NULL,
			`link` varchar(256) CHARACTER SET ucs2 NOT NULL,
			`created` date NOT NULL,
			`modified` date NOT NULL,
			`status` int(2) NOT NULL,
			PRIMARY KEY (`id`)
			) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;";

$arrSql[] ="INSERT INTO `eshop_weblinks` (`id`, `eshop_id`, `name`, `link`, `created`, `modified`, `status`) VALUES
			(8,$shop_id, 'Google', 'http://google.vn', '0000-00-00', '0000-00-00', 1),
			(9,$shop_id, 'dantri', 'http://dantri.com.vn', '0000-00-00', '0000-00-00', 1);";

?>