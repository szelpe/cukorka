<?php

/**
 * SchaccUser filter form base class.
 *
 * @package    cukorka
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedInheritanceTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseSchaccUserFormFilter extends sfGuardUserFormFilter
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('schacc_user_filters[%s]');
  }

  public function getModelName()
  {
    return 'SchaccUser';
  }
}
