<?php

/**
 * File
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 *
 * @package    cukorka
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7021 2010-01-12 20:39:49Z lsmith $
 */
abstract class File extends BaseFile {

    /**
     * Type of the file (homework or aid)
     *
     * @var string
     */
    var $type;

    /**
     * Returns the full path to the file
     *
     * @param string $filename
     * @return string
     */
    public static function getFilePath($type, $course_url, $lecture_url, $username , $filename = '') {
        return sfConfig::get('sf_upload_dir') . '/' . $type . 's/'
                . $course_url . '/'
                . $lecture_url . '/'
                . $username . '/'
                . $filename;
    }

    public function getMyFilePath($type, $filename) {
        return self::getFilePath($type, $this->Lecture->Course->url, $this->Lecture->url, $this->Uploader->username, $filename);
    }

    /**
     * Returns the full path to the file
     *
     * @param string $filename
     * @return string
     */
    public function getFileURL() {
        return '/uploads/' . $this->type . 's/'
                . $this->Lecture->Course->url . '/'
                . $this->Lecture->url . '/'
                . $this->Uploader->username . '/'
                . $this->file;
    }
}