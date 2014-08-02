<?php
$shop_id = 186;
$arrSql = array();
$arrSql[] ="INSERT INTO `estore_advertisements` ( `estore_id`, `name`, `link`, `images`, `created`, `modified`, `status`, `display`) VALUES
	($shop_id, 'cong ty abc', 'http://zing.vn', 'img/gallery/88654b0d4c2e2d7b8a4fd519f870c2b3.jpg', '2011-10-03', '2012-09-14', 1, 1),
	($shop_id, 'quang cao', 'http://dantri.com.vn', 'img/gallery/19c4d76ab1090e42cd476cf7974f419c.jpg', '2011-10-03', '2012-09-14', 1, 2),
	($shop_id, 'cong ty abc', 'http://zing.vn', 'img/gallery/aed5ce1f0358efc5b80877da0fd817d8.jpg', '2011-10-03', '2012-09-14', 1, 0),
	($shop_id, 'zx', 'http://agribank.com.vn', 'img/gallery/69dbb1013ad45d844e128bd7facea6ee.jpg', '2012-09-14', '2012-09-14', 1, 2),
	($shop_id, 'zx', 'http://agribank.com.vn', 'img/gallery/69dbb1013ad45d844e128bd7facea6ee.jpg', '2012-09-14', '2012-09-14', 1, 2),
	($shop_id, 'quang cao', 'http://truongthanhauto.com.vn', 'img/gallery/69dbb1013ad45d844e128bd7facea6ee.jpg', '2012-09-14', '2012-09-14', 1, 2),
	($shop_id, 'asdasd', 'http://duhocdailoan.info', 'img/gallery/8dc8529c47186151846ae23b345e835b.jpg', '2012-09-14', '2012-09-14', 1, 3),
	($shop_id, 'asdsd', 'http://dantri.com.vn', 'img/gallery/1cf5b8f4b563947b0c3b8c29142215c9.jpg', '2012-09-14', '2012-09-14', 1, 3),
	($shop_id, 'asdasd', 'http://zing.vn', 'img/gallery/8dc8529c47186151846ae23b345e835b.jpg', '2012-09-14', '2012-09-14', 1, 3);";

$arrSql[]="INSERT INTO `estore_albums` (`estore_id`, `tt`, `parent_id`, `lft`, `rght`, `name`, `created`, `modified`, `status`, `name_eg`, `images`) VALUES
	($shop_id, NULL, NULL, 1, 2, 'Ảnh khánh thành dây truyền mới', '2012-05-07', '2012-06-18', 1, 'Picture of new line inauguration', 'img/upload/product/2a1bd4f22b63ff775ad0cc8db96591aa.jpg'),
	($shop_id, NULL, NULL, 3, 4, 'Họp ngày 30/04/2012', '2012-05-08', '2012-06-18', 1, 'on 30th April, 2012', 'img/upload/product/102e31ae3f441fbcb391f9e5a26bcbb9.jpg');";

$arrSql[]="INSERT INTO `estore_banners` (`estore_id`, `name`, `images`, `created`, `status`) VALUES
	($shop_id, 'banner', 'img/gallery/af69e2816dec568215d831d8457b36eb.jpg', '2011-10-02 18:16:41', 1);";

$arrSql[]="INSERT INTO `estore_categories` (`estore_id`, `tt`, `parent_id`, `lft`, `rght`, `name`, `name_en`, `created`, `modified`, `status`, `images`, `alias`) VALUES
	($shop_id, 0, 224, 16, 17, 'GIỚI THIỆU', 'ABOUT US', '2011-09-27', '2012-09-14', 1, '', 'gioi-thieu'),
	($shop_id, 3, 224, 2, 7, 'KHUYẾN MÃI', 'PROMOTION', '2011-09-27', '2012-09-14', 1, '', 'khuyen-mai'),
	($shop_id, NULL, NULL, 1, 18, 'DANH MỤC TIN TỨC - DỊCH VỤ - TƯ VẤN', 'NEWS-SERVICE-CONSULTANCY CATEGORY', '2012-07-23', '2012-09-14', 1, '', 'danh-muc-tin-tuc-dich-vu-tu-van'),
	($shop_id, 4, 224, 14, 15, 'TUYỂN DỤNG', 'RECRUITMENT', '2012-07-23', '2012-09-14', 1, '', 'tuyen-dung'),
	($shop_id, 1, 224, 8, 9, 'DỊCH VỤ', 'SERVICE', '2012-07-23', '2012-09-14', 1, '', 'dich-vu'),
	($shop_id, 2, 224, 10, 11, 'TƯ VẤN', 'CONSULTANCY', '2012-07-23', '2012-09-14', 1, '', 'tu-van'),
	($shop_id, 5, 224, 12, 13, 'TRỢ GIÚP', 'HELP', '2012-07-23', '2012-09-14', 1, '', 'tro-giup');";

