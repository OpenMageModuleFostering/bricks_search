<?php

class Bricks_Search_Block_Adminhtml_Search extends Mage_Adminhtml_Block_Widget_Grid_Container {
	protected $_addButtonLabel = 'Upload';

	public function __construct() {
		parent::__construct();
		$this->_blockGroup = 'bricks_search';
		$this->_controller = 'adminhtml';
		$this->_headerText = Mage::helper('bricks_search')->__('Search Keywords');

		return $this;
	}
}
