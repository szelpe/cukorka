<?php

/**
 * CheckIn form.
 *
 * @package    cukorka
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CheckInForm extends BaseCheckInForm {

    /**
     *
     * @return sfGuardSecurityUser
     */
    protected function getUser() {
        return sfContext::getInstance()->getUser();
    }
    public function configure() {
        $this->widgetSchema['motivation'] = new sfWidgetFormTextareaTinyMCE(
                array()
                ,
                array(
                        'rows' => 15,
                        'cols' => 50
                )
        );
        if(!$this->getUser()->isAuthenticated()) {
            $this->embedRelation('User');
            $this->useFields(array('User', 'motivation'));
            $this->widgetSchema['User']->setLabel('Felhasználó adatai');
        } else {
            $this->useFields(array('motivation'));
        }

        $this->widgetSchema['motivation']->setLabel('Motiváció');
    }

    public function render($attributes = array()) {
        sfDynamics::load('tinyMCE');
        return parent::render($attributes);
    }
}
