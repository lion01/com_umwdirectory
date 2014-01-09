CREATE TABLE IF NOT EXISTS `#__umwdirectory_employee` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`asset_id` INT(10) UNSIGNED NOT NULL DEFAULT '0',

`pidm` INT(6)  NOT NULL ,
`ordering` INT(11)  NOT NULL ,
`state` TINYINT(1)  NOT NULL ,
`fname` VARCHAR(50)  NOT NULL ,
`lname` VARCHAR(50)  NOT NULL ,
`pname` VARCHAR(50)  NOT NULL ,
`biography` TEXT NOT NULL ,
`title` VARCHAR(150)  NOT NULL ,
`department` TEXT NOT NULL ,
`phone` VARCHAR(15)  NOT NULL ,
`email` VARCHAR(255)  NOT NULL ,
`fax` VARCHAR(12)  NOT NULL ,
`address` VARCHAR(80)  NOT NULL ,
`mailbox` VARCHAR(15)  NOT NULL ,
`city` VARCHAR(50)  NOT NULL ,
`zipcode` VARCHAR(15)  NOT NULL ,
`state_province_region` VARCHAR(50)  NOT NULL ,
`user_account` INT(11)  NOT NULL ,
`checked_out` INT(11)  NOT NULL ,
`checked_out_time` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
`created_by` INT(11)  NOT NULL ,
`created_date` DATETIME NOT NULL ,
`modified_by` INT(11)  NOT NULL ,
`modified_date` DATETIME NOT NULL ,
`image` VARCHAR(255)  NOT NULL ,
`image_alt_text` VARCHAR(255)  NOT NULL ,
`image_caption` VARCHAR(255)  NOT NULL ,
PRIMARY KEY (`id`)
) DEFAULT COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `#__umwdirectory_department` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`asset_id` INT(10) UNSIGNED NOT NULL DEFAULT '0',

`ordering` INT(11)  NOT NULL ,
`state` TINYINT(1)  NOT NULL ,
`checked_out` INT(11)  NOT NULL ,
`checked_out_time` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
`created_by` INT(11)  NOT NULL ,
`department` INT(11)  NOT NULL ,
PRIMARY KEY (`id`)
) DEFAULT COLLATE=utf8_general_ci;

