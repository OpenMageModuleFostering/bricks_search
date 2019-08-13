<?php

class Bricks_Search_Block_Adminhtml_New_Form extends Mage_Adminhtml_Block_Widget_Form {
	public function __construct() {
		parent::__construct();
		$this->setId('search_keywords_form');
		$this->setTitle(Mage::helper('bricks_search')->__('Upload Keywords'));
	}

	public function _prepareForm() {
		$helper = Mage::helper('bricks_search');

		$form = new Varien_Data_Form(array(
			'id'		 => 'edit_form',
			'action'	 => $this->getUrl('*/*/save'),
			'method'	 => 'post',
			'enctype'	 => 'multipart/form-data'
		));

		$fieldset = $form->addFieldset('base_fieldset', array(
			'legend' => $helper->__('Upload')
		));

		$fieldset->addField('csvupload', 'file', array(
			'name'		 => 'csvupload',
			'label'		 => $helper->__('File'),
			'title'		 => $helper->__('File'),
			'required'	 => true
		));

		$form->setUseContainer(true);
		$this->setForm($form);

		parent::_prepareForm();
		return $this;
	}
}