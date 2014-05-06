<?php

/**
 * &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
 * Repository class of Job table
 * 
 * @author Evaldo Prestes de Oliveira <evaldoprestes@unimedchapeco.com.br>
 * @copyright (c) 2014, GPL
 * &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
 */

namespace Bacula\StatusBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManager;
use Bacula\StatusBundle\Entity\Client;
use Bacula\StatusBundle\Entity\Pool;

class JobRepository extends EntityRepository {

    /**
     * List all jobs filtered by status in the period
     * 
     * @param string $status
     * @param \DateTime $dtIni
     * @param \DateTime $dtEnd
     * @return array
     */
    public function listJobs(\DateTime $dtIni, \DateTime $dtEnd, $status, $clientID, $poolId, $mediaId) {
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder()
                ->select('j')
                ->from('BaculaStatusBundle:Job', 'j')
                ->where('j.startTime >= :dtIni')
                ->andWhere('j.startTime <= :dtEnd')
                ->setParameter('dtIni', $dtIni->format('Y-m-d H:i:s'))
                ->setParameter('dtEnd', $dtEnd->format('Y-m-d H:i:s'))
                ->orderBy('j.jobId', 'DESC')
        ;

        // Filter by status
        if ($status != "any") {
            $query->andWhere('j.jobStatus = :status');
            $query->setParameter('status', $status);
        }

        // filter by client
        if ($clientID != "any") {
            $query->andWhere('j.clientId = :clientID');
            $query->setParameter('clientID', $clientID);
        }

        // Filter by pool
        if ($poolId != "any") {
            $query->andWhere('j.poolId = :poolId');
            $query->setParameter('poolId', $poolId);
        }

        // Filter by Media
        if ($mediaId != "any") {
            $query->innerJoin('BaculaStatusBundle:Pool', 'p', 'WITH', 'p.poolId = j.poolId');
            $query->innerJoin('BaculaStatusBundle:Media', 'm', 'WITH', 'm.poolId = p.poolId');
            $query->andWhere('m.mediaId = :mediaId');
            $query->setParameter('mediaId', $mediaId);
        }


        return $query->getQuery()->getResult();
    }

    /**
     * Gets the total number of jobs in the time interval
     *      
     * @param \DateTime $dtIni
     * @param \DateTime $dtEnd
     * @return integer
     */
    public function getTotalJobsPeriod(\DateTime $dtIni, \DateTime $dtEnd) {
        $total = 0;


        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder()
                ->select('count(j)')
                ->from('BaculaStatusBundle:Job', 'j')
                ->where('j.startTime >= :dtIni')
                ->andWhere('j.startTime <= :dtEnd')
                ->setParameter('dtIni', $dtIni->format('Y-m-d H:i:s'))
                ->setParameter('dtEnd', $dtEnd->format('Y-m-d H:i:s'));

        $total = $query->getQuery()->getSingleScalarResult();
        return $total;
    }

    /**
     * Gets the total number of jobs by the status in the time interval
     * 
     * @param string $status Job Status by bacula developers manual
     * @param \DateTime $dtIni
     * @param \DateTime $dtEnd
     * @return integer
     */
    public function getTotalByStatusPeriod($status, \DateTime $dtIni, \DateTime $dtEnd) {
        $total = 0;


        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder()
                ->select('count(j)')
                ->from('BaculaStatusBundle:Job', 'j')
                ->where('j.jobStatus = :jobStatus')
                ->andWhere('j.startTime >= :dtIni')
                ->andWhere('j.startTime <= :dtEnd')
                ->setParameter('jobStatus', $status)
                ->setParameter('dtIni', $dtIni->format('Y-m-d H:i:s'))
                ->setParameter('dtEnd', $dtEnd->format('Y-m-d H:i:s'));

        $total = $query->getQuery()->getSingleScalarResult();
        return $total;
    }

    /**
     * Gets the total number of files copied by the job in the time interval
     * 
     * @param \DateTime $dtIni
     * @param \DateTime $dtEnd     
     * @return integer
     */
    public function getTotalJobFilesPeriod(\DateTime $dtIni, \DateTime $dtEnd) {
        $total = 0;

        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder()
                ->select('sum(j.jobFiles)')
                ->from('BaculaStatusBundle:Job', 'j')
                ->where('j.startTime >= :dtIni')
                ->andWhere('j.startTime <= :dtEnd')
                ->setParameter('dtIni', $dtIni->format('Y-m-d H:i:s'))
                ->setParameter('dtEnd', $dtEnd->format('Y-m-d H:i:s'));


        $total = $query->getQuery()->getSingleScalarResult();

        return $total;
    }

    /**
     * Gets the total number of bytes copied by the job in the time interval
     * 
     * @param \DateTime $dtIni
     * @param \DateTime $dtEnd
     * @return integer
     */
    public function getTotalJobBytesPeriod(\DateTime $dtIni, \DateTime $dtEnd) {
        $total = 0;

        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder()
                ->select('sum(j.jobBytes)')
                ->from('BaculaStatusBundle:Job', 'j')
                ->where('j.startTime >= :dtIni')
                ->andWhere('j.startTime <= :dtEnd')
                ->setParameter('dtIni', $dtIni->format('Y-m-d H:i:s'))
                ->setParameter('dtEnd', $dtEnd->format('Y-m-d H:i:s'));

        $total = $query->getQuery()->getSingleScalarResult();

        return $total;
    }

