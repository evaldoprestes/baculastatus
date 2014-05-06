<?php

/**
 * &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
 * Entity class of table JobMedia
 * 
 * @author Evaldo Prestes de Oliveira <evaldoprestes@yahoo.com.br>
 * @copyright (c) 2014
 * 
 * 
 * The JobMedia table contains one entry at the following: start of the job, 
 * start of each new tape file, start of each new tape, end of the job. Since 
 * by default, a new tape file is written every 2GB, in general, you will have 
 * more than 2 JobMedia records per Job. The number can be varied by changing 
 * the "Maximum File Size" specified in the Device resource. This record allows 
 * Bacula to efficiently position close to (within 2GB) any given file in a 
 * backup. For restoring a full Job, these records are not very important, but 
 * if you want to retrieve a single file that was written near the end of a 
 * 100GB backup, the JobMedia records can speed it up by orders of magnitude 
 * by permitting forward spacing files and blocks rather than reading the whole 
 * 100GB backup.
 * &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
 */

namespace Bacula\StatusBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="JobMedia")
 */
class JobMedia {

    /**
     * @ORM\Column(name="JobMediaId", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $jobMediaId;
    
    /**
     * @ORM\Column(name="JobId", type="integer", nullable=false)
     */         
    private $jobId;
    
    /**
     * @ORM\Column(name="MediaId", type="integer", nullable=false)
     */         
    private $mediaId;
    
    /**
     * @ORM\Column(name="FirstIndex", type="integer", nullable=true)
     */         
    private $firstIndex;

    /**
     * @ORM\Column(name="LastIndex", type="integer", nullable=true)
     */             
    private $lastIndex;
    
    /**
     * @ORM\Column(name="StartFile", type="integer", nullable=true)
     */             
    private $startFile;
    
    /**
     * @ORM\Column(name="EndFile", type="integer", nullable=true)
     */             
    private $endFile;
    
    /**
     * @ORM\Column(name="StartBlock", type="integer", nullable=true)
     */             
    private $startBlock;
    
    /**
     * @ORM\Column(name="EndBlock", type="integer", nullable=true)
     */             
    private $endBlock;
    
    /**
     * @ORM\Column(name="VolIndex", type="integer", nullable=true)
     */             
    private $volIndex;
           
    
    public function getJobMediaId() {
        return $this->jobMediaId;
    }

    public function getJobId() {
        return $this->jobId;
    }

    public function getMediaId() {
        return $this->mediaId;
    }

    public function getFirstIndex() {
        return $this->firstIndex;
    }

    public function getLastIndex() {
        return $this->lastIndex;
    }

    public function getStartFile() {
        return $this->startFile;
    }

    public function getEndFile() {
        return $this->endFile;
    }

    public function getStartBlock() {
        return $this->startBlock;
    }

    public function getEndBlock() {
        return $this->endBlock;
    }

    public function getVolIndex() {
        return $this->volIndex;
    }

    public function setJobMediaId($jobMediaId) {
        $this->jobMediaId = $jobMediaId;
    }

    public function setJobId($jobId) {
        $this->jobId = $jobId;
    }

    public function setMediaId($mediaId) {
        $this->mediaId = $mediaId;
    }

    public function setFirstIndex($firstIndex) {
        $this->firstIndex = $firstIndex;
    }

    public function setLastIndex($lastIndex) {
        $this->lastIndex = $lastIndex;
    }

    public function setStartFile($startFile) {
        $this->startFile = $startFile;
    }

    public function setEndFile($endFile) {
        $this->endFile = $endFile;
    }

    public function setStartBlock($startBlock) {
        $this->startBlock = $startBlock;
    }

    public function setEndBlock($endBlock) {
        $this->endBlock = $endBlock;
    }

    public function setVolIndex($volIndex) {
        $this->volIndex = $volIndex;
    }

    
}    
?>
