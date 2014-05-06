<?php

/**
 * &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
 * Repository class of Media table
 * 
 * @author Evaldo Prestes de Oliveira <evaldoprestes@unimedchapeco.com.br>
 * @copyright (c) 2014, GPL
 * &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
 */

namespace Bacula\StatusBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManager;

class MediaRepository extends EntityRepository {
    
    /**
     * Find all pools list (Override default findAll() method). 
     * 
     * @return array
     */
    public function findAll() {
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder()
                ->select('m')
                ->from('BaculaStatusBundle:Media', 'm')                
                ->orderBy('m.volumeName', 'ASC');
        
        return $query->getQuery()->getResult();
        
    }
    
}
?>
