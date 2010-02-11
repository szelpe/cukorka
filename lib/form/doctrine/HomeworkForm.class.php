<?php

/**
 * Homework form.
 *
 * @package    cukorka
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class HomeworkForm extends BaseHomeworkForm
{
  public function configure()
  {
      $this->widgetSchema['filename'] = new sfWidgetFormInputFile(array(
          'label' => ' '
      ));
      
      $this->validatorSchema['filename'] = new sfValidatorFile(array(
          'max_size' => '200000',
          'mime_types' => array('application/zip', 'application/x-tar-gz', 'application/x-rar-compressed'),
          'validated_file_class' => 'myValidatedFile'
      ));

      $this->useFields(array('filename'));
  }
}
