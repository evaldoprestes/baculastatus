<?php

/**
 * &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
 * Repository class of Pool table
 * 
 * @author Evaldo Prestes de Oliveira <evaldoprestes@unimedchapeco.com.br>
 * @copyright (c) 2014, GPL
 * &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
 */

namespace Bacula\StatusBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManager;

class PoolRepository extends EntityRepository {
    
    /**
     * Find all pools list (Override default findAll() method). Join with Media 
     * table to display only used pools.
     * 
     * @return array
     */
    public function findAll() {
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder()
                ->select('p')
                ->from('BaculaStatusBundle:Pool', 'p')
                ->innerJoin('BaculaStatusBundle:Media', 'm', 'WITH', 'p.poolId = m.poolId')                
                ->orderBy('p.name', 'ASC');
        
        return $query->getQuery()->getResult();
        
    }
    
}
?>
