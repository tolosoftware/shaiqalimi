ALTER TABLE `proposals`
ADD `offer_guarantee_type` VARCHAR
(10) NULL AFTER `offer_guarantee`;
ALTER TABLE `proposals`
ADD `same_pro` VARCHAR
(100) NULL AFTER `offer_guarantee_type`;
ALTER TABLE `proposals`
ADD `deal_value` decimal
(18,2) NULL AFTER `same_pro`;
ALTER TABLE `proposals`
ADD `financial_power` decimal
(18,2) NULL AFTER `deal_value`;
ALTER TABLE `proposals`
ADD `receive_office` boolean NULL AFTER `financial_power`;
ALTER TABLE `proposals`
ADD `bank_distribute` boolean NULL AFTER `receive_office`;


ALTER TABLE `projects` CHANGE `project_guarantee` `project_guarantee` BIGINT
(20) NOT NULL;
ALTER TABLE `pro_data` CHANGE `total_price` `total_price` BIGINT
(20) NOT NULL;


ALTER TABLE `pro_items` CHANGE `ammount` `ammount` BIGINT
(20) NOT NULL;
ALTER TABLE `pro_items` CHANGE `unit_price` `unit_price` BIGINT
(20) NOT NULL;
ALTER TABLE `pro_items` CHANGE `total_price` `total_price` BIGINT
(20) NOT NULL;
ALTER TABLE `pro_items` CHANGE `equivalent` `equivalent` BIGINT
(20) NOT NULL;


ALTER TABLE `pro_data` CHANGE `pr_worth` `pr_worth` BIGINT
(20) NOT NULL;
ALTER TABLE `pro_data` CHANGE `deposit` `deposit` BIGINT
(20) NOT NULL;
ALTER TABLE `pro_data` CHANGE `tax` `tax` BIGINT
(20) NOT NULL;
ALTER TABLE `pro_data` CHANGE `transit` `transit` BIGINT
(20) NOT NULL;
ALTER TABLE `pro_data` CHANGE `others` `others` BIGINT
(20) NOT NULL;


ALTER TABLE `items` CHANGE `equivalent` `equivalent` BIGINT
(20) NOT NULL;
ALTER TABLE `pro_items`
ADD `density` FLOAT
(5,5) NULL AFTER `equivalent`;


-- ahmdi

<<<<<<< HEAD

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
ALTER TABLE `pro_items` ADD `density` FLOAT(5,5) NULL AFTER `equivalent`;

ALTER TABLE `stock_records` CHANGE `decrement` `decrement` DECIMAL(18,2) NULL DEFAULT '0.00';
ALTER TABLE `stock_records` CHANGE `increment` `increment` DECIMAL(18,2) NULL DEFAULT '0.00';
ALTER TABLE `stock_records` CHANGE `decrement_equiv` `decrement_equiv` DECIMAL(18,2) NULL DEFAULT '0.00';
ALTER TABLE `stock_records` CHANGE `increment_equiv` `increment_equiv` DECIMAL(18,2) NULL DEFAULT '0.00';
=======
>>>>>>> a4a333f0da876a93c807c2d7f12b0c367c9b62e3
