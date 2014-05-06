<?php

/**
 * &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
 * Entity class of table Filename
 * 
 * @author Evaldo Prestes de Oliveira <evaldoprestes@yahoo.com.br>
 * @copyright (c) 2014
 * &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
 */

namespace Bacula\StatusBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Bacula\StatusBundle\Repository\FilenameRepository")
 * @ORM\Table(name="Filename")
 */
class Filename {

    /**
     * @ORM\Column(name="FilenameId", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $fileNameId;
    
    /**
     * @ORM\Column(name="Name", type="blob", nullable=false)
     */
    private $name;
    
    public function getFileNameId() {
        return $this->fileNameId;
    }

    public function getName() {
        return $this->name;
    }

    public function setFileNameId($fileNameId) {
        $this->fileNameId = $fileNameId;
    }

    public function setName($name) {
        $this->name = $name;
    }

    
}    