<?php
/**
 * @category    Fishpig
 * @package     Fishpig_iBanners
 * @license     http://fishpig.co.uk/license.txt
 * @author      Ben Tideswell <help@fishpig.co.uk>
 */

	$this->startSetup();
	
	$this->getConnection()->addColumn($this->getTable('ibanners_banner'), 'url_target', " varchar(32) NOT NULL default ''");

	$this->endSetup();
