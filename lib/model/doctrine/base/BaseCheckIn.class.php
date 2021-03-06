<?php

/**
 * BaseCheckIn
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $user_id
 * @property integer $course_id
 * @property text $motivation
 * @property datetime $date_of_check_in
 * @property sfGuardUser $User
 * @property Course $Course
 * 
 * @method integer     getId()               Returns the current record's "id" value
 * @method integer     getUserId()           Returns the current record's "user_id" value
 * @method integer     getCourseId()         Returns the current record's "course_id" value
 * @method text        getMotivation()       Returns the current record's "motivation" value
 * @method datetime    getDateOfCheckIn()    Returns the current record's "date_of_check_in" value
 * @method sfGuardUser getUser()             Returns the current record's "User" value
 * @method Course      getCourse()           Returns the current record's "Course" value
 * @method CheckIn     setId()               Sets the current record's "id" value
 * @method CheckIn     setUserId()           Sets the current record's "user_id" value
 * @method CheckIn     setCourseId()         Sets the current record's "course_id" value
 * @method CheckIn     setMotivation()       Sets the current record's "motivation" value
 * @method CheckIn     setDateOfCheckIn()    Sets the current record's "date_of_check_in" value
 * @method CheckIn     setUser()             Sets the current record's "User" value
 * @method CheckIn     setCourse()           Sets the current record's "Course" value
 * 
 * @package    cukorka
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7021 2010-01-12 20:39:49Z lsmith $
 */
abstract class BaseCheckIn extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('check_in');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => '4',
             ));
        $this->hasColumn('user_id', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => '4',
             ));
        $this->hasColumn('course_id', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => '4',
             ));
        $this->hasColumn('motivation', 'text', null, array(
             'type' => 'text',
             'notnull' => 'ture',
             ));
        $this->hasColumn('date_of_check_in', 'datetime', null, array(
             'type' => 'datetime',
             'notnull' => true,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('sfGuardUser as User', array(
             'local' => 'user_id',
             'foreign' => 'id',
             'onDelete' => 'cascade'));

        $this->hasOne('Course', array(
             'local' => 'course_id',
             'foreign' => 'id',
             'onDelete' => 'cascade'));
    }
}