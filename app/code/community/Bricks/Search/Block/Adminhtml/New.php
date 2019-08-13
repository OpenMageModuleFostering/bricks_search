<?php

class Bricks_Search_Block_Adminhtml_New extends Mage_Adminhtml_Block_Widget_Form_Container {
	public function __construct() {
		$this->_blockGroup = 'bricks_search';
		$this->_controller = 'adminhtml';
		$this->_mode = 'new';
		parent::__construct();
		$this->_updateButton('save', 'label', 'Upload');
		$this->_removeButton('reset');
	}

	public function getHeaderText() {
		return Mage::helper('bricks_search')->__('Upload Keywords');
	}
}