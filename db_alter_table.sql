ALTER TABLE `proposals` ADD `offer_guarantee_type` VARCHAR(10) NULL AFTER `offer_guarantee`;
ALTER TABLE `proposals` ADD `same_pro` VARCHAR(100) NULL AFTER `offer_guarantee_type`;
ALTER TABLE `proposals` ADD `deal_value` decimal(18,2) NULL AFTER `same_pro`;
ALTER TABLE `proposals` ADD `financial_power` decimal(18,2) NULL AFTER `deal_value`;
ALTER TABLE `proposals` ADD `receive_office` boolean NULL AFTER `financial_power`;
ALTER TABLE `proposals` ADD `bank_distribute` boolean NULL AFTER `receive_office`;
