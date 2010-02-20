<?php

/**
 * course actions.
 *
 * @package    cukorka
 * @subpackage course
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 * @property sfWebResponse $response
 */
class courseActions extends sfActions {

    public function preExecute() {
        $this->user = $this->getUser()->getGuardUser();
    }

    public function postExecute() {
        $this->response->setSlot('sidebar', $this->getPartial('sidebar', array('course' => $this->course)));
    }
    /**
     *
     * @var array
     */
    var $forms;

    /**
     *
     * @var AidForm
     */
    var $aidForm;

    /**
     *
     * @var Homework
     */
    var $homework;

    /**
     *
     * @var Lecture
     */
    var $lecture;

    /**
     *
     * @var Course
     */
    var $course;

    /**
     *
     * @var sfGuardUser
     */
    var $user;

    /**
     * Executes listLectures action
     *
     * @param sfRequest $request A request object
     */
    public function executeListLectures(sfWebRequest $request) {
        $this->course = $this->getRoute()->getObject();
        $this->setVar('course', $this->course);
    }

    /**
     * Executes showLecture action
     *
     * @param sfRequest $request A request object
     */
    public function executeShowLecture(sfWebRequest $request) {
        $this->lecture = $this->getRoute()->getObject();
        $this->course = $this->lecture->Course;
        $this->forms['homework'] = new HomeworkForm();
        $this->forms['aid'] = new AidForm();


        if($request->isMethod('POST')) {
            $types = array_keys($request->getPostParameters());
            $this->executeUploadFile($request, $types[0]);
        }

        $this->setVar('lecture', $this->lecture);
        $this->setVar('course', $this->course);
        $this->setVar('form', $this->forms['homework']);
        $this->setVar('aidForm', $this->forms['aid']);
        $this->setVar('user', $this->user);

        if($this->user && $this->user->isLecturer($this->course)) {
            sfDynamics::load('cukorka.rateselector');
        }
    }



    /**
     *
     * @return array contains uploader_id, lectre_id and date
     */
    protected function getObjectData() {
        return array(
                'uploader_id' => $this->user->id,
                'lecture_id' => $this->lecture->id,
                'date' => date('Y-m-d H:i:s')
        );
    }

    public function executeUploadFile(sfWebRequest $request, $type) {
        $this->forward404Unless($request->isMethod('POST'));

        $dest = File::getFilePath($type, $this->course->url, $this->lecture->url, $this->user->username);
        $this->forms[$type]->getValidator('file')->setOption('path', $dest);

        $this->forms[$type]->bind($request->getParameter($type), $request->getFiles($type));

        if($this->forms[$type]->isValid()) {

            $this->forms[$type]->updateObject($this->getObjectData());
            $this->forms[$type]->save();

            $this->getUser()->setFlash('message', 'Sikeresen feltöltötted a !' . $type);
            $this->redirect($request->getUri());
        }
    }

    /**
     * Executes ajaxRateHomework action
     *
     * @param sfRequest $request A request object
     */
    public function executeAjaxRateHomework(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $this->forward404Unless($request->isMethod('POST'));

        $homework_id = $request->getPostParameter('homework_id');
        $rate = $request->getPostParameter('rate');
        
        $homework = Doctrine::getTable('Homework')->findOneBy('id', $homework_id);
        $homework->rate = $rate == 0 ? null : $rate;
        $homework->save();
        
        echo "Sikeresen módosítottad az értékelést!";

        return sfView::NONE;
    }


    public function executeCheckIn(sfWebRequest $request) {
        $this->course = $this->getRoute()->getObject();
        $this->form = new CheckInForm();
        if($request->isMethod('POST')) {
            $this->form->bind($request->getPostParameter('check_in'));

            if($this->form->isValid()) {
                $this->form->updateObject(array(
                        'user_id' => $this->getUser()->getId(),
                        'course_id' => $this->course->id,
                        'date_of_check_in' => date('Y-m-d H:i:s')
                ));
                $this->form->save();
                
                $this->getUser()->setFlash('message', 'Sikeresen jelentkeztél a tanfolyamra. Hamarosan kapsz értesítést!');
                $uri = $this->context->getRouting()->generate('course', array('url' => $this->course->url));
                $this->redirect($uri);
            }
        }

        $this->setVar('course', $this->course);
    }

}
