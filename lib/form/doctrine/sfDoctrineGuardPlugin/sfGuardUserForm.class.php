<?php

/**
 * sfGuardUser form.
 *
 * @package    cukorka
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrinePluginFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class sfGuardUserForm extends PluginsfGuardUserForm {
    public function configure() {
        $this->useFields(array('username', 'password'));
        $this->widgetSchema['password'] = new sfWidgetFormInputPassword();
        $this->widgetSchema['password_check'] = new sfWidgetFormInputPassword();

        $profileForm = new ProfileForm();
        $this->embedForm('Profile', $profileForm);
        $this->embedRelation('Profile');
        
        $this->validatorSchema['password']->setOption('min_length', 5);
        $this->validatorSchema['password_check'] = new sfValidatorString();
        
        $postValidator = new sfValidatorAnd(array(
            $this->validatorSchema->getPostValidator(),
            new sfValidatorSchemaCompare('password', '==', 'password_check')
        ));
    
        $this->validatorSchema->setPostValidator($postValidator);

        $this->widgetSchema->setLabels(array(
            'username'    => 'Felhasználónév',
            'password' => 'Jelszó',
            'password_check' => 'Jelszó mégegyszer',
            'Profile' => 'Személyes Adatok',
        ));
    }
}
