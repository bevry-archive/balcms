<?php

/**
 * Base_InvoiceDataBackup
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property array $data
 * @property integer $Invoice_id
 * @property Invoice $Invoice
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class Base_InvoiceDataBackup extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('invoice_data_backup');
        $this->hasColumn('id', 'integer', 2, array(
             'type' => 'integer',
             'primary' => true,
             'unsigned' => true,
             'autoincrement' => true,
             'length' => '2',
             ));
        $this->hasColumn('data', 'array', null, array(
             'type' => 'array',
             'notnull' => true,
             ));
        $this->hasColumn('Invoice_id', 'integer', 2, array(
             'type' => 'integer',
             'unsigned' => true,
             'length' => '2',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Invoice', array(
             'local' => 'Invoice_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}