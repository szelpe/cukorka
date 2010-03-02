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
     * Executes view action
     *
     * @param sfRequest $request A request object
     */
    public function executeView(sfWebRequest $request) {
        $this->user = $this->_getAccount($request);
        $this->response->setTitle($this->user->Profile->full_name . ' Profilja');

    }

    /**
     * Executes edit action
     *
     * @param sfRequest $request A request object
     */
    public function executeEdit(sfWebRequest $request) {
        $this->user = $this->_getAccount($request);
        $this->redirectUnless(($this->getUser()->getId() == $this->user->id) || $this->getUser()->hasCredential('admin') , '', 404);
        $this->form = new sfGuardUserForm($this->user);
        $this->setVar('action', $request->getUri());

        if($request->isMethod('post')) {
            $this->form->bind($request->getParameter('sf_guard_user'));
            if($this->form->isValid() && $this->form->save()) {
                $this->getUser()->setFlash('message', 'Sikeres adatmódosítás');

                //ha regisztráció volt, akkor @homepage-re menjen, egyébként vissza
                $redirectUri = strstr($request->getUri(), 'register') ? $this->generateUrl('homepage') : $request->getUri();
                $this->redirect($redirectUri);
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
