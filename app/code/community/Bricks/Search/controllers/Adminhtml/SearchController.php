<?php

class Bricks_Search_Adminhtml_SearchController extends Mage_Adminhtml_Controller_Action {

	/* Index Action */
	public function indexAction() {
		$this->_commonSetup()->renderLayout();
		return $this;
	}

	/* Grid Action */
	public function gridAction() {
		$this->_commonSetup()->renderLayout();
		return $this;
	}

	/* Add Action */
	public function newAction() {
		$this->_commonSetup()->renderLayout();
	}

	/* Edit Action */
	public function editAction() {
		$id = $this->getRequest()->getParam('id');
		$model = Mage::getModel('bricks_search/search');
		try {
			$model->load($id);
		} catch (Exception $ex) {
			Mage::logException($ex);
		}

		if ($model->getId()) {
			Mage::register('search_keyword', $model);
			$this->_commonSetup()
				->_title( $this->__( 'Edit' ) )
				->renderLayout();
		} else {
			$this->_redirect('*/*/');
		}
	}

	/* Save Action */
	public function saveAction() {
		$request = $this->getRequest();

		if ($request->getPost()) {
			try {
				$uploader = new Varien_File_Uploader('csvupload');
				$uploader->setAllowedExtensions(array('csv'));
				$finfo = finfo_open(FILEINFO_MIME_TYPE);
    			$mime = finfo_file($finfo, $_FILES['csvupload']['tmp_name']);
				if ( $uploader->checkMimeType( array('text/csv','text/plain') ) || ($mime=='text/plain' || $mime=='text/csv')) {
					$file = $_FILES['csvupload'];
					$csv = new Varien_File_Csv();
					foreach ( $csv->getData($file['tmp_name']) as $data ) {
						$category = array_shift($data);
						$url = array_shift($data);
						foreach ($data as $keyword) {
							if (empty($keyword)) {
								continue;
							}
							try {
								Mage::getModel('bricks_search/search')
									->setData(array(
										'category_name'	 => $category,
										'url'			 => $url,
										'term'			 => $keyword
									))
									->save();
							} catch (Exception $ex) {
								Mage::logException($ex);
							}
						}
					}
				}
			} catch (Exception $ex) {
				Mage::logException($ex);
			}
		}

		$this->_redirect('*/*/');
	}

	/* Update Action */
	public function updateAction() {
		$request = $this->getRequest();

		if ($request->getPost()) {
			$id = $request->getParam('id');
			$model = Mage::getModel('bricks_search/search');
			try {
				$model->load($id);
				if ($model->getId()) {
					$model->setData('category_name', $request->getPost('category_name'));
					$model->setData('url', $request->getPost('url'));
					$model->save();
					$this->_getSession()->addSuccess( Mage::helper('bricks_search')->__('Keyword Updated.') );
				}
			} catch ( Mage_Core_Exception $ex ) {
				$this->_getSession()->addError( $ex->getMessage() );
			} catch (Exception $ex) {
				Mage::logException($ex);
			}
		}

		$this->_redirect('*/*/');
	}

	/* Delete Action */
	public function deleteAction() {
		$id = $this->getRequest()->getParam( 'id' );
		if ( $id ) {
			$model = Mage::getModel('bricks_search/search');
			foreach( (array) $id as $_id ) {
				try {
					$model->load( $_id )->delete();
				} catch ( Mage_Core_Exception $ex ) {
					$this->_getSession()->addError( $ex->getMessage() );
				} catch( Exception $ex ) {
					Mage::logException( $ex );
				}
			}
		}

		$this->_redirect('*/*/');
	}

	/**
	 * Load layout
	 *
	 * @param mixed $handles
	 * @return self
	 */
	protected function _commonSetup($handles = null) {
		$helper = Mage::helper('bricks_search');
		$this->loadLayout($handles)
			->_setActiveMenu('adminhtml/search')
			->_title($helper->__('Search Keywords'));

		Mage::dispatchEvent($this->getFullActionName() . '_before');

		return $this;
	}
}