$arrSql[]="INSERT INTO `estore_catproducts` (`estore_id`, `parent_id`, `lft`, `rght`, `name`, `name_en`, `created`, `modified`, `status`, `char`, `images`, `alias`) VALUES
	($shop_id, NULL, 1, 48, 'Danh mục sản phẩm', 'Product category', '2012-02-19', '2012-09-13 16:07:33', 1, NULL, '', 'danh-mục-sản-phảm'),
	($shop_id, 11, 2, 11, 'BẾP GA', 'GAS STOVE', '2012-07-29', '2012-09-13 16:54:57', 1, NULL, '', 'bép-ga'),
	($shop_id, 39, 9, 10, 'Bếp ga du lịch', 'Travel gas stove', '2012-07-29', '2012-09-13 16:41:21', 1, NULL, '', 'bép-ga-du-lịch'),
	($shop_id, 11, 12, 21, 'MÁY HÚT KHÓI KHỬ MÙI', 'MACHINE HOODS', '2012-08-06', '2012-09-13 16:11:10', 1, NULL, '', 'máy-hút-khói-khủ-mùi'),
	($shop_id, 11, 38, 47, 'BÌNH GA & LINH KIỆN', 'GAS CONTAINER & COMPONENTS', '2012-08-06', '2012-09-13 16:55:12', 1, NULL, '', 'bình-ga-linh-kiẹn'),
	($shop_id, 117, 40, 41, 'Bình ga 13kg', 'Gas container 13kg', '2012-09-14', '2012-09-14 12:01:37', 1, NULL, '', 'binh-ga-13kg'),
	($shop_id, 117, 42, 43, 'Bình ga 14kg', 'Gas container 14kg', '2012-09-14', '2012-09-14 12:14:16', 1, NULL, '', 'binh-ga-14kg'),
	($shop_id, 39, 5, 6, 'Bếp ga dương', 'Positive gas stove', '2012-08-23', '2012-09-13 16:17:46', 1, NULL, 'img/upload/1c1e93203afe53fb5cda97210c838108.png', 'bép-ga-duong'),
	($shop_id, 39, 3, 4, 'Bếp ga âm', 'Negative gas stove', '2012-08-23', '2012-09-13 16:17:11', 1, NULL, 'img/upload/ce7e12c2374be3da8770b3d3f85b14f4.png', 'bép-ga-am'),
	($shop_id, 11, 22, 31, 'THẾ GIỚI TỦ BẾP', 'WORLD OF KITCHEN CABINETS', '2012-09-13', '2012-09-13 16:30:45', 1, NULL, '', 'thé-giói-tủ-bép'),
	($shop_id, 11, 32, 37, 'BẾP CÔNG NGHIỆP', 'INDUSTRIAL STOVE', '2012-09-13', '2012-09-13 16:14:07', 1, NULL, '', 'bép-cong-nghiẹp'),
	($shop_id, 39, 7, 8, 'Bếp ga đơn', 'Singer gas stove', '2012-09-13', '2012-09-13 16:19:04', 1, NULL, 'img/upload/181885ec49984106001d4b1bb0cb9e78.jpg', 'bép-ga-don'),
	($shop_id, 106, 23, 24, 'Tủ bếp dạng chữ G', 'G-shaped kitchen cabinet', '2012-09-13', '2012-09-13 16:24:32', 1, NULL, '', 'tủ-bép-dạng-chũ-g'),
	($shop_id, 106, 25, 26, 'Tủ bếp dạng chữ L', 'L-shaped kitchen cabinet', '2012-09-13', '2012-09-13 16:24:54', 1, NULL, '', 'tủ-bép-dạng-chũ-l'),
	($shop_id, 106, 27, 28, 'Tủ bếp dạng chữ I', 'I-shaped kitchen cabinet', '2012-09-13', '2012-09-13 16:25:12', 1, NULL, '', 'tủ-bép-dạng-chũ-i'),
	($shop_id, 106, 29, 30, 'Tủ bếp dạng chữ U', 'U-shaped kitchen cabinet', '2012-09-13', '2012-09-13 16:25:28', 1, NULL, '', 'tủ-bép-dạng-chũ-u'),
	($shop_id, 97, 13, 14, 'Hút mùi cổ điển', 'Classic hood', '2012-09-13', '2012-09-13 16:32:48', 1, NULL, '', 'hut-mui-co-dien'),
	($shop_id, 97, 15, 16, 'Hút mùi âm tủ', 'Negative hood', '2012-09-13', '2012-09-13 16:33:14', 1, NULL, '', 'hut-mui-am-tu'),
	($shop_id, 97, 17, 18, 'Hút mùi ống khói', 'chimney hood', '2012-09-13', '2012-09-13 16:33:28', 1, NULL, '', 'hut-mui-ong-khoi'),
	($shop_id, 97, 19, 20, 'Hút mùi đảo', 'Swivel hood', '2012-09-13', '2012-09-13 16:33:59', 1, NULL, '', 'hut-mui-dao'),
	($shop_id, 98, 39, 44, 'Bình ga', 'Gas container', '2012-09-13', '2012-09-13 16:35:02', 1, NULL, '', 'bình-ga'),
	($shop_id, 98, 45, 46, 'Van điều áp gas', 'Gas valve', '2012-09-13', '2012-09-13 16:35:27', 1, NULL, '', 'van-dieu-ap-gas'),
	($shop_id, 107, 33, 34, 'Bếp cho quán ăn', 'Stove for mini-restaurant', '2012-09-13', '2012-09-13 16:37:59', 1, NULL, '', 'bép-cho-quán-an'),
	($shop_id, 107, 35, 36, 'Bếp cho nhà hàng', 'Stove for restaurant', '2012-09-13', '2012-09-13 16:38:17', 1, NULL, '', 'bép-cho-nhà-hàng');";

$arrSql[]="INSERT INTO `estore_comments` (`estore_id`, `title`, `name`, `content`, `id_news`, `user_id`, `email`, `created`, `status`) VALUES
	($shop_id, '', 'Nguyễn hải', 'Chất lượng moto rất tốt', 0, 0, 'hai@gmail.com', '2012-07-26 01:25:36', 1),
	($shop_id, '', 'Nguyễn Nam', 'Kiểu dáng thật tuyệt', 0, 0, 'nguyennam@gmail.com', '2012-07-26 01:17:16', 1),
	($shop_id, '', 'Nguyễn Thanh Tùng', 'Tôi muốn mua xe iata xin hướng dẫn cho tôi', 0, 0, 'nt2ungvn@gmail.com', '2012-07-26 01:38:49', 1),
	($shop_id, '', 'Hồ Hoài', 'Chất lượng của công ty phục vụ rất rốt!', 0, 0, 'hohoai@yahoo.com', '2012-07-26 02:24:11', 0),
	($shop_id, '', 'Hương', 'Các bạn thử tới công ty nhé\', ở nơi này có rất nhiều cảnh đẹp. Con người rất ôn hòa!', 0, 0, 'huong86@yahoo.com', '2012-07-26 02:29:13', 1),
	($shop_id, '', 'Hoàng Phúc', 'Hoàng Phúc', 0, 0, 'phuca4@gmail.com', '2014-07-27 03:04:51', 1),
	($shop_id, '', 'Hay đó nhé', 'Uh hay Lắm đó', 0, 0, 'phuca4@gmail.com', '2014-07-27 03:06:08', 1);";

