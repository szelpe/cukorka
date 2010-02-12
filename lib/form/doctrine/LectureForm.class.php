<?php

require_once dirname(__FILE__) . '/../../../apps/backend/lib/transliteration.php';

/**
 * Lecture form.
 *
 * @package    cukorka
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class LectureForm extends BaseLectureForm {
    public function configure() {
        $this->widgetSchema['url'] = new sfWidgetFormInputHidden();
    }

    public function bind(array $taintedValues = null, array $taintedFiles = null) {
        $taintedValues['url'] = transliteration_clean_filename($taintedValues['title'], 'hun');
        parent::bind($taintedValues, $taintedFiles);
    }
}
