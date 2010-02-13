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
    var $homeworkForm;
    
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
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeShowLecture(sfWebRequest $request) {
        $this->lecture = $this->getRoute()->getObject();
        $this->course = $this->lecture->Course;
        $this->homeworkForm = new HomeworkForm();
        $this->aidForm = new AidForm();
        
        
        if($request->isMethod('POST')) {
            if($request->getPostParameter('aid')) {
                $this->executeUploadAid($request);
            } else if($request->getPostParameter('homework')) {
                $this->executeUploadHomework($request);
            }
        }
        
        $this->setVar('lecture', $this->lecture);
        $this->setVar('course', $this->course);
        $this->setVar('form', $this->homeworkForm);
        $this->setVar('aidForm', $this->aidForm);
        $this->setVar('user', $this->user);
        
        if($this->user && $this->user->isLecturer($this->course)) {
            sfDynamics::load('cukorka.rateselector');
        }
    }
    
    public function executeListLectures(sfWebRequest $request) {
        $this->course = $this->getRoute()->getObject();
        $this->setVar('course', $this->course);
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
    
    public function executeUploadHomework(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod('POST'));

        $dest = $this->getHomeworkPath();
        $this->homeworkForm->getValidator('file')->setOption('path', $dest);
        
        $this->homeworkForm->bind($request->getParameter('homework'), $request->getFiles('homework'));
        
        if($this->homeworkForm->isValid()) {
            
            
            //kitöröljük az előzőekben feltöltött házifeladatot
            $this->deletePrevUploadedHomework();
            
            $this->homeworkForm->updateObject($this->getObjectData());
            $this->homeworkForm->save();
            
            $this->getUser()->setFlash('message', 'Sikeresen feltöltötted a házifeladatodat!');
            $this->redirect($request->getUri());
        }
    }
    
    public function executeUploadAid(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod('POST'));
        
        $dest = $this->getHomeworkPath('aids', '');
        $this->aidForm->getValidator('file')->setOption('path', $dest);
        
        $this->aidForm->bind($request->getPostParameter('aid'), $request->getFiles('aid'));
        
        if($this->aidForm->isValid()) {
            $this->aidForm->updateObject($this->getObjectData());
            $this->aidForm->save();
            
            $this->getUser()->setFlash('message', 'Sikeresen feltöltötted a segédanyagot!');
            $this->redirect($request->getUri());
        }        
    }
    
    protected function deletePrevUploadedHomework() {
        
        $this->homework = Doctrine_Query::create()
                ->from('Homework')
                ->where('uploader_id = ?', $this->user->id)
                ->andWhere('lecture_id = ?', $this->lecture->id)
                ->fetchOne();
        
        if($this->homework) {
            $filename = $this->homework->file;
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
    protected function getHomeworkPath($folder = 'homeworks', $filename = '') {
        $uploadDir = sfFinder::type('directory')
                ->name('uploads')
                ->in(dirname(__FILE__) . '/../../../../../web');
        
        return $uploadDir[0] . '/' . $folder . '/'
                . $this->course->url . '/'
                . $this->lecture->url . '/'
                . $this->user->username . '/'
                . $filename;
    }
    
    public function executeAjaxRateHomework(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $this->forward404Unless($request->isMethod('POST'));
        
        $homework_id = $request->getPostParameter('homework_id');
        $rate = $request->getPostParameter('rate');
        
        $homework = Doctrine::getTable('Homework')->findOneBy('id', $homework_id);
        $homework->rate = $rate == 0 ? null : $rate;
        $homework->save();
        
        echo "Sikeresen módosítottad az értékelést.";
        
        return sfView::NONE;
    }
    
}
