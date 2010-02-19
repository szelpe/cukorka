<?php

/**
 * download actions.
 *
 * @package    cukorka
 * @subpackage download
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class downloadActions extends sfActions {
    /**
     *
     * @var sfWebResponse
     */
    var $response;

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {
        $path = preg_replace('/\/uploads/', '', preg_replace('/:/', '.', $request->getPathInfo()));
        $this->response->setHttpHeader('Content-Type', 'application/force-download');
        $this->response->setHttpHeader('Content-Disposition', 'attachment; filename="' . $path . '"');
        readfile( sfConfig::get('sf_upload_dir') . $path);
        return sfView::NONE;
    }
}
