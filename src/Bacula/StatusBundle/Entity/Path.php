<?php

/**
 * &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
 * Entity class of table Path
 * 
 * @author Evaldo Prestes de Oliveira <evaldoprestes@yahoo.com.br>
 * @copyright (c) 2014
 * &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
 */

namespace Bacula\StatusBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Path")
 */
class Path {

    /**
     * @ORM\Column(name="PathId", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $pathId;
    
    /**
     * @ORM\Column(name="Path", type="blob", nullable=false)
     */
    private $path;
    
    public function getPathId() {
        return $this->pathId;
    }

    public function getPath() {
        return $this->path;
    }

    public function setPathId($pathId) {
        $this->pathId = $pathId;
    }

    public function setPath($path) {
        $this->path = $path;
    }



    
}    