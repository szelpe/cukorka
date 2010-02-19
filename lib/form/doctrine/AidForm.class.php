<?php

/**
 * Aid form.
 *
 * @package    cukorka
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AidForm extends BaseAidForm
{
  public function configure()
  {
      $this->useFields(array('title', 'file'));
      $this->widgetSchema['file'] = new sfWidgetFormInputFile(array(
          'label' => ' '
      ));

      $this->validatorSchema['file'] = new sfValidatorFile(array(
          'max_size' => '2000000',
          'validated_file_class' => 'myValidatedFile'
      ));
  }
}
