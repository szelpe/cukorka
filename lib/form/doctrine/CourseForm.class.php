<?php

require_once dirname(__FILE__) . '/../../../apps/backend/lib/transliteration.php';

/**
 * Course form.
 *
 * @package    cukorka
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CourseForm extends BaseCourseForm {
    public function configure() {
        $this->widgetSchema['url'] = new sfWidgetFormInputHidden();
        $this->widgetSchema['students_list']->setOption('renderer_class' , 'sfWidgetFormSelectDoubleList');
        $this->widgetSchema['lecturers_list']->setOption('renderer_class' , 'sfWidgetFormSelectDoubleList');
    }

    public function bind(array $taintedValues = null, array $taintedFiles = null) {
        $taintedValues['url'] = transliteration_clean_filename($taintedValues['title'], 'hun');
        parent::bind($taintedValues, $taintedFiles);
    }
}
