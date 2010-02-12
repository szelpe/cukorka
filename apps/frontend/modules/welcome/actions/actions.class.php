<?php

/**
 * welcome actions.
 *
 * @package    cukorka
 * @subpackage welcome
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class welcomeActions extends sfActions {
/**
 * Executes index action
 *
 * @param sfRequest $request A request object
 */
    public function executeIndex(sfWebRequest $request) {
        $this->courses = Doctrine::getTable('Course')->findAll();
        $this->loginForm = 'alma';
    }
}