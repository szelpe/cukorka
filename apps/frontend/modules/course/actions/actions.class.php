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
     * @var HomeworkForm
     */
    var $form;

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
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeShowLecture(sfWebRequest $request) {
        $this->lecture = $this->getRoute()->getObject();
        $this->course = $this->lecture->Course;
        $this->form = new HomeworkForm();


        if($request->isMethod('POST')) {
            $file = $request->getFiles('homework');
            $data = $request->getParameter('homework');

            $dest = $this->getHomeworkPath();
            $this->form->getValidator('filename')->setOption('path', $dest);
            
            $this->form->bind($data, $file);

            if($this->form->isValid()) {

                //kitöröljük az előzőekben feltöltött házifeladatot
                $this->deletePrevUploadedHomework();

                //adatbázis írása
                $values = array(
                        'user_id' => $this->user->id,
                        'lecture_id' => $this->lecture->id,
                        'date' => date('Y-m-d H:i:s')
                );

                $this->form->updateObject($values);
                $this->form->save();

                $this->getUser()->setFlash('message', 'Sikeresen feltöltötted a házifeladatodat!');
                $this->redirect($request->getUri());
            }
        }

        $this->setVar('lecture', $this->lecture);
        $this->setVar('course', $this->course);
        $this->setVar('form', $this->form);
        $this->setVar('user', $this->user);

        if($this->user && $this->user->isLecturer($this->course)) {
            sfDynamics::load('cukorka.rateselector');
        }
    }

    public function executeListLectures(sfWebRequest $request) {
        $this->course = $this->getRoute()->getObject();
        $this->setVar('course', $this->course);
    }

    protected function deletePrevUploadedHomework() {

        $this->homework = Doctrine_Query::create()
                ->from('Homework')
                ->where('user_id = ?', $this->user->id)
                ->andWhere('lecture_id = ?', $this->lecture->id)
                ->fetchOne();

        if($this->homework) {
            $filename = $this->homework->filename;
            $this->homework->delete();
            @unlink($this->getHomeworkPath($filename));
        }


    }

    /**
     * Returns the full path to the file
     *
     * @param string $filename
     * @return string
     */
    protected function getHomeworkPath($filename = '') {
        $uploadDir = sfFinder::type('directory')
                ->name('uploads')
                ->in(dirname(__FILE__) . '/../../../../../web');

        return $uploadDir[0] . '/homeworks/'
                . $this->course->url . '/'
                . $this->lecture->url . '/'
                . $this->user->username . '/'
                . $filename;
    }

    public function executeAjaxRateHomework(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $homework_id = $request->getPostParameter('homework_id');
        $rate = $request->getPostParameter('rate');

        $homework = Doctrine::getTable('Homework')->findOneBy('id', $homework_id);
        $homework->rate = $rate == 0 ? null : $rate;
        $homework->save();

        echo "Sikeresen módosítottad az értékelést.";

        return sfView::NONE;
    }

}
