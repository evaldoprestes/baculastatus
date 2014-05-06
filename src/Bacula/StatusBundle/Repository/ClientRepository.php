<?php

/**
 * &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
 * Repository class of Client table
 * 
 * @author Evaldo Prestes de Oliveira <evaldoprestes@unimedchapeco.com.br>
 * @copyright (c) 2014, GPL
 * &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
 */

namespace Bacula\StatusBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManager;

class ClientRepository extends EntityRepository {
    
    public function listAllClients() {

        $em = $this->getEntityManager();
        
        $query = $em->createQueryBuilder()
                ->select('c')
                ->from('BaculaStatusBundle:Client', 'c')
                ->orderBy('c.name', 'ASC');
        
        return $query->getQuery()->getResult();
    }
}

?>
