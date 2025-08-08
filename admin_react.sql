-- Adminer 4.7.3 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `about_us`;
CREATE TABLE `about_us` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `short_title` varchar(30) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) NOT NULL,
  `mission` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `vision` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `admin_setting`;
CREATE TABLE `admin_setting` (
  `adm_set_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `admin_logo` varchar(128) NOT NULL,
  `admin_fav_icon` varchar(128) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_time` datetime NOT NULL,
  PRIMARY KEY (`adm_set_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `admin_setting` (`adm_set_id`, `admin_logo`, `admin_fav_icon`, `created_time`, `updated_time`) VALUES
(1,	'e61babdd9a6b7ae245a0c1ab3f427d76.png',	'b7cdd90b78c787eb177481b2db039154.png',	'2025-01-16 10:41:06',	'2025-03-29 14:39:15');

DROP TABLE IF EXISTS `album`;
CREATE TABLE `album` (
  `album_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `album_title` varchar(80) NOT NULL,
  `album_image` varchar(128) NOT NULL,
  `is_deleted` char(1) NOT NULL DEFAULT 'N',
  `created_time` datetime NOT NULL,
  PRIMARY KEY (`album_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `album` (`album_id`, `album_title`, `album_image`, `is_deleted`, `created_time`) VALUES
(4,	'Album 1',	'eb9035e217d6727b0e26fbfa9011a273.jpg',	'N',	'2025-01-11 15:06:11'),
(5,	'album one',	'78cd0beea1186fd3d3a34c9c5a4a033f.png',	'Y',	'2025-01-30 11:36:59');

DROP TABLE IF EXISTS `album_images`;
CREATE TABLE `album_images` (
  `album_img_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `album_id` int(10) unsigned NOT NULL,
  `image` varchar(128) NOT NULL,
  `is_deleted` char(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`album_img_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `album_images` (`album_img_id`, `album_id`, `image`, `is_deleted`) VALUES
(3,	4,	'74e3268367bbe66161d6d5981cf6746d.jpg',	'Y'),
(4,	4,	'069b6d81c5c8e09c16291af72e7a4bba.jpg',	'N'),
(5,	4,	'3f1971b0973ad26bcb7206e24bcbdce2.jpg',	'N'),
(6,	4,	'187b724068296876ee92a048ab7a99df.png',	'Y'),
(7,	5,	'868ef134d8933e0d0223a061a66d73b7.png',	'N'),
(8,	5,	'eeb9d97a27c3065f362ccd8a7ea52098.png',	'N'),
(9,	4,	'1b4e01e0985f7c4572b48163b7d19d7b.png',	'Y'),
(10,	4,	'6d060a558b7f9e0ac38b893a7779b462.png',	'N');

DROP TABLE IF EXISTS `banners`;
CREATE TABLE `banners` (
  `banner_id` int(11) NOT NULL AUTO_INCREMENT,
  `sequence` char(1) NOT NULL,
  `short_title` varchar(25) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `banner_status` varchar(255) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_time` datetime NOT NULL,
  PRIMARY KEY (`banner_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `banners` (`banner_id`, `sequence`, `short_title`, `title`, `description`, `link`, `image`, `banner_status`, `created_time`, `updated_time`) VALUES
(1,	'1',	'Lets Go Now',	'Explore World And Find The Beauty',	'',	'',	'37902841e5a73bb37b5610ca67c9bb7a.jpg',	'Active',	'2025-01-11 16:51:53',	'2025-01-16 15:52:05'),
(2,	'2',	'Lets Go Now',	'Kickstart Your Make Believe Quest',	'',	'',	'053fc9829f46627214f25658f80b36b5.jpg',	'Active',	'2025-01-11 17:09:22',	'2025-01-17 15:40:47');

DROP TABLE IF EXISTS `blogs`;
CREATE TABLE `blogs` (
  `blog_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `short_description` varchar(255) NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) NOT NULL,
  `blog_status` varchar(255) NOT NULL,
  `is_latest` char(1) NOT NULL DEFAULT 'N',
  `latest_updated_time` datetime NOT NULL,
  `published_date` date NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_time` datetime NOT NULL,
  PRIMARY KEY (`blog_id`),
  KEY `Index_2` (`title`,`short_description`,`blog_status`,`published_date`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `blogs` (`blog_id`, `title`, `slug`, `short_description`, `description`, `image`, `blog_status`, `is_latest`, `latest_updated_time`, `published_date`, `created_time`, `updated_time`) VALUES
(1,	'Unlocking Productivity: Top 10 Tips to Maximize Your Efficiency',	'unlocking-productivity-top-10-tips-to-maximize-your-efficiency',	'Discover actionable strategies to boost your productivity and achieve more in less time. From effective time management to leveraging the right tools, these tips will help you unlock your full potential and stay ahead in today’s fast-paced world.',	'&lt;p&gt;Discover actionable strategies to boost your productivity and achieve more in less time. From effective time management to leveraging the right tools, these tips will help you unlock your full potential and stay ahead in today&rsquo;s fast-paced world.&lt;/p&gt;',	'a3ff26f7f4d1c519e2d60d92197b2987.jpg',	'Active',	'N',	'2025-02-11 12:38:51',	'2025-01-21',	'2025-01-11 14:30:36',	'2025-01-20 17:19:04'),
(2,	'testtest',	'testtest',	'testtest',	'&lt;p&gt;testtest&lt;/p&gt;',	'9f7409d75319879e500d065736934ee3.png',	'Active',	'N',	'2025-02-11 12:38:48',	'2025-02-11',	'2025-02-11 12:31:44',	'0000-00-00 00:00:00'),
(3,	'testtesttt',	'testtesttt',	'testtesttt',	'&lt;p&gt;testtesttt&lt;/p&gt;',	'8f651285f93b5a0f21a5101ebf73887c.png',	'Active',	'N',	'2025-02-11 12:40:23',	'2025-02-15',	'2025-02-11 12:38:01',	'0000-00-00 00:00:00');

DROP TABLE IF EXISTS `contact_enquiries`;
CREATE TABLE `contact_enquiries` (
  `enq_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `person_name` varchar(50) NOT NULL,
  `person_email` varchar(128) NOT NULL,
  `mobile_no` char(10) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `message` varchar(150) NOT NULL,
  `created_time` datetime NOT NULL,
  PRIMARY KEY (`enq_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `contact_form`;
CREATE TABLE `contact_form` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `phn_no` varchar(16) NOT NULL,
  `whatsapp_no` varchar(16) NOT NULL,
  `email` varchar(32) NOT NULL,
  `city` varchar(30) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `date_from` datetime NOT NULL,
  `date_to` datetime NOT NULL,
  `no_of_people` int(11) NOT NULL,
  `vacation_type` varchar(255) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `email_configuration`;
CREATE TABLE `email_configuration` (
  `email_config_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `protocol` char(4) DEFAULT NULL,
  `mailtype` char(4) NOT NULL,
  `smtp_host` varchar(80) DEFAULT NULL,
  `smtp_port` char(4) NOT NULL,
  `sender_email` varchar(128) NOT NULL,
  `password` varchar(50) NOT NULL,
  `updated_time` datetime NOT NULL,
  PRIMARY KEY (`email_config_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `email_configuration` (`email_config_id`, `protocol`, `mailtype`, `smtp_host`, `smtp_port`, `sender_email`, `password`, `updated_time`) VALUES
(1,	'smtp',	'html',	'ssl://smtp.gmail.com',	'465',	'aradhanab2017@gmail.com',	'qdggklcvbmafvwym',	'2025-01-21 17:48:23');

DROP TABLE IF EXISTS `gallery`;
CREATE TABLE `gallery` (
  `gallery_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `gallery_image` varchar(128) NOT NULL,
  `is_active` char(1) NOT NULL DEFAULT 'Y',
  `is_deleted` char(1) NOT NULL DEFAULT 'N',
  `created_time` datetime NOT NULL,
  PRIMARY KEY (`gallery_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `gallery` (`gallery_id`, `gallery_image`, `is_active`, `is_deleted`, `created_time`) VALUES
(1,	'e434710f532a34125ff412bee946f680.jpg',	'Y',	'N',	'2025-01-11 16:36:18'),
(2,	'11f5c47f7c135f6ec6853151464c753f.jpg',	'Y',	'N',	'2025-01-11 16:36:24');

DROP TABLE IF EXISTS `newsletter_subscription`;
CREATE TABLE `newsletter_subscription` (
  `subscribe_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `person_name` varchar(50) NOT NULL,
  `person_email` varchar(128) NOT NULL,
  `message` varchar(150) NOT NULL,
  `created_time` datetime NOT NULL,
  PRIMARY KEY (`subscribe_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `payment_gateway`;
CREATE TABLE `payment_gateway` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `used_id` int(11) NOT NULL,
  `agent` varchar(30) NOT NULL,
  `r_pay_marchantid` varchar(100) DEFAULT NULL,
  `r_pay_password` varchar(100) DEFAULT NULL,
  `r_pay_email` varchar(100) DEFAULT NULL,
  `currency` varchar(10) DEFAULT NULL,
  `is_live` char(1) NOT NULL DEFAULT '1' COMMENT '1=live,0=sandbox',
  `updated_time` datetime NOT NULL,
  PRIMARY KEY (`id`,`used_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `payment_gateway` (`id`, `used_id`, `agent`, `r_pay_marchantid`, `r_pay_password`, `r_pay_email`, `currency`, `is_live`, `updated_time`) VALUES
(1,	1,	'Razorpay',	'rzp_test_2hEj93EL0gFSAp',	'EpfQnpGGOd71Ub44IUcXaVgv',	'',	'INR',	'2',	'2025-02-10 18:22:57');

DROP TABLE IF EXISTS `seo_content`;
CREATE TABLE `seo_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `page_name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `page_link` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `meta_title` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `meta_keywords` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `is_deleted` char(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `updated_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Index_2` (`page_name`,`page`,`page_link`,`is_deleted`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `seo_content` (`id`, `page`, `page_name`, `page_link`, `meta_title`, `meta_description`, `meta_keywords`, `is_deleted`, `updated_time`) VALUES
(1,	'home',	'Home',	'home',	'Home',	'Happy Tours and travels in madurai Call 089392 80268. We are best travels in madurai, tour travels in madurai, best tours travels in madurai.',	'',	'N',	'2024-12-28 14:07:54');

DROP TABLE IF EXISTS `services`;
CREATE TABLE `services` (
  `service_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) NOT NULL,
  `front_image` varchar(255) NOT NULL,
  `icon_image` varchar(255) NOT NULL,
  `service_status` varchar(255) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_time` datetime NOT NULL,
  PRIMARY KEY (`service_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `services` (`service_id`, `title`, `description`, `image`, `front_image`, `icon_image`, `service_status`, `created_time`, `updated_time`) VALUES
(1,	'Service One',	'',	'8f2eb471c1f30c56c538dcd827eb8abf.png',	'',	'',	'Active',	'2025-01-11 14:04:56',	'0000-00-00 00:00:00');

DROP TABLE IF EXISTS `testimonials`;
CREATE TABLE `testimonials` (
  `testimonial_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `ratings` float NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `testimonial_status` varchar(255) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_time` datetime NOT NULL,
  PRIMARY KEY (`testimonial_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `testimonials` (`testimonial_id`, `name`, `designation`, `ratings`, `image`, `description`, `testimonial_status`, `created_time`, `updated_time`) VALUES
(1,	'Alexa',	'Digital Marketing',	4,	'e649b7a010b09256c66e27403a408e38.jpg',	'From start to finish, the customer experience was flawless. The staff went above and beyond to ensure everything was perfect. I felt valued and appreciated throughout the process.',	'Active',	'2025-01-11 14:09:01',	'2025-01-30 15:37:36');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(32) NOT NULL,
  `user_type` int(11) NOT NULL,
  `is_deleted` char(1) NOT NULL DEFAULT 'N',
  `created_time` datetime NOT NULL,
  `updated_time` datetime NOT NULL,
  PRIMARY KEY (`user_id`),
  KEY `Index_2` (`email`,`is_deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `user_type`, `is_deleted`, `created_time`, `updated_time`) VALUES
(1,	'Admin',	'admin@gmail.com',	'L05SWjc3UzhVTHNGZU85aS9EUlEwdz09',	1,	'N',	'2024-11-06 10:17:00',	'2024-11-06 09:00:00');

DROP TABLE IF EXISTS `web_settings`;
CREATE TABLE `web_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_person` varchar(50) NOT NULL,
  `email` varchar(128) NOT NULL,
  `mobile_no` char(10) NOT NULL,
  `hotline_no` char(10) NOT NULL,
  `sales_email` varchar(128) NOT NULL,
  `address` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `web_settings` (`id`, `contact_person`, `email`, `mobile_no`, `hotline_no`, `sales_email`, `address`, `created_time`, `updated_time`) VALUES
(1,	'Super admin',	'muthamil.saitech@gmail.com',	'1234567890',	'1234567890',	'',	'no 2, abc street, new york.',	'2025-01-16 11:17:24',	'0000-00-00 00:00:00');

-- 2025-04-11 08:26:01