$arrSql[]="INSERT INTO `estore_contacts` (`estore_id`, `name`, `email`, `mobile`, `fax`, `company`, `title`, `content`, `content_send`, `created`, `modified`, `status`) VALUES
	($shop_id, 'Hoàng Công Phúc', 'phua4@gmail.com', '01688504263', '09487547584', 'Công ty abc', 'Chúc may mắn', 'dang test mail', '<p>\r\n	you are me and i am you</p>\r\n', '2011-07-04', '2011-07-04', 1);";

$arrSql[]="INSERT INTO `estore_galleries` (`estore_id`, `name`, `images`, `created`, `modified`, `status`, `album_id`) VALUES
	($shop_id, 'anh 4', 'img/gallery/43d68f446ea7527b3dc6daddc6dc80df.jpg', '2012-06-19', '2012-06-19', 1, 204),
	($shop_id, 'anh 5', 'img/gallery/2cf9661dce136d9f6ca6bfce24933a71.jpg', '2012-06-19', '2012-06-19', 1, 204),
	($shop_id, 'anh 3', 'img/gallery/0452ded776f37827ca4887da56816ba8.jpg', '2012-05-08', '2012-06-19', 1, 206),
	($shop_id, 'anh 2', 'img/gallery/e19281319ecba7282bcd8239287056d7.jpg', '2012-05-08', '2012-06-19', 1, 206),
	($shop_id, 'Anh dep', 'img/gallery/7db208fcf126d1bb3cfee4c6b6bacf62.jpg', '2012-05-08', '2012-06-19', 1, 206);";
		
$arrSql[]="INSERT INTO `estore_helps` (`estore_id`, `title`, `title_en`, `user_support`, `user_yahoo`, `user_skype`, `user_mobile`, `user_email`, `hotline`, `created`, `modified`, `status`, `user_yahoo1`, `user_yahoo2`, `user_yahoo3`) VALUES
	($shop_id, 'Tư vấn', 'Support', 'Hoàng Công Phúc', 'adv.golbalmedia2', 'adv.golbalmedia2', '043.8281.768', 'phuca4@gmail.com', '043.8281.768', '2012-06-14 11:19:25', '2014-07-27 17:57:17', 1, 'phuca478', 'phuca478', 'phuca478'),
	($shop_id, 'Kỹ Thuật', 'Technology', 'Mr. Phúc', 'adv.golbalmedia2', 'adv.golbalmedia2', '01229525955', 'phuca4@gmail.com', NULL, '2012-08-22 12:03:14', '2014-07-27 17:57:26', 1, 'phuca478', 'phuca478', 'phuca478');";
		
$arrSql[]="INSERT INTO `estore_helpsd` (`estore_id`, `name`, `name1`, `name2`, `title`, `sdt`, `sdt1`, `sdt2`, `yahoo`, `yahoo1`, `yahoo2`, `skype`, `skype1`, `skype2`, `created`, `modified`, `status`) VALUES
	($shop_id, 'Kỹ thuật 1', '', '', '', NULL, '04 38515107', '09 38515108', NULL, 'vulamnguyen', 'vulamnguyen', 'haihs26', '', '', '2011-12-06 10:08:49', '2012-06-14 10:25:11', 1);";

