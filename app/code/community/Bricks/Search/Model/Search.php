<?php

class Bricks_Search_Model_Search extends Mage_Core_Model_Abstract {
	protected function _construct() {
		$this->_init('bricks_search/search', 'id');
		return $this;
	}
}
