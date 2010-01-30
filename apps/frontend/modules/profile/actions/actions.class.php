<?php

/**
 * profile actions.
 *
 * @package    cukorka
 * @subpackage profile
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 * @property sfWebResponse $response
 */
class profileActions extends sfActions {
    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeView(sfWebRequest $request) {
        $this->user = $this->_getAccount($request);
        $this->response->setTitle($this->user->Profile->full_name . ' Profilja');

    }

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeEdit(sfWebRequest $request) {
        $this->user = $this->_getAccount($request);
        $this->form = new sfGuardUserForm($this->user);

        if($request->isMethod('post')) {
            $this->form->bind($request->getParameter('sf_guard_user'));
            if($this->form->isValid() && $this->form->save()) {
                $this->getUser()->setFlash('message', 'Sikeres adatmódosítás');
                $this->redirect($request->getUri());
            }
        }
    }

    /**
     *
     * @param sfWebRequest $request
     * @return sfGuardUser
     */
    private function _getAccount(sfWebRequest $request) {
        if($request->getParameter('id') == null) {
            return $this->getUser()->getGuardUser();
        } else {
            return Doctrine::getTable('sfGuardUser')->findOneBy('id', $request->getParameter('id'));
        }
    }

}
