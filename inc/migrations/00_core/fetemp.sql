-- phpMyAdmin SQL Dump
-- version 4.0.10.12
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 29, 2016 at 01:02 PM
-- Server version: 5.1.73
-- PHP Version: 5.5.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `fetemp`
--

-- --------------------------------------------------------

--
-- Table structure for table `cms_base_search_index`
--

CREATE TABLE IF NOT EXISTS `cms_base_search_index` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(225) NOT NULL,
  `url` varchar(2048) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `cms_base_search_index`
--

INSERT INTO `cms_base_search_index` (`id`, `title`, `url`, `content`) VALUES
(1, 'Error', '/error', '\r\nUh-Oh!\r\n	\r\nLooks like you took a wrong turn!');

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_ecom_accounts_addresses`
--

CREATE TABLE IF NOT EXISTS `cms_core_ecom_accounts_addresses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `address_2` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zip` varchar(20) NOT NULL,
  `country` varchar(255) NOT NULL,
  `created_at` bigint(20) NOT NULL,
  `updated_at` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_ecom_accounts_users`
--

CREATE TABLE IF NOT EXISTS `cms_core_ecom_accounts_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(2048) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `guid` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` bigint(20) NOT NULL,
  `updated_at` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_ecom_attributes`
--

CREATE TABLE IF NOT EXISTS `cms_core_ecom_attributes` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `title` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_ecom_carts`
--

CREATE TABLE IF NOT EXISTS `cms_core_ecom_carts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `session_id` varchar(32) NOT NULL,
  `shipping_id` varchar(2) NOT NULL,
  `shipping_zip` varchar(20) NOT NULL,
  `shipping_amount` float NOT NULL,
  `created_at` bigint(20) NOT NULL,
  `updated_at` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=87 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_ecom_carts_contents`
--

CREATE TABLE IF NOT EXISTS `cms_core_ecom_carts_contents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cart_id` int(11) NOT NULL,
  `version_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `displayorder` int(11) NOT NULL,
  `created_at` bigint(20) NOT NULL,
  `updated_at` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_ecom_categories`
--

CREATE TABLE IF NOT EXISTS `cms_core_ecom_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `metatitle` varchar(255) NOT NULL,
  `metakeywords` varchar(255) NOT NULL,
  `metadescription` varchar(500) NOT NULL,
  `deleted` tinyint(4) NOT NULL,
  `displayorder` int(11) NOT NULL,
  `created_at` bigint(20) NOT NULL,
  `updated_at` bigint(20) NOT NULL,
  `searchterms` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_ecom_categories_images`
--

CREATE TABLE IF NOT EXISTS `cms_core_ecom_categories_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `alttext` varchar(255) DEFAULT NULL,
  `displayorder` int(11) NOT NULL,
  `created_at` bigint(20) NOT NULL,
  `updated_at` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=80 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_ecom_checkout`
--

CREATE TABLE IF NOT EXISTS `cms_core_ecom_checkout` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_phone` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `created_at` bigint(20) NOT NULL,
  `updated_at` bigint(20) NOT NULL,
  `shipping_first_name` varchar(255) NOT NULL,
  `shipping_last_name` varchar(255) NOT NULL,
  `shipping_address` varchar(255) NOT NULL,
  `shipping_address_2` varchar(255) NOT NULL,
  `shipping_city` varchar(255) NOT NULL,
  `shipping_state` varchar(255) NOT NULL,
  `shipping_zip` varchar(255) NOT NULL,
  `shipping_country` varchar(255) NOT NULL,
  `billing_first_name` varchar(255) NOT NULL,
  `billing_last_name` varchar(255) NOT NULL,
  `billing_address` varchar(255) NOT NULL,
  `billing_address_2` varchar(255) NOT NULL,
  `billing_city` varchar(255) NOT NULL,
  `billing_state` varchar(255) NOT NULL,
  `billing_zip` varchar(255) NOT NULL,
  `billing_country` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_ecom_friendlytitles`
--

CREATE TABLE IF NOT EXISTS `cms_core_ecom_friendlytitles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(25) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `friendlytitle` varchar(255) NOT NULL,
  `active` tinyint(4) NOT NULL,
  `redirect` varchar(2048) NOT NULL,
  `created_at` bigint(20) NOT NULL,
  `updated_at` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2005 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_ecom_inventory`
--

