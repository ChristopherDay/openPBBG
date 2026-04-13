CREATE TABLE IF NOT EXISTS `gameNews` (
  `GN_id` int(11) NOT NULL AUTO_INCREMENT,
  `GN_author` int(11) NOT NULL DEFAULT 0,
  `GN_title` varchar(120) NULL,
  `GN_text` text NULL,
  `GN_date` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`GN_id`)
) DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `mail` (
  `M_id` int(11) NOT NULL AUTO_INCREMENT,
  `M_time` int(11) NOT NULL DEFAULT 0,
  `M_uid` int(11) NOT NULL DEFAULT 0,
  `M_sid` int(11) NOT NULL DEFAULT 0,
  `M_subject` varchar(120) NULL,
  `M_parent` int(11) NOT NULL DEFAULT 0,
  `M_text` text NULL,
  `M_type` int(11) NOT NULL DEFAULT 0,
  `M_read` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`M_id`)
) DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `notifications` (
  `N_id` int(11) NOT NULL AUTO_INCREMENT,
  `N_uid` int(11) NOT NULL DEFAULT 0,
  `N_time` int(11) NOT NULL DEFAULT 0,
  `N_text` text NULL,
  `N_read` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`N_id`)
) DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `ranks` (
  `R_id` int(11) NOT NULL AUTO_INCREMENT,
  `R_name` varchar(100) NULL,
  `R_exp` int(11) NOT NULL DEFAULT 0,
  `R_limit` int(11) NOT NULL DEFAULT 0,
  `R_cashReward` int(11) NOT NULL DEFAULT 0,
  `R_health` int(11) NOT NULL DEFAULT 0,
  `R_bulletReward` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`R_id`)
) DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `settings` (
  `S_id` int(11) NOT NULL AUTO_INCREMENT,
  `S_desc` varchar(255) NULL,
  `S_value` text NULL,
  PRIMARY KEY (`S_id`)
) DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `users` (
  `U_id` int(11) NOT NULL AUTO_INCREMENT,
  `U_name` varchar(30) NULL,
  `U_email` varchar(100) NULL,
  `U_password` varchar(255) NOT NULL DEFAULT '',
  `U_userLevel` int(1) NULL,
  `U_status` int(1) NULL,
  `U_round` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`U_id`)
) DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `userStats` (
  `US_id` int(11) NOT NULL PRIMARY KEY,
  `US_shotBy` int(11) NOT NULL DEFAULT '0',
  `US_exp` int(11) NOT NULL DEFAULT '0',
  `US_money` int(11) NOT NULL DEFAULT '250',
  `US_bank` int(11) NOT NULL DEFAULT '0',
  `US_points` int(11) NOT NULL DEFAULT '0',
  `US_pic` varchar(200) NOT NULL DEFAULT 'themes/default/images/default-profile-picture.png',
  `US_bio` varchar(1000) NOT NULL DEFAULT '0',
  `US_rank` int(11) NOT NULL DEFAULT '1'
) DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `userTimers` (
  `UT_user` int(11) NOT NULL DEFAULT 0,
  `UT_desc` varchar(32) NULL,
  `UT_time` int(11) NOT NULL
) DEFAULT CHARSET=utf8;

CREATE TABLE `rounds` (
  `R_id` INT(11) AUTO_INCREMENT, 
  `R_name` VARCHAR(128), 
  `R_start` INT(11), 
  `R_end` INT(11), 
  PRIMARY KEY(`R_id`)
);

CREATE TABLE IF NOT EXISTS `roleAccess` ( 
  `RA_role` INT NOT NULL , 
  `RA_module` VARCHAR(128) NOT NULL,
  PRIMARY KEY(`RA_role`, `RA_module`)
) DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `userRoles` (
  `UR_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `UR_desc` varchar(128) NULL,
  `UR_color` varchar(7) NOT NULL
) DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `moneyRanks` ( 
  `MR_id` INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT , 
  `MR_desc` VARCHAR(128), 
  `MR_money` INT(11)
) DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `items` (
  `I_id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT , 
  `I_name` VARCHAR(128) NOT NULL ,  
  `I_type` INT(11) NOT NULL DEFAULT 0
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `premiumMembership` (
  `PM_id` int(11) NOT NULL AUTO_INCREMENT,
  `PM_desc` varchar(255) NOT NULL,
  `PM_seconds` int(11) NOT NULL,
  `PM_cost` int(11) NOT NULL,
  PRIMARY KEY (`PM_id`)
) DEFAULT CHARSET=utf8;

CREATE TABLE `userInventory` (
  `UI_user` INT(11), 
  `UI_item` INT(11), 
  `UI_qty` INT(11), 
  PRIMARY KEY(`UI_user`, `UI_item`)
);

CREATE TABLE `itemEffects` (
  `IE_effect` VARCHAR(32), 
  `IE_item` INT(11), 
  `IE_value` VARCHAR(128), 
  `IE_desc` VARCHAR(128), 
  PRIMARY KEY(`IE_effect`, `IE_item`)
);

CREATE TABLE `itemMeta` (
  `IM_item` INT(11), 
  `IM_meta` VARCHAR(32), 
  `IM_value` TEXT, 
  PRIMARY KEY(`IM_item`, `IM_meta`)
);

CREATE TABLE IF NOT EXISTS `chat` (
  `CH_id` int(11) NOT NULL AUTO_INCREMENT,
  `CH_user` int(11) NOT NULL,
  `CH_time` int(11) NOT NULL,
  `CH_text` varchar(128) NOT NULL,
  PRIMARY KEY (`CH_id`)
) DEFAULT CHARSET=utf8;