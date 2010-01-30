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

    public function postExecute() {
        $this->response->setSlot('sidebar', $this->getPartial('sidebar', array('course' => $this->course)));
    }
    /**
     *
     * @var HomeworkForm
     */
//    var $form;
    /**
     *
     * @var Homework
     */
    var $homework;

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
            $data = $request->getPostParameter('homework');

            $this->form->bind($data, $file);
            
            if($this->form->isValid()) {

                //fájl másolása
                $uploadDir = sfFinder::type('directory')->name('uploads')->in(dirname(__FILE__) . '/../../../../../web');
                $dest = $uploadDir[0] . '/homeworks/' . $this->course->url . '/' . $this->lecture->url . '/' . $this->getUser()->getGuardUser()->username . '/' . $file['filename']['name'];
                $filesystem = new sfFilesystem();
                $filesystem->copy($file['filename']['tmp_name'], $dest );

                //adatbázis írása
                $values = array(
                        'filename' => $file['filename']['name'],
                        'user_id' => $this->getUser()->getId(),
                        'lecture_id' => $this->lecture->id,
                        'rate' => 0,
                        'date' => date('Y-m-d H:i:s')
                );
                
                $this->homework = $this->form->updateObject();
                $this->homework->fromArray($values);
                $this->homework->save();

                $this->getUser()->setFlash('message', 'Sikeresen feltöltötted a házifeladatodat!');
                $this->redirect('/' . $this->course->url . '/' . $this->lecture->url );
            }
        }
    }

    public function executeListLectures(sfWebRequest $request) {
        $this->course = $this->getRoute()->getObject();
    }

}
