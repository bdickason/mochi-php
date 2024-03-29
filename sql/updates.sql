ALTER TABLE `users`
CHANGE `phone_number` `phone_primary_number` VARCHAR(25) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,     
CHANGE `phone_type` `phone_primary_type` ENUM('work','mobile','home') CHARACTER SET utf8 COLLATE utf8_general_ci NULL ;

ALTER TABLE `users` 
ADD COLUMN `phone_secondary_number` VARCHAR(25) NULL AFTER `phone_primary_type`,     
ADD COLUMN `phone_secondary_type` ENUM('work','mobile','home') NULL AFTER `phone_secondary_number`;

ALTER TABLE `users`     ADD COLUMN `referral` VARCHAR(255) NULL AFTER `phone_secondary_type`;

/* 2010-01-18 Quantity for checkout */
ALTER TABLE `transactions_entries`     ADD COLUMN `transaction_entry_quantity` INT(5) NOT NULL DEFAULT 1 AFTER `transaction_entry_service_id`;

/* 2010-01-20 Last transaction for the user */
ALTER TABLE users ADD COLUMN last_transaction_date DATETIME;

/* 2010-03-25 Payment type */
ALTER TABLE `transactions`     ADD COLUMN `transaction_payment_type` ENUM('credit','cash','gift') DEFAULT 'credit' NULL AFTER `transaction_paid`;

/* 2010-03-28 Different payment types */
ALTER TABLE `transactions`     CHANGE `transaction_payment_type` `transaction_payment_type` ENUM('cash','gift','visa','amex','mastercard','check') CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT 'visa' NULL ;
UPDATE transactions SET transaction_payment_type = 'visa' WHERE transaction_payment_type = '' OR transaction_payment_type IS NULL;

/* 2010-04-04 User Options table */
CREATE TABLE `users_options` (
  `uid` int(11) NOT NULL,
  `user_option_tag` varchar(20) NOT NULL,
  `user_option_value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`uid`,`user_option_tag`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

/* 2010-05-12 appointments */
CREATE TABLE `appointments` (
  `appointment_id` int(11) NOT NULL AUTO_INCREMENT,
  `appointment_start_date` datetime DEFAULT NULL,
  `appointment_end_date` datetime DEFAULT NULL,
  `appointment_shared_code` varchar(40) DEFAULT NULL COMMENT 'used to link appointments',
  `appointment_client_uid` int(11) DEFAULT NULL,
  `appointment_client_name` varchar(50) DEFAULT NULL,
  `appointment_client_phone` varchar(20) DEFAULT NULL,
  `appointment_client_phone_type` enum('mobile','work','home') DEFAULT NULL,
  `appointment_stylist_uid` int(11) DEFAULT NULL,
  `appointment_active` tinyint(1) DEFAULT NULL,
  `appointment_service_id` int(11) DEFAULT NULL,
  `appointment_checked_out` tinyint(1) DEFAULT NULL,
  `appointment_transaction_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`appointment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8

/* 2012-08-01 Added discover as payment type */
ALTER TABLE `transactions`
CHANGE `transaction_payment_type` `transaction_payment_type` enum('visa','discover','mastercard','amex','check','cash','gift') COLLATE 'utf8_general_ci' NULL DEFAULT 'visa' AFTER `transaction_paid`;

/* 2012-08-13 Added client email to appointments */
ALTER TABLE `appointments`
ADD `appointment_client_email` varchar(255) COLLATE 'utf8_general_ci' NULL AFTER `appointment_client_name`,
COMMENT=''
REMOVE PARTITIONING;

/* 2013-01-03 Added taxable column to products */
ALTER TABLE `products` CHANGE `product_price` `product_price` float(5,2) NOT NULL DEFAULT '0' AFTER `product_sku`,
ADD `taxable` tinyint(1) unsigned NOT NULL DEFAULT '1' AFTER `product_active`, COMMENT='';

/* 2013-01-03 Added taxable column to services_users */
ALTER TABLE `services_users` ADD `taxable` tinyint(1) unsigned NULL DEFAULT '1' AFTER `active`, COMMENT='';

/* 2013-01-03 Update specific products to not be taxable */
UPDATE `products` SET `product_id` = '177', `product_name` = 'Shipping', `product_sku` = 'ship', `product_price` = '0.00', `last_updated` = now(), `product_active` = '1', `taxable` = '0' WHERE `product_id` = '177' COLLATE utf8_bin LIMIT 1;

/* 2013-01-03 Added Gift cards to products */
INSERT INTO `products` (`product_name`, `product_sku`, `product_price`, `last_updated`, `product_active`, `taxable`) VALUES ('Giftcard', 'giftcard', '0.00', now(), '1', '0');

/* 2013-01-03 Add Taxable to transaction entries */
ALTER TABLE `transactions_entries` ADD `transaction_entry_taxable` tinyint(1) unsigned NOT NULL DEFAULT '1' AFTER `transaction_entry_quantity`, COMMENT='';
