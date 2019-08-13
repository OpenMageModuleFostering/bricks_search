<?php

class Bricks_Search_AjaxController extends Mage_Core_Controller_Front_Action {
	public function indexAction() {
		if (!$this->getRequest()->getParam('q', false)) {
			$this->getResponse()->setRedirect(Mage::getSingleton('core/url')->getBaseUrl());
		}

		$q = $this->getRequest()->getParam('q');
		/* @var $collection Bricks_Search_Model_Resource_Search_Collection */
		$collection = Mage::getModel('bricks_search/search')->getCollection();
		$collection->addFieldToFilter('term', array('like' => '%' . str_replace('%', '\%', $q) . '%'));

		$this->getResponse()->setHeader('Content-Type', 'application/json');
		$searchResults = array();
		foreach ($collection->getItems() as $item) {
			$searchResults[] = array(
				'term'		 => $item->getTerm(),
				'url'		 => $item->getUrl(),
				'category'	 => $item->getCategory()
			);
		}
		$this->getResponse()->setBody(Mage::helper('core')->jsonEncode($searchResults));
	}
}