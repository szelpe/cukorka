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
        $file = sfConfig::get('sf_upload_dir') . $path;
        if (file_exists($file)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename='.basename($file));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            ob_clean();
            flush();
            readfile($file);
            exit;
        }
        return sfView::NONE;
    }
}
