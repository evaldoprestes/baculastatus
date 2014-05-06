<?php

namespace Bacula\StatusBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Bacula\StatusBundle\Entity\Job;
use Bacula\StatusBundle\Entity\Client;
use Bacula\StatusBundle\Common\DefaultDefinitions;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\ArrayAdapter;

class JobController extends Controller {

    /**
     * List of jobs according to the chosen filter (Default 24 hours ago)
     * 
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return Render twig template
     */
    public function listJobsAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $translator = $this->get('translator');
        $defaultDefinitions = new DefaultDefinitions();


        // Default interval
        $dtNow = new \DateTime('NOW');
        $dt24hours = new \DateTime('NOW');
        $last24hours = new \DateInterval('PT24H');
        $dt24hours->sub($last24hours); // get date/time of last 24 hours
        // Repository
        $jobRepository = $em->getRepository('BaculaStatusBundle:Job');
        $clientRepository = $em->getRepository('BaculaStatusBundle:Client');
        $poolRepository = $em->getRepository('BaculaStatusBundle:Pool');
        $mediaRepository = $em->getRepository('BaculaStatusBundle:Media');

        // List all job status to display in combobox form
        $listStatus = $defaultDefinitions->getJobStatus();

        // List all clients to display in combobox form
        $listClients = $clientRepository->listAllClients();

        // List all pool to display in combobox form
        $listPools = $poolRepository->findAll();

        // List all medias to display in combobox form
        $listMedia = $mediaRepository->findAll();

        // Get parameters
        $dtIni = $request->query->get('dt_ini', $dt24hours);
        $dtEnd = $request->query->get('dt_end', $dtNow);
        $status = $request->query->get('status', 'R');
        $page = $request->query->get('page', 1);
        $clientId = $request->query->get('clientId', "any");
        $poolId = $request->query->get('poolId', "any");
        $mediaId = $request->query->get('mediaId', "any");

        if (!$dtIni instanceof \DateTime) {
            $dtIni = \DateTime::createFromFormat($this->container->getParameter('date_format'), $dtIni);
        }

        if (!$dtEnd instanceof \DateTime) {
            $dtEnd = \DateTime::createFromFormat($this->container->getParameter('date_format'), $dtEnd);
        }

        $data = array();

        $listJobs = $jobRepository->listJobs($dtIni, $dtEnd, $status, $clientId, $poolId, $mediaId);

        foreach ($listJobs as $job) {
            $client = $clientRepository->find($job->getClientId());
            $pool = $poolRepository->find($job->getPoolId());

            $bytes = $job->getJobBytes();
            $totalSize = '0 B';

            $totalSize = $defaultDefinitions->formatSize($bytes);

            $dataTmp['class'] = $defaultDefinitions->getJobTypeIcon($job->getJobStatus());
            $dataTmp['status'] = $defaultDefinitions->getJobStatus($job->getJobStatus());
            $dataTmp['jobId'] = $job->getJobId();
            $dataTmp['client'] = $client->getName();
            $dataTmp['name'] = $job->getName();
            $dataTmp['startTime'] = $job->getStartTime()->format($this->container->getParameter('date_format'));
            $dataTmp['type'] = $defaultDefinitions->getJobType(strtoupper($job->getType()));
            $dataTmp['level'] = $defaultDefinitions->getJobLevel(strtoupper($job->getLevel()));
            if ($pool instanceof \Bacula\StatusBundle\Entity\Pool) {
                $dataTmp['pool'] = $pool->getName();
            } else {
                $dataTmp['pool'] = '--';
            }

            $dataTmp['files'] = $job->getJobFiles();
            $dataTmp['size'] = $totalSize;

            $data[] = $dataTmp;
        }

        // Pagination
        $adapter = new ArrayAdapter($data);
        $pagerFanta = new Pagerfanta($adapter);
        $pagerFanta->setMaxPerPage($this->container->getParameter('pagination_per_page_show'));
        $pagerFanta->setCurrentPage($page);


