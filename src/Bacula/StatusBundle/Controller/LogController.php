<?php

namespace Bacula\StatusBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Bacula\StatusBundle\Entity\Job;
use Bacula\StatusBundle\Entity\Log;
use Bacula\StatusBundle\Common\DefaultDefinitions;

class LogController extends Controller {
    
    public function displayLogJob(Request $request, $jobId) {
        $em                 = $this->getDoctrine()->getManager();
        
    }
}

?>