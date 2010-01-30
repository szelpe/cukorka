<?php

/**
 * Description of CourseRouteclass
 *
 * @author szel
 */
class LectureRoute extends sfDoctrineRoute {

    public function matchesUrl($url, $context = array()) {

        if(false === ($param = parent::matchesUrl($url, $context))) {
            return false;
        }

        $lecture = Doctrine_Query::create()
            ->from('Lecture l, Course c')
            ->select('l.*')
            ->where('l.course_id = c.id')
            ->andWhere('l.url = ?', $param['lecture_url'])
            ->andWhere('c.url = ?', $param['course_url'])
            ->fetchOne();


        if($lecture === false) {
            return false;
        }

        return array_merge($param, array('id' => $lecture->id));
    }

    protected function getRealVariables() {
        return array_merge(array('id'), parent::getRealVariables());
    }

    protected function doConvertObjectToArray($object) {
        $parameters = parent::doConvertObjectToArray($object);

        unset($parameters['id']);

        return $parameters;
    }
}
?>
