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
      'uploader_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Uploader'), 'add_empty' => false)),
      'lecture_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Lecture'), 'add_empty' => false)),
      'file'        => new sfWidgetFormInputText(),
      'date'        => new sfWidgetFormDateTime(),
      'id'          => new sfWidgetFormInputHidden(),
      'rate'        => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'uploader_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Uploader'))),
      'lecture_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Lecture'))),
      'file'        => new sfValidatorString(array('max_length' => 128)),
      'date'        => new sfValidatorDateTime(),
      'id'          => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'rate'        => new sfValidatorInteger(array('required' => false)),
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