    /**
     * Get total jobs by pool in the time interval
     * 
     * @param \DateTime $dtIni
     * @param \DateTime $dtEnd
     * @return array
     */
    public function getJobsByPoolPeriod(\DateTime $dtIni, \DateTime $dtEnd) {
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder()
                ->select('p.name, count(j.poolId) as total')
                ->from('BaculaStatusBundle:Job', 'j')
                ->innerJoin('BaculaStatusBundle:Pool', 'p', 'WITH', 'p.poolId = j.poolId')
                ->where('j.startTime >= :dtIni')
                ->andWhere('j.startTime <= :dtEnd')
                ->setParameter('dtIni', $dtIni->format('Y-m-d H:i:s'))
                ->setParameter('dtEnd', $dtEnd->format('Y-m-d H:i:s'))
                ->groupBy('p.name')
        ;

        return $query->getQuery()->getResult();
    }

    /**
     * Get total jobs by client in the time interval
     * 
     * @param \DateTime $dtIni
     * @param \DateTime $dtEnd
     */
    public function getTotalJobsOfClientPeriod(\DateTime $dtIni, \DateTime $dtEnd) {
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder()
                ->select('c.name, count(j.jobId) as total')
                ->from('BaculaStatusBundle:Job', 'j')
                ->innerJoin('BaculaStatusBundle:Client', 'c', 'WITH', 'c.clientId = j.clientId')
                ->where('j.startTime >= :dtIni')
                ->andWhere('j.startTime <= :dtEnd')
                ->setParameter('dtIni', $dtIni->format('Y-m-d H:i:s'))
                ->setParameter('dtEnd', $dtEnd->format('Y-m-d H:i:s'))
                ->groupBy('c.name')
                ->orderBy('total', 'DESC')
        ;

        return $query->getQuery()->getResult();
    }

    /**
     * Get total file by client in the time interval
     * 
     * @param \DateTime $dtIni
     * @param \DateTime $dtEnd
     */
    public function getTotalFilesOfClientPeriod(\DateTime $dtIni, \DateTime $dtEnd) {
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder()
                ->select('c.name, sum(j.jobFiles) as total')
                ->from('BaculaStatusBundle:Job', 'j')
                ->innerJoin('BaculaStatusBundle:Client', 'c', 'WITH', 'c.clientId = j.clientId')
                ->where('j.startTime >= :dtIni')
                ->andWhere('j.startTime <= :dtEnd')
                ->setParameter('dtIni', $dtIni->format('Y-m-d H:i:s'))
                ->setParameter('dtEnd', $dtEnd->format('Y-m-d H:i:s'))
                ->groupBy('c.name')
                ->orderBy('total', 'DESC')
        ;

        return $query->getQuery()->getResult();
    }

    /**
     * Get total bytes by client in the time interval
     * 
     * @param \DateTime $dtIni
     * @param \DateTime $dtEnd
     * @return array
     */
    public function getTotalBytesOfClientPeriod(\DateTime $dtIni, \DateTime $dtEnd) {
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder()
                ->select('c.name, sum(j.jobBytes) as total')
                ->from('BaculaStatusBundle:Job', 'j')
                ->innerJoin('BaculaStatusBundle:Client', 'c', 'WITH', 'c.clientId = j.clientId')
                ->where('j.startTime >= :dtIni')
                ->andWhere('j.startTime <= :dtEnd')
                ->setParameter('dtIni', $dtIni->format('Y-m-d H:i:s'))
                ->setParameter('dtEnd', $dtEnd->format('Y-m-d H:i:s'))
                ->groupBy('c.name')
                ->orderBy('total', 'DESC')
        ;

        return $query->getQuery()->getResult();
    }

    /**
     * Get Total of Jobs by type in the time interval
     * @param \DateTime $dtIni
     * @param \DateTime $dtEnd
     * @return array
     */
    public function getTotalJobsByType(\DateTime $dtIni, \DateTime $dtEnd) {
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder()
                ->select('j.type, count(j.jobId) as total')
                ->from('BaculaStatusBundle:Job', 'j')
                ->where('j.startTime >= :dtIni')
                ->andWhere('j.startTime <= :dtEnd')
                ->setParameter('dtIni', $dtIni->format('Y-m-d H:i:s'))
                ->setParameter('dtEnd', $dtEnd->format('Y-m-d H:i:s'))
                ->groupBy('j.type')
                ->orderBy('total', 'DESC')
        ;

        return $query->getQuery()->getResult();
    }

    /**
     * Get Total of Jobs by Status in the time interval
     * 
     * @param \DateTime $dtIni
     * @param \DateTime $dtEnd
     * @return array
     */
    public function getTotalJobsByStatus(\DateTime $dtIni, \DateTime $dtEnd) {
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder()
                ->select('j.jobStatus, count(j.jobId) as total')
                ->from('BaculaStatusBundle:Job', 'j')
                ->where('j.startTime >= :dtIni')
                ->andWhere('j.startTime <= :dtEnd')
                ->setParameter('dtIni', $dtIni->format('Y-m-d H:i:s'))
                ->setParameter('dtEnd', $dtEnd->format('Y-m-d H:i:s'))
                ->groupBy('j.jobStatus')
                ->orderBy('total', 'DESC')
        ;

        return $query->getQuery()->getResult();
    }

    /**
     * Get Total of Jobs by level in the time interval
     * 
     * @param \DateTime $dtIni
     * @param \DateTime $dtEnd
     * @return array
     */
    public function getTotalJobsByLevel(\DateTime $dtIni, \DateTime $dtEnd) {
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder()
                ->select('j.level, count(j.jobId) as total')
                ->from('BaculaStatusBundle:Job', 'j')
                ->where('j.startTime >= :dtIni')
                ->andWhere('j.startTime <= :dtEnd')
                ->setParameter('dtIni', $dtIni->format('Y-m-d H:i:s'))
                ->setParameter('dtEnd', $dtEnd->format('Y-m-d H:i:s'))
                ->groupBy('j.level')
                ->orderBy('total', 'DESC')
        ;

        return $query->getQuery()->getResult();
    }
    
}

?>
