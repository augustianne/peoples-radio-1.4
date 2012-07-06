
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- community
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `community`;


CREATE TABLE `community`
(
	`track_id` INTEGER(11)  NOT NULL,
	`channel_id` INTEGER(11)  NOT NULL,
	`play_count` SMALLINT(6),
	`sequence` SMALLINT(6)   AUTO_INCREMENT,
	PRIMARY KEY (`track_id`,`channel_id`),
	KEY `community_track_id`(`track_id`),
	CONSTRAINT `community_FK_1`
		FOREIGN KEY (`track_id`)
		REFERENCES `track` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	INDEX `community_FI_2` (`channel_id`),
	CONSTRAINT `community_FK_2`
		FOREIGN KEY (`channel_id`)
		REFERENCES `channel` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- channel
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `channel`;


CREATE TABLE `channel`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(300),
	`port` VARCHAR(4),
	`slug` VARCHAR(300),
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- channel_track
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `channel_track`;


CREATE TABLE `channel_track`
(
	`track_id` INTEGER(11)  NOT NULL,
	`channel_id` INTEGER(11)  NOT NULL,
	PRIMARY KEY (`track_id`),
	KEY `channel_track_id`(`track_id`),
	CONSTRAINT `channel_track_FK_1`
		FOREIGN KEY (`track_id`)
		REFERENCES `track` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	INDEX `channel_track_FI_2` (`channel_id`),
	CONSTRAINT `channel_track_FK_2`
		FOREIGN KEY (`channel_id`)
		REFERENCES `channel` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- track
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `track`;


CREATE TABLE `track`
(
	`id` INTEGER(11)  NOT NULL AUTO_INCREMENT,
	`filename` VARCHAR(255)  NOT NULL,
	`name` VARCHAR(255),
	`artist` VARCHAR(255),
	`time` VARCHAR(10),
	`genre` VARCHAR(45),
	`cover` VARCHAR(300),
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- track_vote
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `track_vote`;


CREATE TABLE `track_vote`
(
	`track_id` INTEGER(10)  NOT NULL,
	`channel_id` INTEGER(11)  NOT NULL,
	`all_votes` INTEGER(11),
	`temp_votes` INTEGER(11),
	PRIMARY KEY (`track_id`,`channel_id`),
	KEY `track_vote_id`(`track_id`),
	CONSTRAINT `track_vote_FK_1`
		FOREIGN KEY (`track_id`)
		REFERENCES `track` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	INDEX `track_vote_FI_2` (`channel_id`),
	CONSTRAINT `track_vote_FK_2`
		FOREIGN KEY (`channel_id`)
		REFERENCES `channel` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
)Type=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
