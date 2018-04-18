<?php
/**
 * @category    Fishpig
 * @package     Fishpig_AttributeSplash
 * @license     http://fishpig.co.uk/license.txt
 * @author      Ben Tideswell <help@fishpig.co.uk>
 */

class Fishpig_IBanners_Block_Adminhtml_Dashboard extends Mage_Adminhtml_Block_Widget_Tabs
{
	public function __construct()
	{
		parent::__construct();
		
		$this->setId('ibanners_dashboard_tabs');
        $this->setDestElementId('ibanners_tab_content');
		$this->setTitle($this->__('iBanners'));
		$this->setTemplate('widget/tabshoriz.phtml');
	}
	
	protected function _prepareLayout()
	{
		$tabs = array(
			'group' => 'Groups',
			'banner' => 'Banners',
		);
		
		$_layout = $this->getLayout();
		
		foreach($tabs as $alias => $label) {
			$this->addTab($alias, array(
				'label'     => Mage::helper('catalog')->__($label),
				'content'   => $_layout->createBlock('ibanners/adminhtml_' . $alias)->toHtml(),
				'active'    => $alias === 'banner',
			));
		}
		
		return parent::_prepareLayout();
	}
}
