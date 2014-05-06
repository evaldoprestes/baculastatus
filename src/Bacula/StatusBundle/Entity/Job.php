<?php

/**
 * &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
 * Entity class of table Job
 * 
 * @author Evaldo Prestes de Oliveira <evaldoprestes@yahoo.com.br>
 * @copyright (c) 2014
 * &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
 */

namespace Bacula\StatusBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Bacula\StatusBundle\Repository\JobRepository")
 * @ORM\Table(name="Job")
 */
class Job {

    /**
     * @ORM\Column(name="JobId", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $jobId;
    
    /**
     * @ORM\Column(name="Job", type="blob", nullable=false)
     */    
    private $job;
    
    /**
     * @ORM\Column(name="Name", type="blob", nullable=false)
     */    
    private $name;
    
    /**
     * @ORM\Column(name="PurgedFiles", type="boolean", nullable=false)
     */      
    private $purgedFiles;
    
    /**
     * @ORM\Column(name="Type", type="string" , length=1, nullable=false)
     */      
    private $type;
    
    /**
     * @ORM\Column(name="Level", type="string" , length=1, nullable=false)
     */      
    private $level;
    
    /**
     * @ORM\Column(name="ClientId", type="integer", nullable=true)
     */      
    private $clientId;
    
    /**
     * @ORM\Column(name="JobStatus", type="string" , length=1, nullable=false)
     */    
    private $jobStatus;
    
    /**
     * @ORM\Column(name="SchedTime", type="datetime", nullable=true)
     */      
    private $schedTime;

    /**
     * @ORM\Column(name="StartTime", type="datetime", nullable=true)
     */          
    private $startTime;
    
    /**
     * @ORM\Column(name="EndTime", type="datetime", nullable=true)
     */          
    private $endTime;
    
    /**
     * @ORM\Column(name="RealEndTime", type="datetime", nullable=true)
     */          
    private $realEndTime;
    
    /**
     * @ORM\Column(name="JobTDate", type="bigint", nullable=true)
     */     
    private $jobTDate;
    
    /**
     * @ORM\Column(name="VolSessionId", type="integer", nullable=true)
     */      
    private $volSessionId;
    
    /**
     * @ORM\Column(name="VolSessionTime", type="integer", nullable=true)
     */      
    private $volSessionTime;
    
    /**
     * @ORM\Column(name="JobFiles", type="integer", nullable=true)
     */      
    private $jobFiles;
    
    /**
     * @ORM\Column(name="JobBytes", type="bigint", nullable=true)
     */       
    private $jobBytes;
    
    /**
     * @ORM\Column(name="JobErrors", type="integer", nullable=true)
     */      
    private $jobErrors;
    
    /**
     * @ORM\Column(name="JobMissingFiles", type="integer", nullable=true)
     */      
    private $jobMissingFiles;

    /**
     * @ORM\Column(name="PoolId", type="integer", nullable=true)
     */        
    private $poolId;

    /**
     * @ORM\Column(name="FileSetId", type="integer", nullable=true)
     */     
    private $fileSetId;
   
    /**
     * @ORM\Column(name="PriorJobId", type="integer", nullable=true)
     */     
    private $priorJobId;
    
    /**
     * @ORM\Column(name="HasBase", type="boolean", nullable=true)
     */    
    private $hasBase;
    
    public function getJobId() {
        return $this->jobId;
    }

    public function getJob() {
        return $this->job;
    }

    public function getName() {
        return $this->name;
    }

    public function getPurgedFiles() {
        return $this->purgedFiles;
    }

    public function getType() {
        return $this->type;
    }

    public function getLevel() {
        return $this->level;
    }

    public function getClientId() {
        return $this->clientId;
    }

    public function getJobStatus() {
        return $this->jobStatus;
    }

    public function getSchedTime() {
        return $this->schedTime;
    }

    public function getStartTime() {
        return $this->startTime;
    }

    public function getEndTime() {
        return $this->endTime;
    }

    public function getRealEndTime() {
        return $this->realEndTime;
    }

    public function getJobTDate() {
        return $this->jobTDate;
    }

    public function getVolSessionId() {
        return $this->volSessionId;
    }

    public function getVolSessionTime() {
        return $this->volSessionTime;
    }

    public function getJobFiles() {
        return $this->jobFiles;
    }

    public function getJobBytes() {
        return $this->jobBytes;
    }

    public function getJobErrors() {
        return $this->jobErrors;
    }

    public function getJobMissingFiles() {
        return $this->jobMissingFiles;
    }

    public function getPoolId() {
        return $this->poolId;
    }

    public function getFileSetId() {
        return $this->fileSetId;
    }

    public function getPrioJobId() {
        return $this->prioJobId;
    }

    public function getHasBase() {
        return $this->hasBase;
    }

    public function setJobId($jobId) {
        $this->jobId = $jobId;
    }

    public function setJob($job) {
        $this->job = $job;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setPurgedFiles($purgedFiles) {
        $this->purgedFiles = $purgedFiles;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function setLevel($level) {
        $this->level = $level;
    }

    public function setClientId($clientId) {
        $this->clientId = $clientId;
    }

    public function setJobStatus($jobStatus) {
        $this->jobStatus = $jobStatus;
    }

    public function setSchedTime($schedTime) {
        $this->schedTime = $schedTime;
    }

    public function setStartTime($startTime) {
        $this->startTime = $startTime;
    }

    public function setEndTime($endTime) {
        $this->endTime = $endTime;
    }

    public function setRealEndTime($realEndTime) {
        $this->realEndTime = $realEndTime;
    }

    public function setJobTDate($jobTDate) {
        $this->jobTDate = $jobTDate;
    }

    public function setVolSessionId($volSessionId) {
        $this->volSessionId = $volSessionId;
    }

    public function setVolSessionTime($volSessionTime) {
        $this->volSessionTime = $volSessionTime;
    }

    public function setJobFiles($jobFiles) {
        $this->jobFiles = $jobFiles;
    }

    public function setJobBytes($jobBytes) {
        $this->jobBytes = $jobBytes;
    }

    public function setJobErrors($jobErrors) {
        $this->jobErrors = $jobErrors;
    }

    public function setJobMissingFiles($jobMissingFiles) {
        $this->jobMissingFiles = $jobMissingFiles;
    }

    public function setPoolId($poolId) {
        $this->poolId = $poolId;
    }

    public function setFileSetId($fileSetId) {
        $this->fileSetId = $fileSetId;
    }

    public function setPrioJobId($prioJobId) {
        $this->prioJobId = $prioJobId;
    }

    public function setHasBase($hasBase) {
        $this->hasBase = $hasBase;
    }


}    
?>
