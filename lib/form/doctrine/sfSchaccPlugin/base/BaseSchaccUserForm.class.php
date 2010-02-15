<?php

/**
 * SchaccUser form base class.
 *
 * @method SchaccUser getObject() Returns the current form's model object
 *
 * @package    cukorka
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseSchaccUserForm extends sfGuardUserForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('schacc_user[%s]');
  }

  public function getModelName()
  {
    return 'SchaccUser';
  }

}
