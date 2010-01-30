<?php

/**
 * Aid form base class.
 *
 * @method Aid getObject() Returns the current form's model object
 *
 * @package    cukorka
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseAidForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'course_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Course'), 'add_empty' => false)),
      'uploader_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Uploader'), 'add_empty' => false)),
      'filename'    => new sfWidgetFormInputText(),
      'date'        => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'course_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Course'))),
      'uploader_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Uploader'))),
      'filename'    => new sfValidatorString(array('max_length' => 128)),
      'date'        => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('aid[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Aid';
  }

}
