<?php

/**
 * CourseStudent form base class.
 *
 * @method CourseStudent getObject() Returns the current form's model object
 *
 * @package    cukorka
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseCourseStudentForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'course_id'  => new sfWidgetFormInputHidden(),
      'student_id' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'course_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'course_id', 'required' => false)),
      'student_id' => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'student_id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('course_student[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CourseStudent';
  }

}
