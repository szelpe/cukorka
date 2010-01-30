<?php

/**
 * CourseLecturer form base class.
 *
 * @method CourseLecturer getObject() Returns the current form's model object
 *
 * @package    cukorka
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseCourseLecturerForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'course_id'   => new sfWidgetFormInputHidden(),
      'lecturer_id' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'course_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'course_id', 'required' => false)),
      'lecturer_id' => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'lecturer_id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('course_lecturer[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CourseLecturer';
  }

}
