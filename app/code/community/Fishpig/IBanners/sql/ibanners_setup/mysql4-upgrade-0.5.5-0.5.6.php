<?php
/**
 * @category    Fishpig
 * @package     Fishpig_iBanners
 * @license     http://fishpig.co.uk/license.txt
 * @author      Ben Tideswell <help@fishpig.co.uk>
 */

	$this->startSetup();
	
	$this->getConnection()->addColumn($this->getTable('ibanners_group'), 'carousel_duration', " int(3) unsigned default NULL");
	$this->getConnection()->addColumn($this->getTable('ibanners_group'), 'carousel_auto', " int(1) unsigned default NULL");
	$this->getConnection()->addColumn($this->getTable('ibanners_group'), 'carousel_frequency', " int(3) unsigned default NULL");
	$this->getConnection()->addColumn($this->getTable('ibanners_group'), 'carousel_visible_slides', " int(3) unsigned default NULL");
	$this->getConnection()->addColumn($this->getTable('ibanners_group'), 'carousel_effect', " varchar(32) NOT NULL default ''");
	$this->getConnection()->addColumn($this->getTable('ibanners_group'), 'carousel_transition', " varchar(32) NOT NULL default ''");

	$this->endSetup();
