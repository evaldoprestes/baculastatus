<?php

/**
 * &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
 * Entity class of table Log
 * 
 * @author Evaldo Prestes de Oliveira <evaldoprestes@yahoo.com.br>
 * @copyright (c) 2014
 * &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
 */

namespace Bacula\StatusBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Bacula\StatusBundle\Repository\LogRepository")
 * @ORM\Table(name="Log")
 */
class Log {

    /**
     * @ORM\Column(name="LogId", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $logId;
    
    /**
     * @ORM\Column(name="JobId", type="integer", nullable=true)
     */      
    private $jobId;
    
    /**
     * @ORM\Column(name="Time", type="datetime", nullable=true)
     */          
    private $time;    
    
    /**
     * @ORM\Column(name="LogText", type="blob", nullable=false)
     */    
    private $logText;    
    
    public function getLogId() {
        return $this->logId;
    }

    public function getJobId() {
        return $this->jobId;
    }

    public function getTime() {
        return $this->time;
    }

    public function getLogText() {
        return $this->logText;
    }

    public function setLogId($logId) {
        $this->logId = $logId;
    }

    public function setJobId($jobId) {
        $this->jobId = $jobId;
    }

    public function setTime($time) {
        $this->time = $time;
    }

    public function setLogText($logText) {
        $this->logText = $logText;
    }


}    
?>
