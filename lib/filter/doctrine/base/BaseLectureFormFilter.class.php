<?php

/**
 * Lecture filter form base class.
 *
 * @package    cukorka
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseLectureFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'url'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'course_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Course'), 'add_empty' => true)),
      'title'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'description'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'homeworktask' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'url'          => new sfValidatorPass(array('required' => false)),
      'course_id'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Course'), 'column' => 'id')),
      'title'        => new sfValidatorPass(array('required' => false)),
      'description'  => new sfValidatorPass(array('required' => false)),
      'homeworktask' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('lecture_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Lecture';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'url'          => 'Text',
      'course_id'    => 'ForeignKey',
      'title'        => 'Text',
      'description'  => 'Text',
      'homeworktask' => 'Text',
    );
  }
}
