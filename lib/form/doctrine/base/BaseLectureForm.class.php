<?php

/**
 * Lecture form base class.
 *
 * @method Lecture getObject() Returns the current form's model object
 *
 * @package    cukorka
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseLectureForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'url'          => new sfWidgetFormInputText(),
      'course_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Course'), 'add_empty' => false)),
      'title'        => new sfWidgetFormInputText(),
      'description'  => new sfWidgetFormTextarea(),
      'homeworktask' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'url'          => new sfValidatorString(array('max_length' => 128)),
      'course_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Course'))),
      'title'        => new sfValidatorString(array('max_length' => 128)),
      'description'  => new sfValidatorString(array('max_length' => 2147483647)),
      'homeworktask' => new sfValidatorPass(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Lecture', 'column' => array('url')))
    );

    $this->widgetSchema->setNameFormat('lecture[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Lecture';
  }

}
