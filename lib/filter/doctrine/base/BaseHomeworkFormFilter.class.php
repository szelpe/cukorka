<?php

/**
 * Homework filter form base class.
 *
 * @package    cukorka
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseHomeworkFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'uploader_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Uploader'), 'add_empty' => true)),
      'lecture_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Lecture'), 'add_empty' => true)),
      'file'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'date'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'rate'        => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'uploader_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Uploader'), 'column' => 'id')),
      'lecture_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Lecture'), 'column' => 'id')),
      'file'        => new sfValidatorPass(array('required' => false)),
      'date'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'rate'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('homework_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Homework';
  }

  public function getFields()
  {
    return array(
      'uploader_id' => 'ForeignKey',
      'lecture_id'  => 'ForeignKey',
      'file'        => 'Text',
      'date'        => 'Date',
      'id'          => 'Number',
      'rate'        => 'Number',
    );
  }
}
