<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of componentsclass
 *
 * @author szel
 */
class profileComponents extends sfComponents {

    /**
     * @return sfGuardSecurityUser
     */
    function getUser() {
        return parent::getUser();
    }

    public function executeLoginBox(sfWebRequest $request) {
        if(!$this->getUser()->isAuthenticated()) {
            $this->loginForm = new sfGuardFormSignin();
        }
    }
}
?>