CREATE TABLE IF NOT EXISTS `cms_core_ecom_inventory` (
  `id` int(11) NOT NULL,
  `version_id` int(11) NOT NULL,
  `variation` int(11) NOT NULL DEFAULT '0',
  `type` int(11) NOT NULL,
  `stamp` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_ecom_manufacturers`
--

CREATE TABLE IF NOT EXISTS `cms_core_ecom_manufacturers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `active` tinyint(4) NOT NULL,
  `featured` tinyint(4) NOT NULL,
  `metatitle` varchar(255) NOT NULL,
  `metakeywords` varchar(255) NOT NULL,
  `metadescription` varchar(500) NOT NULL,
  `logo` varchar(50) NOT NULL,
  `displayorder` int(11) NOT NULL,
  `created_at` bigint(20) NOT NULL,
  `updated_at` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_ecom_options`
--

CREATE TABLE IF NOT EXISTS `cms_core_ecom_options` (
  `id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `order` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_ecom_orders`
--

CREATE TABLE IF NOT EXISTS `cms_core_ecom_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_phone` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `comments` varchar(255) DEFAULT NULL,
  `po_number` varchar(255) DEFAULT NULL,
  `created_at` bigint(20) DEFAULT NULL,
  `updated_at` bigint(20) DEFAULT NULL,
  `shipping_first_name` varchar(255) NOT NULL,
  `shipping_last_name` varchar(255) NOT NULL,
  `shipping_address` varchar(255) NOT NULL,
  `shipping_address_2` varchar(255) NOT NULL,
  `shipping_city` varchar(255) NOT NULL,
  `shipping_state` varchar(255) NOT NULL,
  `shipping_zip` varchar(255) NOT NULL,
  `shipping_country` varchar(255) NOT NULL,
  `shipping_type` varchar(2) NOT NULL,
  `billing_first_name` varchar(255) NOT NULL,
  `billing_last_name` varchar(255) NOT NULL,
  `billing_address` varchar(255) NOT NULL,
  `billing_address_2` varchar(255) NOT NULL,
  `billing_city` varchar(255) NOT NULL,
  `billing_state` varchar(255) NOT NULL,
  `billing_zip` varchar(255) NOT NULL,
  `billing_country` varchar(255) NOT NULL,
  `cart_subtotal` float NOT NULL,
  `cart_shipping` float NOT NULL,
  `cart_tax` float NOT NULL,
  `cart_total` float NOT NULL,
  `status` int(11) NOT NULL,
  `weborder_id` varchar(20) NOT NULL,
  `transaction_id` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_ecom_orders_products`
--

CREATE TABLE IF NOT EXISTS `cms_core_ecom_orders_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `created_at` bigint(20) NOT NULL,
  `updated_at` bigint(20) NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `product_features` varchar(255) NOT NULL,
  `version_id` int(11) NOT NULL,
  `version_sku` varchar(255) NOT NULL,
  `version_quantity` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_ecom_payment_errors`
--

CREATE TABLE IF NOT EXISTS `cms_core_ecom_payment_errors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `error` tinyint(4) NOT NULL,
  `details` text NOT NULL,
  `stamp` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_ecom_products`
--

CREATE TABLE IF NOT EXISTS `cms_core_ecom_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `manufacturer_id` int(11) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '0',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `metatitle` varchar(255) NOT NULL,
  `metakeywords` varchar(255) NOT NULL,
  `metadescription` varchar(500) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `searchterms` varchar(500) NOT NULL,
  `price` float NOT NULL,
  `weight` float NOT NULL,
  `length` float NOT NULL,
  `width` float NOT NULL,
  `height` float NOT NULL,
  `created_at` bigint(20) NOT NULL,
  `updated_at` bigint(20) NOT NULL,
  `shipping_times_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_ecom_products_categories`
--

CREATE TABLE IF NOT EXISTS `cms_core_ecom_products_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `displayorder` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_ecom_products_documents`
--

CREATE TABLE IF NOT EXISTS `cms_core_ecom_products_documents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `document` varchar(255) NOT NULL,
  `displayorder` int(11) NOT NULL,
  `created_at` bigint(20) NOT NULL,
  `updated_at` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_ecom_products_images`
--

CREATE TABLE IF NOT EXISTS `cms_core_ecom_products_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `alttext` varchar(255) DEFAULT NULL,
  `displayorder` int(11) NOT NULL,
  `created_at` bigint(20) NOT NULL,
  `updated_at` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_ecom_products_related`
--

CREATE TABLE IF NOT EXISTS `cms_core_ecom_products_related` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `related_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_ecom_products_reviews`
--

CREATE TABLE IF NOT EXISTS `cms_core_ecom_products_reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `stamp` bigint(20) NOT NULL,
  `comment` text NOT NULL,
  `rating` int(11) NOT NULL,
  `created_at` bigint(20) NOT NULL,
  `updated_at` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_ecom_products_videos`
--

CREATE TABLE IF NOT EXISTS `cms_core_ecom_products_videos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `video` varchar(255) NOT NULL,
  `displayorder` int(11) NOT NULL,
  `created_at` bigint(20) NOT NULL,
  `updated_at` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_ecom_search_index`
--

CREATE TABLE IF NOT EXISTS `cms_core_ecom_search_index` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `item` varchar(255) NOT NULL,
  `searchindex` text NOT NULL,
  `link` varchar(2048) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_ecom_shipping_times`
--

CREATE TABLE IF NOT EXISTS `cms_core_ecom_shipping_times` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `displayorder` int(11) NOT NULL,
  `created_at` bigint(20) NOT NULL,
  `updated_at` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_ecom_variationtypes`
--

CREATE TABLE IF NOT EXISTS `cms_core_ecom_variationtypes` (
  `id` int(11) NOT NULL,
  `title` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_ecom_version`
--

CREATE TABLE IF NOT EXISTS `cms_core_ecom_version` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `priceadj` float NOT NULL DEFAULT '0',
  `sku` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_ecom_versions_options`
--

CREATE TABLE IF NOT EXISTS `cms_core_ecom_versions_options` (
  `version_id` int(11) NOT NULL,
  `option_id` int(11) NOT NULL,
  PRIMARY KEY (`version_id`,`option_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_module_ad_banners`
--

CREATE TABLE IF NOT EXISTS `cms_core_module_ad_banners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `url` varchar(2048) NOT NULL,
  `image` varchar(255) NOT NULL,
  `imagealt` varchar(255) NOT NULL,
  `impressions` int(11) NOT NULL,
  `clicks` int(11) NOT NULL,
  `start_date` int(11) NOT NULL,
  `end_date` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `newwindow` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_module_ad_banner_clicks`
--

CREATE TABLE IF NOT EXISTS `cms_core_module_ad_banner_clicks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `adbanner_id` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `ip` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_module_ad_banner_groups`
--

CREATE TABLE IF NOT EXISTS `cms_core_module_ad_banner_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_module_ad_banner_impressions`
--

CREATE TABLE IF NOT EXISTS `cms_core_module_ad_banner_impressions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `adbanner_id` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `ip` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_module_ad_banner_sizes`
--

CREATE TABLE IF NOT EXISTS `cms_core_module_ad_banner_sizes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_module_ad_banner_to_groups`
--

CREATE TABLE IF NOT EXISTS `cms_core_module_ad_banner_to_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `banner_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_module_blogposts`
--

CREATE TABLE IF NOT EXISTS `cms_core_module_blogposts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `date` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_module_blogposts_to_categories`
--

CREATE TABLE IF NOT EXISTS `cms_core_module_blogposts_to_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `blogpost_id` int(11) NOT NULL,
  `blogcategory_id` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_module_blogposts_to_tags`
--

CREATE TABLE IF NOT EXISTS `cms_core_module_blogposts_to_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `blogpost_id` int(11) NOT NULL,
  `blogtag_id` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_module_blogpost_categories`
--

CREATE TABLE IF NOT EXISTS `cms_core_module_blogpost_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_module_blogpost_tags`
--

CREATE TABLE IF NOT EXISTS `cms_core_module_blogpost_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_module_broken_links`
--

CREATE TABLE IF NOT EXISTS `cms_core_module_broken_links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL,
  `ipaddress` varchar(40) NOT NULL,
  `time` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `cms_core_module_broken_links`
--

INSERT INTO `cms_core_module_broken_links` (`id`, `url`, `ipaddress`, `time`, `created_at`, `updated_at`) VALUES
(1, '/favicon.ico', '10.1.2.1', 1461948438, 1461948438, 1461948438),
(2, '/themes/site/assets/grabbing.png', '10.1.2.1', 1461948664, 1461948664, 1461948664),
(3, '/assets/images/favicon.png', '10.1.2.1', 1461949284, 1461949284, 1461949284);

-- --------------------------------------------------------

--
-- Stand-in structure for view `cms_core_module_current_friendlyurls`
--
CREATE TABLE IF NOT EXISTS `cms_core_module_current_friendlyurls` (
`id` int(11)
,`route` varchar(255)
,`friendlyurl` varchar(255)
,`created` int(11)
,`active` tinyint(1)
,`redirect` varchar(2048)
);
-- --------------------------------------------------------

--
-- Table structure for table `cms_core_module_email_addresses`
--

CREATE TABLE IF NOT EXISTS `cms_core_module_email_addresses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `list_id` int(11) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_module_email_lists`
--

CREATE TABLE IF NOT EXISTS `cms_core_module_email_lists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email_addresses` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_module_events`
--

CREATE TABLE IF NOT EXISTS `cms_core_module_events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unique_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `event_type_id` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `description` text NOT NULL,
  `summary` text NOT NULL,
  `ticket_link` varchar(2048) NOT NULL,
  `luxury_suite` tinyint(1) NOT NULL,
  `group_event` tinyint(1) NOT NULL,
  `featured` tinyint(1) NOT NULL,
  `video_image` varchar(10) NOT NULL,
  `video_link` varchar(2048) NOT NULL,
  `amazon_map` varchar(2048) NOT NULL,
  `seating_chart` int(11) NOT NULL,
  `image_listing` varchar(10) NOT NULL,
  `image_details` varchar(10) NOT NULL,
  `image_interested` varchar(10) NOT NULL,
  `imagealt` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_module_events_buttons`
--

CREATE TABLE IF NOT EXISTS `cms_core_module_events_buttons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `link` varchar(2048) NOT NULL,
  `label` varchar(255) NOT NULL,
  `new_window` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_module_events_showtimes`
--

CREATE TABLE IF NOT EXISTS `cms_core_module_events_showtimes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `ticket_link` varchar(2048) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_module_events_videos`
--

CREATE TABLE IF NOT EXISTS `cms_core_module_events_videos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `link` varchar(2048) NOT NULL,
  `image` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_module_footersitemenu`
--

CREATE TABLE IF NOT EXISTS `cms_core_module_footersitemenu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `displayorder` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `newwindow` tinyint(1) NOT NULL DEFAULT '0',
  `image` varchar(10) NOT NULL,
  `page_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_module_forms`
--

CREATE TABLE IF NOT EXISTS `cms_core_module_forms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `thankyou` text NOT NULL,
  `emails` text NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `cms_core_module_forms`
--

INSERT INTO `cms_core_module_forms` (`id`, `name`, `thankyou`, `emails`, `created_at`, `updated_at`) VALUES
(1, 'Contact', '', '', 1460924155, 1460924155),
(2, 'Employment', '', '', 1460925545, 1460925545);

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_module_form_fields`
--

CREATE TABLE IF NOT EXISTS `cms_core_module_form_fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `formid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(20) NOT NULL,
  `displayorder` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `cms_core_module_form_fields`
--

INSERT INTO `cms_core_module_form_fields` (`id`, `formid`, `name`, `type`, `displayorder`, `created_at`, `updated_at`) VALUES
(1, 0, 'First Name', 'text', 1, 1460924956, 1460924956),
(2, 1, 'First name', 'text', 1, 1460925266, 1460926156),
(3, 1, 'Last Name', 'text', 2, 1460925328, 1460926156),
(4, 2, 'First Name', 'text', 1, 1460925558, 1460926165),
(5, 2, 'Last Name', 'text', 2, 1460925568, 1460926165),
(6, 2, 'Address', 'text', 3, 1460925574, 1460925574),
(7, 1, 'Phone Number', 'text', 3, 1460925906, 1460925906);

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_module_form_results`
--

CREATE TABLE IF NOT EXISTS `cms_core_module_form_results` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `formid` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `cms_core_module_form_results`
--

INSERT INTO `cms_core_module_form_results` (`id`, `formid`, `created_at`, `updated_at`) VALUES
(1, 1, 1460927885, 1460927885),
(2, 1, 1460927925, 1460927925),
(3, 1, 1460927930, 1460927930),
(4, 1, 1460927982, 1460927982),
(5, 1, 1460929859, 1460929859),
(6, 1, 1460930017, 1460930017),
(7, 1, 1460930078, 1460930078);

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_module_form_result_values`
--

CREATE TABLE IF NOT EXISTS `cms_core_module_form_result_values` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `resultid` int(11) NOT NULL,
  `fieldid` int(11) NOT NULL,
  `value` varchar(255) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `cms_core_module_form_result_values`
--

INSERT INTO `cms_core_module_form_result_values` (`id`, `resultid`, `fieldid`, `value`, `created_at`, `updated_at`) VALUES
(1, 4, 7, '4843785146', 1460927983, 1460928557),
(2, 4, 7, '4843785146', 1460927983, 1460928557),
(3, 4, 7, '4843785146', 1460927984, 1460928557),
(4, 5, 2, 'Ting', 1460929859, 1460929859),
(5, 5, 3, 'Yuan', 1460929859, 1460929859),
(6, 5, 7, '484-378-5149', 1460929859, 1460929859),
(7, 6, 2, 'Keith', 1460930017, 1460930017),
(8, 6, 3, 'Larson', 1460930017, 1460930017),
(9, 6, 7, '4843785146', 1460930017, 1460930017),
(10, 7, 2, 'Keitho', 1460930078, 1460930583),
(11, 7, 3, 'Larsono', 1460930078, 1460930584),
(12, 7, 7, '4843785146-0', 1460930078, 1460930586);

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_module_friendly_urls`
--

CREATE TABLE IF NOT EXISTS `cms_core_module_friendly_urls` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `route` varchar(255) NOT NULL,
  `friendlyurl` varchar(255) NOT NULL,
  `created` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `redirect` varchar(2048) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=67 ;

--
-- Dumping data for table `cms_core_module_friendly_urls`
--

INSERT INTO `cms_core_module_friendly_urls` (`id`, `route`, `friendlyurl`, `created`, `active`, `redirect`) VALUES
(1, '/page/view/1', '/', 1458142603, 1, ''),
(29, '/page/view/2', '/error', 1460847243, 1, ''),
(28, '/page/view/2', '/error', 1460840657, 1, ''),
(27, '/page/view/1', '/', 1460838942, 1, ''),
(26, '/page/view/2', '/error', 1460838935, 1, ''),
(25, '/page/view/2', '/error', 1460838351, 1, ''),
(24, '/page/view/2', '/error', 1460838330, 1, ''),
(23, '/page/view/2', '/error', 1460838296, 1, ''),
(21, '/page/view/2', '/error', 1460838265, 1, ''),
(17, '/page/view/2', '/error', 1460838205, 1, ''),
(18, '/page/view/2', '/error', 1460838229, 1, ''),
(19, '/page/view/2', '/error', 1460838234, 1, ''),
(20, '/page/view/2', '/error', 1460838253, 1, ''),
(13, '/page/view/2', '/error', 1460397713, 1, ''),
(22, '/page/view/2', '/error', 1460838279, 1, ''),
(30, '/page/view/2', '/error', 1460847896, 1, ''),
(31, '/page/view/2', '/error', 1460848666, 1, ''),
(32, '/manufacturer/details/108', '/manufacturer/sony', 1461678606, 1, ''),
(33, '/products/details/1024', '/product/walkman', 1461681643, 1, ''),
(34, '/products/details/1', '/product/sony', 1461696276, 1, ''),
(35, '/products/category/183', '/category/electronics', 1461774190, 1, ''),
(36, '/products/category/184', '/category/furniture', 1461775736, 1, ''),
(37, '/products/category/185', '/category/clothing', 1461775745, 1, ''),
(38, '/products/category/186', '/category/sofas', 1461775757, 1, ''),
(39, '/products/category/186', '/category/sofas', 1461780160, 1, ''),
(40, '/products/category/187', '/category/futons', 1461780676, 1, ''),
(41, '/products/category/185', '/clothing', 1461782487, 1, ''),
(42, '/products/category/183', '/electronics', 1461782487, 1, ''),
(43, '/products/category/184', '/furniture', 1461782487, 1, ''),
(44, '/products/category/183', '/electronics', 1461782507, 1, ''),
(45, '/products/category/185', '/clothing', 1461782507, 1, ''),
(46, '/products/category/184', '/furniture', 1461782507, 1, ''),
(47, '/products/category/185', '/clothing', 1461782525, 1, ''),
(48, '/products/category/183', '/electronics', 1461782525, 1, ''),
(49, '/products/category/184', '/furniture', 1461782525, 1, ''),
(50, '/products/category/184', '/furniture', 1461782529, 1, ''),
(51, '/products/category/183', '/electronics', 1461782529, 1, ''),
(52, '/products/category/185', '/clothing', 1461782529, 1, ''),
(53, '/products/category/183', '/electronics', 1461782550, 1, ''),
(54, '/products/category/184', '/furniture', 1461782550, 1, ''),
(55, '/products/category/185', '/clothing', 1461782550, 1, ''),
(56, '/products/category/185', '/clothing', 1461782553, 1, ''),
(57, '/products/category/183', '/electronics', 1461782553, 1, ''),
(58, '/products/category/184', '/furniture', 1461782553, 1, ''),
(59, '/products/details/1', '/product/sony', 1461783470, 1, ''),
(60, '/products/details/1', '/product/sony', 1461783599, 1, ''),
(61, '/manufacturer/details/109', '/manufacturer/ikea', 1461784978, 1, ''),
(62, '/manufacturer/details/110', '/manufacturer/microsoft', 1461784991, 1, ''),
(63, '/products/details/2', '/product/three-person-sofabed', 1461785021, 1, ''),
(64, '/products/details/2', '/product/three-person-sofabed', 1461785597, 1, ''),
(65, '/products/details/2', '/product/three-person-sofabed', 1461785610, 1, ''),
(66, '/products/details/2', '/product/three-person-sofabed', 1461786795, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_module_galleries`
--

CREATE TABLE IF NOT EXISTS `cms_core_module_galleries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `displayorder` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `cms_core_module_galleries`
--

INSERT INTO `cms_core_module_galleries` (`id`, `created_at`, `updated_at`, `name`, `displayorder`) VALUES
(1, 1461686961, 1461686961, 'Test', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_module_gallery_albums`
--

CREATE TABLE IF NOT EXISTS `cms_core_module_gallery_albums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gallery_id` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `displayorder` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `cms_core_module_gallery_albums`
--

INSERT INTO `cms_core_module_gallery_albums` (`id`, `gallery_id`, `created_at`, `updated_at`, `name`, `text`, `displayorder`) VALUES
(1, 1, 1461686972, 1461686972, 'Images', '<p>test</p>', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_module_gallery_images`
--

CREATE TABLE IF NOT EXISTS `cms_core_module_gallery_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gallery_album_id` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(10) NOT NULL,
  `displayorder` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_module_globalpageinjections`
--

CREATE TABLE IF NOT EXISTS `cms_core_module_globalpageinjections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `cms_core_module_globalpageinjections`
--

INSERT INTO `cms_core_module_globalpageinjections` (`id`, `name`, `value`, `created_at`, `updated_at`) VALUES
(1, 'Header', '', 0, 1460844412),
(2, 'Footer', '', 0, 0),
(3, 'Tracking Scripts', '', 0, 1460844443),
(4, 'Body Class', 'testo', 0, 1460842385);

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_module_metadata`
--

CREATE TABLE IF NOT EXISTS `cms_core_module_metadata` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(256) NOT NULL,
  `title` varchar(256) NOT NULL,
  `keywords` varchar(256) NOT NULL,
  `description` varchar(256) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_module_newsarticles`
--

CREATE TABLE IF NOT EXISTS `cms_core_module_newsarticles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `date` int(11) NOT NULL,
  `description` text NOT NULL,
  `summary` varchar(2048) NOT NULL,
  `video` varchar(255) NOT NULL DEFAULT '',
  `image` varchar(10) NOT NULL,
  `imagealt` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_module_newsarticle_newslinks`
--

CREATE TABLE IF NOT EXISTS `cms_core_module_newsarticle_newslinks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `newsarticle_id` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `label` varchar(255) NOT NULL,
  `url` varchar(2048) NOT NULL,
  `newwindow` tinyint(1) NOT NULL,
  `displayorder` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_module_newsarticle_newspdfs`
--

CREATE TABLE IF NOT EXISTS `cms_core_module_newsarticle_newspdfs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `newsarticle_id` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `pdf` varchar(2048) NOT NULL,
  `displayorder` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_module_news_videos`
--

CREATE TABLE IF NOT EXISTS `cms_core_module_news_videos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `news_id` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `link` varchar(2048) NOT NULL,
  `image` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_module_pages`
--

CREATE TABLE IF NOT EXISTS `cms_core_module_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `in_sitemap` tinyint(1) NOT NULL DEFAULT '1',
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  `searchable` tinyint(1) NOT NULL,
  `header` text NOT NULL,
  `footer` text NOT NULL,
  `bodyclass` text NOT NULL,
  `trackingscripts` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `cms_core_module_pages`
--

INSERT INTO `cms_core_module_pages` (`id`, `created_at`, `updated_at`, `title`, `in_sitemap`, `enabled`, `searchable`, `header`, `footer`, `bodyclass`, `trackingscripts`) VALUES
(1, 1458142603, 1458142603, 'Homepage', 1, 1, 0, '', '', '', ''),
(2, 1460397713, 1460848666, 'Error', 1, 1, 1, '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_module_pages_available_partials`
--

CREATE TABLE IF NOT EXISTS `cms_core_module_pages_available_partials` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pageid` int(11) NOT NULL,
  `partialid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=308 ;

--
-- Dumping data for table `cms_core_module_pages_available_partials`
--

INSERT INTO `cms_core_module_pages_available_partials` (`id`, `pageid`, `partialid`) VALUES
(220, 1, 11),
(221, 1, 20),
(222, 1, 19),
(223, 1, 5),
(224, 1, 18),
(225, 1, 31),
(226, 1, 8),
(227, 1, 32),
(228, 1, 25),
(229, 1, 1),
(295, 2, 3),
(296, 2, 24),
(297, 2, 11),
(298, 2, 20),
(299, 2, 5),
(300, 2, 2),
(301, 2, 18),
(302, 2, 31),
(303, 2, 9),
(304, 2, 8),
(305, 2, 25),
(306, 2, 1),
(307, 2, 10);

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_module_pages_group_permissions`
--

CREATE TABLE IF NOT EXISTS `cms_core_module_pages_group_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pageid` int(11) NOT NULL,
  `groupid` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `cms_core_module_pages_group_permissions`
--

INSERT INTO `cms_core_module_pages_group_permissions` (`id`, `pageid`, `groupid`, `created_at`, `updated_at`) VALUES
(1, 5, 30, 1460485002, 1460485002),
(2, 5, 40, 1460485002, 1460485002),
(6, 2, 20, 1460838935, 1460838935),
(4, 5, 10, 1460485002, 1460485002),
(5, 5, 20, 1460485002, 1460485002),
(7, 2, 30, 1460838935, 1460838935),
(8, 2, 40, 1460838935, 1460838935),
(9, 2, 10, 1460838935, 1460838935),
(10, 2, 20, 1460838935, 1460838935),
(11, 1, 20, 1460838942, 1460838942),
(12, 1, 30, 1460838942, 1460838942),
(13, 1, 40, 1460838942, 1460838942),
(14, 1, 10, 1460838942, 1460838942),
(15, 1, 20, 1460838942, 1460838942);

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_module_pages_partials`
--

CREATE TABLE IF NOT EXISTS `cms_core_module_pages_partials` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pageid` int(11) NOT NULL,
  `partialid` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `static` tinyint(1) NOT NULL,
  `order` int(11) NOT NULL,
  `permission` int(1) NOT NULL,
  `class` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `cms_core_module_pages_partials`
--

INSERT INTO `cms_core_module_pages_partials` (`id`, `pageid`, `partialid`, `title`, `static`, `order`, `permission`, `class`) VALUES
(1, 1, 10, 'Top Header', 0, 0, 1, ''),
(18, 1, 19, 'Test', 0, 2, 1, ''),
(19, 1, 8, 'Test2', 0, 3, 2, ''),
(20, 2, 10, 'Error', 0, 0, 2, 'asdf1111'),
(21, 2, 5, 'Content', 0, 2, 2, '');

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_module_partials`
--

CREATE TABLE IF NOT EXISTS `cms_core_module_partials` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `directory` varchar(256) NOT NULL,
  `template` varchar(256) NOT NULL,
  `default` tinyint(1) NOT NULL,
  `autocreate` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `cms_core_module_partials`
--

INSERT INTO `cms_core_module_partials` (`id`, `name`, `directory`, `template`, `default`, `autocreate`) VALUES
(1, 'Text Area', 'core_textarea', '', 1, 0),
(2, 'Image', 'core_image', '', 1, 0),
(3, 'Accordian', 'core_accordion', '', 1, 0),
(5, 'HTML Text area', 'core_htmltext', '', 1, 0),
(8, 'Info Block (Right)', 'core_infoblock', 'right', 1, 0),
(9, 'Info Block (Left)', 'core_infoblock', 'left', 1, 0),
(10, 'Top Header (Every Page)', 'core_topheader', '', 1, 1),
(11, 'Complex Accordion', 'core_complexaccordion', '', 1, 0),
(15, 'Hero', 'core_hero', '', 0, 0),
(16, 'Video Player', 'core_videoplayer', '', 0, 0),
(17, 'Homepage Info Block', 'site_homeinfoblock', '', 0, 0),
(18, 'Image Carousel', 'core_imagecarousel', '', 1, 0),
(19, 'Google Map', 'core_googlemap', '', 0, 0),
(20, 'Events Thumbnails Slider', 'site_eventsslider', '', 1, 0),
(22, 'Title and Text Block', 'core_titletextblock', '', 0, 0),
(23, 'Info List', 'core_infolist', '', 0, 0),
(24, 'Button Group', 'core_buttongroup', '', 1, 0),
(25, 'Media Gallery', 'core_mediagallery', '', 1, 0),
(26, 'Video List', 'core_videolist', '', 0, 0),
(31, 'Image Slider', 'core_imageslider', '', 1, 0),
(32, 'Instagram Feed', 'core_instafeed', '', 0, 0),
(33, 'Social Tabs', 'core_socialtabs', '', 0, 0),
(34, 'Related Events Slider', 'site_relatedevents', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_module_popups`
--

CREATE TABLE IF NOT EXISTS `cms_core_module_popups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `start` int(11) NOT NULL,
  `end` int(11) NOT NULL,
  `image` varchar(10) NOT NULL,
  `imagealt` varchar(255) NOT NULL,
  `link` varchar(2048) NOT NULL,
  `newwindow` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_module_redirects`
--

CREATE TABLE IF NOT EXISTS `cms_core_module_redirects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `url` varchar(256) NOT NULL,
  `destination` varchar(256) NOT NULL,
  `permanent` tinyint(1) DEFAULT '0',
  `parent_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_module_siteinfo`
--

CREATE TABLE IF NOT EXISTS `cms_core_module_siteinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `group_id` int(11) NOT NULL DEFAULT '0',
  `key` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `cms_core_module_siteinfo`
--

INSERT INTO `cms_core_module_siteinfo` (`id`, `created_at`, `updated_at`, `group_id`, `key`, `value`) VALUES
(1, 2015, 1456524077, 1, 'facebook link', 'https://www.facebook.comtest'),
(2, 2015, 1454079155, 0, 'site title', 'The Liacouras Center'),
(3, 1451504763, 1454079155, 0, 'Address Street', '1776 North Broad Street'),
(4, 1451504772, 1454079155, 0, 'Address City', 'Philadelphia'),
(5, 1451504781, 1454079155, 0, 'Address State', 'Pennsylvania'),
(6, 1451504791, 1454079155, 0, 'Address State Abbreviation', 'PA'),
(7, 1451504800, 1454079155, 0, 'Address Zip', '19121'),
(8, 1451506644, 1454079155, 0, 'Phone Number', '215.204.2400'),
(9, 1451506654, 1454079241, 0, 'Contact Email', 'info@liacourascenter.com'),
(10, 1451938591, 1456523663, 1, 'Twitter Link', 'https://twitter.com/LiacourasCentersdfg'),
(11, 1451938606, 1452611551, 1, 'Instagram Link', 'https://instagram.com/theryancenter'),
(12, 1451938693, 1452611551, 1, 'Instagram ID', '295022538'),
(13, 1452872675, 1452872692, 1, 'google plus', '#test'),
(14, 0, 0, 0, 'Address Latitude', '39.979826'),
(15, 0, 0, 0, 'Address Longitude', '-75.158559');

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_module_siteinfogroups`
--

CREATE TABLE IF NOT EXISTS `cms_core_module_siteinfogroups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `cms_core_module_siteinfogroups`
--

INSERT INTO `cms_core_module_siteinfogroups` (`id`, `created_at`, `updated_at`, `name`) VALUES
(1, 1452552277, 1452552277, 'Social Media');

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_module_sitemenu`
--

CREATE TABLE IF NOT EXISTS `cms_core_module_sitemenu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `displayorder` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `newwindow` tinyint(1) NOT NULL,
  `image` varchar(10) NOT NULL,
  `page_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `locked` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `cms_core_module_sitemenu`
--

INSERT INTO `cms_core_module_sitemenu` (`id`, `created_at`, `updated_at`, `displayorder`, `title`, `url`, `newwindow`, `image`, `page_id`, `parent_id`, `locked`) VALUES
(1, 1460919701, 1460921790, 1, 'Homepage', '', 0, '', 1, 0, 1),
(2, 1460919806, 1461949347, 1, 'Example', '/example', 0, '', 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_module_users`
--

CREATE TABLE IF NOT EXISTS `cms_core_module_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `username` varchar(80) NOT NULL,
  `fullname` varchar(120) NOT NULL,
  `email` varchar(80) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `token_expires` datetime DEFAULT NULL,
  `central_auth` tinyint(1) NOT NULL DEFAULT '0',
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  `userlevel` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `cms_core_module_users`
--

INSERT INTO `cms_core_module_users` (`id`, `created_at`, `updated_at`, `username`, `fullname`, `email`, `password`, `token`, `token_expires`, `central_auth`, `enabled`, `userlevel`) VALUES
(15, 1458137680, 1460840265, 'clientuser', 'Client User', 'clientuser@gmail.com', '$2y$10$5iS8ODgGmGwE1UYBkxu5ZOuwJHifKboa1rg60CgIE9At0zrzFSLZW', NULL, NULL, 0, 1, 40),
(16, 1458137699, 1460921839, 'Clientadmin', 'Client Admin', 'clientadmin@gmail.com', '$2y$10$i09RzHPi2ZAA.l6.7lW1w.FsjholGvq9IZtiDZKjnxmX7PL411V/q', NULL, NULL, 0, 1, 30),
(17, 1458137760, 1460495243, 'aycuser', 'AYC User', 'aycuser@gmail.com', '$2y$10$6ONJ7AU1zXMzl4x.qmII9.JGVJ371lMZCrmyL4bNl7NjOYK5RJ5.G', NULL, NULL, 0, 1, 20),
(22, 1460837748, 1461949353, 'keithl', '', '', '$2y$10$tLyK6svS.qZ6DiAjsDVZ.uLM5.yeBRkWapnz0vSt/oX8Cugenl2/C', 'W8OIkxiRox18aONGyUpa81fJxAQ5o5gk5PnKBQAXUufmC6w3uRNuqvW1JX19Z4W8vBGpNwPTu4ZP9hTuXirVvJjeLlUV2afRqPy3g+58NNbiZL9OVIGq8p9QV5VhjoCvOxElNXRH/qObSOn0n2LL9iopZZC2YLPFufs82gK05pU=', '2016-04-29 14:02:33', 1, 1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_module_users_modules`
--

CREATE TABLE IF NOT EXISTS `cms_core_module_users_modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `module` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `cms_core_module_users_modules`
--

INSERT INTO `cms_core_module_users_modules` (`id`, `created_at`, `updated_at`, `userid`, `module`) VALUES
(31, 1460840265, 1460840265, 15, 'pages'),
(30, 1460840265, 1460840265, 15, 'events'),
(28, 1460840265, 1460840265, 15, 'redirects');

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_module_users_pages`
--

CREATE TABLE IF NOT EXISTS `cms_core_module_users_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `pageid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `cms_core_module_users_pages`
--

INSERT INTO `cms_core_module_users_pages` (`id`, `userid`, `pageid`) VALUES
(17, 15, 2),
(16, 15, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_partial_accordion`
--

CREATE TABLE IF NOT EXISTS `cms_core_partial_accordion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_partial_id` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `modified_at` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_partial_accordion_items`
--

CREATE TABLE IF NOT EXISTS `cms_core_partial_accordion_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `updated_at` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_partial_buttongroup`
--

CREATE TABLE IF NOT EXISTS `cms_core_partial_buttongroup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_partial_id` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `position` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `cms_core_partial_buttongroup`
--

INSERT INTO `cms_core_partial_buttongroup` (`id`, `page_partial_id`, `created_at`, `updated_at`, `name`, `position`) VALUES
(1, 5, 0, 0, 'Report', 'button-left');

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_partial_buttongroup_button`
--

CREATE TABLE IF NOT EXISTS `cms_core_partial_buttongroup_button` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `label` varchar(255) NOT NULL,
  `link` varchar(2048) NOT NULL,
  `newwindow` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `cms_core_partial_buttongroup_button`
--

INSERT INTO `cms_core_partial_buttongroup_button` (`id`, `parent_id`, `created_at`, `updated_at`, `label`, `link`, `newwindow`) VALUES
(1, 1, 0, 0, 'Septa', 'http://www.septa.com', 0),
(2, 1, 0, 0, 'Catering Menu', 'http://www.1.com', 0),
(3, 1, 0, 0, 'Test', 'http://www.test.com', 0),
(4, 1, 0, 0, 'qwdqwd', 'http://www.lol.com/pdfs/catering.pdf', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_partial_hero`
--

CREATE TABLE IF NOT EXISTS `cms_core_partial_hero` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_partial_id` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_partial_hero_slides`
--

CREATE TABLE IF NOT EXISTS `cms_core_partial_hero_slides` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `displayorder` int(11) NOT NULL,
  `image_desktop` varchar(10) NOT NULL,
  `image_mobile` varchar(10) NOT NULL,
  `image_alt` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_partial_htmltext`
--

CREATE TABLE IF NOT EXISTS `cms_core_partial_htmltext` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_partial_id` int(11) NOT NULL,
  `header` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `cms_core_partial_htmltext`
--

INSERT INTO `cms_core_partial_htmltext` (`id`, `page_partial_id`, `header`, `title`, `text`) VALUES
(1, 21, '', 'Uh-Oh!', '<p>Looks like you took a wrong turn!</p>');

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_partial_image`
--

CREATE TABLE IF NOT EXISTS `cms_core_partial_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_partial_id` int(11) NOT NULL,
  `image` varchar(256) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_partial_imageslider`
--

CREATE TABLE IF NOT EXISTS `cms_core_partial_imageslider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_partial_id` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `modified_at` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_partial_imageslider_images`
--

CREATE TABLE IF NOT EXISTS `cms_core_partial_imageslider_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `modified_at` int(11) NOT NULL,
  `image` varchar(10) NOT NULL,
  `alttag` varchar(255) NOT NULL,
  `videolink` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_partial_infoblock`
--

CREATE TABLE IF NOT EXISTS `cms_core_partial_infoblock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_partial_id` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `header` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `link` varchar(2048) NOT NULL,
  `button_name` varchar(255) NOT NULL,
  `image` varchar(10) NOT NULL,
  `newwindow` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_partial_infolist`
--

CREATE TABLE IF NOT EXISTS `cms_core_partial_infolist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_partial_id` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `modified_at` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `columns` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_partial_infolist_items`
--

CREATE TABLE IF NOT EXISTS `cms_core_partial_infolist_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `updated_at` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `link` varchar(2048) NOT NULL,
  `label` varchar(255) NOT NULL,
  `newwindow` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_partial_mediagallery`
--

CREATE TABLE IF NOT EXISTS `cms_core_partial_mediagallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_partial_id` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `modified_at` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_partial_mediagallery_images`
--

CREATE TABLE IF NOT EXISTS `cms_core_partial_mediagallery_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `modified_at` int(11) NOT NULL,
  `image` varchar(10) NOT NULL,
  `alttag` varchar(255) NOT NULL,
  `videolink` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_partial_textarea`
--

CREATE TABLE IF NOT EXISTS `cms_core_partial_textarea` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_partial_id` int(11) NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_partial_titletextblock`
--

CREATE TABLE IF NOT EXISTS `cms_core_partial_titletextblock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_partial_id` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_partial_topheader`
--

CREATE TABLE IF NOT EXISTS `cms_core_partial_topheader` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_partial_id` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `modified_at` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `cms_core_partial_topheader`
--

INSERT INTO `cms_core_partial_topheader` (`id`, `page_partial_id`, `created_at`, `modified_at`, `title`, `text`) VALUES
(1, 1, 0, 0, 'Homepage', ''),
(2, 20, 0, 0, 'Page not Found', ''),
(3, 24, 0, 0, 'Honda', '');

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_partial_topheader_images`
--

CREATE TABLE IF NOT EXISTS `cms_core_partial_topheader_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `modified_at` int(11) NOT NULL,
  `image` varchar(10) NOT NULL,
  `alttag` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_partial_videolist`
--

CREATE TABLE IF NOT EXISTS `cms_core_partial_videolist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_partial_id` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `link` varchar(2048) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_partial_videolist_videos`
--

CREATE TABLE IF NOT EXISTS `cms_core_partial_videolist_videos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `link` varchar(2048) NOT NULL,
  `displayorder` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_core_sessions`
--

CREATE TABLE IF NOT EXISTS `cms_core_sessions` (
  `id` varchar(32) NOT NULL DEFAULT '',
  `created` bigint(20) NOT NULL DEFAULT '0',
  `modified` bigint(20) NOT NULL DEFAULT '0',
  `data` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `modified` (`modified`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cms_core_sessions`
--

INSERT INTO `cms_core_sessions` (`id`, `created`, `modified`, `data`) VALUES
('0ksb9u4nuq8pkiat415jgh5f96', 1461947800, 1461949353, 'admin|a:6:{s:4:"user";O:10:"Model\\User":35:{s:8:"\0*\0table";s:21:"cms_core_module_users";s:13:"\0*\0attributes";a:12:{s:2:"id";s:2:"22";s:10:"created_at";s:10:"1460837748";s:10:"updated_at";s:10:"1461949353";s:8:"username";s:6:"keithl";s:8:"fullname";s:0:"";s:5:"email";s:0:"";s:8:"password";s:60:"$2y$10$tLyK6svS.qZ6DiAjsDVZ.uLM5.yeBRkWapnz0vSt/oX8Cugenl2/C";s:5:"token";s:172:"W8OIkxiRox18aONGyUpa81fJxAQ5o5gk5PnKBQAXUufmC6w3uRNuqvW1JX19Z4W8vBGpNwPTu4ZP9hTuXirVvJjeLlUV2afRqPy3g+58NNbiZL9OVIGq8p9QV5VhjoCvOxElNXRH/qObSOn0n2LL9iopZZC2YLPFufs82gK05pU=";s:13:"token_expires";s:19:"2016-04-29 14:02:33";s:12:"central_auth";s:1:"1";s:7:"enabled";s:1:"1";s:9:"userlevel";s:2:"10";}s:11:"\0*\0fillable";a:9:{i:0;s:8:"username";i:1;s:8:"fullname";i:2;s:5:"email";i:3;s:8:"password";i:4;s:5:"token";i:5;s:13:"token_expires";i:6;s:12:"central_auth";i:7;s:7:"enabled";i:8;s:9:"userlevel";}s:10:"dateFormat";s:1:"U";s:19:"\0*\0requiredMessages";a:0:{}s:9:"\0*\0errors";a:0:{}s:19:"\0*\0usesFriendlyURLs";b:0;s:21:"friendlyURLController";s:9:"basemodel";s:20:"\0*\0friendlyURLMethod";s:9:"basemodel";s:16:"\0*\0friendlyURLID";s:2:"id";s:21:"friendlyURLDeriveFrom";s:5:"title";s:14:"\0*\0imageFields";a:0:{}s:11:"imageFolder";s:9:"basemodel";s:12:"\0*\0pdfFields";a:0:{}s:9:"pdfFolder";s:9:"basemodel";s:17:"\0*\0skipValidation";b:0;s:13:"\0*\0connection";N;s:13:"\0*\0primaryKey";s:2:"id";s:10:"\0*\0perPage";i:15;s:12:"incrementing";b:1;s:10:"timestamps";b:1;s:11:"\0*\0original";a:12:{s:2:"id";s:2:"22";s:10:"created_at";s:10:"1460837748";s:10:"updated_at";s:10:"1461949353";s:8:"username";s:6:"keithl";s:8:"fullname";s:0:"";s:5:"email";s:0:"";s:8:"password";s:60:"$2y$10$tLyK6svS.qZ6DiAjsDVZ.uLM5.yeBRkWapnz0vSt/oX8Cugenl2/C";s:5:"token";s:172:"W8OIkxiRox18aONGyUpa81fJxAQ5o5gk5PnKBQAXUufmC6w3uRNuqvW1JX19Z4W8vBGpNwPTu4ZP9hTuXirVvJjeLlUV2afRqPy3g+58NNbiZL9OVIGq8p9QV5VhjoCvOxElNXRH/qObSOn0n2LL9iopZZC2YLPFufs82gK05pU=";s:13:"token_expires";s:19:"2016-04-29 14:02:33";s:12:"central_auth";s:1:"1";s:7:"enabled";s:1:"1";s:9:"userlevel";s:2:"10";}s:12:"\0*\0relations";a:0:{}s:9:"\0*\0hidden";a:0:{}s:10:"\0*\0visible";a:0:{}s:10:"\0*\0appends";a:0:{}s:10:"\0*\0guarded";a:1:{i:0;s:1:"*";}s:8:"\0*\0dates";a:0:{}s:8:"\0*\0casts";a:0:{}s:10:"\0*\0touches";a:0:{}s:14:"\0*\0observables";a:0:{}s:7:"\0*\0with";a:0:{}s:13:"\0*\0morphClass";N;s:6:"exists";b:1;s:18:"wasRecentlyCreated";b:0;}s:4:"auth";s:240:"22:W8OIkxiRox18aONGyUpa81fJxAQ5o5gk5PnKBQAXUufmC6w3uRNuqvW1JX19Z4W8vBGpNwPTu4ZP9hTuXirVvJjeLlUV2afRqPy3g+58NNbiZL9OVIGq8p9QV5VhjoCvOxElNXRH/qObSOn0n2LL9iopZZC2YLPFufs82gK05pU=:78ce5a43b047099c41ef3d7ce287f229ea95c09cab2cce7cf4ebaa1618d3a4ca";s:5:"cauth";b:1;s:9:"userlevel";s:2:"10";s:7:"modules";a:0:{}s:5:"pages";a:0:{}}'),
('5otode0qprji48nkqa14uldhm5', 1461782947, 1461947108, 'admin|a:7:{s:4:"user";O:10:"Model\\User":35:{s:8:"\0*\0table";s:21:"cms_core_module_users";s:13:"\0*\0attributes";a:12:{s:2:"id";s:2:"22";s:10:"created_at";s:10:"1460837748";s:10:"updated_at";s:10:"1461947107";s:8:"username";s:6:"keithl";s:8:"fullname";s:0:"";s:5:"email";s:0:"";s:8:"password";s:60:"$2y$10$615sCQxhqbHkMpy.gtjIuO/YGhBL5aE1FyNmVGO854txptKgrezBu";s:5:"token";s:172:"MjsAIqBSK+JRtVnJJ3vw/PL5U90Ng2LL30XMpijP0GYIe2k0TOJprYWv36bK4/eTlwtnK697u9B2a3o2Z7FQzO9isY9Vp5PPXCwrRWfqYG6srkHuQ+cajuzTrWGY0tMrEZV6+kowwASLznJe2Ls4pajVEdBwJYHZfZ2qDs9WW1k=";s:13:"token_expires";s:19:"2016-04-29 13:25:07";s:12:"central_auth";s:1:"1";s:7:"enabled";s:1:"1";s:9:"userlevel";s:2:"20";}s:11:"\0*\0fillable";a:9:{i:0;s:8:"username";i:1;s:8:"fullname";i:2;s:5:"email";i:3;s:8:"password";i:4;s:5:"token";i:5;s:13:"token_expires";i:6;s:12:"central_auth";i:7;s:7:"enabled";i:8;s:9:"userlevel";}s:10:"dateFormat";s:1:"U";s:19:"\0*\0requiredMessages";a:0:{}s:9:"\0*\0errors";a:0:{}s:19:"\0*\0usesFriendlyURLs";b:0;s:21:"friendlyURLController";s:9:"basemodel";s:20:"\0*\0friendlyURLMethod";s:9:"basemodel";s:16:"\0*\0friendlyURLID";s:2:"id";s:21:"friendlyURLDeriveFrom";s:5:"title";s:14:"\0*\0imageFields";a:0:{}s:11:"imageFolder";s:9:"basemodel";s:12:"\0*\0pdfFields";a:0:{}s:9:"pdfFolder";s:9:"basemodel";s:17:"\0*\0skipValidation";b:0;s:13:"\0*\0connection";N;s:13:"\0*\0primaryKey";s:2:"id";s:10:"\0*\0perPage";i:15;s:12:"incrementing";b:1;s:10:"timestamps";b:1;s:11:"\0*\0original";a:12:{s:2:"id";s:2:"22";s:10:"created_at";s:10:"1460837748";s:10:"updated_at";s:10:"1461947107";s:8:"username";s:6:"keithl";s:8:"fullname";s:0:"";s:5:"email";s:0:"";s:8:"password";s:60:"$2y$10$615sCQxhqbHkMpy.gtjIuO/YGhBL5aE1FyNmVGO854txptKgrezBu";s:5:"token";s:172:"MjsAIqBSK+JRtVnJJ3vw/PL5U90Ng2LL30XMpijP0GYIe2k0TOJprYWv36bK4/eTlwtnK697u9B2a3o2Z7FQzO9isY9Vp5PPXCwrRWfqYG6srkHuQ+cajuzTrWGY0tMrEZV6+kowwASLznJe2Ls4pajVEdBwJYHZfZ2qDs9WW1k=";s:13:"token_expires";s:19:"2016-04-29 13:25:07";s:12:"central_auth";s:1:"1";s:7:"enabled";s:1:"1";s:9:"userlevel";s:2:"20";}s:12:"\0*\0relations";a:0:{}s:9:"\0*\0hidden";a:0:{}s:10:"\0*\0visible";a:0:{}s:10:"\0*\0appends";a:0:{}s:10:"\0*\0guarded";a:1:{i:0;s:1:"*";}s:8:"\0*\0dates";a:0:{}s:8:"\0*\0casts";a:0:{}s:10:"\0*\0touches";a:0:{}s:14:"\0*\0observables";a:0:{}s:7:"\0*\0with";a:0:{}s:13:"\0*\0morphClass";N;s:6:"exists";b:1;s:18:"wasRecentlyCreated";b:0;}s:7:"message";s:64:"You have been logged out due to inactivity. Please log in again.";s:4:"auth";s:240:"22:MjsAIqBSK+JRtVnJJ3vw/PL5U90Ng2LL30XMpijP0GYIe2k0TOJprYWv36bK4/eTlwtnK697u9B2a3o2Z7FQzO9isY9Vp5PPXCwrRWfqYG6srkHuQ+cajuzTrWGY0tMrEZV6+kowwASLznJe2Ls4pajVEdBwJYHZfZ2qDs9WW1k=:67710880a613663b8789e3989b5b90606433b00258b41a92500e06308a55b94a";s:5:"cauth";b:1;s:9:"userlevel";s:2:"20";s:7:"modules";a:0:{}s:5:"pages";a:0:{}}');

-- --------------------------------------------------------

--
-- Table structure for table `cms_site_module_event_types`
--

CREATE TABLE IF NOT EXISTS `cms_site_module_event_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_site_module_jobapplicants`
--

CREATE TABLE IF NOT EXISTS `cms_site_module_jobapplicants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `jobposition_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `fulltime` tinyint(1) NOT NULL,
  `coverletter` varchar(255) NOT NULL,
  `resume` varchar(255) NOT NULL,
  `message` varchar(2048) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_site_module_jobpositions`
--

CREATE TABLE IF NOT EXISTS `cms_site_module_jobpositions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `pdf` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_site_module_meeting_spaces`
--

CREATE TABLE IF NOT EXISTS `cms_site_module_meeting_spaces` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(10) NOT NULL,
  `imagealt` varchar(255) NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_site_module_newsarticles`
--

CREATE TABLE IF NOT EXISTS `cms_site_module_newsarticles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `date` int(11) NOT NULL,
  `description` text NOT NULL,
  `summary` varchar(2048) NOT NULL,
  `image` varchar(10) NOT NULL,
  `imagealt` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_site_module_newsarticle_newslinks`
--

CREATE TABLE IF NOT EXISTS `cms_site_module_newsarticle_newslinks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `newsarticle_id` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `label` varchar(255) NOT NULL,
  `url` varchar(2048) NOT NULL,
  `newwindow` tinyint(1) NOT NULL,
  `displayorder` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_site_module_newsarticle_newspdfs`
--

CREATE TABLE IF NOT EXISTS `cms_site_module_newsarticle_newspdfs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `newsarticle_id` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `pdf` varchar(2048) NOT NULL,
  `displayorder` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_site_module_seating_charts`
--

CREATE TABLE IF NOT EXISTS `cms_site_module_seating_charts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image_small` varchar(10) NOT NULL,
  `image_large` varchar(10) NOT NULL,
  `imagealt` varchar(255) NOT NULL,
  `pdf` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_site_partial_breakingnews`
--

CREATE TABLE IF NOT EXISTS `cms_site_partial_breakingnews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_partial_id` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `text` varchar(255) NOT NULL,
  `link` varchar(2048) NOT NULL,
  `newwindow` tinyint(1) NOT NULL DEFAULT '0',
  `enabled` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_site_partial_complex_accordion`
--

CREATE TABLE IF NOT EXISTS `cms_site_partial_complex_accordion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_partial_id` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `header` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_site_partial_complex_accordion_items`
--

CREATE TABLE IF NOT EXISTS `cms_site_partial_complex_accordion_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `text` varchar(2048) NOT NULL,
  `image` varchar(10) NOT NULL,
  `imagealt` varchar(255) NOT NULL,
  `buttonlink` varchar(2048) NOT NULL,
  `buttontext` varchar(255) NOT NULL,
  `newwindow` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_site_partial_eventsslider`
--

CREATE TABLE IF NOT EXISTS `cms_site_partial_eventsslider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_partial_id` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `type` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_site_partial_homeinfoblock`
--

CREATE TABLE IF NOT EXISTS `cms_site_partial_homeinfoblock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_partial_id` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `headertitle` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` varchar(2048) NOT NULL,
  `image` varchar(10) NOT NULL,
  `link` varchar(2048) NOT NULL,
  `newwindow` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_site_partial_homepagevideoslider`
--

CREATE TABLE IF NOT EXISTS `cms_site_partial_homepagevideoslider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_partial_id` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_site_partial_homepagevideoslider_video`
--

CREATE TABLE IF NOT EXISTS `cms_site_partial_homepagevideoslider_video` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `link` varchar(2048) NOT NULL,
  `image` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_site_partial_map`
--

CREATE TABLE IF NOT EXISTS `cms_site_partial_map` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_partial_id` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure for view `cms_core_module_current_friendlyurls`
--
DROP TABLE IF EXISTS `cms_core_module_current_friendlyurls`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `cms_core_module_current_friendlyurls` AS select `cms_core_module_friendly_urls`.`id` AS `id`,`cms_core_module_friendly_urls`.`route` AS `route`,`cms_core_module_friendly_urls`.`friendlyurl` AS `friendlyurl`,`cms_core_module_friendly_urls`.`created` AS `created`,`cms_core_module_friendly_urls`.`active` AS `active`,`cms_core_module_friendly_urls`.`redirect` AS `redirect` from `cms_core_module_friendly_urls` order by `cms_core_module_friendly_urls`.`created` desc;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
