<?php

/**
 * &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
 * Entity class of table Pool
 * 
 * @author Evaldo Prestes de Oliveira <evaldoprestes@yahoo.com.br>
 * @copyright (c) 2014
 * 
 * 
 * The Pool table contains one entry for each media pool controlled by Bacula 
 * in this database. One media record exists for each of the NumVols contained 
 * in the Pool. The PoolType is a Bacula defined keyword. The MediaType is 
 * defined by the administrator, and corresponds to the MediaType specified 
 * in the Director's Storage definition record. The CurrentVol is the sequence 
 * number of the Media record for the current volume.
 * &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
 */

namespace Bacula\StatusBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Bacula\StatusBundle\Repository\PoolRepository")
 * @ORM\Table(name="Pool")
 */
class Pool {

    /**
     * @ORM\Column(name="PoolId", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $poolId;
    
    /**
     * @ORM\Column(name="Name", type="blob", nullable=false)
     */
    private $name;
    
    /**
     * @ORM\Column(name="NumVols", type="integer")
     */     
    private $numVols;
    
    /**
     * @ORM\Column(name="MaxVols", type="integer")
     */     
    private $maxVols;
    
    /**
     * @ORM\Column(name="UseOnce", type="smallint")
     * 
     */     
    private $useOnce;
    
    /**
     * @ORM\Column(name="UseCatalog", type="smallint")
     * 
     */     
    private $useCatalog;
    
    /**
     * @ORM\Column(name="AcceptAnyVolume", type="smallint")
     * 
     */ 
    private $acceptAnyVolume;
    
    /**
     * @ORM\Column(name="VolRetention", type="bigint", nullable=true)
     */     
    private $volRetention;
    
    /**
     * @ORM\Column(name="VolUseDuration", type="bigint", nullable=true)
     */     
    private $volUseDuration;
    
    /**
     * @ORM\Column(name="MaxVolJobs", type="integer")
     */     
    private $maxVolJobs;
    
    /**
     * @ORM\Column(name="MaxVolFiles", type="integer")
     */     
    private $maxVolFiles;
    
    /**
     * @ORM\Column(name="MaxVolBytes", type="bigint", nullable=true)
     */       
    private $maxVolBytes;
    
    /**
     * @ORM\Column(name="AutoPrune", type="boolean", nullable=true)
     */       
    private $autoPrune;
    
    /**
     * @ORM\Column(name="Recycle", type="boolean", nullable=true)
     */       
    private $recycle;
    
    /**
     * @ORM\Column(name="ActionOnPurge", type="boolean", nullable=true)
     */       
    private $actionOnPurge;
    
    /**
     * @ORM\Column(name="PoolType", type="blob", nullable=false)
     */    
    private $poolType;
    
    /**
     * @ORM\Column(name="LabelType", type="smallint")
     */     
    private $labelType;
    
    /**
     * @ORM\Column(name="LabelFormat", type="blob", nullable=false)
     */        
    private $labelFormat;
    
    /**
     * @ORM\Column(name="Enabled", type="boolean", nullable=true)
     */      
    private $enabled;
    
    /**
     * @ORM\Column(name="ScratchPoolId", type="integer")
     */     
    private $scratchPoolId;
    
    /**
     * @ORM\Column(name="RecyclePoolId", type="integer")
     */     
    private $recyclePoolId;
    
    /**
     * @ORM\Column(name="NextPoolId", type="integer")
     */     
    private $nextPoolId;
    
    /**
     * @ORM\Column(name="MigrationHighBytes", type="bigint", nullable=true)
     */     
    private $migrationHighBytes;
    
    /**
     * @ORM\Column(name="MigrationLowBytes", type="bigint", nullable=true)
     */     
    private $migrationLowBytes;

    /**
     * @ORM\Column(name="MigrationTime", type="bigint", nullable=true)
     */     
    private $migrationTime;
    
    public function getPoolId() {
        return $this->poolId;
    }

    public function getName() {
        return $this->name;
    }

    public function getNumVols() {
        return $this->numVols;
    }

    public function getMaxVols() {
        return $this->maxVols;
    }

