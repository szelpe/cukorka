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
        $this->widgetSchema['displayHomeworkForm'] = new sfWidgetFormInputCheckbox();
        $this->widgetSchema['homeworktask'] = new sfWidgetFormTextarea();
    }

    public function bind(array $taintedValues = null, array $taintedFiles = null) {
        $taintedValues['url'] = transliteration_clean_filename($taintedValues['title'], 'hun');
        $taintedValues['displayHomeworkForm'] = isset($taintedValues['displayHomeworkForm']);
        parent::bind($taintedValues, $taintedFiles);
    }
}
