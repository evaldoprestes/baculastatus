<?php

/**
 * &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
 * Entity class of table Media
 * 
 * @author Evaldo Prestes de Oliveira <evaldoprestes@yahoo.com.br>
 * @copyright (c) 2014
 * 
 * 
 * The Volume table (internally referred to as the Media table) contains one 
 * entry for each volume, that is each tape, cassette (8mm, DLT, DAT, ...), or 
 * file on which information is or was backed up. There is one Volume record 
 * created for each of the NumVols specified in the Pool resource record.
 * &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
 */

namespace Bacula\StatusBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Bacula\StatusBundle\Repository\MediaRepository")
 * @ORM\Table(name="Media")
 */
class Media {

    /**
     * @ORM\Column(name="MediaId", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $mediaId;
    
    /**
     * @ORM\Column(name="VolumeName", type="blob", nullable=false)
     */    
    private $volumeName;
    
    /**
     * @ORM\Column(name="Slot", type="integer")
     */    
    private $slot;
    
    /**
     * @ORM\Column(name="PoolId", type="integer")
     */     
    private $poolId;
    
    /**
     * @ORM\Column(name="MediaType", type="blob", nullable=false)
     */     
    private $mediaType;
    
    /**
     * @ORM\Column(name="MediaTypeId", type="integer")
     */     
    private $mediaTypeId;
    
    /**
     * @ORM\Column(name="LabelType", type="smallint")
     * 
     */    
    private $labelType;
    
    /**
     * @ORM\Column(name="FirstWritten", type="datetime", nullable=true)
     */     
    private $firstWritten;
    
    /**
     * @ORM\Column(name="LastWritten", type="datetime", nullable=true)
     */     
    private $lastWritten;
    
    /**
     * @ORM\Column(name="LabelDate", type="datetime", nullable=true)
     */     
    private $labelDate;
    
    /**
     * @ORM\Column(name="VolJobs", type="integer", nullable=true)
     */          
    private $volJobs;
    
    /**
     * @ORM\Column(name="VolFiles", type="integer", nullable=true)
     */     
    private $volFiles;

    /**
     * @ORM\Column(name="VolBlocks", type="integer", nullable=true)
     */    
    private $volBlocks;
    
    /**
     * @ORM\Column(name="VolMounts", type="integer", nullable=true)
     */      
    private $volMounts;
    
    /**
     * @ORM\Column(name="VolBytes", type="bigint", nullable=true)
     */     
    private $volBytes;
    
    /**
     * @ORM\Column(name="VolParts", type="integer", nullable=true)
     */      
    private $volParts;
    
    /**
     * @ORM\Column(name="VolErrors", type="integer", nullable=true)
     */         
    private $volErrors;
    
    /**
     * @ORM\Column(name="VolWrites", type="integer", nullable=true)
     */      
    private $volWrites;
    
    /**
     * @ORM\Column(name="MaxVolBytes", type="bigint", nullable=true)
     */      
    private $maxVolBytes;
    
    /**
     * @ORM\Column(name="VolCapacityBytes", type="bigint", nullable=true)
     */     
    private $volCapacityBytes;
    
    /**
     * @ORM\Column(name="VolStatus", type="string", nullable=false)
     */        
    private $volStatus; 
    
    /**
     * @ORM\Column(name="Enabled", type="boolean", nullable=true)
     */     
    private $enabled;
    
    /**
     * @ORM\Column(name="Recycle", type="boolean", nullable=true)
     */     
    private $recycle;
    
    /**
     * @ORM\Column(name="ActionOnPurge", type="boolean", nullable=true)
     */     
    private $actionOnPurge;
    
    /**
     * @ORM\Column(name="VolRetention", type="bigint", nullable=true)
     */     
    private $volRetention;
    
    /**
     * @ORM\Column(name="VolUseDuration", type="bigint", nullable=true)
     */      
    private $volUseDuration;
    
    /**
     * @ORM\Column(name="MaxVolJobs", type="integer", nullable=true)
     */     
    private $maxVolJobs;
    
