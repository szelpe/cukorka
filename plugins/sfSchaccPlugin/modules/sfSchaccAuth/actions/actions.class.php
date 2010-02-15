<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
*/

require_once(dirname(__FILE__).'/../../../lib/adLDAP.php');
require_once(dirname(__FILE__).'/../../../../sfDoctrineGuardPlugin/modules/sfGuardAuth/actions/actions.class.php');

/**
 *
 * @package    symfony
 * @subpackage plugin
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: BasesfGuardAuthActions.class.php 23800 2009-11-11 23:30:50Z Kris.Wallsmith $
 */
class sfSchaccAuthActions extends sfGuardAuthActions {
    public function executeSignin($request) {
        $this->form = new sfGuardFormSignin();
        if ($request->isMethod('post')) {
            $data = $request->getParameter('signin');

            $adldap = new adLDAP(array(
                            'account_suffix' => '@sch.bme.hu',
                            'domain_controllers' => array('152.66.208.42'),
                            'ad_username' => $data['username'],
                            'ad_password' => $data['password']
            ));
            try {
                $authUser = $adldap->authenticate($data['username'], $data['password']);
                if ($authUser === true) {
                    $userData = $adldap->user_info($data['username']);
                    $user = Doctrine::getTable('sfGuardUser')->findOneBy('username', $data['username']);

                    $save = false;
                    if($user) {
                        if($user->Profile->full_name != $userData[0]["displayname"][0] || $user->Profile->email != $userData[0]["mail"][0]) {
                            $save = true;
                        }
                    } else {
                        $user = new sfGuardUser();
                        $save = true;
                    }

                    if($save) {
                        $user->username = $data['username'];
                        $user->password = $data['password'];
                        $user->Profile->full_name = $userData[0]["displayname"][0];
                        $user->Profile->email = $userData[0]["mail"][0];
                        $user->save();
                    }
                }
                
            }
            catch(Exception $e) {
                echo $e;
            }


        }
        parent::executeSignin($request);
    }
}
