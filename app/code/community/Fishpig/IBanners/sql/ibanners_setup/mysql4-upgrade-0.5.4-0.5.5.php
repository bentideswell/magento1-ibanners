<?php
/**
 * @category    Fishpig
 * @package     Fishpig_iBanners
 * @license     http://fishpig.co.uk/license.txt
 * @author      Ben Tideswell <help@fishpig.co.uk>
 */

	$this->startSetup();
	
	$this->run("
		ALTER TABLE {$this->getTable('ibanners_banner')} CHANGE group_id group_id  int (11) unsigned default NULL
	");

	$this->endSetup();