    /**
     * @ORM\Column(name="MaxVolFiles", type="integer", nullable=true)
     */     
    private $maxVolFiles;
    
    /**
     * @ORM\Column(name="InChanger", type="boolean", nullable=true)
     */      
    private $inChanger;
    
    /**
     * @ORM\Column(name="StorageId", type="integer", nullable=true)
     */       
    private $storageId;
    
    /**
     * @ORM\Column(name="DeviceId", type="integer", nullable=true)
     */     
    private $deviceId;
    
    /**
     * @ORM\Column(name="MediaAddressing", type="integer", nullable=true)
     */         
    private $mediaAddressing;
    
    /**
     * @ORM\Column(name="VolReadTime", type="bigint", nullable=true)
     */        
    private $volReadTime;
    
    /**
     * @ORM\Column(name="VolWriteTime", type="bigint", nullable=true)
     */        
    private $volWriteTime;
    
    /**
     * @ORM\Column(name="EndFile", type="integer", nullable=true)
     */       
    private $endFile;
    
    /**
     * @ORM\Column(name="EndBlock", type="integer", nullable=true)
     */       
    private $endBlock;
    
    /**
     * @ORM\Column(name="LocationId", type="integer", nullable=true)
     */     
    private $locationId;
    
    /**
     * @ORM\Column(name="RecycleCount", type="integer", nullable=true)
     */     
    private $recycleCount;
    
    /**
     * @ORM\Column(name="InitialWrite", type="datetime", nullable=true)
     */     
    private $initialWrite;
    
    /**
     * @ORM\Column(name="ScratchPoolId", type="integer", nullable=true)
     */      
    private $scratchPoolId;
    
    /**
     * @ORM\Column(name="RecyclePoolId", type="integer", nullable=true)
     */      
    private $recyclePoolId;
    
    /**
     * @ORM\Column(name="Comment", type="blob", nullable=true)
     */         
    private $comment;
    
    public function getMediaId() {
        return $this->mediaId;
    }

    public function getVolumeName() {
        return $this->volumeName;
    }

    public function getSlot() {
        return $this->slot;
    }

    public function getPoolId() {
        return $this->poolId;
    }

    public function getMediaType() {
        return $this->mediaType;
    }

    public function getMediaTypeId() {
        return $this->mediaTypeId;
    }

    public function getLabelType() {
        return $this->labelType;
    }

    public function getFirstWritten() {
        return $this->firstWritten;
    }

    public function getLastWritten() {
        return $this->lastWritten;
    }

    public function getLabelDate() {
        return $this->labelDate;
    }

    public function getVolJobs() {
        return $this->volJobs;
    }

    public function getVolFiles() {
        return $this->volFiles;
    }

    public function getVolBlocks() {
        return $this->volBlocks;
    }

    public function getVolMounts() {
        return $this->volMounts;
    }

    public function getVolBytes() {
        return $this->volBytes;
    }

    public function getVolParts() {
        return $this->volParts;
    }

    public function getVolErrors() {
        return $this->volErrors;
    }

    public function getVolWrites() {
        return $this->volWrites;
    }

    public function getMaxVolBytes() {
        return $this->maxVolBytes;
    }

    public function getVolCapacityBytes() {
        return $this->volCapacityBytes;
    }

    public function getVolStatus() {
        return $this->volStatus;
    }

    public function getEnabled() {
        return $this->enabled;
    }

    public function getRecycle() {
        return $this->recycle;
    }

