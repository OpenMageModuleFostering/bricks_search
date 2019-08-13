<?php

class Bricks_Search_Block_Adminhtml_Grid extends Mage_Adminhtml_Block_Widget_Grid {
	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct();
		$this->setId('search_keywrods')
			->setDefaultSort('id')
			->setDefaultDir('DESC')
			->setUseAjax(true)
			->setSaveParametersInSession(true);
	}

	/**
	 * Prepare Collection for the Grid
	 *
	 * @return type
	 */
	public function _prepareCollection() {
		$collection = Mage::getModel('bricks_search/search')->getCollection();
		$this->setCollection($collection);
		return parent::_prepareCollection();
	}

	/**
	 * Return item edit URL
	 *
	 * @param Mage_Core_Model_Abstract $item
	 * @return string
	 */
	public function getRowUrl($item) {
		return $this->getUrl('*/*/edit', array('id' => $item->getId()));
	}

	public function getGridUrl() {
		return $this->getUrl( '*/*/grid', array( '_current' => true ) );
	}

	protected function _prepareColumns() {
		$helper = Mage::helper('bricks_search');
		$this
			->addColumn('id', array(
				'header'	 => $helper->__('id'),
				'width'		 => '50px',
				'index'		 => 'id',
				'sortable'	 => true
			))
			->addColumn('url', array(
				'header'	 => $helper->__('URL'),
				'index'		 => 'url',
				'sortable'	 => false
			))
			->addColumn('category_name', array(
				'header'	 => $helper->__('Category Name'),
				'index'		 => 'category_name',
				'sortable'	 => true
			))
			->addColumn('keyword', array(
				'header'	 => $helper->__('Keyword'),
				'index'		 => 'term',
				'sortable'	 => true
			));

		parent::_prepareColumns();
		return $this;
	}

	protected function _prepareMassaction() {
		$this->setMassactionIdField( 'id' );
		$this->getMassactionBlock()->setFormFieldName( 'id' );
		$this->getMassactionBlock()->addItem( 'delete', array(
			'label'		 => Mage::helper('bricks_search')->__('Delete'),
			'url'		 => $this->getUrl('*/*/delete', array('' => '')),
			'confirm'	 => Mage::helper('bricks_search')->__('Are you sure')
		) );

		parent::_prepareMassaction();
		return $this;
	}
}
