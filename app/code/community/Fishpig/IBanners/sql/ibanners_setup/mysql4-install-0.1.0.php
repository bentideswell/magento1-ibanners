<?php
/**
 * @category    Fishpig
 * @package     Fishpig_iBanners
 * @license     http://fishpig.co.uk/license.txt
 * @author      Ben Tideswell <help@fishpig.co.uk>
 */

	$this->startSetup();
	
	$this->run("
	
		DROP TABLE IF EXISTS {$this->getTable('ibanners_group')};		
		CREATE TABLE IF NOT EXISTS {$this->getTable('ibanners_group')} (
			`group_id` int(11) unsigned NOT NULL auto_increment,
			`store_id` int(11) unsigned NOT NULL default 0,
			`title` varchar(255) NOT NULL default '',
			`code` varchar(32) NOT NULL default '',
			`is_enabled` tinyint(1) unsigned NOT NULL default 1,
			PRIMARY KEY (`group_id`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8;

		DROP TABLE IF EXISTS {$this->getTable('ibanners_banner')};
		CREATE TABLE IF NOT EXISTS {$this->getTable('ibanners_banner')} (
			`banner_id` int(11) unsigned NOT NULL auto_increment,
			`group_id` int (11) unsigned NOT NULL default 0,
			`title` varchar(255) NOT NULL default '',
			`url` varchar(255) NOT NULL default '',
			`image` varchar(255) NOT NULL default '',
			`alt_text` varchar(255) NOT NULL default '',
			`sort_order` tinyint(3) unsigned NOT NULL default 1,
			`is_enabled` tinyint(1) unsigned NOT NULL default 1,
			KEY `FK_GROUP_ID_BANNER` (`group_id`),
			CONSTRAINT `FK_GROUP_ID_BANNER` FOREIGN KEY (`group_id`) REFERENCES `{$this->getTable('ibanners_group')}` (`group_id`) ON DELETE CASCADE ON UPDATE CASCADE,
			PRIMARY KEY (`banner_id`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8;

		ALTER TABLE {$this->getTable('ibanners_group')} ADD UNIQUE (code, store_id);
		
		INSERT INTO {$this->getTable('ibanners_group')} (store_id, title, code, is_enabled) VALUES (0, 'Homepage', 'home', 1);

	");
	
	$this->endSetup();
