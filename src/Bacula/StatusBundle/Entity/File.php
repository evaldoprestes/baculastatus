<?php

/**
 * &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
 * Entity class of table File
 * 
 * @author Evaldo Prestes de Oliveira <evaldoprestes@yahoo.com.br>
 * @copyright (c) 2014
 * &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
 */

namespace Bacula\StatusBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Bacula\StatusBundle\Repository\FileRepository")
 * @ORM\Table(name="File")
 */
class File {

    /**
     * @ORM\Column(name="FileId", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $fileId;

    /**
     * @ORM\Column(name="FileIndex", type="integer", nullable=true)
     */
    private $fileIndex;

    /**
     * @ORM\Column(name="JobId", type="integer", nullable=false)
     */
    private $jobId;

    /**
     * @ORM\Column(name="PathId", type="integer", nullable=false)
     */
    private $pathId;

    /**
     * @ORM\Column(name="FilenameId", type="integer", nullable=false)
     */
    private $fileNameId;

    /**
     * @ORM\Column(name="MarkId", type="integer", nullable=true)
     */
    private $markId;

    /**
     * @ORM\Column(name="LStat", type="blob", nullable=false)
     */
    private $LStat;
    
    /**
     * @ORM\Column(name="MD5", type="blob", nullable=true)
     */    
    private $md5;

    public function getFileId() {
        return $this->fileId;
    }

    public function getFileIndex() {
        return $this->fileIndex;
    }

    public function getJobId() {
        return $this->jobId;
    }

    public function getPathId() {
        return $this->pathId;
    }

    public function getFileNameId() {
        return $this->fileNameId;
    }

    public function getMarkId() {
        return $this->markId;
    }

    public function getLStat() {
        return $this->LStat;
    }

    public function getMd5() {
        return $this->md5;
    }

    public function setFileId($fileId) {
        $this->fileId = $fileId;
    }

    public function setFileIndex($fileIndex) {
        $this->fileIndex = $fileIndex;
    }

    public function setJobId($jobId) {
        $this->jobId = $jobId;
    }

    public function setPathId($pathId) {
        $this->pathId = $pathId;
    }

    public function setFileNameId($fileNameId) {
        $this->fileNameId = $fileNameId;
    }

    public function setMarkId($markId) {
        $this->markId = $markId;
    }

    public function setLStat($LStat) {
        $this->LStat = $LStat;
    }

    public function setMd5($md5) {
        $this->md5 = $md5;
    }

    
    
}

?>
