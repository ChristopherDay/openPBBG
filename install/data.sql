
INSERT INTO `gameNews` (`GN_id`, `GN_author`, `GN_title`, `GN_text`, `GN_date`) VALUES
(1, 1, 'Instalation Complete', 'GL v2 successfully installed', UNIX_TIMESTAMP());


INSERT INTO `notifications` (`N_time`, `N_id`, `N_uid`, `N_text`, `N_read`) VALUES
(UNIX_TIMESTAMP(), 1, 1, 'GL V2 installed successfully', 0);

INSERT INTO `ranks` (`R_id`, `R_name`, `R_exp`, `R_limit`, `R_cashReward`, `R_bulletReward`, `R_health`) VALUES
(1, 'Lowlife', 0, 0, 75, 25, 5000),
(2, 'Thug', 50, 0, 150, 60, 10000),
(3, 'Criminal', 100, 0, 250, 100, 15000);

INSERT INTO `rounds` VALUES (NULL, "Round 1", UNIX_TIMESTAMP() - UNIX_TIMESTAMP() % 86400, UNIX_TIMESTAMP() - UNIX_TIMESTAMP() % 86400 + (60 * 86400));


INSERT INTO `settings` (`S_desc`, `S_value`) VALUES
('pointsName', 'Points'),
('detectiveReport', '2'),
('gangName', 'Gang');

INSERT INTO `userRoles` (`UR_id`, `UR_desc`, `UR_color`) VALUES
(1, 'User', '#777777'),
(2, 'Admin', '#FFFFFF'),
(3, 'Banned', '#FF0000');

INSERT INTO `roleAccess` (`RA_role`, `RA_module`) VALUES (2, '*');

INSERT INTO `moneyRanks` (`MR_id`, `MR_desc`, `MR_money`) VALUES
(1, "Broke", 0),
(2, "Very Poor", 10000),
(3, "Poor", 100000),
(4, "Rich", 1000000),
(5, "Very Rich", 10000000);
