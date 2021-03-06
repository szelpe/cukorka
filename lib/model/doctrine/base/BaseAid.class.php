<?php

/**
 * BaseAid
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $title
 * @property Lecture $Lecture
 * @property sfGuardUser $Uploader
 * 
 * @method integer     getId()       Returns the current record's "id" value
 * @method string      getTitle()    Returns the current record's "title" value
 * @method Lecture     getLecture()  Returns the current record's "Lecture" value
 * @method sfGuardUser getUploader() Returns the current record's "Uploader" value
 * @method Aid         setId()       Sets the current record's "id" value
 * @method Aid         setTitle()    Sets the current record's "title" value
 * @method Aid         setLecture()  Sets the current record's "Lecture" value
 * @method Aid         setUploader() Sets the current record's "Uploader" value
 * 
 * @package    cukorka
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7021 2010-01-12 20:39:49Z lsmith $
 */
abstract class BaseAid extends File
{
    public function setTableDefinition()
    {
        parent::setTableDefinition();
        $this->setTableName('aid');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => '4',
             ));
        $this->hasColumn('title', 'string', 128, array(
             'type' => 'string',
             'notnull' => true,
             'length' => '128',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Lecture', array(
             'local' => 'lecture_id',
             'foreign' => 'id',
             'onDelete' => 'cascade'));

        $this->hasOne('sfGuardUser as Uploader', array(
             'local' => 'uploader_id',
             'foreign' => 'id'));
    }
}