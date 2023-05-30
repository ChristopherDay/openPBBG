CREATE TABLE IF NOT EXISTS `chat` (
  `CH_id` int(11) NOT NULL AUTO_INCREMENT,
  `CH_user` int(11) NOT NULL,
  `CH_time` int(11) NOT NULL,
  `CH_text` varchar(128) NOT NULL,
  PRIMARY KEY (`CH_id`)
) DEFAULT CHARSET=utf8;