    public function getUseOnce() {
        return $this->useOnce;
    }

    public function getUseCatalog() {
        return $this->useCatalog;
    }

    public function getAcceptAnyVolume() {
        return $this->acceptAnyVolume;
    }

    public function getVolRetention() {
        return $this->volRetention;
    }

    public function getVolUseDuration() {
        return $this->volUseDuration;
    }

    public function getMaxVolJobs() {
        return $this->maxVolJobs;
    }

    public function getMaxVolFiles() {
        return $this->maxVolFiles;
    }

    public function getMaxVolBytes() {
        return $this->maxVolBytes;
    }

    public function getAutoPrune() {
        return $this->autoPrune;
    }

    public function getRecycle() {
        return $this->recycle;
    }

    public function getActionOnPurge() {
        return $this->actionOnPurge;
    }

    public function getPoolType() {
        return $this->poolType;
    }

    public function getLabelType() {
        return $this->labelType;
    }

    public function getLabelFormat() {
        return $this->labelFormat;
    }

    public function getEnabled() {
        return $this->enabled;
    }

    public function getScratchPoolId() {
        return $this->scratchPoolId;
    }

    public function getRecyclePoolId() {
        return $this->recyclePoolId;
    }

    public function getNextPoolId() {
        return $this->nextPoolId;
    }

    public function getMigrationHighBytes() {
        return $this->migrationHighBytes;
    }

    public function getMigrationLowBytes() {
        return $this->migrationLowBytes;
    }

    public function getMigrationTime() {
        return $this->migrationTime;
    }

    public function setPoolId($poolId) {
        $this->poolId = $poolId;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setNumVols($numVols) {
        $this->numVols = $numVols;
    }

    public function setMaxVols($maxVols) {
        $this->maxVols = $maxVols;
    }

    public function setUseOnce($useOnce) {
        $this->useOnce = $useOnce;
    }

    public function setUseCatalog($useCatalog) {
        $this->useCatalog = $useCatalog;
    }

    public function setAcceptAnyVolume($acceptAnyVolume) {
        $this->acceptAnyVolume = $acceptAnyVolume;
    }

    public function setVolRetention($volRetention) {
        $this->volRetention = $volRetention;
    }

    public function setVolUseDuration($volUseDuration) {
        $this->volUseDuration = $volUseDuration;
    }

    public function setMaxVolJobs($maxVolJobs) {
        $this->maxVolJobs = $maxVolJobs;
    }

    public function setMaxVolFiles($maxVolFiles) {
        $this->maxVolFiles = $maxVolFiles;
    }

    public function setMaxVolBytes($maxVolBytes) {
        $this->maxVolBytes = $maxVolBytes;
    }

    public function setAutoPrune($autoPrune) {
        $this->autoPrune = $autoPrune;
    }

    public function setRecycle($recycle) {
        $this->recycle = $recycle;
    }

    public function setActionOnPurge($actionOnPurge) {
        $this->actionOnPurge = $actionOnPurge;
    }

    public function setPoolType($poolType) {
        $this->poolType = $poolType;
    }

    public function setLabelType($labelType) {
        $this->labelType = $labelType;
    }

    public function setLabelFormat($labelFormat) {
        $this->labelFormat = $labelFormat;
    }

    public function setEnabled($enabled) {
        $this->enabled = $enabled;
    }

    public function setScratchPoolId($scratchPoolId) {
        $this->scratchPoolId = $scratchPoolId;
    }

    public function setRecyclePoolId($recyclePoolId) {
        $this->recyclePoolId = $recyclePoolId;
    }

    public function setNextPoolId($nextPoolId) {
        $this->nextPoolId = $nextPoolId;
    }

    public function setMigrationHighBytes($migrationHighBytes) {
        $this->migrationHighBytes = $migrationHighBytes;
    }

    public function setMigrationLowBytes($migrationLowBytes) {
        $this->migrationLowBytes = $migrationLowBytes;
    }

    public function setMigrationTime($migrationTime) {
        $this->migrationTime = $migrationTime;
    }


    
}    
?>