$arrSql[]="INSERT INTO `estore_infomationdetails` (`estore_id`, `infomations_id`, `product_id`, `name`, `images`, `quantity`, `price`) VALUES
	($shop_id, 36, 19, 'sp14', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_27.jpg', 1, 200),
	($shop_id, 36, 20, 'sp13', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_20.jpg', 1, 400),
	($shop_id, 37, 20, 'sp13', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_20.jpg', 2, 400),
	($shop_id, 37, 19, 'sp14', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_27.jpg', 1, 200),
	($shop_id, 38, 21, 'sp2', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_17.jpg', 1, 300),
	($shop_id, 38, 27, 'sp3', '/khieuvu/estoreadmin/webroot/upload/image/files/3.jpg', 1, 200),
	($shop_id, 39, 27, 'sp3', '/khieuvu/estoreadmin/webroot/upload/image/files/3.jpg', 23, 200),
	($shop_id, 40, 25, 'sp1', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_09.jpg', 3, 120),
	($shop_id, 40, 26, 'sp43', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_20.jpg', 1, 120000),
	($shop_id, 41, 21, 'sp2', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_17.jpg', 2, 300),
	($shop_id, 41, 19, 'sp14', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_27.jpg', 1, 200),
	($shop_id, 41, 26, 'sp43', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_20.jpg', 1, 120000),
	($shop_id, 42, 26, 'sp43', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_20.jpg', 5, 120000),
	($shop_id, 43, 32, 'sp565', '/khieuvu/estoreadmin/webroot/upload/image/files/bg_menu_20.jpg', 2, 20000),
	($shop_id, 44, 64, 'sp5', '/estoreadmin/webroot/upload/image/files/vietsys_53.jpg', 1, 40000),
	($shop_id, 44, 48, 'sp4', '/estoreadmin/webroot/upload/image/files/vietsys_55.jpg', 1, 300000),
	($shop_id, 44, 61, 'sp2', '/estoreadmin/webroot/upload/image/files/vietsys_55.jpg', 1, 300000),
	($shop_id, 44, 49, 'sp5', '/estoreadmin/webroot/upload/image/files/vietsys_53.jpg', 1, 40000),
	($shop_id, 45, 63, 'sp4', '/estoreadmin/webroot/upload/image/files/vietsys_55.jpg', 1, 300000),
	($shop_id, 46, 49, 'sp5', '/estoreadmin/webroot/upload/image/files/vietsys_53.jpg', 1, 40000),
	($shop_id, 46, 50, 'sp6', '/estoreadmin/webroot/upload/image/files/vietsys_55.jpg', 1, 300000),
	($shop_id, 47, 64, 'sp5', '/estoreadmin/webroot/upload/image/files/vietsys_53.jpg', 1, 40000),
	($shop_id, 47, 78, 'sp4', '/estoreadmin/webroot/upload/image/files/vietsys_55.jpg', 1, 300000),
	($shop_id, 48, 73, 'sp4', '/estoreadmin/webroot/upload/image/files/vietsys_55.jpg', 1, 300000),
	($shop_id, 51, 243, 'Tủ chữ L nhiều ngăn', 'img/upload/e06b30abc2aa67efdccf89e55f45cafc.jpg', 1, 4500000),
	($shop_id, 51, 245, 'Bếp cho quán ăn vừa và nhỏ', 'img/upload/3007b340574bcfd67cc42fd18c74d9b0.jpg', 1, 160000),
	($shop_id, 52, 243, 'Tủ chữ L nhiều ngăn', 'img/upload/e06b30abc2aa67efdccf89e55f45cafc.jpg', 1, 4500000),
	($shop_id, 52, 232, 'Bếp trung bình chữ I', 'img/upload/06e0bd26dd69280f9c14e247b49a3ec6.jpg', 2, 2300000),
	($shop_id, 53, 218, 'Bến nhà hàng', 'img/upload/3007b340574bcfd67cc42fd18c74d9b0.jpg', 3, 3500000),
	($shop_id, 53, 243, 'Tủ chữ L nhiều ngăn', 'img/upload/e06b30abc2aa67efdccf89e55f45cafc.jpg', 1, 4500000),
	($shop_id, 54, 243, 'Tủ chữ L nhiều ngăn', 'img/upload/e06b30abc2aa67efdccf89e55f45cafc.jpg', 1, 4500000),
	($shop_id, 54, 231, 'Bếp trung bình chữ I', 'img/upload/06e0bd26dd69280f9c14e247b49a3ec6.jpg', 3, 2300000);";

$arrSql[]="INSERT INTO `estore_infomations` (`estore_id`, `idnew`, `user_id`, `name`, `email`, `address`, `mobile`, `comment`, `deal`, `company`, `phone`, `fax`, `country`, `datereturn`, `fullname_male`, `fullname_female`, `questions_day`, `wedding_day`, `title_question`, `wedding_title`, `name_product`, `images`, `sl`, `price`, `total`, `orther`, `created`, `status`) VALUES
	($shop_id, 0, 'id173768', 'Hoang Cong Phuc', 'phuca4@gmail.com', 'Ha Noi', 2147483647, '', NULL, '', '84972607988', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '9100000', NULL, '2014-07-25 08:57:55', 0),
	($shop_id, 0, 'id98603', 'Hoang Phuc', 'phuca4@gmail.com', 'Ha Noi', 2147483647, '', NULL, '', '84972607988', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '15000000', NULL, '2014-07-25 09:04:11', 0),
	($shop_id, 0, 'id686188', 'Hoang Cong Phuc', 'phuca4@gmail.com', 'Ha Noi', 2147483647, '', NULL, '', '84972607988', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '11400000', NULL, '2014-07-25 09:10:40', 0);";

$arrSql[]="INSERT INTO `estore_manufacturers` (`estore_id`, `parent_id`, `lft`, `rght`, `name`, `created`, `modified`, `status`, `char`) VALUES
	($shop_id, NULL, 1, 28, 'Rigth', '2012-05-18', '2012-09-13 17:55:06', 1, NULL),
	($shop_id, NULL, 29, 62, 'Toyota', '2012-05-18', '2012-06-04 06:57:18', 1, NULL),
	($shop_id, NULL, 63, 80, 'Daewoo', '2012-05-18', '2012-06-21 06:25:09', 1, NULL),
	($shop_id, NULL, 81, 92, 'Ford', '2012-05-18', '2012-06-19 13:11:22', 1, NULL),
	($shop_id, NULL, 93, 116, 'BMW', '2012-05-18', '2012-05-18 13:50:13', 1, NULL),
	($shop_id, NULL, 117, 130, 'Nissan', '2012-05-18', '2012-05-18 13:50:25', 1, NULL),
	($shop_id, NULL, 131, 144, 'Suzuki', '2012-05-18', '2012-05-18 13:50:51', 1, NULL),
	($shop_id, NULL, 145, 168, 'Audi', '2012-05-24', '2012-05-24 08:07:17', 1, NULL),
	($shop_id, NULL, 169, 184, 'Mitsubishi', '2012-05-24', '2012-05-24 08:08:10', 1, NULL),
	($shop_id, NULL, 185, 200, 'Kia', '2012-05-24', '2014-07-27 10:05:08', 1, NULL),
	($shop_id, NULL, 201, 214, 'Ford', '2012-05-24', '2012-06-21 06:11:02', 0, NULL),
	($shop_id, NULL, 215, 230, 'Hyundai', '2012-05-24', '2012-06-19 13:00:19', 1, NULL),
	($shop_id, NULL, 231, 244, 'Mercedes ', '2012-05-28', '2012-05-28 07:49:40', 1, NULL);";

$arrSql[]="INSERT INTO `estore_orders` (`estore_id`, `user_id`, `pid`, `pname`, `images`, `quantity`, `price`, `total_price`) VALUES
	($shop_id, 'id366822', 21, 'Ống công nghiệp inox ', '/tana/estoreadmin/webroot/upload/image/images/index_29.jpg', 1, 300, 300),
	($shop_id, 'id366822', 20, 'Ống công nghiệp inox', '/tana/estoreadmin/webroot/upload/image/images/index_33.jpg', 1, 400, 400),
	($shop_id, 'id366822', 19, 'Ống công nghiệp inox ', '/tana/estoreadmin/webroot/upload/image/images/index_31.jpg', 1, 200, 200),
	($shop_id, 'id47761', 25, 'Ống công nghiệp inox ', '/tana/estoreadmin/webroot/upload/image/images/index_27.jpg', 5, 120, 600),
	($shop_id, 'id47761', 20, 'Ống công nghiệp inox', '/tana/estoreadmin/webroot/upload/image/images/index_33.jpg', 5, 400, 2000),
	($shop_id, 'id717636', 25, 'sp1', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_09.jpg', 1, 120, 120),
	($shop_id, 'id881866', 21, 'sp2', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_17.jpg', 1, 300, 300),
	($shop_id, 'id503470', 26, 'sp43', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_20.jpg', 1, 120000, 120000),
	($shop_id, 'id67517', 27, 'sp3', '/khieuvu/estoreadmin/webroot/upload/image/files/3.jpg', 1, 200, 200);";

$arrSql[]="INSERT INTO `estore_partners` (`estore_id`, `name`, `phone`, `email`, `website`, `fax`, `address`, `images`, `content`, `created`, `modified`, `status`) VALUES
	($shop_id, 'Công ty bcds', '', '', 'http://google.com', NULL, '', 'img/upload/a26d66b1322c320201a5a6c01e9f004f.jpg', NULL, '2012-07-29', '2012-07-29', 1),
	($shop_id, 'Công ty bcd', '', '', 'http://google.com', NULL, '', 'img/upload/aded75138b945d987476ee4beaa48400.jpg', NULL, '2012-07-29', '2012-07-29', 1),
	($shop_id, 'Công ty dcb', '', '', 'http://google.com', NULL, '', 'img/upload/65756cba90775ab2b30a744199a7c84a.jpg', NULL, '2012-07-29', '2012-07-29', 1),
	($shop_id, 'Công ty abc', '', '', 'http://eximbank.com.vn', NULL, '', 'img/upload/61c692bbd3e8c4f8cb24ca87e9ff3d92.jpg', NULL, '2012-07-29', '2012-07-29', 1),
	($shop_id, 'ádasd', '', '', 'http://google.com', NULL, '', 'img/upload/36e21b2e6d68b65741d004886e5223cb.jpg', NULL, '2012-09-16', '2012-09-16', 1),
	($shop_id, 'hhhh', '', '', 'http://google.com', NULL, '', 'img/upload/97fea11d1a80d7ccfad25eccdd7d031e.jpg', NULL, '2012-09-16', '2012-09-16', 1),
	($shop_id, 'hhh', '', '', 'http://google.com', NULL, '', 'img/upload/f6c03d67fe500b1ac80f32c87c60ec59.jpg', NULL, '2012-09-16', '2012-09-16', 1),
	($shop_id, 'h', '', '', 'http://google.com', NULL, '', 'img/upload/8f9fa526eff662129d81b1fb55d07676.jpg', NULL, '2012-09-16', '2012-09-16', 1),
	($shop_id, 'hhh', '', '', 'http://google.com', NULL, '', 'img/upload/74b21a268eb187c89772e79f91895d62.jpg', NULL, '2012-09-16', '2012-09-16', 1),
	($shop_id, 'á', '', '', 'http://google.com', NULL, '', 'img/upload/ff76a40ba32dfb0687988e0bdbc15765.jpg', NULL, '2012-09-16', '2012-09-16', 1),
	($shop_id, 'ádas', '', '', 'http://google.com', NULL, '', 'img/upload/cb18c77ef1e964033f5e9b33c991411d.jpg', NULL, '2012-09-16', '2012-09-16', 1);";

$arrSql[]="INSERT INTO `estore_products` (`estore_id`, `title`, `title_en`, `price`, `manufacturer`, `introduction`, `content`, `content_en`, `images`, `images_en`, `catproduct_id`, `display`, `created`, `modified`, `sptieubieu`, `status`, `alias`, `code`, `kichthuoc`, `chatlieu`, `khoanggia`, `spkuyenmai`) VALUES
	($shop_id, 'Bến chữ U cho bếp rộng', 'U-shaped cabinet for large kitchen', 12500000, '144', '', '<p>\r\n	đang cập nhật</p>\r\n<p>\r\n	&nbsp;</p>\r\n', '', 'img/upload/434d3a69764058750f0f6b59e7c2e0e3.jpg', '', 112, 0, '2012-08-23 10:30:03', '2012-09-14 10:58:18', 1, 1, 'ben-chu-u-cho-bep-rong', 'able 02', '30 x 30 cm ', 'Cây cọ', 10, 0),
	($shop_id, 'Tủ chữ L', 'L-shaped kitchen cabinet', 4500000, '', '', '<p>\r\n	đang cập nhật</p>\r\n', '', 'img/upload/e06b30abc2aa67efdccf89e55f45cafc.jpg', '', 110, 0, '2012-08-23 10:55:17', '2012-09-14 10:55:27', 1, 1, 'tu-chu-l', 'h4322', '20 x 40 cm', 'Mây, Tre', 5, 1),
	($shop_id, 'kids product 123', 'kids product 123', 210000, '', '', '<p>\r\n	update...</p>\r\n', '', 'img/upload/7aa2d4c620cba46145faf03c72afb234.jpg', '', 105, 0, '2012-08-23 11:11:53', '2012-08-23 18:17:45', 1, 1, 'kids-product-123', '123123', '30 x 30 cm', 'gỗ', NULL, 0),
	($shop_id, 'adults product 12', 'adults product 12', 321000, '', '', '<p>\r\n	update...</p>\r\n', '', 'img/upload/a024674425c52d5d93bcfa308f9dc244.png', '', 104, 0, '2012-08-23 11:13:56', '2012-08-23 11:13:56', 1, 1, 'adults-product 12', '5645', '30 x 30 cm', 'da', NULL, 0),
	($shop_id, 'Máy khử mùi Nsaka', 'Nsaka machine hood', 120000, '', '', '<p>\r\n	đang cập nhật</p>\r\n<p>\r\n	&nbsp;</p>\r\n', '', 'img/upload/de7ed01c7b9dbb1bbdb2711a21176e49.jpg', '', 114, 0, '2012-08-23 10:30:03', '2012-09-14 10:51:51', 1, 1, 'may-khu-mui-nsaka', 'able 02', '30 x 30 cm ', 'Cây cọ', 1, 0),
	($shop_id, 'Bình + Van 14kg', 'Gas Container + Valve 14kg', 400000, '148', '', '<p>\r\n	đang cập nhật</p>\r\n', '', 'img/upload/00687fc01e05574a7182ab1761b81ab3.jpg', '', 118, 0, '2012-08-23 10:55:17', '2012-09-14 10:53:32', 1, 1, 'bình-van-14kg', 'BV1232', '20 x 40 cm', 'Mây, Tre', 0, 1),
	($shop_id, 'Bến nhà hàng', 'Gas stove for restaurant', 3500000, '', '', '<p>\r\n	update...</p>\r\n', '', 'img/upload/3007b340574bcfd67cc42fd18c74d9b0.jpg', '', 119, 0, '2012-08-23 11:11:53', '2012-09-13 18:39:19', 1, 1, 'bén-nhà-hàng', 'B1123', '100 x 200 m', 'gỗ', 2, 0),
	($shop_id, 'adults product 2', 'adults product 2', 321000, '', '', '<p>\r\n	update...</p>\r\n', '', 'img/upload/de76e83506ffb367e04f84696b80c962.jpg', '', 104, 0, '2012-08-23 11:13:56', '2012-08-23 18:17:15', 1, 1, 'adults-product 12', '564500', '30 x 30 cm', 'da', NULL, 0),
	($shop_id, 'Bếp nướng Mỹ', 'American Grill Stove', 5000000, '145', '', '<p>\r\n	đang cập nhật</p>\r\n<p>\r\n	&nbsp;</p>\r\n', '', 'img/upload/872b06396ec7593b99032bd001c8a508.jpg', '', 120, 0, '2012-08-23 10:30:03', '2012-09-14 10:50:06', 1, 1, 'bep-nuong-my', 'able 02', '30 x 30 cm ', 'Cây cọ', 6, 0),
	($shop_id, 'Bình 13kg', 'Gas container 13kg', 312000, '144', '', '<p>\r\n	đang cập nhật</p>\r\n', '', 'img/upload/d9745f770c64999ec1cd9111f2031fc6.jpg', '', 117, 0, '2012-08-23 10:55:17', '2012-09-14 10:52:55', 0, 1, 'bình-13kg', 'B123', '100 x 40 cm', 'Mây, Tre', 0, 0),
	($shop_id, 'Bếp ga RinNight', 'RinNight gas stove', 900000, '', '', '<p>\r\n	update...</p>\r\n', '', 'img/upload/06e53cdfec18eaa1af6e79a1d3231a15.jpg', '', 105, 0, '2012-08-23 11:11:53', '2012-09-13 18:34:42', 1, 1, 'bép-ga-rinnight', 'R123123', '300 x 300 cm', 'gỗ', 0, 0),
	($shop_id, 'Bếp ga âm Hàn Quốc', 'Korean negative gas stove', 1500000, '', '', '<p>\r\n	update...</p>\r\n', '', 'img/upload/face1fafd07a42b87dfe77dd92f048c4.jpg', '', 104, 0, '2012-08-23 11:13:56', '2012-09-14 10:24:36', 1, 1, 'bép-ga-am-hàn-quóc', 'HQ5645', '30 x 30 cm', '', 1, 1),
	($shop_id, 'Bếp trung bình chữ I', 'I-shaped medium gas stove', 2300000, '139', '', '<p>\r\n	đang cập nhật</p>\r\n', '', 'img/upload/06e0bd26dd69280f9c14e247b49a3ec6.jpg', '', 111, 0, '2012-09-14 10:57:02', '2012-09-14 10:57:02', 1, 1, 'bep-trung-binh-chu-i', 'B56I', NULL, NULL, 2, 0),
	($shop_id, 'Bến chữ U đẹp', 'U-shaped gas stove', 12500000, '144', '', '<p>\r\n	đang cập nhật</p>\r\n<p>\r\n	&nbsp;</p>\r\n', '', 'img/upload/434d3a69764058750f0f6b59e7c2e0e3.jpg', '', 112, 0, '2012-08-23 10:30:03', '2012-09-14 10:58:18', 1, 1, 'ben-chu-u-cho-bep-rong', 'able 02', '30 x 30 cm ', 'Cây cọ', 10, 0),
	($shop_id, 'Tủ chữ L nhiều ngăn', 'L-shaped gas stove with drawers', 4500000, '', '', '<p>\r\n	đang cập nhật</p>\r\n', '', 'img/upload/e06b30abc2aa67efdccf89e55f45cafc.jpg', '', 110, 0, '2012-08-23 10:55:17', '2012-09-14 10:55:27', 1, 1, 'tu-chu-l', 'h4322', '20 x 40 cm', 'Mây, Tre', 5, 1),
	($shop_id, 'kids product 123', 'kids product 123', 21, '', '', '<p>\r\n	update...</p>\r\n', '', 'img/upload/7aa2d4c620cba46145faf03c72afb234.jpg', '', 105, 0, '2012-08-23 11:11:53', '2012-08-23 18:17:45', 1, 1, 'kids-product-123', '123123', '30 x 30 cm', 'gỗ', NULL, 0),
	($shop_id, 'adults product 12', 'adults product 12', 321000, '', '', '<p>\r\n	update...</p>\r\n', '', 'img/upload/a024674425c52d5d93bcfa308f9dc244.png', '', 104, 0, '2012-08-23 11:13:56', '2012-08-23 11:13:56', 1, 1, 'adults-product 12', '5645', '30 x 30 cm', 'da', NULL, 0),
	($shop_id, 'Máy khử mùi Nsaka', 'Nsaka machine hood', 120000, '', '', '<p>\r\n	đang cập nhật</p>\r\n<p>\r\n	&nbsp;</p>\r\n', '', 'img/upload/de7ed01c7b9dbb1bbdb2711a21176e49.jpg', '', 114, 0, '2012-08-23 10:30:03', '2012-09-14 10:51:51', 1, 1, 'may-khu-mui-nsaka', 'able 02', '30 x 30 cm ', 'Cây cọ', 1, 0),
	($shop_id, 'Bình + Van 14kg', 'Gas Container + Valve 14kg', 400000, '148', '', '<p>\r\n	đang cập nhật</p>\r\n', '', 'img/upload/00687fc01e05574a7182ab1761b81ab3.jpg', '', 118, 0, '2012-08-23 10:55:17', '2012-09-14 10:53:32', 1, 1, 'bình-van-14kg', 'BV1232', '20 x 40 cm', 'Mây, Tre', 0, 1),
	($shop_id, 'Bến nhà hàng', 'Gas stove for restaurant', 3500000, '', '', '<p>\r\n	update...</p>\r\n', '', 'img/upload/3007b340574bcfd67cc42fd18c74d9b0.jpg', '', 119, 0, '2012-08-23 11:11:53', '2012-09-13 18:39:19', 1, 1, 'bén-nhà-hàng', 'B1123', '100 x 200 m', 'gỗ', 2, 0),
	($shop_id, 'adults product 2', 'adults product 2', 321000, '', '', '<p>\r\n	update...</p>\r\n', '', 'img/upload/de76e83506ffb367e04f84696b80c962.jpg', '', 104, 0, '2012-08-23 11:13:56', '2012-08-23 18:17:15', 1, 1, 'adults-product 12', '5645', '30 x 30 cm', 'da', NULL, 0),
	($shop_id, 'Bếp nướng Mỹ', 'American Grill Stove', 5000000, '145', '', '<p>\r\n	đang cập nhật</p>\r\n<p>\r\n	&nbsp;</p>\r\n', '', 'img/upload/872b06396ec7593b99032bd001c8a508.jpg', '', 120, 0, '2012-08-23 10:30:03', '2012-09-14 10:50:06', 1, 1, 'bep-nuong-my', 'able 02', '30 x 30 cm ', 'Cây cọ', 6, 0),
	($shop_id, 'Bình 13kg', 'Gas container 13kg', 312000, '144', '', '<p>\r\n	đang cập nhật</p>\r\n', '', 'img/upload/d9745f770c64999ec1cd9111f2031fc6.jpg', '', 117, 0, '2012-08-23 10:55:17', '2012-09-14 10:52:55', 0, 1, 'bình-13kg', 'B123', '100 x 40 cm', 'Mây, Tre', 0, 0),
	($shop_id, 'Bếp ga RinNight', 'RinNight gas stove', 900000, '', '', '<p>\r\n	update...</p>\r\n', '', 'img/upload/06e53cdfec18eaa1af6e79a1d3231a15.jpg', '', 105, 0, '2012-08-23 11:11:53', '2012-09-13 18:34:42', 1, 1, 'bép-ga-rinnight', 'R123123', '300 x 300 cm', 'gỗ', 0, 0),
	($shop_id, 'Bếp ga âm Hàn Quốc', 'Korean negative gas stove', 1500000, '', '', '<p>\r\n	update...</p>\r\n', '', 'img/upload/face1fafd07a42b87dfe77dd92f048c4.jpg', '', 104, 0, '2012-08-23 11:13:56', '2012-09-14 10:24:36', 1, 1, 'bép-ga-am-hàn-quóc', 'HQ5645', '30 x 30 cm', '', 1, 1),
	($shop_id, 'Bếp trung bình chữ I', 'I-shaped medium gas stove', 2300000, '139', '', '<p>\r\n	đang cập nhật</p>\r\n', '', 'img/upload/06e0bd26dd69280f9c14e247b49a3ec6.jpg', '', 111, 0, '2012-09-14 10:57:02', '2012-09-14 10:57:02', 1, 1, 'bep-trung-binh-chu-i', 'B56I', NULL, NULL, 2, 0),
	($shop_id, 'Bếp cho quán ăn vừa và nhỏ', 'Gas stove for small and medium restaurant', 160000, '141', '', '<p>\r\n	đang c&acirc;p nhật</p>\r\n', '', 'img/upload/3007b340574bcfd67cc42fd18c74d9b0.jpg', '', 119, 0, '2012-09-14 11:33:00', '2012-09-14 11:33:00', 0, 1, 'bep-cho-quan-an-vua-va-nho', 'B912', NULL, NULL, 1, 1),
	($shop_id, 'Bếp nấu ăn nhà hàng 5 sao', 'Gas stove for 5-star restaurant', 17500000, '', '', '<p>\r\n	đang cập nhật</p>\r\n', '', 'img/upload/92cecb0fc068b89020e492ecf4c673ea.jpg', '', 120, 0, '2012-09-14 11:34:37', '2012-09-14 11:34:37', 0, 1, 'bep-nau-an-nha-hang-5-sao', 'Vi89', NULL, NULL, 10, 1),
	($shop_id, 'Tủ chữ L', 'L-shaped kitchen cabinet', 4500000, '', '', '<p>\r\n	đang cập nhật</p>\r\n', '', 'img/upload/e06b30abc2aa67efdccf89e55f45cafc.jpg', '', 110, 0, '2012-08-23 10:55:17', '2012-09-14 10:55:27', 1, 1, 'tu-chu-l', 'h4322', '20 x 40 cm', 'Mây, Tre', 5, 1);";

$arrSql[]="INSERT INTO `estore_settings` (`estore_id`, `name`, `title`, `info_other`, `address`, `phone`, `mobile`, `email`, `server`, `username`, `password`, `url`, `keyword`, `description`, `content`, `created`, `modified`, `name_en`, `address_eg`, `title_en`, `descriptions`, `footer`) VALUES
	($shop_id, 'Công ty cổ phần Demo', 'CÔNG TY TNHH DEMO', 'Copyright © 2011 Bản quyền thuộc Vinaconex 12', 'Nguyễn Văn Linh - Q. Long Biên - Hà Nội', '04.38517532', '0979 644 688', 'servic@demo.vn', 'localhost', 'root', NULL, 'demo.vn', 'CONG TY TNHH  DEMO', 'CONG TY TNHH  DEMO', '<p>\r\n	<span style=\"font-size:14px;\"><tt>Hoặc vui l&ograve;ng điền đầy đủ th&ocirc;ng tin v&agrave;o đơn h&agrave;ng, sau khi ho&agrave;n th&agrave;nh qu&yacute; kh&aacute;ch lick &quot;Gửi đơn h&agrave;ng&quot;<br />\r\n	Sau khi nhận được đơn h&agrave;ng, trong v&ograve;ng 24h ch&uacute;ng t&ocirc;i sẽ li&ecirc;n hệ với qu&yacute; kh&aacute;ch để x&aacute;c nhận. </tt></span></p>\r\n', '0000-00-00', '1406477611', 'CONG TY TNHH DAU TU THUONG MAI & DICH VỤ VIET NAM TOAN CAU', '', 'CONG TY TNHH  DEMO', '<p>\r\n	đang cập nhật</p>\r\n', '<p style=\"text-align: center; \">\r\n	&nbsp;</p>\r\n<table border=\"0\" cellpadding=\"1\" cellspacing=\"1\" style=\"width: 980px; \">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n				<div>\r\n					<span style=\"color: rgb(255, 255, 255); \">Head office: 4A No, Lang Ha street - Ba Dinh district - HN City</span></div>\r\n				<div>\r\n					<span style=\"color: rgb(255, 255, 255); \">Showroom 1: 128C No, Dai La street - HN City</span></div>\r\n				<div>\r\n					<span style=\"color: rgb(255, 255, 255); \">Tel: (+84) 4 37 53 3004 - (+84) 4 59 22 27 - Fax: (+84) 4 37 53 3004</span></div>\r\n			</td>\r\n			<td>\r\n				<div>\r\n					<span style=\"color: rgb(255, 255, 255); \">Showroom 2: 128c ,street &nbsp;- Dong Tam district - HN City</span></div>\r\n				<div>\r\n					<span style=\"color: rgb(255, 255, 255); \">Tel: (+84) 4 36 74 1073 &nbsp;- Fax: (+84) 4 37 59 3004</span></div>\r\n				<div>\r\n					<span style=\"color: rgb(255, 215, 0); \">Website: www.alatca.vn</span></div>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<p style=\"text-align: center; \">\r\n	&nbsp;</p>\r\n');";

$arrSql[]="INSERT INTO `estore_slideshows` (`estore_id`, `name`, `images`, `created`, `status`) VALUES
	($shop_id, 'slide4', 'img/gallery/529ef1813f7eb5638314a9814bdf4371.png', '2012-07-29 15:36:03', 1),
	($shop_id, 'slide', 'img/gallery/784197959d177a4062b681bcda56ebe0.jpg', '2012-09-13 12:52:02', 1);";

$arrSql[]="INSERT INTO `estore_users` (`estore_id`, `password`, `name`, `email`, `phone`, `birth_date`, `sex`, `images`, `created`, `modified`, `active_key`, `status`) VALUES
	($shop_id, 'e10adc3949ba59abbe56e057f20f883e', 'admin', 'estoreadmin@estoreadmin', 2147483647, '18-11-1968', '1', '', '2011-05-17 14:33:04', '2012-07-08 10:07:43', '70c639df5e30bdee440e4cdf599fec2b', 1),
	($shop_id, 'e10adc3949ba59abbe56e057f20f883e', 'tung', 'phuca4@gmail.com', 972943090, '2012-07-18', '1', '', '2012-07-10 08:56:46', '2012-07-10 08:56:46', 'd58072be2820e8682c0a27c0518e805e', 0);";

$arrSql[]="INSERT INTO `estore_videos` (`estore_id`, `name`, `video`, `LinkUrl`, `created`, `status`, `left`, `right`) VALUES
	($shop_id, 'Gala trong ngay', 'video/upload/c67b28f317fe8740ada0a80316a0559c.flv', 'http://www.youtube.com/watch?v=5z7DEE70dEs&feature=related', '2011-10-02 18:51:33', 1, 0, 0),
	($shop_id, 'Clip gala Bên phải', 'video/upload/64c23f4052d6626521caef72b1bc067f.flv', 'http://www.youtube.com/watch?v=76ZqkGxe_Mc&feature=g-vrec', '2012-06-14 14:46:38', 1, 1, 0);";

$arrSql[]="INSERT INTO `estore_weblinks` (`estore_id`, `name`, `link`, `created`, `modified`, `status`) VALUES
	($shop_id, 'Google', 'http://google.vn', '0000-00-00', '0000-00-00', 1),
	($shop_id, 'Dân trí', 'http://dantri.com.vn', '0000-00-00', '2012-08-04', 1),
	($shop_id, '24h', 'http://24h.com.vn', '2012-08-04', '2012-08-04', 1),
	($shop_id, 'quản trị mạng', 'http://quantrimang.com.vn', '2012-08-04', '2012-08-04', 1);"; 

var_dump($sql);
?>