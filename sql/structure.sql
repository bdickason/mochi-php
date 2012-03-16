/*Table structure for table `products` */

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(100) DEFAULT NULL,
  `product_sku` varchar(30) DEFAULT NULL,
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `product_active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `products_prices` */

DROP TABLE IF EXISTS `products_prices`;

CREATE TABLE `products_prices` (
  `product_price_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_price` float(5,2) DEFAULT NULL,
  `product_price_version` int(5) DEFAULT '1',
  `product_price_date_start` datetime DEFAULT NULL,
  `product_price_date_end` datetime DEFAULT NULL,
  PRIMARY KEY (`product_price_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `services` */

DROP TABLE IF EXISTS `services`;

CREATE TABLE `services` (
  `service_id` int(11) NOT NULL AUTO_INCREMENT,
  `service_name` varchar(50) DEFAULT NULL,
  `service_active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`service_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'global user id',
  `email` varchar(50) DEFAULT NULL COMMENT 'email',
  `date_added` datetime DEFAULT NULL COMMENT 'date of user added',
  `date_updated` datetime DEFAULT NULL COMMENT 'date of last user update',
  `password_hash` varchar(40) DEFAULT NULL COMMENT 'sha1 of password and salt',
  `password_salt` varchar(10) DEFAULT NULL COMMENT 'random string',
  `active` tinyint(1) DEFAULT '1' COMMENT '1 means active',
  `type` enum('assistant','client','receptionist','stylist','administrator') DEFAULT 'assistant' COMMENT 'user type',
  `name` varchar(100) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `notes` text COMMENT 'client notes usually',
  `ssn` varchar(11) DEFAULT NULL COMMENT 'SSN',
  `permissions` set('administrator') DEFAULT NULL COMMENT 'set of permissions',
  `tax_info` enum('1','2','3','4','0') DEFAULT '0' COMMENT 'tax allowances',
  `tax_type` enum('W2','W9') DEFAULT NULL COMMENT 'tax form type',
  `address_street` varchar(100) DEFAULT NULL,
  `address_apartment` varchar(20) DEFAULT NULL,
  `address_city` varchar(50) DEFAULT NULL,
  `address_state` varchar(5) DEFAULT NULL,
  `address_country` varchar(10) DEFAULT 'US',
  `address_zip` varchar(10) DEFAULT NULL,
  `gender` enum('male','female') DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `phone_type` enum('work','mobile','home') DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `users_options` (
  `uid` int(11) NOT NULL,
  `user_option_tag` varchar(20) NOT NULL,
  `user_option_value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`uid`,`user_option_tag`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;
