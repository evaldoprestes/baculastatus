<?php

/**
 * &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
 * Entity class of table Storage
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
 * @ORM\Entity
 * @ORM\Table(name="Storage")
 */
class Storage {

    /**
     * @ORM\Column(name="StorageId", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $storageId;
    
    /**
     * @ORM\Column(name="Name", type="blob", nullable=false)
     */    
    private $name;
    
    /**
     * @ORM\Column(name="AutoChanger", type="boolean", nullable=true)
     */       
    private $autoChanger;
    
    public function getStorageId() {
        return $this->storageId;
    }

    public function getName() {
        return $this->name;
    }

    public function getAutoChanger() {
        return $this->autoChanger;
    }

    public function setStorageId($storageId) {
        $this->storageId = $storageId;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setAutoChanger($autoChanger) {
        $this->autoChanger = $autoChanger;
    }


    
}       
?>
