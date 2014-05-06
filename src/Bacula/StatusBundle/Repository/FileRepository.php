<?php

/**
 * &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
 * Repository class of File table
 * 
 * @author Evaldo Prestes de Oliveira <evaldoprestes@unimedchapeco.com.br>
 * @copyright (c) 2014, GPL
 * &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
 */

namespace Bacula\StatusBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManager;

class FileRepository extends EntityRepository {

    public function listFilesOfJob($jobId) {
        
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder()
                ->select('p.path, fn.name')
                ->from('BaculaStatusBundle:File', 'f')
                ->innerJoin('BaculaStatusBundle:Filename', 'fn', 'WITH', 'fn.fileNameId = f.fileNameId')
                ->innerJoin('BaculaStatusBundle:Path', 'p', 'WITH', 'p.pathId = f.pathId')
                ->where('f.jobId = :jobId')
                ->setParameter('jobId', $jobId)
                ->orderBy('f.fileId', 'ASC')
                ;
        
        return $query->getQuery()->getResult();
    }
}
?>
