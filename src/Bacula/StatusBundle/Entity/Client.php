<?php

/**
 * &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
 * Entity class of table Client
 * 
 * @author Evaldo Prestes de Oliveira <evaldoprestes@yahoo.com.br>
 * @copyright (c) 2014
 * 
 * The Client table contains one entry for each machine backed up by Bacula in 
 * this database. Normally the Name is a fully qualified domain name.
 * &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
 */

namespace Bacula\StatusBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Bacula\StatusBundle\Repository\ClientRepository")
 * @ORM\Table(name="Client")
 */
class Client {

    /**
     * @ORM\Column(name="ClientId", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $clientId;

    /**
     * @ORM\Column(name="Name", type="blob", nullable=false)
     */
    private $name;

    /**
     * @ORM\Column(name="UName", type="blob", nullable=false)
     */
    private $UName;

    /**
     * @ORM\Column(name="AutoPrune", type="smallint")
     * 
     */
    private $autoPrune;

    /**
     * @ORM\Column(name="FileRetention", type="bigint")
     * 
     */
    private $fileRetention;

    /**
     * @ORM\Column(name="JobRetention", type="bigint")
     * 
     */
    private $jobRetention;

    public function getClientId() {
        return $this->clientId;
    }

    public function getName() {
        return $this->name;
    }

    public function getUName() {
        return $this->UName;
    }

    public function getAutoPrune() {
        return $this->autoPrune;
    }

    public function getFileRetention() {
        return $this->fileRetention;
    }

    public function getJobRetention() {
        return $this->jobRetention;
    }

    public function setClientId($clientId) {
        $this->clientId = $clientId;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setUName($UName) {
        $this->UName = $UName;
    }

    public function setAutoPrune($autoPrune) {
        $this->autoPrune = $autoPrune;
    }

    public function setFileRetention($fileRetention) {
        $this->fileRetention = $fileRetention;
    }

    public function setJobRetention($jobRetention) {
        $this->jobRetention = $jobRetention;
    }

    public function __toString() {
        return (string)$this->getName();
    }

}

?>
