<?php

/* @var $installer Bricks_Search_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();

/* @var $adapter Varien_Db_Adapter_Pdo_Mysql */
$adapter = $installer->getConnection();

$searchTable = $adapter->newTable($installer->getTable('bricks_search/search'));
$searchTable
	->addColumn('id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
		'identity' => true,
		'unsigned' => true,
		'nullable' => false,
		'primary'  => true
	))
	->addColumn('term', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
		'nullable' => false
	))
	->addColumn('category_name', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
		'nullable' => false
	))
	->addColumn('url', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
		'nullable' => false
	))
	->addIndex($installer->getIdxName('bricks_search/search', array('id', 'category_name')), array('id', 'category_name'))
	->addIndex($installer->getIdxName('bricks_search/search', 'term', Varien_Db_Adapter_Interface::INDEX_TYPE_UNIQUE), 'term', array(
		'type' => Varien_Db_Adapter_Interface::INDEX_TYPE_UNIQUE
	));
$adapter->createTable($searchTable);

$installer->endSetup();
