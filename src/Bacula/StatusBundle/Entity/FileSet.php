<?php

/**
 * &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
 * Entity class of table FileSet
 * 
 * @author Evaldo Prestes de Oliveira <evaldoprestes@yahoo.com.br>
 * @copyright (c) 2014
 * &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
 */

namespace Bacula\StatusBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="FileSet")
 */
class FileSet {
    
    /**
     * @ORM\Column(name="FileSetId", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $fileSetId;
    
    /**
     * @ORM\Column(name="FileSet", type="blob", nullable=false)
     */     
    private $fileSet;
    
    /**
     * @ORM\Column(name="MD5", type="blob", nullable=true)
     */     
    private $md5;
    
    /**
     * @ORM\Column(name="CreateTime", type="datetime", nullable=true)
     */         
    private $createTime;
    
    public function getFileSetId() {
        return $this->fileSetId;
    }

    public function getFileSet() {
        return $this->fileSet;
    }

    public function getMd5() {
        return $this->md5;
    }

    public function getCreateTime() {
        return $this->createTime;
    }

    public function setFileSetId($fileSetId) {
        $this->fileSetId = $fileSetId;
    }

    public function setFileSet($fileSet) {
        $this->fileSet = $fileSet;
    }

    public function setMd5($md5) {
        $this->md5 = $md5;
    }

    public function setCreateTime($createTime) {
        $this->createTime = $createTime;
    }


}

?>
