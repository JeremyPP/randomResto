SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

CREATE DATABASE `randomResto` DEFAULT CHARACTER SET ;
USE `randomResto`;

CREATE TABLE IF NOT EXISTS `rr_admins` (
  `uid` int(11) NOT NULL,
  CONSTRAINT fk_user_id FOREIGN KEY (`uid`) REFERENCES rr_user(id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `rr_group` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  `admin_uid` int(11) NOT NULL,
  CONSTRAINT fk_user_id FOREIGN KEY (`uid`) REFERENCES rr_user(id),
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `rr_user` (
  `id` int(11) NOT NULL auto_increment,
  `login` varchar(20) NOT NULL,
  `pwd` varchar(40) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `photo` binary(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `rr_usersingroups` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(11) NOT NULL,
  `gid` int(11) NOT NULL,
  CONSTRAINT fk_user_id FOREIGN KEY (`uid`) REFERENCES rr_user(id),
  CONSTRAINT fk_group_id FOREIGN KEY (`gid`) REFERENCES rr_group(id),
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
