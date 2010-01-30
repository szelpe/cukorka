<?php

class frontendConfiguration extends sfApplicationConfiguration {
    public function configure() {
    }

    public function configureDoctrine(Doctrine_Manager $manager) {
        //Adding my own Doctrine_Collection class
        $manager->setAttribute(Doctrine::ATTR_COLLECTION_CLASS, 'cukorkaCollection');
    }
}
