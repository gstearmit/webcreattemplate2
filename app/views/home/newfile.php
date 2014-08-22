<?php
$arrSql = array();
$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_advertisements` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `estore_id` int(50) NOT NULL DEFAULT '0',
  `name` varchar(256) CHARACTER SET utf8 NOT NULL,
  `link` varchar(256) CHARACTER SET ucs2 NOT NULL,
  `images` varchar(256) CHARACTER SET utf8 NOT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  `status` int(2) NOT NULL,
  `display` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;";

$arrSql[] ="INSERT INTO `estore_advertisements` (`id`, `estore_id`, `name`, `link`, `images`, `created`, `modified`, `status`, `display`) VALUES
	(25, 0, 'cong ty abc', 'http://zing.vn', 'img/gallery/88654b0d4c2e2d7b8a4fd519f870c2b3.jpg', '2011-10-03', '2012-09-14', 1, 1),
	(24, 0, 'quang cao', 'http://dantri.com.vn', 'img/gallery/19c4d76ab1090e42cd476cf7974f419c.jpg', '2011-10-03', '2012-09-14', 1, 2),
	(26, 0, 'cong ty abc', 'http://zing.vn', 'img/gallery/aed5ce1f0358efc5b80877da0fd817d8.jpg', '2011-10-03', '2012-09-14', 1, 0),
	(27, 0, 'zx', 'http://agribank.com.vn', 'img/gallery/69dbb1013ad45d844e128bd7facea6ee.jpg', '2012-09-14', '2012-09-14', 1, 2),
	(28, 0, 'zx', 'http://agribank.com.vn', 'img/gallery/69dbb1013ad45d844e128bd7facea6ee.jpg', '2012-09-14', '2012-09-14', 1, 2),
	(29, 0, 'quang cao', 'http://truongthanhauto.com.vn', 'img/gallery/69dbb1013ad45d844e128bd7facea6ee.jpg', '2012-09-14', '2012-09-14', 1, 2),
	(30, 0, 'asdasd', 'http://duhocdailoan.info', 'img/gallery/8dc8529c47186151846ae23b345e835b.jpg', '2012-09-14', '2012-09-14', 1, 3),
	(31, 0, 'asdsd', 'http://dantri.com.vn', 'img/gallery/1cf5b8f4b563947b0c3b8c29142215c9.jpg', '2012-09-14', '2012-09-14', 1, 3),
	(32, 0, 'asdasd', 'http://zing.vn', 'img/gallery/8dc8529c47186151846ae23b345e835b.jpg', '2012-09-14', '2012-09-14', 1, 3);";

$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_albums` (
  `id` int(50) unsigned NOT NULL AUTO_INCREMENT,
  `estore_id` int(50) unsigned NOT NULL DEFAULT '0',
  `tt` int(10) DEFAULT NULL,
  `parent_id` int(10) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  `status` int(2) NOT NULL,
  `name_eg` varchar(255) DEFAULT NULL,
  `images` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=207 DEFAULT CHARSET=utf8;";

$arrSql[] ="INSERT INTO `estore_albums` (`id`, `estore_id`, `tt`, `parent_id`, `lft`, `rght`, `name`, `created`, `modified`, `status`, `name_eg`, `images`) VALUES
	(204, 0, NULL, NULL, 1, 2, 'Ảnh khánh thành dây truyền mới', '2012-05-07', '2012-06-18', 1, 'Picture of new line inauguration', 'img/upload/product/2a1bd4f22b63ff775ad0cc8db96591aa.jpg'),
	(206, 0, NULL, NULL, 3, 4, 'Họp ngày 30/04/2012', '2012-05-08', '2012-06-18', 1, 'on 30th April, 2012', 'img/upload/product/102e31ae3f441fbcb391f9e5a26bcbb9.jpg');";

$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_answerquestions` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `estore_id` int(50) NOT NULL DEFAULT '0',
  `name` varchar(256) CHARACTER SET utf8 NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 NOT NULL,
  `mobile` varchar(256) CHARACTER SET utf8 NOT NULL,
  `address` varchar(225) CHARACTER SET utf8 NOT NULL,
  `title` varchar(225) CHARACTER SET utf8 NOT NULL,
  `introduction` text CHARACTER SET utf8 NOT NULL,
  `content` text CHARACTER SET utf8 NOT NULL,
  `answer` text CHARACTER SET utf8 NOT NULL,
  `created` datetime NOT NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;";

$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_banners` (
  `id` int(50) unsigned NOT NULL AUTO_INCREMENT,
  `estore_id` int(50) unsigned NOT NULL DEFAULT '0',
  `name` varchar(250) NOT NULL,
  `images` varchar(250) NOT NULL,
  `created` datetime NOT NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;";

$arrSql[] ="INSERT INTO `estore_banners` (`id`, `estore_id`, `name`, `images`, `created`, `status`) VALUES
	(1, 0, 'banner', 'img/gallery/af69e2816dec568215d831d8457b36eb.jpg', '2011-10-02 18:16:41', 1);";

$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_categories` (
  `id` int(50) unsigned NOT NULL AUTO_INCREMENT,
  `estore_id` int(50) unsigned NOT NULL DEFAULT '0',
  `tt` int(10) DEFAULT NULL,
  `parent_id` int(10) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `name_en` varchar(256) NOT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  `status` int(2) NOT NULL,
  `images` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=229 DEFAULT CHARSET=utf8;";

$arrSql[] ="INSERT INTO `estore_categories` (`id`, `estore_id`, `tt`, `parent_id`, `lft`, `rght`, `name`, `name_en`, `created`, `modified`, `status`, `images`, `alias`) VALUES
	(146, 0, 0, 224, 16, 17, 'GIỚI THIỆU', 'ABOUT US', '2011-09-27', '2012-09-14', 1, '', 'gioi-thieu'),
	(156, 0, 3, 224, 2, 7, 'KHUYẾN MÃI', 'PROMOTION', '2011-09-27', '2012-09-14', 1, '', 'khuyen-mai'),
	(224, 0, NULL, NULL, 1, 18, 'DANH MỤC TIN TỨC - DỊCH VỤ - TƯ VẤN', 'NEWS-SERVICE-CONSULTANCY CATEGORY', '2012-07-23', '2012-09-14', 1, '', 'danh-muc-tin-tuc-dich-vu-tu-van'),
	(225, 0, 4, 224, 14, 15, 'TUYỂN DỤNG', 'RECRUITMENT', '2012-07-23', '2012-09-14', 1, '', 'tuyen-dung'),
	(226, 0, 1, 224, 8, 9, 'DỊCH VỤ', 'SERVICE', '2012-07-23', '2012-09-14', 1, '', 'dich-vu'),
	(227, 0, 2, 224, 10, 11, 'TƯ VẤN', 'CONSULTANCY', '2012-07-23', '2012-09-14', 1, '', 'tu-van'),
	(228, 0, 5, 224, 12, 13, 'TRỢ GIÚP', 'HELP', '2012-07-23', '2012-09-14', 1, '', 'tro-giup');";

$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_catproducts` (
  `id` int(50) unsigned NOT NULL AUTO_INCREMENT,
  `estore_id` int(50) unsigned NOT NULL DEFAULT '0',
  `parent_id` int(10) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  `name` varchar(250) CHARACTER SET utf8 NOT NULL,
  `name_en` varchar(250) CHARACTER SET ucs2 NOT NULL,
  `created` date NOT NULL,
  `modified` datetime NOT NULL,
  `status` int(2) NOT NULL,
  `char` int(10) DEFAULT NULL,
  `images` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=123 DEFAULT CHARSET=latin1;";

$arrSql[] ="INSERT INTO `estore_catproducts` (`id`, `estore_id`, `parent_id`, `lft`, `rght`, `name`, `name_en`, `created`, `modified`, `status`, `char`, `images`, `alias`) VALUES
	(11, 0, NULL, 1, 48, 'Danh mục sản phẩm', 'Product category', '2012-02-19', '2012-09-13 16:07:33', 1, NULL, '', 'danh-mục-sản-phảm'),
	(39, 0, 11, 2, 11, 'BẾP GA', 'GAS STOVE', '2012-07-29', '2012-09-13 16:54:57', 1, NULL, '', 'bép-ga'),
	(40, 0, 39, 9, 10, 'Bếp ga du lịch', 'Travel gas stove', '2012-07-29', '2012-09-13 16:41:21', 1, NULL, '', 'bép-ga-du-lịch'),
	(97, 0, 11, 12, 21, 'MÁY HÚT KHÓI KHỬ MÙI', 'MACHINE HOODS', '2012-08-06', '2012-09-13 16:11:10', 1, NULL, '', 'máy-hút-khói-khủ-mùi'),
	(98, 0, 11, 38, 47, 'BÌNH GA & LINH KIỆN', 'GAS CONTAINER & COMPONENTS', '2012-08-06', '2012-09-13 16:55:12', 1, NULL, '', 'bình-ga-linh-kiẹn'),
	(121, 0, 117, 40, 41, 'Bình ga 13kg', 'Gas container 13kg', '2012-09-14', '2012-09-14 12:01:37', 1, NULL, '', 'binh-ga-13kg'),
	(122, 0, 117, 42, 43, 'Bình ga 14kg', 'Gas container 14kg', '2012-09-14', '2012-09-14 12:14:16', 1, NULL, '', 'binh-ga-14kg'),
	(105, 0, 39, 5, 6, 'Bếp ga dương', 'Positive gas stove', '2012-08-23', '2012-09-13 16:17:46', 1, NULL, 'img/upload/1c1e93203afe53fb5cda97210c838108.png', 'bép-ga-duong'),
	(104, 0, 39, 3, 4, 'Bếp ga âm', 'Negative gas stove', '2012-08-23', '2012-09-13 16:17:11', 1, NULL, 'img/upload/ce7e12c2374be3da8770b3d3f85b14f4.png', 'bép-ga-am'),
	(106, 0, 11, 22, 31, 'THẾ GIỚI TỦ BẾP', 'WORLD OF KITCHEN CABINETS', '2012-09-13', '2012-09-13 16:30:45', 1, NULL, '', 'thé-giói-tủ-bép'),
	(107, 0, 11, 32, 37, 'BẾP CÔNG NGHIỆP', 'INDUSTRIAL STOVE', '2012-09-13', '2012-09-13 16:14:07', 1, NULL, '', 'bép-cong-nghiẹp'),
	(108, 0, 39, 7, 8, 'Bếp ga đơn', 'Singer gas stove', '2012-09-13', '2012-09-13 16:19:04', 1, NULL, 'img/upload/181885ec49984106001d4b1bb0cb9e78.jpg', 'bép-ga-don'),
	(109, 0, 106, 23, 24, 'Tủ bếp dạng chữ G', 'G-shaped kitchen cabinet', '2012-09-13', '2012-09-13 16:24:32', 1, NULL, '', 'tủ-bép-dạng-chũ-g'),
	(110, 0, 106, 25, 26, 'Tủ bếp dạng chữ L', 'L-shaped kitchen cabinet', '2012-09-13', '2012-09-13 16:24:54', 1, NULL, '', 'tủ-bép-dạng-chũ-l'),
	(111, 0, 106, 27, 28, 'Tủ bếp dạng chữ I', 'I-shaped kitchen cabinet', '2012-09-13', '2012-09-13 16:25:12', 1, NULL, '', 'tủ-bép-dạng-chũ-i'),
	(112, 0, 106, 29, 30, 'Tủ bếp dạng chữ U', 'U-shaped kitchen cabinet', '2012-09-13', '2012-09-13 16:25:28', 1, NULL, '', 'tủ-bép-dạng-chũ-u'),
	(113, 0, 97, 13, 14, 'Hút mùi cổ điển', 'Classic hood', '2012-09-13', '2012-09-13 16:32:48', 1, NULL, '', 'hut-mui-co-dien'),
	(114, 0, 97, 15, 16, 'Hút mùi âm tủ', 'Negative hood', '2012-09-13', '2012-09-13 16:33:14', 1, NULL, '', 'hut-mui-am-tu'),
	(115, 0, 97, 17, 18, 'Hút mùi ống khói', 'chimney hood', '2012-09-13', '2012-09-13 16:33:28', 1, NULL, '', 'hut-mui-ong-khoi'),
	(116, 0, 97, 19, 20, 'Hút mùi đảo', 'Swivel hood', '2012-09-13', '2012-09-13 16:33:59', 1, NULL, '', 'hut-mui-dao'),
	(117, 0, 98, 39, 44, 'Bình ga', 'Gas container', '2012-09-13', '2012-09-13 16:35:02', 1, NULL, '', 'bình-ga'),
	(118, 0, 98, 45, 46, 'Van điều áp gas', 'Gas valve', '2012-09-13', '2012-09-13 16:35:27', 1, NULL, '', 'van-dieu-ap-gas'),
	(119, 0, 107, 33, 34, 'Bếp cho quán ăn', 'Stove for mini-restaurant', '2012-09-13', '2012-09-13 16:37:59', 1, NULL, '', 'bép-cho-quán-an'),
	(120, 0, 107, 35, 36, 'Bếp cho nhà hàng', 'Stove for restaurant', '2012-09-13', '2012-09-13 16:38:17', 1, NULL, '', 'bép-cho-nhà-hàng');";

$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `estore_id` int(50) unsigned NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `id_news` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `created` datetime NOT NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=75 DEFAULT CHARSET=utf8;";


$arrSql[] ="INSERT INTO `estore_comments` (`id`, `estore_id`, `title`, `name`, `content`, `id_news`, `user_id`, `email`, `created`, `status`) VALUES
	(67, 0, '', 'Nguyễn hải', 'Chất lượng moto rất tốt', 0, 0, 'hai@gmail.com', '2012-07-26 01:25:36', 1),
	(66, 0, '', 'Nguyễn Nam', 'Kiểu dáng thật tuyệt', 0, 0, 'nguyennam@gmail.com', '2012-07-26 01:17:16', 1),
	(68, 0, '', 'Nguyễn Thanh Tùng', 'Tôi muốn mua xe iata xin hướng dẫn cho tôi', 0, 0, 'nt2ungvn@gmail.com', '2012-07-26 01:38:49', 1),
	(69, 0, '', 'Hồ Hoài', 'Chất lượng của công ty phục vụ rất rốt!', 0, 0, 'hohoai@yahoo.com', '2012-07-26 02:24:11', 0),
	(70, 0, '', 'Hương', 'Các bạn thử tới công ty nhé\', ở nơi này có rất nhiều cảnh đẹp. Con người rất ôn hòa!', 0, 0, 'huong86@yahoo.com', '2012-07-26 02:29:13', 1),
	(73, 0, '', 'Hoàng Phúc', 'Hoàng Phúc', 0, 0, 'phuca4@gmail.com', '2014-07-27 03:04:51', 1),
	(74, 0, '', 'Hay đó nhé', 'Uh hay Lắm đó', 0, 0, 'phuca4@gmail.com', '2014-07-27 03:06:08', 1);";

$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_contacts` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `estore_id` int(50) NOT NULL DEFAULT '0',
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

$arrSql[] ="INSERT INTO `estore_contacts` (`id`, `estore_id`, `name`, `email`, `mobile`, `fax`, `company`, `title`, `content`, `content_send`, `created`, `modified`, `status`) VALUES
	(4, 0, 'Hoàng Công Phúc', 'phua4@gmail.com', '01688504263', '09487547584', 'Công ty abc', 'Chúc may mắn', 'dang test mail', '<p>\r\n	you are me and i am you</p>\r\n', '2011-07-04', '2011-07-04', 1);";

$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_galleries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `estore_id` int(50) NOT NULL DEFAULT '0',
  `name` varchar(50) DEFAULT NULL,
  `images` varchar(255) NOT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  `status` int(1) NOT NULL,
  `album_id` int(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=69 DEFAULT CHARSET=utf8;";

$arrSql[] ="INSERT INTO `estore_galleries` (`id`, `estore_id`, `name`, `images`, `created`, `modified`, `status`, `album_id`) VALUES
	(67, 0, 'anh 4', 'img/gallery/43d68f446ea7527b3dc6daddc6dc80df.jpg', '2012-06-19', '2012-06-19', 1, 204),
	(68, 0, 'anh 5', 'img/gallery/2cf9661dce136d9f6ca6bfce24933a71.jpg', '2012-06-19', '2012-06-19', 1, 204),
	(64, 0, 'anh 3', 'img/gallery/0452ded776f37827ca4887da56816ba8.jpg', '2012-05-08', '2012-06-19', 1, 206),
	(65, 0, 'anh 2', 'img/gallery/e19281319ecba7282bcd8239287056d7.jpg', '2012-05-08', '2012-06-19', 1, 206),
	(66, 0, 'Anh dep', 'img/gallery/7db208fcf126d1bb3cfee4c6b6bacf62.jpg', '2012-05-08', '2012-06-19', 1, 206);";

$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_helps` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `estore_id` int(50) NOT NULL DEFAULT '0',
  `title` varchar(200) NOT NULL,
  `title_en` varchar(200) NOT NULL,
  `user_support` varchar(200) DEFAULT NULL,
  `user_yahoo` varchar(200) DEFAULT NULL,
  `user_skype` varchar(200) DEFAULT NULL,
  `user_mobile` varchar(20) DEFAULT NULL,
  `user_email` varchar(30) DEFAULT NULL,
  `hotline` varchar(20) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `user_yahoo1` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_yahoo2` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_yahoo3` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;";


$arrSql[] ="INSERT INTO `estore_helps` (`id`, `estore_id`, `title`, `title_en`, `user_support`, `user_yahoo`, `user_skype`, `user_mobile`, `user_email`, `hotline`, `created`, `modified`, `status`, `user_yahoo1`, `user_yahoo2`, `user_yahoo3`) VALUES
	(7, 0, 'Tư vấn', 'Support', 'Hoàng Công Phúc', 'adv.golbalmedia2', 'adv.golbalmedia2', '043.8281.768', 'phuca4@gmail.com', '043.8281.768', '2012-06-14 11:19:25', '2014-07-27 17:57:17', 1, 'phuca478', 'phuca478', 'phuca478'),
	(8, 0, 'Kỹ Thuật', 'Technology', 'Mr. Phúc', 'adv.golbalmedia2', 'adv.golbalmedia2', '01229525955', 'phuca4@gmail.com', NULL, '2012-08-22 12:03:14', '2014-07-27 17:57:26', 1, 'phuca478', 'phuca478', 'phuca478');";

$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_helpsd` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `estore_id` int(50) NOT NULL DEFAULT '0',
  `name` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
  `name1` varchar(256) CHARACTER SET utf8 NOT NULL,
  `name2` varchar(256) CHARACTER SET utf8 NOT NULL,
  `title` varchar(256) CHARACTER SET utf8 NOT NULL,
  `sdt` varchar(20) DEFAULT NULL,
  `sdt1` varchar(20) NOT NULL,
  `sdt2` varchar(20) NOT NULL,
  `yahoo` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
  `yahoo1` varchar(256) CHARACTER SET utf8 NOT NULL,
  `yahoo2` varchar(256) NOT NULL,
  `skype` varchar(256) DEFAULT NULL,
  `skype1` varchar(256) CHARACTER SET utf8 NOT NULL,
  `skype2` varchar(256) CHARACTER SET utf8 NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;";

$arrSql[] ="INSERT INTO `estore_helpsd` (`id`, `estore_id`, `name`, `name1`, `name2`, `title`, `sdt`, `sdt1`, `sdt2`, `yahoo`, `yahoo1`, `yahoo2`, `skype`, `skype1`, `skype2`, `created`, `modified`, `status`) VALUES
	(22, 0, 'Kỹ thuật 1', '', '', '', NULL, '04 38515107', '09 38515108', NULL, 'vulamnguyen', 'vulamnguyen', 'haihs26', '', '', '2011-12-06 10:08:49', '2012-06-14 10:25:11', 1);";

$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_infomationdetails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `estore_id` int(50) NOT NULL DEFAULT '0',
  `infomations_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(250) CHARACTER SET utf8 NOT NULL,
  `images` varchar(250) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;";

$arrSql[] ="INSERT INTO `estore_infomationdetails` (`id`, `estore_id`, `infomations_id`, `product_id`, `name`, `images`, `quantity`, `price`) VALUES
	(5, 0, 36, 19, 'sp14', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_27.jpg', 1, 200),
	(6, 0, 36, 20, 'sp13', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_20.jpg', 1, 400),
	(7, 0, 37, 20, 'sp13', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_20.jpg', 2, 400),
	(8, 0, 37, 19, 'sp14', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_27.jpg', 1, 200),
	(9, 0, 38, 21, 'sp2', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_17.jpg', 1, 300),
	(10, 0, 38, 27, 'sp3', '/khieuvu/estoreadmin/webroot/upload/image/files/3.jpg', 1, 200),
	(11, 0, 39, 27, 'sp3', '/khieuvu/estoreadmin/webroot/upload/image/files/3.jpg', 23, 200),
	(12, 0, 40, 25, 'sp1', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_09.jpg', 3, 120),
	(13, 0, 40, 26, 'sp43', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_20.jpg', 1, 120000),
	(14, 0, 41, 21, 'sp2', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_17.jpg', 2, 300),
	(15, 0, 41, 19, 'sp14', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_27.jpg', 1, 200),
	(16, 0, 41, 26, 'sp43', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_20.jpg', 1, 120000),
	(17, 0, 42, 26, 'sp43', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_20.jpg', 5, 120000),
	(18, 0, 43, 32, 'sp565', '/khieuvu/estoreadmin/webroot/upload/image/files/bg_menu_20.jpg', 2, 20000),
	(19, 0, 44, 64, 'sp5', '/estoreadmin/webroot/upload/image/files/vietsys_53.jpg', 1, 40000),
	(20, 0, 44, 48, 'sp4', '/estoreadmin/webroot/upload/image/files/vietsys_55.jpg', 1, 300000),
	(21, 0, 44, 61, 'sp2', '/estoreadmin/webroot/upload/image/files/vietsys_55.jpg', 1, 300000),
	(22, 0, 44, 49, 'sp5', '/estoreadmin/webroot/upload/image/files/vietsys_53.jpg', 1, 40000),
	(23, 0, 45, 63, 'sp4', '/estoreadmin/webroot/upload/image/files/vietsys_55.jpg', 1, 300000),
	(24, 0, 46, 49, 'sp5', '/estoreadmin/webroot/upload/image/files/vietsys_53.jpg', 1, 40000),
	(25, 0, 46, 50, 'sp6', '/estoreadmin/webroot/upload/image/files/vietsys_55.jpg', 1, 300000),
	(26, 0, 47, 64, 'sp5', '/estoreadmin/webroot/upload/image/files/vietsys_53.jpg', 1, 40000),
	(27, 0, 47, 78, 'sp4', '/estoreadmin/webroot/upload/image/files/vietsys_55.jpg', 1, 300000),
	(28, 0, 48, 73, 'sp4', '/estoreadmin/webroot/upload/image/files/vietsys_55.jpg', 1, 300000),
	(29, 0, 51, 243, 'Tủ chữ L nhiều ngăn', 'img/upload/e06b30abc2aa67efdccf89e55f45cafc.jpg', 1, 4500000),
	(30, 0, 51, 245, 'Bếp cho quán ăn vừa và nhỏ', 'img/upload/3007b340574bcfd67cc42fd18c74d9b0.jpg', 1, 160000),
	(31, 0, 52, 243, 'Tủ chữ L nhiều ngăn', 'img/upload/e06b30abc2aa67efdccf89e55f45cafc.jpg', 1, 4500000),
	(32, 0, 52, 232, 'Bếp trung bình chữ I', 'img/upload/06e0bd26dd69280f9c14e247b49a3ec6.jpg', 2, 2300000),
	(33, 0, 53, 218, 'Bến nhà hàng', 'img/upload/3007b340574bcfd67cc42fd18c74d9b0.jpg', 3, 3500000),
	(34, 0, 53, 243, 'Tủ chữ L nhiều ngăn', 'img/upload/e06b30abc2aa67efdccf89e55f45cafc.jpg', 1, 4500000),
	(35, 0, 54, 243, 'Tủ chữ L nhiều ngăn', 'img/upload/e06b30abc2aa67efdccf89e55f45cafc.jpg', 1, 4500000),
	(36, 0, 54, 231, 'Bếp trung bình chữ I', 'img/upload/06e0bd26dd69280f9c14e247b49a3ec6.jpg', 3, 2300000);";

$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_infomations` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `estore_id` int(50) NOT NULL DEFAULT '0',
  `idnew` int(10) NOT NULL,
  `user_id` varchar(200) CHARACTER SET utf8 DEFAULT NULL COMMENT 'null',
  `name` varchar(250) CHARACTER SET utf8 NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `address` varchar(300) CHARACTER SET utf8 NOT NULL,
  `mobile` int(15) DEFAULT NULL,
  `comment` varchar(300) CHARACTER SET utf8 NOT NULL,
  `deal` text CHARACTER SET utf8,
  `company` varchar(255) CHARACTER SET utf8 NOT NULL,
  `phone` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `fax` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `country` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `datereturn` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `fullname_male` varchar(25) CHARACTER SET utf8 DEFAULT NULL,
  `fullname_female` varchar(25) CHARACTER SET utf8 DEFAULT NULL,
  `questions_day` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `wedding_day` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `title_question` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `wedding_title` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `name_product` varchar(250) NOT NULL,
  `images` varchar(250) NOT NULL,
  `sl` varchar(250) NOT NULL,
  `price` varchar(250) NOT NULL,
  `total` varchar(250) NOT NULL,
  `orther` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `created` datetime NOT NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;";

$arrSql[] ="INSERT INTO `estore_infomations` (`id`, `estore_id`, `idnew`, `user_id`, `name`, `email`, `address`, `mobile`, `comment`, `deal`, `company`, `phone`, `fax`, `country`, `datereturn`, `fullname_male`, `fullname_female`, `questions_day`, `wedding_day`, `title_question`, `wedding_title`, `name_product`, `images`, `sl`, `price`, `total`, `orther`, `created`, `status`) VALUES
	(52, 0, 0, 'id173768', 'Hoang Cong Phuc', 'phuca4@gmail.com', 'Ha Noi', 2147483647, '', NULL, '', '84972607988', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '9100000', NULL, '2014-07-25 08:57:55', 0),
	(53, 0, 0, 'id98603', 'Hoang Phuc', 'phuca4@gmail.com', 'Ha Noi', 2147483647, '', NULL, '', '84972607988', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '15000000', NULL, '2014-07-25 09:04:11', 0),
	(54, 0, 0, 'id686188', 'Hoang Cong Phuc', 'phuca4@gmail.com', 'Ha Noi', 2147483647, '', NULL, '', '84972607988', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '11400000', NULL, '2014-07-25 09:10:40', 0);";

$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_manufacturers` (
  `id` int(50) unsigned NOT NULL AUTO_INCREMENT,
  `estore_id` int(50) unsigned NOT NULL DEFAULT '0',
  `parent_id` int(10) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  `name` varchar(250) CHARACTER SET utf8 NOT NULL,
  `created` date NOT NULL,
  `modified` datetime NOT NULL,
  `status` int(2) NOT NULL,
  `char` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=271 DEFAULT CHARSET=latin1;";

$arrSql[] ="INSERT INTO `estore_manufacturers` (`id`, `estore_id`, `parent_id`, `lft`, `rght`, `name`, `created`, `modified`, `status`, `char`) VALUES
	(135, 0, NULL, 1, 28, 'Rigth', '2012-05-18', '2012-09-13 17:55:06', 1, NULL),
	(136, 0, NULL, 29, 62, 'Toyota', '2012-05-18', '2012-06-04 06:57:18', 1, NULL),
	(137, 0, NULL, 63, 80, 'Daewoo', '2012-05-18', '2012-06-21 06:25:09', 1, NULL),
	(138, 0, NULL, 81, 92, 'Ford', '2012-05-18', '2012-06-19 13:11:22', 1, NULL),
	(139, 0, NULL, 93, 116, 'BMW', '2012-05-18', '2012-05-18 13:50:13', 1, NULL),
	(140, 0, NULL, 117, 130, 'Nissan', '2012-05-18', '2012-05-18 13:50:25', 1, NULL),
	(141, 0, NULL, 131, 144, 'Suzuki', '2012-05-18', '2012-05-18 13:50:51', 1, NULL),
	(142, 0, NULL, 145, 168, 'Audi', '2012-05-24', '2012-05-24 08:07:17', 1, NULL),
	(143, 0, NULL, 169, 184, 'Mitsubishi', '2012-05-24', '2012-05-24 08:08:10', 1, NULL),
	(144, 0, NULL, 185, 200, 'Kia', '2012-05-24', '2014-07-27 10:05:08', 1, NULL),
	(145, 0, NULL, 201, 214, 'Ford', '2012-05-24', '2012-06-21 06:11:02', 0, NULL),
	(146, 0, NULL, 215, 230, 'Hyundai', '2012-05-24', '2012-06-19 13:00:19', 1, NULL),
	(148, 0, NULL, 231, 244, 'Mercedes ', '2012-05-28', '2012-05-28 07:49:40', 1, NULL);";

$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_news` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `estore_id` int(50) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `title_en` varchar(256) NOT NULL,
  `introduction` text NOT NULL,
  `introduction_en` text NOT NULL,
  `content` text,
  `content_en` text NOT NULL,
  `images` varchar(256) NOT NULL,
  `images_en` varchar(256) NOT NULL,
  `category_id` int(11) NOT NULL,
  `source` varchar(200) NOT NULL,
  `view` int(50) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `status` int(1) DEFAULT '0',
  `hotnew` tinyint(4) DEFAULT NULL,
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=128 DEFAULT CHARSET=utf8;";

$arrSql[] ="INSERT INTO `estore_news` (`id`, `estore_id`, `user_id`, `title`, `title_en`, `introduction`, `introduction_en`, `content`, `content_en`, `images`, `images_en`, `category_id`, `source`, `view`, `created`, `modified`, `status`, `hotnew`, `alias`) VALUES
	(115, 0, 0, 'Cách thanh toán', 'Method of payment', '<p>\r\n	sfsdf</p>\r\n', '', '<p>\r\n	sdfsdf</p>\r\n', '', '/estoreadmin/webroot/upload/image/files/vietsys_55.jpg', '', 156, '', 0, '2012-07-09 13:55:44', '2012-08-22 11:57:00', 1, NULL, ''),
	(95, 0, 0, 'Đèn trung thu', 'Mid-autumn lamp', '<p>\r\n	<span style=\"font-size:14px;\">Những chiếc đ&egrave;n b&agrave;n trang tr&iacute; n&agrave;y l&agrave; sự kết hợp giữa chất liệu vả của chụp đ&egrave;n v&agrave; <a href=\"http://www.webhangdoc.com/hang-doc/gom-phong-thuy.html\" target=\"_blank\">gốm</a> sứ của phần th&acirc;n đ&egrave;n mang lại vẻ đẹp trang trọng, hiện đại v&agrave; tinh tế cho căn ph&ograve;ng của bạn. Bạn c&oacute; thể đặt đ&egrave;n trang tr&iacute; ở nhiều kh&ocirc;ng gian trong ng&ocirc;i nh&agrave;, từ ph&ograve;ng ngủ, ph&ograve;ng kh&aacute;ch đến ph&ograve;ng đọc s&aacute;ch, ph&ograve;ng giải tr&iacute; cho gia đ&igrave;nh. Đ&acirc;y l&agrave; một c&aacute;ch trang tr&iacute; nh&agrave; rất s&aacute;ng tạo thể hiện thẩm mỹ cao của gia chủ.<br />\r\n	<br />\r\n	<br />\r\n	<br />\r\n	Đ&egrave;n trang tr&iacute; - <a href=\"http://www.shopdentrangtri.com/\" target=\"_blank\" title=\"\"><em><strong>den trang tri</strong></em></a> c&oacute; nhiều kiểu d&aacute;ng mẫu m&atilde; phần th&acirc;n đ&egrave;n cho bạn lựa chọn. C&aacute;c chất liệu <a href=\"http://www.webhangdoc.com/hang-doc/gom-phong-thuy.html\" target=\"_blank\">gốm</a> sứ l&agrave;m n&ecirc;n đ&egrave;n cũng kh&aacute; <a href=\"http://www.webhangdoc.com/\" target=\"_blank\">độc đ&aacute;o</a> v&agrave; lạ mắt. C&oacute; những chiếc đ&egrave;n c&oacute; phần th&acirc;n l&agrave; b&igrave;nh gốm x&ugrave; x&igrave; th&ocirc; mộc nhưng lại mang n&eacute;t c&aacute; t&iacute;nh v&agrave; phong c&aacute;ch. Cũng c&oacute; những chiếc đ&egrave;n c&oacute; phần th&acirc;n được l&agrave;m từ sứ cao cấp với m&agrave;u sắc tươi s&aacute;ng, trong trẻo. Độc đ&aacute;o hơn với những chiếc b&igrave;nh với v&acirc;n đ&aacute; rất đẹp v&agrave; sang trọng.</span></p>\r\n', '<p>\r\n	Những chiếc đ&egrave;n b&agrave;n trang tr&iacute; n&agrave;y l&agrave; sự kết hợp giữa chất liệu vả của chụp đ&egrave;n v&agrave; <a href=\"http://www.webhangdoc.com/hang-doc/gom-phong-thuy.html\" target=\"_blank\">gốm</a> sứ của phần th&acirc;n đ&egrave;n mang lại vẻ đẹp trang trọng, hiện đại v&agrave; tinh tế cho căn ph&ograve;ng của bạn. Bạn c&oacute; thể đặt đ&egrave;n trang tr&iacute; ở nhiều kh&ocirc;ng gian trong ng&ocirc;i nh&agrave;, từ ph&ograve;ng ngủ, ph&ograve;ng kh&aacute;ch đến ph&ograve;ng đọc s&aacute;ch, ph&ograve;ng giải tr&iacute; cho gia đ&igrave;nh. Đ&acirc;y l&agrave; một c&aacute;ch trang tr&iacute; nh&agrave; rất s&aacute;ng tạo thể hiện thẩm mỹ cao của gia chủ.</p>\r\n', '<p>\r\n	<span style=\"font-size:14px;\">Những chiếc đ&egrave;n b&agrave;n trang tr&iacute; n&agrave;y l&agrave; sự kết hợp giữa chất liệu vả của chụp đ&egrave;n v&agrave; <a href=\"http://www.webhangdoc.com/hang-doc/gom-phong-thuy.html\" target=\"_blank\">gốm</a> sứ của phần th&acirc;n đ&egrave;n mang lại vẻ đẹp trang trọng, hiện đại v&agrave; tinh tế cho căn ph&ograve;ng của bạn. Bạn c&oacute; thể đặt đ&egrave;n trang tr&iacute; ở nhiều kh&ocirc;ng gian trong ng&ocirc;i nh&agrave;, từ ph&ograve;ng ngủ, ph&ograve;ng kh&aacute;ch đến ph&ograve;ng đọc s&aacute;ch, ph&ograve;ng giải tr&iacute; cho gia đ&igrave;nh. Đ&acirc;y l&agrave; một c&aacute;ch trang tr&iacute; nh&agrave; rất s&aacute;ng tạo thể hiện thẩm mỹ cao của gia chủ.<br />\r\n	<br />\r\n	<br />\r\n	<br />\r\n	Đ&egrave;n trang tr&iacute; - <a href=\"http://www.shopdentrangtri.com/\" target=\"_blank\" title=\"\"><em><strong>den trang tri</strong></em></a> c&oacute; nhiều kiểu d&aacute;ng mẫu m&atilde; phần th&acirc;n đ&egrave;n cho bạn lựa chọn. C&aacute;c chất liệu <a href=\"http://www.webhangdoc.com/hang-doc/gom-phong-thuy.html\" target=\"_blank\">gốm</a> sứ l&agrave;m n&ecirc;n đ&egrave;n cũng kh&aacute; <a href=\"http://www.webhangdoc.com/\" target=\"_blank\">độc đ&aacute;o</a> v&agrave; lạ mắt. C&oacute; những chiếc đ&egrave;n c&oacute; phần th&acirc;n l&agrave; b&igrave;nh gốm x&ugrave; x&igrave; th&ocirc; mộc nhưng lại mang n&eacute;t c&aacute; t&iacute;nh v&agrave; phong c&aacute;ch. Cũng c&oacute; những chiếc đ&egrave;n c&oacute; phần th&acirc;n được l&agrave;m từ sứ cao cấp với m&agrave;u sắc tươi s&aacute;ng, trong trẻo. Độc đ&aacute;o hơn với những chiếc b&igrave;nh với v&acirc;n đ&aacute; rất đẹp v&agrave; sang trọng.</span></p>\r\n', '<p>\r\n	Những chiếc đ&egrave;n b&agrave;n trang tr&iacute; n&agrave;y l&agrave; sự kết hợp giữa chất liệu vả của chụp đ&egrave;n v&agrave; <a href=\"http://www.webhangdoc.com/hang-doc/gom-phong-thuy.html\" target=\"_blank\">gốm</a> sứ của phần th&acirc;n đ&egrave;n mang lại vẻ đẹp trang trọng, hiện đại v&agrave; tinh tế cho căn ph&ograve;ng của bạn. Bạn c&oacute; thể đặt đ&egrave;n trang tr&iacute; ở nhiều kh&ocirc;ng gian trong ng&ocirc;i nh&agrave;, từ ph&ograve;ng ngủ, ph&ograve;ng kh&aacute;ch đến ph&ograve;ng đọc s&aacute;ch, ph&ograve;ng giải tr&iacute; cho gia đ&igrave;nh. Đ&acirc;y l&agrave; một c&aacute;ch trang tr&iacute; nh&agrave; rất s&aacute;ng tạo thể hiện thẩm mỹ cao của gia chủ.<br />\r\n	<br />\r\n	<br />\r\n	<br />\r\n	Đ&egrave;n trang tr&iacute; - <a href=\"http://www.shopdentrangtri.com/\" target=\"_blank\" title=\"\"><em><strong>den trang tri</strong></em></a> c&oacute; nhiều kiểu d&aacute;ng mẫu m&atilde; phần th&acirc;n đ&egrave;n cho bạn lựa chọn. C&aacute;c chất liệu <a href=\"http://www.webhangdoc.com/hang-doc/gom-phong-thuy.html\" target=\"_blank\">gốm</a> sứ l&agrave;m n&ecirc;n đ&egrave;n cũng kh&aacute; <a href=\"http://www.webhangdoc.com/\" target=\"_blank\">độc đ&aacute;o</a> v&agrave; lạ mắt. C&oacute; những chiếc đ&egrave;n c&oacute; phần th&acirc;n l&agrave; b&igrave;nh gốm x&ugrave; x&igrave; th&ocirc; mộc nhưng lại mang n&eacute;t c&aacute; t&iacute;nh v&agrave; phong c&aacute;ch. Cũng c&oacute; những chiếc đ&egrave;n c&oacute; phần th&acirc;n được l&agrave;m từ sứ cao cấp với m&agrave;u sắc tươi s&aacute;ng, trong trẻo. Độc đ&aacute;o hơn với những chiếc b&igrave;nh với v&acirc;n đ&aacute; rất đẹp v&agrave; sang trọng.</p>\r\n', '/estoreadmin/webroot/upload/image/files/vietsys_71.jpg', 'img/upload/076e3caed758a1c18c91a0e9cae3368f.jpg', 156, '', 1, '2011-12-06 09:16:42', '2012-07-23 15:21:30', 1, NULL, NULL),
	(96, 0, 0, 'Lộng lẫy đèn chùm', 'Splendid chandelier', '<p>\r\n	<b><span id=\"ctl00_ContentPlaceHolder1_NewsDetail1_lblSubContent\">Với kiểu d&aacute;ng thiết kế mới lạ, đ&egrave;n ch&ugrave;m ng&agrave;y nay mang lại vẻ mềm mại, sang trọng cho ng&ocirc;i nh&agrave;. Hầu hết c&aacute;c mẫu đ&egrave;n được thiết kế cầu kỳ với nhiều lớp đ&egrave;n, đ&aacute; trang tr&iacute;. Loại n&agrave;y gồm một b&oacute;ng ch&iacute;nh ở giữa s&aacute;ng nhất, c&aacute;c đ&egrave;n phụ được thiết kế xung quanh.</span></b></p>\r\n', '<p>\r\n	Enable luck with crystal chandeliersEnable luck with crystal chandeliers</p>\r\n', '<p>\r\n	<b><span id=\"ctl00_ContentPlaceHolder1_NewsDetail1_lblSubContent\">Với kiểu d&aacute;ng thiết kế mới lạ, đ&egrave;n ch&ugrave;m ng&agrave;y nay mang lại vẻ mềm mại, sang trọng cho ng&ocirc;i nh&agrave;. Hầu hết c&aacute;c mẫu đ&egrave;n được thiết kế cầu kỳ với nhiều lớp đ&egrave;n, đ&aacute; trang tr&iacute;. Loại n&agrave;y gồm một b&oacute;ng ch&iacute;nh ở giữa s&aacute;ng nhất, c&aacute;c đ&egrave;n phụ được thiết kế xung quanh.</span> </b></p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	<img alt=\"\" height=\"431\" src=\"http://www.denchum.net/Images/News/Sub/images/Picture1.jpg\" width=\"500\" /></p>\r\n<div>\r\n	Đ&egrave;n ch&ugrave;m rực rỡ với t&iacute;nh thẩm mỹ cao gi&uacute;p bạn t&ocirc; điểm cho ng&ocirc;i nh&agrave;</div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	Tuy nhi&ecirc;n, thỉnh thoảng bạn vẫn bắt gặp kiểu đ&egrave;n ch&ugrave;m khổng lồ chỉ c&oacute; một b&oacute;ng. C&ograve;n lại l&agrave; phụ liệu đ&iacute;nh k&egrave;m, chủ yếu mang t&iacute;nh trang tr&iacute;. C&aacute;c kiểu đ&egrave;n n&agrave;y gi&uacute;p căn ph&ograve;ng trở n&ecirc;n duy&ecirc;n d&aacute;ng v&agrave; sang trọng hơn.</div>\r\n<div>\r\n	Đặc biệt chất liệu tạo n&ecirc;n c&aacute;c ch&ugrave;m đ&egrave;n rất quan trọng v&igrave; n&oacute; quyết định sự mềm mại v&agrave; n&eacute;t ri&ecirc;ng của từng kiểu đ&egrave;n. &Aacute;nh s&aacute;ng chỉ l&agrave; yếu tố phụ n&ecirc;n bạn phải thiết k&ecirc; th&ecirc;m c&aacute;c đ&egrave;n kh&aacute;c để lấy &aacute;nh s&aacute;ng cho ph&ograve;ng kh&aacute;ch.</div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	<strong>Những lưu &yacute; khi lắp đặt đ&egrave;n ch&ugrave;m</strong></div>\r\n<div>\r\n	<img alt=\"\" height=\"267\" src=\"http://www.denchum.net/Images/News/Sub/images/Picture2.jpg\" width=\"500\" /></div>\r\n<div>\r\n	Đa dạng về kiểu d&aacute;ng, mẫu m&atilde;</div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	Muốn bố tr&iacute; đ&egrave;n ch&ugrave;m, trần nh&agrave; phải cao từ 3m trở l&ecirc;n để kh&ocirc;ng g&acirc;y cảm gi&aacute;c vướng v&iacute;u, nặng nề. Kiểu đ&egrave;n cũng cần h&agrave;i ho&agrave; với c&aacute;c đ&egrave;n chiếu s&aacute;ng kh&aacute;c trong ph&ograve;ng.</div>\r\n<div>\r\n	Theo quan niệm phong thuỷ, kh&ocirc;ng n&ecirc;n lắp đ&egrave;n ch&ugrave;m trong ph&ograve;ng ngủ, nhất l&agrave; ph&iacute;a tr&ecirc;n giường. Nếu đ&egrave;n bằng chất liệu pha l&ecirc;, đ&aacute; thuỷ tinh, tốt nhất n&ecirc;n treo ở trung t&acirc;m nh&agrave; để t&iacute;ch tụ năng lượng dương cho căn ph&ograve;ng.</div>\r\n<div>\r\n	Theo Netfile</div>\r\n', '<p>\r\n	Enable luck with crystal chandeliersEnable luck with crystal chandeliersEnable luck with crystal chandeliersEnable luck with crystal chandeliersEnable luck with crystal chandeliers</p>\r\n', '/estoreadmin/webroot/upload/image/files/vietsys_68.jpg', 'img/upload/8969288f4245120e7c3870287cce0ff3.jpg', 156, '', 0, '2011-12-06 09:42:09', '2012-07-23 15:25:27', 1, NULL, NULL),
	(116, 0, 0, 'About', 'About', '<p>\r\n	<span id=\"result_box\" lang=\"en\"><span title=\"Công ty TNHH thiết bị y tế và khoa học kỹ thuật Hà Nội được thành lập năm 2002 với lĩnh vực kinh doanh chính là: thiết bị y tế, thiết bị thẩm mỹ, thiết bị khoa học kỹ thuật, công nghệ và môi trường.\">Medical Equipment Co., Ltd. technical and scientific Hanoi was established in 2002 with main business areas are: medical device, aesthetic equipment, scientific equipment, technology and the environment.</span><br />\r\n	<br />\r\n	<span title=\"Tôn chỉ của chúng tôi:\">Our guiding principles:</span><br />\r\n	<br />\r\n	<span title=\"- Cung cấp tới tận tay khách hàng các sản phẩm có chất lượng và kỹ thuật cao trong ngành y tế và khoa học công nghệ môi trường với giá cả cạnh tranh nhất.\">- Provide end-customers with quality products and high technology in the health sector and environmental science and technology with the most competitive price.</span><br />\r\n	<br />\r\n	<span title=\"- Xây dựng và đào tạo một mạng lưới dịch vụ kỹ thuật sau bán hàng một cách hoàn hảo.\">- Develop and train a network of after-sales technical service perfectly.</span><br />\r\n	<br />\r\n	<span title=\"- Luôn giữ chữ “tín” và lấy lợi ích của khách hàng làm trọng.\">- Always keep the words &quot;credit&quot; and get the benefits of important customer.</span><br />\r\n	<br />\r\n	<span title=\"Sản phẩm Công ty cung cấp:\">The company offers products:</span><br />\r\n	<br />\r\n	<span title=\"- Máy soi cổ tử cung kỹ thuật số, monitor sản khoa, monitor theo dõi bệnh nhân đa thông số, hệ thống monitor trung tâm, máy cắt đốt cổ tử cung chuyên dụng, máy đo nồng độ bão hòa ô xy trong máu, bơm\">- Portable digital colposcopy, obstetrics monitor, monitor multi-parameter patient monitor, central monitor system, dedicated cervical ablation, measuring oxygen saturation in the blood, the pump </span><span title=\"tiêm điện, máy truyền dịch tự động của hãng GOLDWAY (US).,INC.\">power injection, its automatic infusion Goldway (U.S.)., INC.</span><br />\r\n	<br />\r\n	<span title=\"- Máy siêu âm đen trắng, siêu màu 4D các loại của hãng Fukuda- Nhật Bản\">- Ultrasound in black and white, super color 4D Its kind Fukuda, Japan</span><br />\r\n	<br />\r\n	<span title=\"- Máy áp lạnh cổ tử cung\">- Air pressure cervical cold</span><br />\r\n	<br />\r\n	<span title=\"- Điện não VIDEO EEG, DIGITAL EEG, điện tim của Tây Ban Nha\">- Electrical brain EEG VIDEO, DIGITAL EEG, ECG of Spain</span><br />\r\n	<br />\r\n	<span title=\"- Máy đo thính lực chuyên dụng của Tây Ban Nha\">- Dedicated audiometric of Spain</span><br />\r\n	<br />\r\n	<span title=\"- Máy đo bilirubin, hemoglobin sản xuất tại Nhật Bản\">- Bilirubin meter, hemoglobin production in Japan</span><br />\r\n	<br />\r\n	<span title=\"- Máy gây mê, máy thở, máy nghe tim thai, nội soi, điện tim, máy phát hiện vàng da.\">- Anesthesia machine, ventilator, fetal player, endoscopy, ECG, jaundice detector.</span><br />\r\n	<br />\r\n	<span title=\"- Máy xét nghiệm sinh hóa (bán tự động, tự động, tổng hợp), ELISA, dao mổ điện sản xuất tại Mỹ\">- Machine biochemical tests (semi-automatic, automatic, synthesis), ELISA, scalpels electricity produced in the U.S.</span><br />\r\n	<br />\r\n	<span title=\"- Máy xét nghiệm nước tiểu Cybow, Clinitek Status (Hàn Quốc, Anh)\">- Machine test urine Cybow, Clinitek Status (Korean, English)</span><br />\r\n	<br />\r\n	<span title=\"- Máy quang phổ UV/VIS - Nhật, tủ bảo quản dược phẩm, tủ trữ máu của Đức.\">- UV Spectrometer / VIS - Japan, pharmaceutical storage cabinets, storage cabinets German blood.</span><br />\r\n	<br />\r\n	<span title=\"- Đèn mổ (Thụy Sĩ), tủ sấy, nồi hấp (Đài Loan)...\">- Lamp (Switzerland), oven, autoclave (Taiwan) ...</span><br />\r\n	<br />\r\n	<span title=\"- Các loại thiết bị khoa học kỹ thuật chuyên dụng của Anh, Mỹ, Đức.\">- The specialized scientific and technical equipment in the UK, USA, Germany.</span><br />\r\n	<br />\r\n	<span title=\"- Các linh kiện thay thế cho các loại monitor theo dõi bệnh nhân, monitor sản khoa\">- The replacement parts for the type of monitor patient monitor, monitor obstetric</span><br />\r\n	<br />\r\n	<span title=\"Công ty có đội ngũ kỹ sư được đào tạo đúng chuyên ngành thiết bị y tế ở trong và ngoài nước.\">The company has a team of engineers who have been properly trained in medical equipment at home and abroad. </span><span title=\"Đội ngũ này không ngừng được nâng cao tay nghề thông qua các khoá đào tạo của các nhà sản xuất...\">This team constantly upgrade their skills through training of producers ...</span><br />\r\n	<br />\r\n	<span title=\"Với thế mạnh của mình, chúng tôi hy vọng rằng trong một tương lai gần, Công ty Công nghệ Quang Anh sẽ trở thành một đối tác truyền thống của Quý khách hàng với tư cách là một nhà cung cấp thiết bị y tế có giá cả\">With its strength, we hope that in the near future, the British Optical Technology Company will become a traditional partner of customers as a supplier of medical equipment pricing </span><span title=\"hợp lý nhất, chất lượng tốt nhất và dịch vụ sau bán hàng hoàn hảo.\">most affordable, best quality and perfect after-sales service.</span><br />\r\n	<br />\r\n	<span title=\"Khi cần mua thiết bị y tế- Đến với Công ty thiết bị y tế &amp; khoa học hà nội\">The need for a new medical device-Coming to medical &amp; scientific equipment hanoi</span></span></p>\r\n', '<p>\r\n	<span id=\"result_box\" lang=\"en\"><span title=\"Công ty TNHH thiết bị y tế và khoa học kỹ thuật Hà Nội được thành lập năm 2002 với lĩnh vực kinh doanh chính là: thiết bị y tế, thiết bị thẩm mỹ, thiết bị khoa học kỹ thuật, công nghệ và môi trường.\">Co., Ltd. medical equipment and scientific and technical Hanoi was established in 2002 with the main business areas: medical equipment, beauty equipment, scientific equipment, technology and environment.</span><br />\r\n	<br />\r\n	<span title=\"Tôn chỉ của chúng tôi:\">Our guiding principles:<br />\r\n	<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Cung cấp tới tận tay khách hàng các sản phẩm có chất lượng và kỹ thuật cao trong ngành y tế và khoa học công nghệ môi trường với giá cả cạnh tranh nhất.\">Hand to provide customers with quality products and high technology in the health and environmental science and technology with the most competitive prices.<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Xây dựng và đào tạo một mạng lưới dịch vụ kỹ thuật sau bán hàng một cách hoàn hảo.\">Develop and train a network of technical service after the sale perfectly.<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Luôn giữ chữ “tín” và lấy lợi ích của khách hàng làm trọng.\">Always keep the word &quot;credit&quot; and get the benefit of customer-focused.</span><br />\r\n	<br />\r\n	<span title=\"Sản phẩm Công ty cung cấp:\">Products The company offers:<br />\r\n	<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Máy soi cổ tử cung kỹ thuật số, monitor sản khoa, monitor theo dõi bệnh nhân đa thông số, hệ thống monitor trung tâm, máy cắt đốt cổ tử cung chuyên dụng, máy đo nồng độ bão hòa ô xy trong máu, bơm tiêm\">Colposcopy machine digital, monitor anesthesia, monitor patient monitor multiple parameters, the central monitor system, cervical ablation machine dedicated machine measurements of oxygen saturation levels in blood, syringes </span><span title=\"điện, máy truyền dịch tự động của hãng GOLDWAY (US).,INC.\">electric machine company infusion of automated GOLDWAY (U.S.)., INC.<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Máy siêu âm đen trắng, siêu màu 4D các loại của hãng Fukuda- Nhật Bản\">Ultrasound machine black &amp; white, color 4D super types of firms Fukuda, Japan<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Máy áp lạnh cổ tử cung\">Machine cold pressure of the cervix<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Điện não VIDEO EEG, DIGITAL EEG, điện tim của Tây Ban Nha\">EEG EEG VIDEO, DIGITAL EEG, ECG of Spain<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Máy đo thính lực chuyên dụng của Tây Ban Nha\">Machinery specialized hearing test in Spain<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Máy đo bilirubin, hemoglobin sản xuất tại Nhật Bản\">Gauge bilirubin, hemoglobin production in Japan<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Máy gây mê, máy thở, máy nghe tim thai, nội soi, điện tim, máy phát hiện vàng da.\">Anesthesia machines, ventilators, air auscultation, endoscopy, ECG, jaundice detector.<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Máy xét nghiệm sinh hóa (bán tự động, tự động, tổng hợp), ELISA, dao mổ điện sản xuất tại Mỹ\">Biochemical machine (semi-automatic, automatic, general), ELISA, electric knife made in USA<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Máy xét nghiệm nước tiểu Cybow, Clinitek Status (Hàn Quốc, Anh)\">Machine Cybow urine, Clinitek Status (Korean, English)<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Máy quang phổ UV/VIS - Nhật, tủ bảo quản dược phẩm, tủ trữ máu của Đức.\">Spectrophotometer UV / VIS - Japanese pharmaceutical storage cabinets, storage cabinets of German blood.<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Đèn mổ (Thụy Sĩ), tủ sấy, nồi hấp (Đài Loan)...\">Lights (Switzerland), oven, steamer (Taiwan) ...<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Các loại thiết bị khoa học kỹ thuật chuyên dụng của Anh, Mỹ, Đức.\">The type of equipment dedicated science and technology in the UK, U.S., Germany.<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Các linh kiện thay thế cho các loại monitor theo dõi bệnh nhân, monitor sản khoa\">Replacement parts for the type of monitor to track patients, monitor obstetric</span><br />\r\n	<br />\r\n	<span title=\"Công ty có đội ngũ kỹ sư được đào tạo đúng chuyên ngành thiết bị y tế ở trong và ngoài nước.\">The company has a team of engineers are properly trained specialized medical equipment at home and abroad. </span><span title=\"Đội ngũ này không ngừng được nâng cao tay nghề thông qua các khoá đào tạo của các nhà sản xuất...\">This team is constantly improving skills through training of manufacturers ...</span><br />\r\n	<br />\r\n	<span title=\"Với thế mạnh của mình, chúng tôi hy vọng rằng trong một tương lai gần, Công ty Công nghệ Quang Anh sẽ trở thành một đối tác truyền thống của Quý khách hàng với tư cách là một nhà cung cấp thiết bị y tế có giá cả\">With its strength, we hope that in the near future, Quang Anh Technology Company will become a traditional partner of customers as a supplier of medical equipment priced </span><span title=\"hợp lý nhất, chất lượng tốt nhất và dịch vụ sau bán hàng hoàn hảo.\">most logical, best quality and after sales service perfect.</span><br />\r\n	<br />\r\n	<span title=\"Khi cần mua thiết bị y tế- Đến với Công ty thiết bị y tế Quang Anh\">When you need to buy medical equipment-to the medical device company Quang Anh</span></span></p>\r\n', '<p>\r\n	<span id=\"result_box\" lang=\"en\"><span title=\"Công ty TNHH thiết bị y tế và khoa học kỹ thuật Hà Nội được thành lập năm 2002 với lĩnh vực kinh doanh chính là: thiết bị y tế, thiết bị thẩm mỹ, thiết bị khoa học kỹ thuật, công nghệ và môi trường.\">Medical Equipment Co., Ltd. technical and scientific Hanoi was established in 2002 with main business areas are: medical device, aesthetic equipment, scientific equipment, technology and the environment.</span><br />\r\n	<br />\r\n	<span title=\"Tôn chỉ của chúng tôi:\">Our guiding principles:</span><br />\r\n	<br />\r\n	<span title=\"- Cung cấp tới tận tay khách hàng các sản phẩm có chất lượng và kỹ thuật cao trong ngành y tế và khoa học công nghệ môi trường với giá cả cạnh tranh nhất.\">- Provide end-customers with quality products and high technology in the health sector and environmental science and technology with the most competitive price.</span><br />\r\n	<br />\r\n	<span title=\"- Xây dựng và đào tạo một mạng lưới dịch vụ kỹ thuật sau bán hàng một cách hoàn hảo.\">- Develop and train a network of after-sales technical service perfectly.</span><br />\r\n	<br />\r\n	<span title=\"- Luôn giữ chữ “tín” và lấy lợi ích của khách hàng làm trọng.\">- Always keep the words &quot;credit&quot; and get the benefits of important customer.</span><br />\r\n	<br />\r\n	<span title=\"Sản phẩm Công ty cung cấp:\">The company offers products:</span><br />\r\n	<br />\r\n	<span title=\"- Máy soi cổ tử cung kỹ thuật số, monitor sản khoa, monitor theo dõi bệnh nhân đa thông số, hệ thống monitor trung tâm, máy cắt đốt cổ tử cung chuyên dụng, máy đo nồng độ bão hòa ô xy trong máu, bơm\">- Portable digital colposcopy, obstetrics monitor, monitor multi-parameter patient monitor, central monitor system, dedicated cervical ablation, measuring oxygen saturation in the blood, the pump </span><span title=\"tiêm điện, máy truyền dịch tự động của hãng GOLDWAY (US).,INC.\">power injection, its automatic infusion Goldway (U.S.)., INC.</span><br />\r\n	<br />\r\n	<span title=\"- Máy siêu âm đen trắng, siêu màu 4D các loại của hãng Fukuda- Nhật Bản\">- Ultrasound in black and white, super color 4D Its kind Fukuda, Japan</span><br />\r\n	<br />\r\n	<span title=\"- Máy áp lạnh cổ tử cung\">- Air pressure cervical cold</span><br />\r\n	<br />\r\n	<span title=\"- Điện não VIDEO EEG, DIGITAL EEG, điện tim của Tây Ban Nha\">- Electrical brain EEG VIDEO, DIGITAL EEG, ECG of Spain</span><br />\r\n	<br />\r\n	<span title=\"- Máy đo thính lực chuyên dụng của Tây Ban Nha\">- Dedicated audiometric of Spain</span><br />\r\n	<br />\r\n	<span title=\"- Máy đo bilirubin, hemoglobin sản xuất tại Nhật Bản\">- Bilirubin meter, hemoglobin production in Japan</span><br />\r\n	<br />\r\n	<span title=\"- Máy gây mê, máy thở, máy nghe tim thai, nội soi, điện tim, máy phát hiện vàng da.\">- Anesthesia machine, ventilator, fetal player, endoscopy, ECG, jaundice detector.</span><br />\r\n	<br />\r\n	<span title=\"- Máy xét nghiệm sinh hóa (bán tự động, tự động, tổng hợp), ELISA, dao mổ điện sản xuất tại Mỹ\">- Machine biochemical tests (semi-automatic, automatic, synthesis), ELISA, scalpels electricity produced in the U.S.</span><br />\r\n	<br />\r\n	<span title=\"- Máy xét nghiệm nước tiểu Cybow, Clinitek Status (Hàn Quốc, Anh)\">- Machine test urine Cybow, Clinitek Status (Korean, English)</span><br />\r\n	<br />\r\n	<span title=\"- Máy quang phổ UV/VIS - Nhật, tủ bảo quản dược phẩm, tủ trữ máu của Đức.\">- UV Spectrometer / VIS - Japan, pharmaceutical storage cabinets, storage cabinets German blood.</span><br />\r\n	<br />\r\n	<span title=\"- Đèn mổ (Thụy Sĩ), tủ sấy, nồi hấp (Đài Loan)...\">- Lamp (Switzerland), oven, autoclave (Taiwan) ...</span><br />\r\n	<br />\r\n	<span title=\"- Các loại thiết bị khoa học kỹ thuật chuyên dụng của Anh, Mỹ, Đức.\">- The specialized scientific and technical equipment in the UK, USA, Germany.</span><br />\r\n	<br />\r\n	<span title=\"- Các linh kiện thay thế cho các loại monitor theo dõi bệnh nhân, monitor sản khoa\">- The replacement parts for the type of monitor patient monitor, monitor obstetric</span><br />\r\n	<br />\r\n	<span title=\"Công ty có đội ngũ kỹ sư được đào tạo đúng chuyên ngành thiết bị y tế ở trong và ngoài nước.\">The company has a team of engineers who have been properly trained in medical equipment at home and abroad. </span><span title=\"Đội ngũ này không ngừng được nâng cao tay nghề thông qua các khoá đào tạo của các nhà sản xuất...\">This team constantly upgrade their skills through training of producers ...</span><br />\r\n	<br />\r\n	<span title=\"Với thế mạnh của mình, chúng tôi hy vọng rằng trong một tương lai gần, Công ty Công nghệ Quang Anh sẽ trở thành một đối tác truyền thống của Quý khách hàng với tư cách là một nhà cung cấp thiết bị y tế có giá cả\">With its strength, we hope that in the near future, the British Optical Technology Company will become a traditional partner of customers as a supplier of medical equipment pricing </span><span title=\"hợp lý nhất, chất lượng tốt nhất và dịch vụ sau bán hàng hoàn hảo.\">most affordable, best quality and perfect after-sales service.</span><br />\r\n	<br />\r\n	<span title=\"Khi cần mua thiết bị y tế- Đến với Công ty thiết bị y tế &amp; khoa học hà nội\">The need for a new medical device-Coming to medical &amp; scientific equipment hanoi</span></span></p>\r\n', '<p>\r\n	<span id=\"result_box\" lang=\"en\"><span title=\"Công ty TNHH thiết bị y tế và khoa học kỹ thuật Hà Nội được thành lập năm 2002 với lĩnh vực kinh doanh chính là: thiết bị y tế, thiết bị thẩm mỹ, thiết bị khoa học kỹ thuật, công nghệ và môi trường.\">Co., Ltd. medical equipment and scientific and technical Hanoi was established in 2002 with the main business areas: medical equipment, beauty equipment, scientific equipment, technology and environment.</span><br />\r\n	<br />\r\n	<span title=\"Tôn chỉ của chúng tôi:\">Our guiding principles:<br />\r\n	<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Cung cấp tới tận tay khách hàng các sản phẩm có chất lượng và kỹ thuật cao trong ngành y tế và khoa học công nghệ môi trường với giá cả cạnh tranh nhất.\">Hand to provide customers with quality products and high technology in the health and environmental science and technology with the most competitive prices.<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Xây dựng và đào tạo một mạng lưới dịch vụ kỹ thuật sau bán hàng một cách hoàn hảo.\">Develop and train a network of technical service after the sale perfectly.<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Luôn giữ chữ “tín” và lấy lợi ích của khách hàng làm trọng.\">Always keep the word &quot;credit&quot; and get the benefit of customer-focused.</span><br />\r\n	<br />\r\n	<span title=\"Sản phẩm Công ty cung cấp:\">Products The company offers:<br />\r\n	<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Máy soi cổ tử cung kỹ thuật số, monitor sản khoa, monitor theo dõi bệnh nhân đa thông số, hệ thống monitor trung tâm, máy cắt đốt cổ tử cung chuyên dụng, máy đo nồng độ bão hòa ô xy trong máu, bơm tiêm\">Colposcopy machine digital, monitor anesthesia, monitor patient monitor multiple parameters, the central monitor system, cervical ablation machine dedicated machine measurements of oxygen saturation levels in blood, syringes </span><span title=\"điện, máy truyền dịch tự động của hãng GOLDWAY (US).,INC.\">electric machine company infusion of automated GOLDWAY (U.S.)., INC.<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Máy siêu âm đen trắng, siêu màu 4D các loại của hãng Fukuda- Nhật Bản\">Ultrasound machine black &amp; white, color 4D super types of firms Fukuda, Japan<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Máy áp lạnh cổ tử cung\">Machine cold pressure of the cervix<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Điện não VIDEO EEG, DIGITAL EEG, điện tim của Tây Ban Nha\">EEG EEG VIDEO, DIGITAL EEG, ECG of Spain<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Máy đo thính lực chuyên dụng của Tây Ban Nha\">Machinery specialized hearing test in Spain<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Máy đo bilirubin, hemoglobin sản xuất tại Nhật Bản\">Gauge bilirubin, hemoglobin production in Japan<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Máy gây mê, máy thở, máy nghe tim thai, nội soi, điện tim, máy phát hiện vàng da.\">Anesthesia machines, ventilators, air auscultation, endoscopy, ECG, jaundice detector.<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Máy xét nghiệm sinh hóa (bán tự động, tự động, tổng hợp), ELISA, dao mổ điện sản xuất tại Mỹ\">Biochemical machine (semi-automatic, automatic, general), ELISA, electric knife made in USA<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Máy xét nghiệm nước tiểu Cybow, Clinitek Status (Hàn Quốc, Anh)\">Machine Cybow urine, Clinitek Status (Korean, English)<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Máy quang phổ UV/VIS - Nhật, tủ bảo quản dược phẩm, tủ trữ máu của Đức.\">Spectrophotometer UV / VIS - Japanese pharmaceutical storage cabinets, storage cabinets of German blood.<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Đèn mổ (Thụy Sĩ), tủ sấy, nồi hấp (Đài Loan)...\">Lights (Switzerland), oven, steamer (Taiwan) ...<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Các loại thiết bị khoa học kỹ thuật chuyên dụng của Anh, Mỹ, Đức.\">The type of equipment dedicated science and technology in the UK, U.S., Germany.<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Các linh kiện thay thế cho các loại monitor theo dõi bệnh nhân, monitor sản khoa\">Replacement parts for the type of monitor to track patients, monitor obstetric</span><br />\r\n	<br />\r\n	<span title=\"Công ty có đội ngũ kỹ sư được đào tạo đúng chuyên ngành thiết bị y tế ở trong và ngoài nước.\">The company has a team of engineers are properly trained specialized medical equipment at home and abroad. </span><span title=\"Đội ngũ này không ngừng được nâng cao tay nghề thông qua các khoá đào tạo của các nhà sản xuất...\">This team is constantly improving skills through training of manufacturers ...</span><br />\r\n	<br />\r\n	<span title=\"Với thế mạnh của mình, chúng tôi hy vọng rằng trong một tương lai gần, Công ty Công nghệ Quang Anh sẽ trở thành một đối tác truyền thống của Quý khách hàng với tư cách là một nhà cung cấp thiết bị y tế có giá cả\">With its strength, we hope that in the near future, Quang Anh Technology Company will become a traditional partner of customers as a supplier of medical equipment priced </span><span title=\"hợp lý nhất, chất lượng tốt nhất và dịch vụ sau bán hàng hoàn hảo.\">most logical, best quality and after sales service perfect.</span><br />\r\n	<br />\r\n	<span title=\"Khi cần mua thiết bị y tế- Đến với Công ty thiết bị y tế Quang Anh\">When you need to buy medical equipment-to the medical device company Quang Anh</span></span></p>\r\n', 'img/upload/076e3caed758a1c18c91a0e9cae3368f.jpg', '', 146, '', 0, '2012-07-23 14:38:15', '2012-08-23 17:51:27', 1, NULL, 'about'),
	(117, 0, 0, 'Hướng dẫn mua hàng qua điện thoại', 'Method of purchases via phones', '<p>\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">Hướng dẫn mua h&agrave;ng qua điện thoại</span></p>\r\n', '', '<br />\r\n<p style=\"line-height: 150%\">\r\n	<span style=\"font-weight: bold; font-family: Arial; color: rgb(0, 102, 255); \"><a href=\"http://topcare.vn/content/cc7c5215-0e85-4f4d-97cc-d12782e5fd43/Huong_dan_mua_hang_online.aspx#mh1\" id=\"mh1\" name=\"mh1\">I/ Đặt h&agrave;ng qua Điện thoại</a><span style=\"font-size: 10pt; \"><a href=\"http://topcare.vn/content/cc7c5215-0e85-4f4d-97cc-d12782e5fd43/Huong_dan_mua_hang_online.aspx#top\" style=\"text-decoration: none\"><span style=\"color: rgb(0, 102, 255); \">(L&ecirc;n tr&ecirc;n </span></a></span></span><a href=\"http://topcare.vn/content/cc7c5215-0e85-4f4d-97cc-d12782e5fd43/Huong_dan_mua_hang_online.aspx#top\" style=\"text-decoration: none\"><span style=\"text-decoration: none; font-weight: bold; font-size: 10pt; color: rgb(0, 102, 255); \">&uarr;</span><span style=\"text-decoration: none; font-weight: bold; font-family: Arial; font-size: 10pt; color: rgb(0, 102, 255); \">)</span></a><br />\r\n	&nbsp;</p>\r\n<p style=\"line-height: 150%\">\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">Qu&yacute; kh&aacute;ch gọi điện thoại trực tiếp đến Ph&ograve;ng B&aacute;n h&agrave;ng Online theo số m&aacute;y <span style=\"font-weight: bold; \">04.32888999</span> hoặc <span style=\"font-weight: bold; \">04.85821888</span>.<br />\r\n	<br />\r\n	</span></p>\r\n<p style=\"line-height: 150%\">\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">H&agrave;ng ng&agrave;y từ 8h30 &ndash; 21h30 kể cả Thứ bảy, Chủ Nhật v&agrave; c&aacute;c ng&agrave;y Lễ, nh&acirc;n vi&ecirc;n b&aacute;n h&agrave;ng trực tuyến của TOPCARE lu&ocirc;n sẵn s&agrave;ng phục vụ.<br />\r\n	<br />\r\n	</span><br />\r\n	<span style=\"font-weight: bold; font-family: Arial; color: rgb(0, 102, 255); \"> <a href=\"http://topcare.vn/content/cc7c5215-0e85-4f4d-97cc-d12782e5fd43/Huong_dan_mua_hang_online.aspx#mh2\" id=\"mh2\">II/ Đặt h&agrave;ng qua Chương tr&igrave;nh Chat Yahoo hoặc Skype</a><span style=\"font-size: 10pt; \"><a href=\"http://topcare.vn/content/cc7c5215-0e85-4f4d-97cc-d12782e5fd43/Huong_dan_mua_hang_online.aspx#top\" style=\"text-decoration: none\"><span style=\"color: rgb(0, 102, 255); \">(L&ecirc;n tr&ecirc;n </span></a></span></span><a href=\"http://topcare.vn/content/cc7c5215-0e85-4f4d-97cc-d12782e5fd43/Huong_dan_mua_hang_online.aspx#top\" style=\"text-decoration: none\"><span style=\"font-weight: bold; font-size: 10pt; color: rgb(0, 102, 255); \">&uarr;</span><span style=\"font-weight: bold; font-family: Arial; font-size: 10pt; color: rgb(0, 102, 255); \">)</span></a></p>\r\n<p style=\"line-height: 150%\">\r\n	<br />\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">Khi Qu&yacute; kh&aacute;ch truy cập trang <a href=\"http://www.topcare.vn\">www.topcare.vn</a> c&oacute; thể chat v&agrave; đăng k&yacute; mua h&agrave;ng với c&aacute;c nick Yahoo, Skype hiển thị s&aacute;ng tr&ecirc;n Website ch&iacute;nh thức của ch&uacute;ng t&ocirc;i:<br />\r\n	<br />\r\n	</span></p>\r\n<p align=\"center\" style=\"line-height: 150%\">\r\n	<img border=\"1\" height=\"29\" src=\"http://topcare.vn/Images/anh/yahoo_skype.jpg\" width=\"145\" /></p>\r\n<p style=\"line-height: 150%\">\r\n	<br />\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">Nhấn v&agrave;o biểu tượng mặt cười, cửa sổ chương tr&igrave;nh Yahoo! Messenger hoặc Skype sẽ tự động bật l&ecirc;n.</span></p>\r\n<p style=\"line-height: 150%\">\r\n	<br />\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">Chat với nh&acirc;n vi&ecirc;n b&aacute;n h&agrave;ng trực tuyến của TOPCARE, Qu&yacute; kh&aacute;ch sẽ được tư vấn v&agrave; c&oacute; thể y&ecirc;u cầu đặt h&agrave;ng ngay. Nh&acirc;n vi&ecirc;n Topcare sẽ gọi điện thoại cho Qu&yacute; kh&aacute;ch để x&aacute;c nhận đơn h&agrave;ng v&agrave; x&aacute;c nhận địa chỉ giao h&agrave;ng (nếu cần).<br />\r\n	<br />\r\n	</span><br />\r\n	<span style=\"font-weight: bold; font-family: Arial; color: rgb(0, 102, 255); \"> <a href=\"http://topcare.vn/content/cc7c5215-0e85-4f4d-97cc-d12782e5fd43/Huong_dan_mua_hang_online.aspx#mh3\" id=\"mh3\">III/ Đăng k&yacute; mua h&agrave;ng qua website www.topcare.vn</a><a href=\"http://topcare.vn/content/cc7c5215-0e85-4f4d-97cc-d12782e5fd43/Huong_dan_mua_hang_online.aspx#top\" style=\"text-decoration: none\"><span style=\"font-size: 10pt; color: rgb(0, 102, 255); \">(L&ecirc;n tr&ecirc;n </span></a></span><a href=\"http://topcare.vn/content/cc7c5215-0e85-4f4d-97cc-d12782e5fd43/Huong_dan_mua_hang_online.aspx#top\" style=\"text-decoration: none\"><span style=\"font-weight: bold; font-size: 10pt; color: rgb(0, 102, 255); \">&uarr;</span><span style=\"font-weight: bold; font-family: Arial; font-size: 10pt; color: rgb(0, 102, 255); \">)</span></a></p>\r\n<p style=\"line-height: 150%\">\r\n	<br />\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">Việc đăng k&yacute; mua h&agrave;ng qua website cũng cực kỳ đơn giản, Qu&yacute; kh&aacute;ch c&oacute; thể l&agrave;m theo c&aacute;c hướng dẫn dưới đ&acirc;y:</span></p>\r\n<p style=\"line-height: 150%\">\r\n	<br />\r\n	<span style=\"font-weight: bold; font-family: Arial; font-size: 10pt; \">Bước 1: Qu&yacute; kh&aacute;ch chọn sản phẩm v&agrave;o &quot;giỏ h&agrave;ng&quot; bằng nhiều c&aacute;ch</span></p>\r\n<p style=\"line-height: 150%\">\r\n	<br />\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">V&iacute; dụ như v&agrave;o danh mục h&agrave;ng tương ứng, chọn theo h&atilde;ng, chọn theo gi&aacute;, chọn theo chức năng, chọn theo t&iacute;nh năng, nhập m&atilde; h&agrave;ng v&agrave;o &ocirc; t&igrave;m kiếm&hellip;<br />\r\n	Sau khi đ&atilde; chọn được sản phẩm cần mua, Qu&yacute; kh&aacute;ch nhấn n&uacute;t <img align=\"top\" border=\"0\" height=\"20\" src=\"http://topcare.vn/Images/btn_cart_small.jpg\" width=\"88\" /> tại khung hiển thị của sản phẩm đ&oacute;.</span></p>\r\n<p align=\"left\" style=\"line-height: 150%\">\r\n	<br />\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">Ngay lập tức tr&ecirc;n website sẽ xuất hiện <span style=\"font-weight: bold; \">Khung giỏ h&agrave;ng</span> với những sản phẩm Qu&yacute; kh&aacute;ch vừa chọn:<br />\r\n	<br />\r\n	</span></p>\r\n<p align=\"center\" style=\"line-height: 150%\">\r\n	<span style=\"font-family: Arial; font-size: 10pt; \"><img border=\"1\" height=\"256\" src=\"http://topcare.vn/Images/anh/cart_1_small.jpg\" width=\"575\" /></span></p>\r\n<p align=\"left\" style=\"line-height: 150%\">\r\n	<br />\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">Tại <span style=\"font-weight: bold; \">Khung giỏ h&agrave;ng</span> n&agrave;y đ&atilde; c&oacute; hướng dẫn chi tiết để Qu&yacute; kh&aacute;ch chọn số lượng sản phẩm m&igrave;nh cần mua, hoặc bỏ kh&ocirc;ng chọn sản phẩm n&agrave;y nữa m&agrave; thay bằng chọn sản phẩm kh&aacute;c.</span></p>\r\n<ul>\r\n	<li>\r\n		<span class=\"Apple-style-span\" style=\"font-family: Arial; font-size: 13px; line-height: 24px; \">Nếu Qu&yacute; kh&aacute;ch muốn bỏ mua mặt h&agrave;ng n&agrave;o đ&oacute;, chỉ cần bấm v&agrave;o n&uacute;t <img align=\"top\" border=\"0\" height=\"20\" src=\"http://topcare.vn/Images/anh/DeleteRed.jpg\" width=\"20\" />&nbsp;<span style=\"color: rgb(0, 0, 255); \">Loại bỏ</span> c&ugrave;ng h&agrave;ng với sản phẩm đ&oacute;<br />\r\n		<br />\r\n		</span></li>\r\n	<li>\r\n		<span class=\"Apple-style-span\" style=\"font-family: Arial; font-size: 13px; line-height: 24px; \">Nếu Qu&yacute; kh&aacute;ch muốn chọn mua th&ecirc;m những sản phẩm kh&aacute;c, bấm v&agrave;o n&uacute;t <img align=\"middle\" border=\"0\" height=\"32\" src=\"http://topcare.vn/Images/anh/btn_more.jpg\" width=\"233\" />, <span style=\"font-weight: bold; \">Khung giỏ h&agrave;ng</span> sẽ tạm thời ẩn đi để Qu&yacute; kh&aacute;ch chọn sản phẩm kh&aacute;c v&agrave;o Giỏ h&agrave;ng.<br />\r\n		<br />\r\n		</span></li>\r\n	<li>\r\n		<span class=\"Apple-style-span\" style=\"font-family: Arial; font-size: 13px; line-height: 24px; \">Sau khi đ&atilde; chọn xong sản phẩm cần mua, Qu&yacute; kh&aacute;ch kiểm tra lại th&ocirc;ng tin sản phẩm trong giỏ h&agrave;ng 1 lần nữa như: T&ecirc;n sản phẩm, số lượng, đơn gi&aacute;, tổng số tiền phải thanh to&aacute;n... Qu&yacute; kh&aacute;ch nhấn n&uacute;t <img align=\"middle\" border=\"0\" height=\"32\" src=\"http://topcare.vn/Images/anh/continue_button.jpg\" width=\"95\" /> để chuyển sang bước 2</span></li>\r\n</ul>\r\n', '', '/estoreadmin/webroot/upload/image/files/vietsys_55.jpg', '', 156, '', 0, '2012-07-23 14:45:38', '2012-08-22 11:56:58', 1, NULL, ''),
	(118, 0, 0, 'Cách thanh toán qua cổng trực tuyến', 'Method of online payment', '<p>\r\n	sfsdf</p>\r\n', '', '<p>\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">Ở bước n&agrave;y Qu&yacute; kh&aacute;ch sẽ nhập c&aacute;c th&ocirc;ng tin cần thiết như <span style=\"font-weight: bold; \">Họ t&ecirc;n, Số điện thoại, Địa chỉ nhận h&agrave;ng, Email</span> (để Topcare gửi th&ocirc;ng tin đơn h&agrave;ng cho Qu&yacute; kh&aacute;ch), hoặc c&oacute; thể bổ sung th&ecirc;m v&agrave;i th&ocirc;ng tin kh&aacute;c m&agrave; Qu&yacute; kh&aacute;ch cảm thấy cần thiết trong &ocirc; <span style=\"font-weight: bold; \">&quot;Ch&uacute; th&iacute;ch th&ecirc;m&quot;</span> (hướng dẫn Topcare giao h&agrave;ng, y&ecirc;u cầu viết ho&aacute; đơn VAT cho c&ocirc;ng ty...)</span></p>\r\n<p align=\"left\" style=\"line-height: 150%\">\r\n	<br />\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">Sau khi điền đủ c&aacute;c th&ocirc;ng tin, Qu&yacute; kh&aacute;ch cần điền th&ecirc;m<span style=\"font-weight: bold; \"> &ldquo;Nhập m&atilde; bảo vệ&rdquo;</span> (để tr&aacute;nh t&igrave;nh trạng SPAM, gửi h&agrave;ng loạt đơn h&agrave;ng), m&atilde; Qu&yacute; kh&aacute;ch phải nhập kh&ocirc;ng ph&acirc;n biệt chữ hoa, chữ thường. Nếu Qu&yacute; kh&aacute;ch kh&ocirc;ng nh&igrave;n r&otilde; m&atilde; bảo vệ đ&oacute;, Qu&yacute; kh&aacute;ch c&oacute; thể bấm <img align=\"top\" border=\"0\" height=\"20\" src=\"http://topcare.vn/Images/anh/iconcopy.jpg\" width=\"20\" />&nbsp;<span style=\"font-weight: bold; color: rgb(0, 102, 255); \">Chọn m&atilde; kh&aacute;c</span>. Rồi bấm <img align=\"middle\" border=\"0\" height=\"32\" src=\"http://topcare.vn/Images/anh/cart_finish.jpg\" width=\"92\" /> v&agrave; chờ v&agrave;i gi&acirc;y để đơn h&agrave;ng được gửi tới hệ thống của Topcare.</span></p>\r\n<p align=\"left\" style=\"line-height: 150%\">\r\n	<br />\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">Hệ thống sẽ kiểm tra những th&ocirc;ng tin của Qu&yacute; kh&aacute;ch đ&atilde; cung cấp 1 lần nữa, nếu th&ocirc;ng tin đơn h&agrave;ng hợp lệ, khung đặt h&agrave;ng sẽ hiện l&ecirc;n th&ocirc;ng b&aacute;o ho&agrave;n tất quy tr&igrave;nh mua h&agrave;ng như h&igrave;nh dưới đ&acirc;y:<br />\r\n	<br />\r\n	</span></p>\r\n<p align=\"center\" style=\"line-height: 150%\">\r\n	<img border=\"1\" height=\"256\" src=\"http://topcare.vn/Images/anh/cartfinish.jpg\" width=\"575\" /></p>\r\n<p style=\"line-height: 150%\">\r\n	<br />\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">Sau đ&oacute; nh&acirc;n vi&ecirc;n của Topcare sẽ xử l&yacute; đơn đặt h&agrave;ng v&agrave; li&ecirc;n lạc lại với Qu&yacute; kh&aacute;ch để x&aacute;c nhận v&agrave; thống nhất việc mua h&agrave;ng.<br />\r\n	<br />\r\n	</span></p>\r\n<p style=\"line-height: 150%\">\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">Qu&yacute; kh&aacute;ch cũng c&oacute; thể li&ecirc;n lạc với Ph&ograve;ng B&aacute;n h&agrave;ng Online để nhận hỗ trợ:</span></p>\r\n<ul>\r\n	<li>\r\n		<span class=\"Apple-style-span\" style=\"font-family: Arial; font-size: 13px; line-height: 24px; \">Hỗ trợ th&ocirc;ng tin qua Email: <a href=\"mailto:banhang.online@topcare.vn\">banhang.online@topcare.vn</a><br />\r\n		<br />\r\n		</span></li>\r\n	<li>\r\n		<span class=\"Apple-style-span\" style=\"font-family: Arial; font-size: 13px; line-height: 24px; \">Điện thoại : <span style=\"font-weight: bold; \">(04).32888999</span> hoặc <span style=\"font-weight: bold; \">(04).85821888</span></span></li>\r\n</ul>\r\n<p style=\"line-height: 150%\">\r\n	<br />\r\n	<span style=\"text-decoration: underline; \"><span style=\"font-weight: bold; font-family: Arial; color: rgb(0, 102, 255); \">Một số lưu &yacute;:</span></span></p>\r\n<ul>\r\n	<li>\r\n		<span class=\"Apple-style-span\" style=\"font-family: Arial; font-size: 13px; line-height: 24px; \">Topcare chỉ chấp nhận những Đơn đặt h&agrave;ng khi cung cấp đủ th&ocirc;ng tin ch&iacute;nh x&aacute;c về địa chỉ, số điện thoại &hellip; Sau khi Qu&yacute; kh&aacute;ch đặt h&agrave;ng, TOPCARE sẽ gọi điện cho Qu&yacute; kh&aacute;ch để x&aacute;c nhận th&ocirc;ng tin v&agrave; trao đổi việc thực hiện đơn h&agrave;ng.<br />\r\n		<br />\r\n		</span></li>\r\n	<li>\r\n		<span class=\"Apple-style-span\" style=\"font-family: Arial; line-height: 24px; font-size: small; \">Hiện tại Topcare chỉ phục vụ b&aacute;n h&agrave;ng Online đối với kh&aacute;ch h&agrave;ng H&agrave; Nội v&agrave; c&aacute;c tỉnh th&agrave;nh kh&aacute;c thuộc nước Việt Nam.<br />\r\n		<br />\r\n		</span></li>\r\n	<li>\r\n		<span class=\"Apple-style-span\" style=\"font-family: Arial; line-height: 24px; font-size: small; \">Địa chỉ giao h&agrave;ng phải c&oacute; th&ocirc;ng tin người nhận h&agrave;ng, địa chỉ, số điện thoại ch&iacute;nh x&aacute;c, r&otilde; r&agrave;ng. Ch&uacute;ng t&ocirc;i kh&ocirc;ng chịu tr&aacute;ch nhiệm khi qu&yacute; kh&aacute;ch ghi sai th&ocirc;ng tin người nhận.<br />\r\n		<br />\r\n		</span></li>\r\n	<li>\r\n		<span class=\"Apple-style-span\" style=\"font-family: Arial; font-size: 13px; line-height: 24px; \">Topcare kh&ocirc;ng b&aacute;n sản phẩm cho người dưới 13 tuổi. Nếu qu&yacute; kh&aacute;ch dưới 13 tuổi, Qu&yacute; kh&aacute;ch được y&ecirc;u cầu phải c&oacute; sự đồng &yacute; của cha mẹ hoặc người gi&aacute;m hộ để thực hiện mua h&agrave;ng từ website <a href=\"http://www.topcare.vn\">www.topcare.vn</a></span></li>\r\n</ul>\r\n', '', '/estoreadmin/webroot/upload/image/files/vietsys_55.jpg', '', 156, '', 0, '2012-07-23 14:46:20', '2012-08-22 11:56:53', 1, NULL, ''),
	(119, 0, 0, 'Hướng dẫn đặt hàng', 'Method of order', '', '', '<p>\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">Ở bước n&agrave;y Qu&yacute; kh&aacute;ch sẽ nhập c&aacute;c th&ocirc;ng tin cần thiết như <span style=\"font-weight: bold; \">Họ t&ecirc;n, Số điện thoại, Địa chỉ nhận h&agrave;ng, Email</span> (để Topcare gửi th&ocirc;ng tin đơn h&agrave;ng cho Qu&yacute; kh&aacute;ch), hoặc c&oacute; thể bổ sung th&ecirc;m v&agrave;i th&ocirc;ng tin kh&aacute;c m&agrave; Qu&yacute; kh&aacute;ch cảm thấy cần thiết trong &ocirc; <span style=\"font-weight: bold; \">&quot;Ch&uacute; th&iacute;ch th&ecirc;m&quot;</span> (hướng dẫn Topcare giao h&agrave;ng, y&ecirc;u cầu viết ho&aacute; đơn VAT cho c&ocirc;ng ty...)</span></p>\r\n<p align=\"left\" style=\"line-height: 150%\">\r\n	<br />\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">Sau khi điền đủ c&aacute;c th&ocirc;ng tin, Qu&yacute; kh&aacute;ch cần điền th&ecirc;m<span style=\"font-weight: bold; \"> &ldquo;Nhập m&atilde; bảo vệ&rdquo;</span> (để tr&aacute;nh t&igrave;nh trạng SPAM, gửi h&agrave;ng loạt đơn h&agrave;ng), m&atilde; Qu&yacute; kh&aacute;ch phải nhập kh&ocirc;ng ph&acirc;n biệt chữ hoa, chữ thường. Nếu Qu&yacute; kh&aacute;ch kh&ocirc;ng nh&igrave;n r&otilde; m&atilde; bảo vệ đ&oacute;, Qu&yacute; kh&aacute;ch c&oacute; thể bấm <img align=\"top\" border=\"0\" height=\"20\" src=\"http://topcare.vn/Images/anh/iconcopy.jpg\" width=\"20\" />&nbsp;<span style=\"font-weight: bold; color: rgb(0, 102, 255); \">Chọn m&atilde; kh&aacute;c</span>. Rồi bấm <img align=\"middle\" border=\"0\" height=\"32\" src=\"http://topcare.vn/Images/anh/cart_finish.jpg\" width=\"92\" /> v&agrave; chờ v&agrave;i gi&acirc;y để đơn h&agrave;ng được gửi tới hệ thống của Topcare.</span></p>\r\n<p align=\"left\" style=\"line-height: 150%\">\r\n	<br />\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">Hệ thống sẽ kiểm tra những th&ocirc;ng tin của Qu&yacute; kh&aacute;ch đ&atilde; cung cấp 1 lần nữa, nếu th&ocirc;ng tin đơn h&agrave;ng hợp lệ, khung đặt h&agrave;ng sẽ hiện l&ecirc;n th&ocirc;ng b&aacute;o ho&agrave;n tất quy tr&igrave;nh mua h&agrave;ng như h&igrave;nh dưới đ&acirc;y:<br />\r\n	<br />\r\n	</span></p>\r\n<p align=\"center\" style=\"line-height: 150%\">\r\n	<img border=\"1\" height=\"256\" src=\"http://topcare.vn/Images/anh/cartfinish.jpg\" width=\"575\" /></p>\r\n<p style=\"line-height: 150%\">\r\n	<br />\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">Sau đ&oacute; nh&acirc;n vi&ecirc;n của Topcare sẽ xử l&yacute; đơn đặt h&agrave;ng v&agrave; li&ecirc;n lạc lại với Qu&yacute; kh&aacute;ch để x&aacute;c nhận v&agrave; thống nhất việc mua h&agrave;ng.<br />\r\n	<br />\r\n	</span></p>\r\n<p style=\"line-height: 150%\">\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">Qu&yacute; kh&aacute;ch cũng c&oacute; thể li&ecirc;n lạc với Ph&ograve;ng B&aacute;n h&agrave;ng Online để nhận hỗ trợ:</span></p>\r\n<ul>\r\n	<li>\r\n		<span class=\"Apple-style-span\" style=\"font-family: Arial; font-size: 13px; line-height: 24px; \">Hỗ trợ th&ocirc;ng tin qua Email: <a href=\"mailto:banhang.online@topcare.vn\">banhang.online@topcare.vn</a><br />\r\n		<br />\r\n		</span></li>\r\n	<li>\r\n		<span class=\"Apple-style-span\" style=\"font-family: Arial; font-size: 13px; line-height: 24px; \">Điện thoại : <span style=\"font-weight: bold; \">(04).32888999</span> hoặc <span style=\"font-weight: bold; \">(04).85821888</span></span></li>\r\n</ul>\r\n<p style=\"line-height: 150%\">\r\n	<br />\r\n	<span style=\"text-decoration: underline; \"><span style=\"font-weight: bold; font-family: Arial; color: rgb(0, 102, 255); \">Một số lưu &yacute;:</span></span></p>\r\n<ul>\r\n	<li>\r\n		<span class=\"Apple-style-span\" style=\"font-family: Arial; font-size: 13px; line-height: 24px; \">Topcare chỉ chấp nhận những Đơn đặt h&agrave;ng khi cung cấp đủ th&ocirc;ng tin ch&iacute;nh x&aacute;c về địa chỉ, số điện thoại &hellip; Sau khi Qu&yacute; kh&aacute;ch đặt h&agrave;ng, TOPCARE sẽ gọi điện cho Qu&yacute; kh&aacute;ch để x&aacute;c nhận th&ocirc;ng tin v&agrave; trao đổi việc thực hiện đơn h&agrave;ng.<br />\r\n		<br />\r\n		</span></li>\r\n	<li>\r\n		<span class=\"Apple-style-span\" style=\"font-family: Arial; line-height: 24px; font-size: small; \">Hiện tại Topcare chỉ phục vụ b&aacute;n h&agrave;ng Online đối với kh&aacute;ch h&agrave;ng H&agrave; Nội v&agrave; c&aacute;c tỉnh th&agrave;nh kh&aacute;c thuộc nước Việt Nam.<br />\r\n		<br />\r\n		</span></li>\r\n	<li>\r\n		<span class=\"Apple-style-span\" style=\"font-family: Arial; line-height: 24px; font-size: small; \">Địa chỉ giao h&agrave;ng phải c&oacute; th&ocirc;ng tin người nhận h&agrave;ng, địa chỉ, số điện thoại ch&iacute;nh x&aacute;c, r&otilde; r&agrave;ng. Ch&uacute;ng t&ocirc;i kh&ocirc;ng chịu tr&aacute;ch nhiệm khi qu&yacute; kh&aacute;ch ghi sai th&ocirc;ng tin người nhận.<br />\r\n		<br />\r\n		</span></li>\r\n	<li>\r\n		<span class=\"Apple-style-span\" style=\"font-family: Arial; font-size: 13px; line-height: 24px; \">Topcare kh&ocirc;ng b&aacute;n sản phẩm cho người dưới 13 tuổi. Nếu qu&yacute; kh&aacute;ch dưới 13 tuổi, Qu&yacute; kh&aacute;ch được y&ecirc;u cầu phải c&oacute; sự đồng &yacute; của cha mẹ hoặc người gi&aacute;m hộ để thực hiện mua h&agrave;ng từ website <a href=\"http://www.topcare.vn\">www.topcare.vn</a></span></li>\r\n</ul>\r\n', '', '/estoreadmin/webroot/upload/image/images/13.jpg', '', 156, '', 0, '2012-07-23 14:47:22', '2012-08-22 11:56:42', 1, NULL, ''),
	(126, 0, 0, 'Sáng nay giá vàng giảm 500 nghìn/1 lượng', 'The price of gold has decreased by 500 thousand VND this morning ', '<p>\r\n	S&aacute;ng nay gi&aacute; v&agrave;ng giảm 500 ngh&igrave;n/1 lượng, mọi người đổ x&ocirc; ra c&aacute;c tiệm v&agrave;ng để b&aacute;n, v&igrave; lo sợ gi&aacute; v&agrave;ng tiếp tục giảm</p>\r\n', '<p>\r\n	update</p>\r\n', '<p>\r\n	S&aacute;ng nay gi&aacute; v&agrave;ng giảm 500 ngh&igrave;n/1 lượng, mọi người đổ x&ocirc; ra c&aacute;c tiệm v&agrave;ng để b&aacute;n, v&igrave; lo sợ gi&aacute; v&agrave;ng tiếp tục giảm</p>\r\n', '<p>\r\n	update..</p>\r\n', 'img/upload/17e72a27ea8728adf98fd4cc99c4db82.jpg', '', 156, '', 0, '2012-07-29 16:43:23', '2012-07-29 16:43:23', 1, NULL, 'sang-nay-gia-vang-giam-500-nghin-1-luong'),
	(127, 0, 0, 'Công ty TNHH thiết bị y tế mới nhập 1 lô sản phẩm y tế', 'Medical Equipment Co., Ltd has just imported a new batch of medical products', '<p>\r\n	Đ&acirc;y&nbsp; lo h&agrave;ng ống nước hiện đại nhất thế giới, được sản xuất theo c&ocirc;ng nghệ của mỹ , ti&ecirc;n tiến nhất hiện nay</p>\r\n', '<p>\r\n	<span id=\"result_box\" lang=\"en\"><span class=\"hps\">This</span> <span class=\"hps\">concerns</span> <span class=\"hps\">the most modern</span> <span class=\"hps\">water</span> <span class=\"hps\">pipe</span> <span class=\"hps\">in the world,</span> <span class=\"hps\">is produced by</span> <span class=\"hps\">the</span> <span class=\"hps\">U.S.</span> <span class=\"hps\">technology</span><span>,</span> <span class=\"hps\">today&#39;s most</span> <span class=\"hps\">advanced</span></span></p>\r\n', '<p>\r\n	Đ&acirc;y&nbsp; lo h&agrave;ng ống nước hiện đại nhất thế giới, được sản xuất theo c&ocirc;ng nghệ của mỹ , ti&ecirc;n tiến nhất hiện nay</p>\r\n', '<p>\r\n	<span id=\"result_box\" lang=\"en\"><span class=\"hps\">This</span> <span class=\"hps\">concerns</span> <span class=\"hps\">the most modern</span> <span class=\"hps\">water</span> <span class=\"hps\">pipe</span> <span class=\"hps\">in the world,</span> <span class=\"hps\">is produced by</span> <span class=\"hps\">the</span> <span class=\"hps\">U.S.</span> <span class=\"hps\">technology</span><span>,</span> <span class=\"hps\">today&#39;s most</span> <span class=\"hps\">advanced</span></span></p>\r\n', 'img/upload/ab9459f38a75e382e4c2fa044f39fc10.jpg', '', 156, '', 0, '2012-07-29 16:45:58', '2012-08-06 12:45:44', 1, NULL, 'cong-ty-tnhh-thiet-bi-y-te-moi-nhap-1-lo-san-pham-y-te');";

$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_orders` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `estore_id` int(50) NOT NULL DEFAULT '0',
  `user_id` varchar(200) NOT NULL,
  `pid` int(11) NOT NULL,
  `pname` varchar(255) NOT NULL,
  `images` varchar(255) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;";

$arrSql[] ="INSERT INTO `estore_orders` (`id`, `estore_id`, `user_id`, `pid`, `pname`, `images`, `quantity`, `price`, `total_price`) VALUES
	(1, 0, 'id366822', 21, 'Ống công nghiệp inox ', '/tana/estoreadmin/webroot/upload/image/images/index_29.jpg', 1, 300, 300),
	(2, 0, 'id366822', 20, 'Ống công nghiệp inox', '/tana/estoreadmin/webroot/upload/image/images/index_33.jpg', 1, 400, 400),
	(3, 0, 'id366822', 19, 'Ống công nghiệp inox ', '/tana/estoreadmin/webroot/upload/image/images/index_31.jpg', 1, 200, 200),
	(4, 0, 'id47761', 25, 'Ống công nghiệp inox ', '/tana/estoreadmin/webroot/upload/image/images/index_27.jpg', 5, 120, 600),
	(5, 0, 'id47761', 20, 'Ống công nghiệp inox', '/tana/estoreadmin/webroot/upload/image/images/index_33.jpg', 5, 400, 2000),
	(6, 0, 'id717636', 25, 'sp1', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_09.jpg', 1, 120, 120),
	(7, 0, 'id881866', 21, 'sp2', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_17.jpg', 1, 300, 300),
	(8, 0, 'id503470', 26, 'sp43', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_20.jpg', 1, 120000, 120000),
	(9, 0, 'id67517', 27, 'sp3', '/khieuvu/estoreadmin/webroot/upload/image/files/3.jpg', 1, 200, 200);";

$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_partners` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `estore_id` int(50) NOT NULL DEFAULT '0',
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
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;";

$arrSql[] ="INSERT INTO `estore_partners` (`id`, `estore_id`, `name`, `phone`, `email`, `website`, `fax`, `address`, `images`, `content`, `created`, `modified`, `status`) VALUES
	(19, 0, 'Công ty bcds', '', '', 'http://google.com', NULL, '', 'img/upload/a26d66b1322c320201a5a6c01e9f004f.jpg', NULL, '2012-07-29', '2012-07-29', 1),
	(18, 0, 'Công ty bcd', '', '', 'http://google.com', NULL, '', 'img/upload/aded75138b945d987476ee4beaa48400.jpg', NULL, '2012-07-29', '2012-07-29', 1),
	(17, 0, 'Công ty dcb', '', '', 'http://google.com', NULL, '', 'img/upload/65756cba90775ab2b30a744199a7c84a.jpg', NULL, '2012-07-29', '2012-07-29', 1),
	(16, 0, 'Công ty abc', '', '', 'http://eximbank.com.vn', NULL, '', 'img/upload/61c692bbd3e8c4f8cb24ca87e9ff3d92.jpg', NULL, '2012-07-29', '2012-07-29', 1),
	(20, 0, 'ádasd', '', '', 'http://google.com', NULL, '', 'img/upload/36e21b2e6d68b65741d004886e5223cb.jpg', NULL, '2012-09-16', '2012-09-16', 1),
	(21, 0, 'hhhh', '', '', 'http://google.com', NULL, '', 'img/upload/97fea11d1a80d7ccfad25eccdd7d031e.jpg', NULL, '2012-09-16', '2012-09-16', 1),
	(22, 0, 'hhh', '', '', 'http://google.com', NULL, '', 'img/upload/f6c03d67fe500b1ac80f32c87c60ec59.jpg', NULL, '2012-09-16', '2012-09-16', 1),
	(23, 0, 'h', '', '', 'http://google.com', NULL, '', 'img/upload/8f9fa526eff662129d81b1fb55d07676.jpg', NULL, '2012-09-16', '2012-09-16', 1),
	(24, 0, 'hhh', '', '', 'http://google.com', NULL, '', 'img/upload/74b21a268eb187c89772e79f91895d62.jpg', NULL, '2012-09-16', '2012-09-16', 1),
	(25, 0, 'á', '', '', 'http://google.com', NULL, '', 'img/upload/ff76a40ba32dfb0687988e0bdbc15765.jpg', NULL, '2012-09-16', '2012-09-16', 1),
	(26, 0, 'ádas', '', '', 'http://google.com', NULL, '', 'img/upload/cb18c77ef1e964033f5e9b33c991411d.jpg', NULL, '2012-09-16', '2012-09-16', 1);";

$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_products` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `estore_id` int(50) NOT NULL DEFAULT '0',
  `title` varchar(256) NOT NULL,
  `title_en` varchar(256) NOT NULL,
  `price` int(30) DEFAULT NULL,
  `manufacturer` varchar(256) NOT NULL COMMENT 'hang sx',
  `introduction` text NOT NULL COMMENT 'mo ta chung',
  `content` text NOT NULL,
  `content_en` text NOT NULL,
  `images` varchar(256) NOT NULL,
  `images_en` varchar(256) NOT NULL,
  `catproduct_id` int(10) NOT NULL,
  `display` int(2) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `sptieubieu` tinyint(2) NOT NULL,
  `status` int(2) NOT NULL,
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `code` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `kichthuoc` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `chatlieu` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `khoanggia` int(20) DEFAULT NULL,
  `spkuyenmai` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=248 DEFAULT CHARSET=utf8;";

$arrSql[] ="INSERT INTO `estore_products` (`id`, `estore_id`, `title`, `title_en`, `price`, `manufacturer`, `introduction`, `content`, `content_en`, `images`, `images_en`, `catproduct_id`, `display`, `created`, `modified`, `sptieubieu`, `status`, `alias`, `code`, `kichthuoc`, `chatlieu`, `khoanggia`, `spkuyenmai`) VALUES
	(211, 0, 'Bến chữ U cho bếp rộng', 'U-shaped cabinet for large kitchen', 12500000, '144', '', '<p>\r\n	đang cập nhật</p>\r\n<p>\r\n	&nbsp;</p>\r\n', '', 'img/upload/434d3a69764058750f0f6b59e7c2e0e3.jpg', '', 112, 0, '2012-08-23 10:30:03', '2012-09-14 10:58:18', 1, 1, 'ben-chu-u-cho-bep-rong', 'able 02', '30 x 30 cm ', 'Cây cọ', 10, 0),
	(212, 0, 'Tủ chữ L', 'L-shaped kitchen cabinet', 4500000, '', '', '<p>\r\n	đang cập nhật</p>\r\n', '', 'img/upload/e06b30abc2aa67efdccf89e55f45cafc.jpg', '', 110, 0, '2012-08-23 10:55:17', '2012-09-14 10:55:27', 1, 1, 'tu-chu-l', 'h4322', '20 x 40 cm', 'Mây, Tre', 5, 1),
	(215, 0, 'kids product 123', 'kids product 123', 210000, '', '', '<p>\r\n	update...</p>\r\n', '', 'img/upload/7aa2d4c620cba46145faf03c72afb234.jpg', '', 105, 0, '2012-08-23 11:11:53', '2012-08-23 18:17:45', 1, 1, 'kids-product-123', '123123', '30 x 30 cm', 'gỗ', NULL, 0),
	(216, 0, 'adults product 12', 'adults product 12', 321000, '', '', '<p>\r\n	update...</p>\r\n', '', 'img/upload/a024674425c52d5d93bcfa308f9dc244.png', '', 104, 0, '2012-08-23 11:13:56', '2012-08-23 11:13:56', 1, 1, 'adults-product 12', '5645', '30 x 30 cm', 'da', NULL, 0),
	(223, 0, 'Máy khử mùi Nsaka', 'Nsaka machine hood', 120000, '', '', '<p>\r\n	đang cập nhật</p>\r\n<p>\r\n	&nbsp;</p>\r\n', '', 'img/upload/de7ed01c7b9dbb1bbdb2711a21176e49.jpg', '', 114, 0, '2012-08-23 10:30:03', '2012-09-14 10:51:51', 1, 1, 'may-khu-mui-nsaka', 'able 02', '30 x 30 cm ', 'Cây cọ', 1, 0),
	(222, 0, 'Bình + Van 14kg', 'Gas Container + Valve 14kg', 400000, '148', '', '<p>\r\n	đang cập nhật</p>\r\n', '', 'img/upload/00687fc01e05574a7182ab1761b81ab3.jpg', '', 118, 0, '2012-08-23 10:55:17', '2012-09-14 10:53:32', 1, 1, 'bình-van-14kg', 'BV1232', '20 x 40 cm', 'Mây, Tre', 0, 1),
	(218, 0, 'Bến nhà hàng', 'Gas stove for restaurant', 3500000, '', '', '<p>\r\n	update...</p>\r\n', '', 'img/upload/3007b340574bcfd67cc42fd18c74d9b0.jpg', '', 119, 0, '2012-08-23 11:11:53', '2012-09-13 18:39:19', 1, 1, 'bén-nhà-hàng', 'B1123', '100 x 200 m', 'gỗ', 2, 0),
	(217, 0, 'adults product 2', 'adults product 2', 321000, '', '', '<p>\r\n	update...</p>\r\n', '', 'img/upload/de76e83506ffb367e04f84696b80c962.jpg', '', 104, 0, '2012-08-23 11:13:56', '2012-08-23 18:17:15', 1, 1, 'adults-product 12', '564500', '30 x 30 cm', 'da', NULL, 0),
	(224, 0, 'Bếp nướng Mỹ', 'American Grill Stove', 5000000, '145', '', '<p>\r\n	đang cập nhật</p>\r\n<p>\r\n	&nbsp;</p>\r\n', '', 'img/upload/872b06396ec7593b99032bd001c8a508.jpg', '', 120, 0, '2012-08-23 10:30:03', '2012-09-14 10:50:06', 1, 1, 'bep-nuong-my', 'able 02', '30 x 30 cm ', 'Cây cọ', 6, 0),
	(225, 0, 'Bình 13kg', 'Gas container 13kg', 312000, '144', '', '<p>\r\n	đang cập nhật</p>\r\n', '', 'img/upload/d9745f770c64999ec1cd9111f2031fc6.jpg', '', 117, 0, '2012-08-23 10:55:17', '2012-09-14 10:52:55', 0, 1, 'bình-13kg', 'B123', '100 x 40 cm', 'Mây, Tre', 0, 0),
	(229, 0, 'Bếp ga RinNight', 'RinNight gas stove', 900000, '', '', '<p>\r\n	update...</p>\r\n', '', 'img/upload/06e53cdfec18eaa1af6e79a1d3231a15.jpg', '', 105, 0, '2012-08-23 11:11:53', '2012-09-13 18:34:42', 1, 1, 'bép-ga-rinnight', 'R123123', '300 x 300 cm', 'gỗ', 0, 0),
	(230, 0, 'Bếp ga âm Hàn Quốc', 'Korean negative gas stove', 1500000, '', '', '<p>\r\n	update...</p>\r\n', '', 'img/upload/face1fafd07a42b87dfe77dd92f048c4.jpg', '', 104, 0, '2012-08-23 11:13:56', '2012-09-14 10:24:36', 1, 1, 'bép-ga-am-hàn-quóc', 'HQ5645', '30 x 30 cm', '', 1, 1),
	(231, 0, 'Bếp trung bình chữ I', 'I-shaped medium gas stove', 2300000, '139', '', '<p>\r\n	đang cập nhật</p>\r\n', '', 'img/upload/06e0bd26dd69280f9c14e247b49a3ec6.jpg', '', 111, 0, '2012-09-14 10:57:02', '2012-09-14 10:57:02', 1, 1, 'bep-trung-binh-chu-i', 'B56I', NULL, NULL, 2, 0),
	(244, 0, 'Bến chữ U đẹp', 'U-shaped gas stove', 12500000, '144', '', '<p>\r\n	đang cập nhật</p>\r\n<p>\r\n	&nbsp;</p>\r\n', '', 'img/upload/434d3a69764058750f0f6b59e7c2e0e3.jpg', '', 112, 0, '2012-08-23 10:30:03', '2012-09-14 10:58:18', 1, 1, 'ben-chu-u-cho-bep-rong', 'able 02', '30 x 30 cm ', 'Cây cọ', 10, 0),
	(243, 0, 'Tủ chữ L nhiều ngăn', 'L-shaped gas stove with drawers', 4500000, '', '', '<p>\r\n	đang cập nhật</p>\r\n', '', 'img/upload/e06b30abc2aa67efdccf89e55f45cafc.jpg', '', 110, 0, '2012-08-23 10:55:17', '2012-09-14 10:55:27', 1, 1, 'tu-chu-l', 'h4322', '20 x 40 cm', 'Mây, Tre', 5, 1),
	(242, 0, 'kids product 123', 'kids product 123', 21, '', '', '<p>\r\n	update...</p>\r\n', '', 'img/upload/7aa2d4c620cba46145faf03c72afb234.jpg', '', 105, 0, '2012-08-23 11:11:53', '2012-08-23 18:17:45', 1, 1, 'kids-product-123', '123123', '30 x 30 cm', 'gỗ', NULL, 0),
	(241, 0, 'adults product 12', 'adults product 12', 321000, '', '', '<p>\r\n	update...</p>\r\n', '', 'img/upload/a024674425c52d5d93bcfa308f9dc244.png', '', 104, 0, '2012-08-23 11:13:56', '2012-08-23 11:13:56', 1, 1, 'adults-product 12', '5645', '30 x 30 cm', 'da', NULL, 0),
	(240, 0, 'Máy khử mùi Nsaka', 'Nsaka machine hood', 120000, '', '', '<p>\r\n	đang cập nhật</p>\r\n<p>\r\n	&nbsp;</p>\r\n', '', 'img/upload/de7ed01c7b9dbb1bbdb2711a21176e49.jpg', '', 114, 0, '2012-08-23 10:30:03', '2012-09-14 10:51:51', 1, 1, 'may-khu-mui-nsaka', 'able 02', '30 x 30 cm ', 'Cây cọ', 1, 0),
	(239, 0, 'Bình + Van 14kg', 'Gas Container + Valve 14kg', 400000, '148', '', '<p>\r\n	đang cập nhật</p>\r\n', '', 'img/upload/00687fc01e05574a7182ab1761b81ab3.jpg', '', 118, 0, '2012-08-23 10:55:17', '2012-09-14 10:53:32', 1, 1, 'bình-van-14kg', 'BV1232', '20 x 40 cm', 'Mây, Tre', 0, 1),
	(238, 0, 'Bến nhà hàng', 'Gas stove for restaurant', 3500000, '', '', '<p>\r\n	update...</p>\r\n', '', 'img/upload/3007b340574bcfd67cc42fd18c74d9b0.jpg', '', 119, 0, '2012-08-23 11:11:53', '2012-09-13 18:39:19', 1, 1, 'bén-nhà-hàng', 'B1123', '100 x 200 m', 'gỗ', 2, 0),
	(237, 0, 'adults product 2', 'adults product 2', 321000, '', '', '<p>\r\n	update...</p>\r\n', '', 'img/upload/de76e83506ffb367e04f84696b80c962.jpg', '', 104, 0, '2012-08-23 11:13:56', '2012-08-23 18:17:15', 1, 1, 'adults-product 12', '5645', '30 x 30 cm', 'da', NULL, 0),
	(236, 0, 'Bếp nướng Mỹ', 'American Grill Stove', 5000000, '145', '', '<p>\r\n	đang cập nhật</p>\r\n<p>\r\n	&nbsp;</p>\r\n', '', 'img/upload/872b06396ec7593b99032bd001c8a508.jpg', '', 120, 0, '2012-08-23 10:30:03', '2012-09-14 10:50:06', 1, 1, 'bep-nuong-my', 'able 02', '30 x 30 cm ', 'Cây cọ', 6, 0),
	(235, 0, 'Bình 13kg', 'Gas container 13kg', 312000, '144', '', '<p>\r\n	đang cập nhật</p>\r\n', '', 'img/upload/d9745f770c64999ec1cd9111f2031fc6.jpg', '', 117, 0, '2012-08-23 10:55:17', '2012-09-14 10:52:55', 0, 1, 'bình-13kg', 'B123', '100 x 40 cm', 'Mây, Tre', 0, 0),
	(234, 0, 'Bếp ga RinNight', 'RinNight gas stove', 900000, '', '', '<p>\r\n	update...</p>\r\n', '', 'img/upload/06e53cdfec18eaa1af6e79a1d3231a15.jpg', '', 105, 0, '2012-08-23 11:11:53', '2012-09-13 18:34:42', 1, 1, 'bép-ga-rinnight', 'R123123', '300 x 300 cm', 'gỗ', 0, 0),
	(233, 0, 'Bếp ga âm Hàn Quốc', 'Korean negative gas stove', 1500000, '', '', '<p>\r\n	update...</p>\r\n', '', 'img/upload/face1fafd07a42b87dfe77dd92f048c4.jpg', '', 104, 0, '2012-08-23 11:13:56', '2012-09-14 10:24:36', 1, 1, 'bép-ga-am-hàn-quóc', 'HQ5645', '30 x 30 cm', '', 1, 1),
	(232, 0, 'Bếp trung bình chữ I', 'I-shaped medium gas stove', 2300000, '139', '', '<p>\r\n	đang cập nhật</p>\r\n', '', 'img/upload/06e0bd26dd69280f9c14e247b49a3ec6.jpg', '', 111, 0, '2012-09-14 10:57:02', '2012-09-14 10:57:02', 1, 1, 'bep-trung-binh-chu-i', 'B56I', NULL, NULL, 2, 0),
	(245, 0, 'Bếp cho quán ăn vừa và nhỏ', 'Gas stove for small and medium restaurant', 160000, '141', '', '<p>\r\n	đang c&acirc;p nhật</p>\r\n', '', 'img/upload/3007b340574bcfd67cc42fd18c74d9b0.jpg', '', 119, 0, '2012-09-14 11:33:00', '2012-09-14 11:33:00', 0, 1, 'bep-cho-quan-an-vua-va-nho', 'B912', NULL, NULL, 1, 1),
	(246, 0, 'Bếp nấu ăn nhà hàng 5 sao', 'Gas stove for 5-star restaurant', 17500000, '', '', '<p>\r\n	đang cập nhật</p>\r\n', '', 'img/upload/92cecb0fc068b89020e492ecf4c673ea.jpg', '', 120, 0, '2012-09-14 11:34:37', '2012-09-14 11:34:37', 0, 1, 'bep-nau-an-nha-hang-5-sao', 'Vi89', NULL, NULL, 10, 1),
	(247, 0, 'Tủ chữ L', 'L-shaped kitchen cabinet', 4500000, '', '', '<p>\r\n	đang cập nhật</p>\r\n', '', 'img/upload/e06b30abc2aa67efdccf89e55f45cafc.jpg', '', 110, 0, '2012-08-23 10:55:17', '2012-09-14 10:55:27', 1, 1, 'tu-chu-l', 'h4322', '20 x 40 cm', 'Mây, Tre', 5, 1);";

$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_settings` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `estore_id` int(50) NOT NULL DEFAULT '0',
  `name` varchar(256) CHARACTER SET utf8 NOT NULL,
  `title` varchar(250) CHARACTER SET utf8 NOT NULL,
  `info_other` varchar(250) CHARACTER SET utf8 NOT NULL,
  `address` varchar(256) CHARACTER SET utf8 NOT NULL,
  `phone` varchar(100) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `email` varchar(256) NOT NULL,
  `server` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
  `username` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
  `password` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
  `url` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
  `keyword` varchar(500) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `content` text CHARACTER SET utf8,
  `created` date NOT NULL,
  `modified` text NOT NULL,
  `name_en` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `address_eg` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `title_en` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `descriptions` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `footer` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;";

$arrSql[] ="INSERT INTO `estore_settings` (`id`, `estore_id`, `name`, `title`, `info_other`, `address`, `phone`, `mobile`, `email`, `server`, `username`, `password`, `url`, `keyword`, `description`, `content`, `created`, `modified`, `name_en`, `address_eg`, `title_en`, `descriptions`, `footer`) VALUES
	(1, 0, 'Công ty cổ phần Demo', 'CÔNG TY TNHH DEMO', 'Copyright © 2011 Bản quyền thuộc Vinaconex 12', 'Nguyễn Văn Linh - Q. Long Biên - Hà Nội', '04.38517532', '0979 644 688', 'servic@demo.vn', 'localhost', 'root', NULL, 'demo.vn', 'CONG TY TNHH  DEMO', 'CONG TY TNHH  DEMO', '<p>\r\n	<span style=\"font-size:14px;\"><tt>Hoặc vui l&ograve;ng điền đầy đủ th&ocirc;ng tin v&agrave;o đơn h&agrave;ng, sau khi ho&agrave;n th&agrave;nh qu&yacute; kh&aacute;ch lick &quot;Gửi đơn h&agrave;ng&quot;<br />\r\n	Sau khi nhận được đơn h&agrave;ng, trong v&ograve;ng 24h ch&uacute;ng t&ocirc;i sẽ li&ecirc;n hệ với qu&yacute; kh&aacute;ch để x&aacute;c nhận. </tt></span></p>\r\n', '0000-00-00', '1406477611', 'CONG TY TNHH DAU TU THUONG MAI & DICH VỤ VIET NAM TOAN CAU', '', 'CONG TY TNHH  DEMO', '<p>\r\n	đang cập nhật</p>\r\n', '<p style=\"text-align: center; \">\r\n	&nbsp;</p>\r\n<table border=\"0\" cellpadding=\"1\" cellspacing=\"1\" style=\"width: 980px; \">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n				<div>\r\n					<span style=\"color: rgb(255, 255, 255); \">Head office: 4A No, Lang Ha street - Ba Dinh district - HN City</span></div>\r\n				<div>\r\n					<span style=\"color: rgb(255, 255, 255); \">Showroom 1: 128C No, Dai La street - HN City</span></div>\r\n				<div>\r\n					<span style=\"color: rgb(255, 255, 255); \">Tel: (+84) 4 37 53 3004 - (+84) 4 59 22 27 - Fax: (+84) 4 37 53 3004</span></div>\r\n			</td>\r\n			<td>\r\n				<div>\r\n					<span style=\"color: rgb(255, 255, 255); \">Showroom 2: 128c ,street &nbsp;- Dong Tam district - HN City</span></div>\r\n				<div>\r\n					<span style=\"color: rgb(255, 255, 255); \">Tel: (+84) 4 36 74 1073 &nbsp;- Fax: (+84) 4 37 59 3004</span></div>\r\n				<div>\r\n					<span style=\"color: rgb(255, 215, 0); \">Website: www.alatca.vn</span></div>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<p style=\"text-align: center; \">\r\n	&nbsp;</p>\r\n');";


$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_slideshows` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `estore_id` int(50) NOT NULL DEFAULT '0',
  `name` varchar(250) CHARACTER SET utf8 NOT NULL,
  `images` varchar(250) CHARACTER SET utf8 NOT NULL,
  `created` datetime NOT NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;";

$arrSql[] ="INSERT INTO `estore_slideshows` (`id`, `estore_id`, `name`, `images`, `created`, `status`) VALUES
	(20, 0, 'slide4', 'img/gallery/529ef1813f7eb5638314a9814bdf4371.png', '2012-07-29 15:36:03', 1),
	(22, 0, 'slide', 'img/gallery/784197959d177a4062b681bcda56ebe0.jpg', '2012-09-13 12:52:02', 1);";

$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_users` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `estore_id` int(50) NOT NULL DEFAULT '0',
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
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;";

$arrSql[] ="INSERT INTO `estore_users` (`id`, `estore_id`, `password`, `name`, `email`, `phone`, `birth_date`, `sex`, `images`, `created`, `modified`, `active_key`, `status`) VALUES
	(17, 0, 'e10adc3949ba59abbe56e057f20f883e', 'admin', 'estoreadmin@estoreadmin', 2147483647, '18-11-1968', '1', '', '2011-05-17 14:33:04', '2012-07-08 10:07:43', '70c639df5e30bdee440e4cdf599fec2b', 1),
	(39, 0, 'e10adc3949ba59abbe56e057f20f883e', 'tung', 'phuca4@gmail.com', 972943090, '2012-07-18', '1', '', '2012-07-10 08:56:46', '2012-07-10 08:56:46', 'd58072be2820e8682c0a27c0518e805e', 0);";

$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_videos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `estore_id` int(50) NOT NULL DEFAULT '0',
  `name` varchar(250) CHARACTER SET utf8 NOT NULL,
  `video` varchar(250) CHARACTER SET utf8 NOT NULL,
  `LinkUrl` varchar(255) DEFAULT NULL,
  `created` datetime NOT NULL,
  `status` int(2) NOT NULL,
  `left` int(2) NOT NULL,
  `right` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;";

$arrSql[] ="INSERT INTO `estore_videos` (`id`, `estore_id`, `name`, `video`, `LinkUrl`, `created`, `status`, `left`, `right`) VALUES
	(1, 0, 'Gala trong ngay', 'video/upload/c67b28f317fe8740ada0a80316a0559c.flv', 'http://www.youtube.com/watch?v=5z7DEE70dEs&feature=related', '2011-10-02 18:51:33', 1, 0, 0),
	(2, 0, 'Clip gala Bên phải', 'video/upload/64c23f4052d6626521caef72b1bc067f.flv', 'http://www.youtube.com/watch?v=76ZqkGxe_Mc&feature=g-vrec', '2012-06-14 14:46:38', 1, 1, 0);";
	
$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_wards` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `estore_id` int(50) NOT NULL DEFAULT '0',
  `name` varchar(256) CHARACTER SET utf8 NOT NULL,
  `district_id` int(10) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";

$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_weblinks` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `estore_id` int(50) NOT NULL DEFAULT '0',
  `name` varchar(256) CHARACTER SET utf8 NOT NULL,
  `link` varchar(256) CHARACTER SET ucs2 NOT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;";

$arrSql[] ="INSERT INTO `estore_weblinks` (`id`, `estore_id`, `name`, `link`, `created`, `modified`, `status`) VALUES
	(8, 0, 'Google', 'http://google.vn', '0000-00-00', '0000-00-00', 1),
	(9, 0, 'Dân trí', 'http://dantri.com.vn', '0000-00-00', '2012-08-04', 1),
	(10, 0, '24h', 'http://24h.com.vn', '2012-08-04', '2012-08-04', 1),
	(11, 0, 'quản trị mạng', 'http://quantrimang.com.vn', '2012-08-04', '2012-08-04', 1);";

?>