        return $this->render('BaculaStatusBundle:Job:listJobs.html.twig', array(
                    'listJobs'    => $pagerFanta,
                    'dtIni'       => $dt24hours,
                    'dtEnd'       => $dtNow,
                    'listStatus'  => $listStatus,
                    'listClients' => $listClients,
                    'listPools'   => $listPools,
                    'listMedia'   => $listMedia,
                    'status'      => $status,
                    'clientId'    => $clientId,
                    'poolId'      => $poolId,
                    'mediaId'     => $mediaId,
                    'page'        => $page,
                    'dt_ini'      => $dtIni->format($this->container->getParameter('date_format')),
                    'dt_end'      => $dtEnd->format($this->container->getParameter('date_format'))
                        )
        );
    }

    /**
     * Display job details
     * 
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param integer $jobId
     * @return Render twig template
     */
    public function displayJobAction(Request $request, $jobId) {

        $em = $this->getDoctrine()->getManager();
        $defaultDefinitions = new DefaultDefinitions();

        $jobRepository = $em->getRepository('BaculaStatusBundle:Job');
        $logRepository = $em->getRepository('BaculaStatusBundle:Log');
        $clientRepository = $em->getRepository('BaculaStatusBundle:Client');
        $poolRepository = $em->getRepository('BaculaStatusBundle:Pool');
        $fileRepository = $em->getRepository('BaculaStatusBundle:File');

        $job = $jobRepository->find($jobId);
        $log = $logRepository->displayLogByJob($jobId);
        $client = $clientRepository->find($job->getClientId());
        $pool = $poolRepository->find($job->getPoolId());
        $files = $fileRepository->listFilesOfJob($jobId);

        $dataJob['jobId'] = $job->getJobId();
        $dataJob['name'] = $job->getName();
        $dataJob['client'] = $client->getName();

        if ($pool instanceof \Bacula\StatusBundle\Entity\Pool) {
            $dataJob['pool'] = $pool->getName();
        } else {
            $dataJob['pool'] = '--';
        }

        $dataJob['startTime'] = $job->getStartTime();
        $dataJob['endTime'] = $job->getEndTime();

        $dtIni = $job->getStartTime();
        $dtEnd = $job->getEndTime();
        $intervalTotalTime = $dtEnd->diff($dtIni);
        $totalTime = $intervalTotalTime->format("%dd %H:%I");
        $dataJob['totalTime'] = $totalTime;

        $dataJob['class'] = $defaultDefinitions->getJobTypeIcon($job->getJobStatus());
        $dataJob['status'] = $defaultDefinitions->getJobStatus($job->getJobStatus());
        $dataJob['level'] = $defaultDefinitions->getJobLevel($job->getLevel());
        $dataJob['files'] = number_format($job->getJobFiles());

        $bytes = $job->getJobBytes();
        $totalSize = $defaultDefinitions->formatSize($bytes);
        $dataJob['size'] = $totalSize;

        return $this->render('BaculaStatusBundle:Job:displayJob.html.twig', array(
                    'job'       => $dataJob,
                    'logJob'    => $log,
                    'listFiles' => $files
                        )
        );
    }

    /**
     * Job dashboard
     * 
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return Render twig template
     */
    public function dashboardAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $defaultDefinitions = new DefaultDefinitions();
        $translator = $this->get('translator');

        $dtNow = new \DateTime('NOW');
        $dt24hours = new \DateTime('NOW');
        $last24hours = new \DateInterval('PT24H');
        $dt24hours->sub($last24hours); // get date/time of last 24 hours
        // Get parameters
        $dtIni = $request->query->get('dt_ini', $dt24hours);
        $dtEnd = $request->query->get('dt_end', $dtNow);

        if (!$dtIni instanceof \DateTime) {
            $dtIni = \DateTime::createFromFormat($this->container->getParameter('date_format'), $dtIni);
        }

        if (!$dtEnd instanceof \DateTime) {
            $dtEnd = \DateTime::createFromFormat($this->container->getParameter('date_format'), $dtEnd);
        }

        $jobRepository = $em->getRepository('BaculaStatusBundle:Job');

        // ....................................................................
        // Total of files
        // ....................................................................
        $totalFiles = $jobRepository->getTotalJobFilesPeriod($dtIni, $dtEnd);

        // ....................................................................
        // Total jobs by day in the time interval
        // ....................................................................        
        $OneDayInterval = new \DateInterval('P1D');
        $strDtIni = $dtIni->format('Y-m-d') . ' 00:00:00';
        $strStartDate = '1970-' . date('m') . '-01 00:00:00';

        $dtTrb = \DateTime::createFromFormat('Y-m-d H:i:s', $strDtIni);
        $graphTotalJobs = array();

        while ($dtTrb->format('Ymd') <= $dtNow->format('Ymd')) {
            $dtEndTmp = \DateTime::createFromFormat('Y-m-d H:i:s', $dtTrb->format('Y-m-d 23:59:59'));

            $graphTotalJobs[] = array(
                'label' => (string) $dtTrb->format('Y-m-d'),
                'value' => $jobRepository->getTotalJobsPeriod($dtTrb, $dtEndTmp)
            );

            $dtTrb->add($OneDayInterval);
        }

        // ....................................................................
        // Total files by day in the time interval
        // ....................................................................        
        $OneDayInterval = new \DateInterval('P1D');
        $strDtIni = $dtIni->format('Y-m-d') . ' 00:00:00';
        $strStartDate = '1970-' . date('m') . '-01 00:00:00';

        $dtTrb = \DateTime::createFromFormat('Y-m-d H:i:s', $strDtIni);
        $graphTotalFiles = array();

        while ($dtTrb->format('Ymd') <= $dtNow->format('Ymd')) {
            $dtEndTmp = \DateTime::createFromFormat('Y-m-d H:i:s', $dtTrb->format('Y-m-d 23:59:59'));

            $graphTotalFiles[] = array(
                'label' => (string) $dtTrb->format('Y-m-d'),
                'value' => $jobRepository->getTotalJobFilesPeriod($dtTrb, $dtEndTmp)
            );

            $dtTrb->add($OneDayInterval);
        }

        // ....................................................................
        // Total jobs by type
        // ....................................................................        
        $totalByType = $jobRepository->getTotalJobsByType($dtIni, $dtEnd);
        $graphJobType = array();

        foreach ($totalByType as $dataTmp) {
            $graphJobType[] = array(
                'label' => $translator->trans($defaultDefinitions->getJobType($dataTmp['type'])),
                'value' => (int) $dataTmp['total']
            );
        }

        // ....................................................................
        // Total jobs by status
        // ....................................................................        
        $totalByStatus = $jobRepository->getTotalJobsByStatus($dtIni, $dtEnd);
        $graphJobStatus = array();

        foreach ($totalByStatus as $dataTmp) {
            $graphJobStatus[] = array(
                'label' => $translator->trans($defaultDefinitions->getJobStatus($dataTmp['jobStatus'])),
                'value' => (int) $dataTmp['total']
            );
        }


        // ....................................................................
        // Total jobs by level
        // ....................................................................        
        $totalByLevel = $jobRepository->getTotalJobsByLevel($dtIni, $dtEnd);
        $graphJobLevel = array();

        foreach ($totalByLevel as $dataTmp) {
            $graphJobLevel[] = array(
                'label' => $translator->trans($defaultDefinitions->getJobLevel($dataTmp['level'])),
                'value' => (int) $dataTmp['total']
            );
        }


        return $this->render('BaculaStatusBundle:Job:dashboard.html.twig', array(
                    'dt_ini'          => $dtIni->format($this->container->getParameter('date_format')),
                    'dt_end'          => $dtEnd->format($this->container->getParameter('date_format')),
                    'graphTotalJobs'  => json_encode($graphTotalJobs, JSON_NUMERIC_CHECK),
                    'graphTotalFiles' => json_encode($graphTotalFiles, JSON_NUMERIC_CHECK),
                    'graphJobType'    => json_encode($graphJobType, JSON_NUMERIC_CHECK),
                    'graphJobStatus'  => json_encode($graphJobStatus, JSON_NUMERIC_CHECK),
                    'graphJobLevel'   => json_encode($graphJobLevel, JSON_NUMERIC_CHECK),
                        )
        );
    }

}

?>
