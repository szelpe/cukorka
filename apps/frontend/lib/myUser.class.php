<?php

class myUser extends sfGuardSecurityUser {
    /**
     * Initializes the sfGuardSecurityUser object.
     *
     * @param sfEventDispatcher $dispatcher The event dispatcher object
     * @param sfStorage $storage The session storage object
     * @param array $options An array of options
     */
    public function initialize(sfEventDispatcher $dispatcher, sfStorage $storage, $options = array()) {
        parent::initialize($dispatcher, $storage, $options);
        $this->setCulture('hu');
    }

    public function getId() {
        return $this->getGuardUser()->id;
    }
}
