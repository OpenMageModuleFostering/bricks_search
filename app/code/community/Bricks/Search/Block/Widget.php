<?php

class Bricks_Search_Block_Widget extends Mage_Core_Block_Template implements Mage_Widget_Block_Interface {
	protected function _prepareLayout() {
		$this->setTemplate('bricks/search/widget.phtml');
		return parent::_prepareLayout();
	}
}