    public function getActionOnPurge() {
        return $this->actionOnPurge;
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

    public function getInChanger() {
        return $this->inChanger;
    }

    public function getStorageId() {
        return $this->storageId;
    }

    public function getDeviceId() {
        return $this->deviceId;
    }

    public function getMediaAddressing() {
        return $this->mediaAddressing;
    }

    public function getVolReadTime() {
        return $this->volReadTime;
    }

    public function getVolWriteTime() {
        return $this->volWriteTime;
    }

    public function getEndFile() {
        return $this->endFile;
    }

    public function getEndBlock() {
        return $this->endBlock;
    }

    public function getLocationId() {
        return $this->locationId;
    }

    public function getRecycleCount() {
        return $this->recycleCount;
    }

    public function getInitialWrite() {
        return $this->initialWrite;
    }

    public function getScratchPoolId() {
        return $this->scratchPoolId;
    }

    public function getRecyclePoolId() {
        return $this->recyclePoolId;
    }

    public function getComment() {
        return $this->comment;
    }

    public function setMediaId($mediaId) {
        $this->mediaId = $mediaId;
    }

    public function setVolumeName($volumeName) {
        $this->volumeName = $volumeName;
    }

    public function setSlot($slot) {
        $this->slot = $slot;
    }

    public function setPoolId($poolId) {
        $this->poolId = $poolId;
    }

    public function setMediaType($mediaType) {
        $this->mediaType = $mediaType;
    }

    public function setMediaTypeId($mediaTypeId) {
        $this->mediaTypeId = $mediaTypeId;
    }

    public function setLabelType($labelType) {
        $this->labelType = $labelType;
    }

    public function setFirstWritten($firstWritten) {
        $this->firstWritten = $firstWritten;
    }

    public function setLastWritten($lastWritten) {
        $this->lastWritten = $lastWritten;
    }

    public function setLabelDate($labelDate) {
        $this->labelDate = $labelDate;
    }

    public function setVolJobs($volJobs) {
        $this->volJobs = $volJobs;
    }

    public function setVolFiles($volFiles) {
        $this->volFiles = $volFiles;
    }

    public function setVolBlocks($volBlocks) {
        $this->volBlocks = $volBlocks;
    }

    public function setVolMounts($volMounts) {
        $this->volMounts = $volMounts;
    }

    public function setVolBytes($volBytes) {
        $this->volBytes = $volBytes;
    }

    public function setVolParts($volParts) {
        $this->volParts = $volParts;
    }

    public function setVolErrors($volErrors) {
        $this->volErrors = $volErrors;
    }

    public function setVolWrites($volWrites) {
        $this->volWrites = $volWrites;
    }

    public function setMaxVolBytes($maxVolBytes) {
        $this->maxVolBytes = $maxVolBytes;
    }

    public function setVolCapacityBytes($volCapacityBytes) {
        $this->volCapacityBytes = $volCapacityBytes;
    }

    public function setVolStatus($volStatus) {
        $this->volStatus = $volStatus;
    }

    public function setEnabled($enabled) {
        $this->enabled = $enabled;
    }

    public function setRecycle($recycle) {
        $this->recycle = $recycle;
    }

    public function setActionOnPurge($actionOnPurge) {
        $this->actionOnPurge = $actionOnPurge;
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

    public function setInChanger($inChanger) {
        $this->inChanger = $inChanger;
    }

    public function setStorageId($storageId) {
        $this->storageId = $storageId;
    }

    public function setDeviceId($deviceId) {
        $this->deviceId = $deviceId;
    }

    public function setMediaAddressing($mediaAddressing) {
        $this->mediaAddressing = $mediaAddressing;
    }

    public function setVolReadTime($volReadTime) {
        $this->volReadTime = $volReadTime;
    }

    public function setVolWriteTime($volWriteTime) {
        $this->volWriteTime = $volWriteTime;
    }

    public function setEndFile($endFile) {
        $this->endFile = $endFile;
    }

    public function setEndBlock($endBlock) {
        $this->endBlock = $endBlock;
    }

    public function setLocationId($locationId) {
        $this->locationId = $locationId;
    }

    public function setRecycleCount($recycleCount) {
        $this->recycleCount = $recycleCount;
    }

    public function setInitialWrite($initialWrite) {
        $this->initialWrite = $initialWrite;
    }

    public function setScratchPoolId($scratchPoolId) {
        $this->scratchPoolId = $scratchPoolId;
    }

    public function setRecyclePoolId($recyclePoolId) {
        $this->recyclePoolId = $recyclePoolId;
    }

    public function setComment($comment) {
        $this->comment = $comment;
    }


}
?>
