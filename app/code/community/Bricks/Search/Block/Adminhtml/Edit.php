<?php

class Bricks_Search_Block_Adminhtml_Edit extends Mage_Adminhtml_Block_Widget_Form_Container {
	public function __construct() {
		$this->_blockGroup = 'bricks_search';
		$this->_controller = 'adminhtml';
		parent::__construct();
	}

	public function getHeaderText() {
		return Mage::helper('bricks_search')->__('Edit Keyword');
	}
}