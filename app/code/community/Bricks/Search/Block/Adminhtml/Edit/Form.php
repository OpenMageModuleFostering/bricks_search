<?php

class Bricks_Search_Block_Adminhtml_Edit_Form extends Mage_Adminhtml_Block_Widget_Form {
	public function __construct() {
		parent::__construct();
		$this->setId('search_keywords_form');
		$this->setTitle(Mage::helper('bricks_search')->__('Update Keyword'));
	}

	public function _prepareForm() {
		$helper = Mage::helper('bricks_search');
		$model = Mage::registry('search_keyword');

		$form = new Varien_Data_form(array(
			'id'	 => 'edit_form',
			'action' => $this->getUrl('*/*/update', array('id' => $this->getRequest()->getParam('id'))),
			'method' => 'post'
		));

		$fieldset = $form->addFieldSet('base_fieldset', array(
			'legend' => $helper->__('Edit Keyword: ') . $model->getTerm()
		));

		$fieldset->addField('url', 'text', array(
			'name'	 => 'url',
			'label'	 => $helper->__('URL'),
			'title'	 => $helper->__('URL')
		));
		$fieldset->addField('category_name', 'text', array(
			'name'	 => 'category_name',
			'label'	 => $helper->__('Category'),
			'title'	 => $helper->__('Categiry')
		));

		$form->setValues($model->getData());
		$form->setUseContainer(true);
		$this->setForm($form);

		parent::_prepareForm();
		return $this;
	}
}