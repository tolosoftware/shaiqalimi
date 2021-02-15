ALTER TABLE `proposals` ADD `offer_guarantee_type` VARCHAR (10) NULL AFTER `offer_guarantee`;
ALTER TABLE `proposals` ADD `same_pro` VARCHAR (100) NULL AFTER `offer_guarantee_type`;
ALTER TABLE `proposals` ADD `deal_value` decimal (18, 2) NULL AFTER `same_pro`; 
ALTER TABLE `proposals` ADD `financial_power` decimal (18, 2) NULL AFTER `deal_value`;
ALTER TABLE `proposals` ADD `receive_office` boolean NULL AFTER `financial_power`;
ALTER TABLE `proposals` ADD `bank_distribute` boolean NULL AFTER `receive_office`;
ALTER TABLE `pro_items` ADD `density` FLOAT (5, 5) NULL AFTER `equivalent`;
ALTER TABLE `pro_items` ADD `density` FLOAT(5, 5) NULL AFTER `equivalent`;
ALTER TABLE `stock_records` ADD `ex_rate_id` INT(10) NULL AFTER `remark`;

-- Changes
ALTER TABLE `projects` CHANGE `project_guarantee` `project_guarantee` BIGINT (20) NOT NULL;
ALTER TABLE `pro_data` CHANGE `total_price` `total_price` BIGINT (20) NOT NULL;
ALTER TABLE `pro_items` CHANGE `ammount` `ammount` BIGINT (20) NOT NULL;
ALTER TABLE `pro_items` CHANGE `unit_price` `unit_price` BIGINT (20) NOT NULL;
ALTER TABLE `pro_items` CHANGE `total_price` `total_price` BIGINT (20) NOT NULL;
ALTER TABLE `pro_items` CHANGE `equivalent` `equivalent` BIGINT (20) NOT NULL;
ALTER TABLE `pro_data` CHANGE `pr_worth` `pr_worth` BIGINT (20) NOT NULL;
ALTER TABLE `pro_data` CHANGE `deposit` `deposit` BIGINT (20) NOT NULL;
ALTER TABLE `pro_data` CHANGE `tax` `tax` BIGINT (20) NOT NULL;
ALTER TABLE `pro_data` CHANGE `transit` `transit` BIGINT (20) NOT NULL;
ALTER TABLE `pro_data` CHANGE `others` `others` BIGINT (20) NOT NULL;
ALTER TABLE `items` CHANGE `equivalent` `equivalent` BIGINT (20) NOT NULL;
ALTER TABLE `projects` CHANGE `project_guarantee` `project_guarantee` BIGINT(20) NOT NULL;
ALTER TABLE `pro_data` CHANGE `total_price` `total_price` BIGINT(20) NOT NULL;
ALTER TABLE `pro_items` CHANGE `ammount` `ammount` BIGINT(20) NOT NULL;
ALTER TABLE `pro_items` CHANGE `unit_price` `unit_price` BIGINT(20) NOT NULL;
ALTER TABLE `pro_items` CHANGE `total_price` `total_price` BIGINT(20) NOT NULL;
ALTER TABLE `pro_items` CHANGE `equivalent` `equivalent` BIGINT(20) NOT NULL;
ALTER TABLE `pro_data` CHANGE `pr_worth` `pr_worth` BIGINT(20) NOT NULL;
ALTER TABLE `pro_data` CHANGE `deposit` `deposit` BIGINT(20) NOT NULL;
ALTER TABLE `pro_data` CHANGE `tax` `tax` BIGINT(20) NOT NULL;
ALTER TABLE `pro_data` CHANGE `transit` `transit` BIGINT(20) NOT NULL;
ALTER TABLE `pro_data` CHANGE `others` `others` BIGINT(20) NOT NULL;
ALTER TABLE `items` CHANGE `equivalent` `equivalent` BIGINT(20) NOT NULL;
ALTER TABLE `stock_records` CHANGE `decrement` `decrement` DECIMAL(18, 2) NULL DEFAULT '0.00';
ALTER TABLE `stock_records` CHANGE `increment` `increment` DECIMAL(18, 2) NULL DEFAULT '0.00';
ALTER TABLE `stock_records` CHANGE `decrement_equiv` `decrement_equiv` DECIMAL(18, 2) NULL DEFAULT '0.00';
ALTER TABLE `stock_records` CHANGE `increment_equiv` `increment_equiv` DECIMAL(18, 2) NULL DEFAULT '0.00';
ALTER TABLE `users` CHANGE `image` `image` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;
ALTER TABLE `items` CHANGE `description` `description` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;
ALTER TABLE `purchases` CHANGE `description` `description` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;
ALTER TABLE `financial_records` CHANGE `description` `description` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;

ALTER TABLE `sales_fours` CHANGE `steps` `steps` DECIMAL(11) NULL DEFAULT NULL;
ALTER TABLE `sales_threes` CHANGE `steps` `steps` DECIMAL(11) NULL DEFAULT NULL;
ALTER TABLE `sales_twos` CHANGE `steps` `steps` DECIMAL(11) NULL DEFAULT NULL;
ALTER TABLE `sales_ones` CHANGE `steps` `steps` DECIMAL(11) NULL DEFAULT NULL;

ALTER TABLE `sales_fours` CHANGE `description` `description` VARCHAR(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;
ALTER TABLE `sales_threes`  CHANGE `description` `description` VARCHAR(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;
ALTER TABLE `sales_twos`  CHANGE `description` `description` VARCHAR(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;
ALTER TABLE `sales_ones`  CHANGE `description` `description` VARCHAR(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;
ALTER TABLE `stock_records`  CHANGE `remark` `remark` VARCHAR(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;
ALTER TABLE `notifications` ADD `notif_number` INT(5) NULL AFTER `user_id`;
ALTER TABLE `notifications` ADD `notif_source` VARCHAR(20) NULL AFTER `user_id`;
ALTER TABLE `notifications` ADD `notif_source_id` INT(5) NULL AFTER `user_id`;