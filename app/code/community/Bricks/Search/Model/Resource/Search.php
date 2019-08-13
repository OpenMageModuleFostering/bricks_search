<?php

class Bricks_Search_Model_Resource_Search extends Mage_Core_Model_Resource_Db_Abstract {
	protected function _construct() {
		$this->_init('bricks_search/search', 'id');
	}
}
