<?php
/**
 * @category    Fishpig
 * @package     Fishpig_iBanners
 * @license     http://fishpig.co.uk/license.txt
 * @author      Ben Tideswell <help@fishpig.co.uk>
 */

class Fishpig_iBanners_Adminhtml_iBanners_GroupController extends Fishpig_iBanners_Controller_Adminhtml_Abstract
{
	/**
	 * Redirect to iBanners dashboard
	 *
	 * @return $this
	 */
	public function indexAction()
	{
		return $this->_redirect('*/iBanners');
	}
	
	/**
	 * Forward to the edit action so the user can add a new group
	 *
	 */
	public function newAction()
	{
		$this->_forward('edit');
	}
	
	/**
	 * Display the edit/add form
	 *
	 */
	public function editAction()
	{
		$group = $this->_initGroupModel();
		
		$this->loadLayout();
		
		if ($headBlock = $this->getLayout()->getBlock('head')) {
			$titles = array('iBanners by FishPig');
			
			if ($group) {
				array_unshift($titles, $group->getTitle());
			}
			else {
				array_unshift($titles, 'Create a Group');
			}

			$headBlock->setTitle(implode(' - ', $titles));
		}
		
		$this->renderLayout();
	}
	
	/**
	 * Save the group
	 *
	 */
	public function saveAction()
	{
		if ($data = $this->getRequest()->getPost('group')) {
			$group = Mage::getModel('ibanners/group')
				->setData($data)
				->setId($this->getRequest()->getParam('id'));
			
			try {
				$group->save();
				$this->_getSession()->addSuccess($this->__('Banner Group was saved'));
			}
			catch (Exception $e) {
				$this->_getSession()->addError($e->getMessage());
				Mage::logException($e);
			}
			
			if ($this->getRequest()->getParam('back') && $group->getId()) {
				$this->_redirect('*/*/edit', array('id' => $group->getId()));
				return;
			}
		}
		else {
			$this->_getSession()->addError($this->__('There was no data to save'));
		}
		
		$this->_redirect('*/iBanners');
	}
	
	/**
	 * Delete a ibanners group
	 *
	 */
	public function deleteAction()
	{
		if ($groupId = $this->getRequest()->getParam('id')) {
			$group = Mage::getModel('ibanners/group')->load($groupId);
			
			if ($group->getId()) {
				try {
					$group->delete();
					$this->_getSession()->addSuccess($this->__('The banner group was deleted.'));
				}
				catch (Exception $e) {
					$this->_getSession()->addError($e->getMessage());
				}
			}
		}
		
		$this->_redirect('*/iBanners');
	}
	
	/**
	 * Delete multiple ibanners groups in one go
	 *
	 */
	public function massDeleteAction()
	{
		$groupIds = $this->getRequest()->getParam('group');

		if (!is_array($groupIds)) {
			$this->_getSession()->addError($this->__('Please select some groups.'));
		}
		else {
			if (!empty($groupIds)) {
				try {
					foreach ($groupIds as $groupId) {
						$group = Mage::getSingleton('ibanners/group')->load($groupId);
	
						Mage::dispatchEvent('ibanners_controller_group_delete', array('ibanners_group' => $group));
	
						$group->delete();
					}
					
					$this->_getSession()->addSuccess($this->__('Total of %d record(s) have been deleted.', count($groupIds)));
				}
				catch (Exception $e) {
					$this->_getSession()->addError($e->getMessage());
				}
			}
		}
		
		$this->_redirect('*/iBanners');
	}
	
	/**
	 * Initialise the group model
	 *
	 * @return null|Fishpig_iBanners_Model_Group
	 */
	protected function _initGroupModel()
	{
		if ($groupId = $this->getRequest()->getParam('id')) {
			$group = Mage::getModel('ibanners/group')->load($groupId);
			
			if ($group->getId()) {
				Mage::register('ibanners_group', $group);
			}
		}
		
		return Mage::registry('ibanners_group');
	}
	
	/**
	 * Determine ACL permissions
	 *
	 * @return bool
	 */
	protected function _isAllowed()
	{
		return true;
	}
}