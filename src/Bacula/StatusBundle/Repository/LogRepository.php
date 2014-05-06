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

class LogRepository extends EntityRepository {
    
    public function displayLogByJob($jobId) {
        
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder()
                ->select('l')
                ->from('BaculaStatusBundle:Log', 'l')
                ->where('l.jobId = :jobId')
                ->setParameter('jobId', $jobId)                
                ->orderBy('l.logId', 'DESC')
                ;

        return $query->getQuery()->getResult();        
        
    }
    
}


?>
