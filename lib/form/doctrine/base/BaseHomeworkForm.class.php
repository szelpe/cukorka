<?php

/**
 * Homework form base class.
 *
 * @method Homework getObject() Returns the current form's model object
 *
 * @package    cukorka
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseHomeworkForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'user_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => false)),
      'lecture_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Lecture'), 'add_empty' => false)),
      'filename'   => new sfWidgetFormInputText(),
      'date'       => new sfWidgetFormDateTime(),
      'rate'       => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'user_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('User'))),
      'lecture_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Lecture'))),
      'filename'   => new sfValidatorString(array('max_length' => 128)),
      'date'       => new sfValidatorDateTime(),
      'rate'       => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('homework[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Homework';
  }

}
