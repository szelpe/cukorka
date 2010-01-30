<?php

/**
 * Profile form.
 *
 * @package    cukorka
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ProfileForm extends BaseProfileForm
{
  public function configure()
  {
      $this->useFields(array('full_name', 'email'));
      $this->validatorSchema['email'] = new sfValidatorEmail((array('max_length' => 128)));

      $this->widgetSchema->setLabels(array(
            'email'   => 'E-mail cím:',
            'full_name' => 'Teljes név:',
        ));
  }
}
