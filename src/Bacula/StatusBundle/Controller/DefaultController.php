<?php

namespace Bacula\StatusBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Bacula\StatusBundle\Entity\Job;
use Bacula\StatusBundle\Common\DefaultDefinitions;

class DefaultController extends Controller {

    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $defaultDefinitions = new DefaultDefinitions ();

        $jobRepository = $em->getRepository('BaculaStatusBundle:Job');

        // ----------------------------------------------------------------------
        //
		// Get Last 24 hours statistics
        //
		// ----------------------------------------------------------------------
        $dtNow = new \DateTime('NOW');
        $dt24hours = new \DateTime('NOW');
        $last24hours = new \DateInterval('PT24H');
        $dt24hours->sub($last24hours); // get date/time of last 24 hours
        //
		                                  // Total by status
        $running = $jobRepository->getTotalByStatusPeriod('R', $dt24hours, $dtNow);
        $cancelled = $jobRepository->getTotalByStatusPeriod('A', $dt24hours, $dtNow);
        $success = $jobRepository->getTotalByStatusPeriod('T', $dt24hours, $dtNow);
        $errorTmp = $jobRepository->getTotalByStatusPeriod('E', $dt24hours, $dtNow);
        $error = $errorTmp;
        if ($errorTmp > 0) {
            $flagError = 'E';
        }

        $errorTmp = $jobRepository->getTotalByStatusPeriod('e', $dt24hours, $dtNow);
        $error += $errorTmp;
        if ($errorTmp > 0) {
            $flagError = 'e';
        }

        $errorTmp = $jobRepository->getTotalByStatusPeriod('f', $dt24hours, $dtNow);
        $error += $errorTmp;
        if ($errorTmp > 0) {
            $flagError = 'f';
        }

        // ....................................................................
        // Graph total bytes per hour
        // ....................................................................
        $OneHourInterval = new \DateInterval('PT1H');
        $dataGraph24Hours = array();
        $dtTmp24hours = new \DateTime('NOW');
        $dtTmp24hours->sub($last24hours); // get date/time of last 24 hours

        while ($dtTmp24hours <= $dtNow) {
            $dtIniTmp = \DateTime::createFromFormat('Y-m-d H:i:s', $dtTmp24hours->format('Y-m-d H:00:00'));
            $dtFimTmp = \DateTime::createFromFormat('Y-m-d H:i:s', $dtTmp24hours->format('Y-m-d H:59:59'));

            $totalBytes = $jobRepository->getTotalJobBytesPeriod($dtIniTmp, $dtFimTmp);

            $graph24Hour [] = array(
                'label'     => (string) $dtTmp24hours->format('H:00'),
                'value'     => $totalBytes,
                'formatted' => $defaultDefinitions->formatSize($totalBytes)
            );

            $dtTmp24hours->add($OneHourInterval);
        }

        // ....................................................................
        // Total of files
        // ....................................................................
        $totalFiles = $jobRepository->getTotalJobFilesPeriod($dt24hours, $dtNow);

        // ....................................................................
        // Total of bytes
        // ....................................................................
        $totalBytes = $jobRepository->getTotalJobBytesPeriod($dt24hours, $dtNow);

        // ....................................................................
        // Total Jobs by Pool
        // ....................................................................
        $totalJobsPool = $jobRepository->getJobsByPoolPeriod($dt24hours, $dtNow);
        foreach ($totalJobsPool as $dataTmp) {

            $graphPool [] = array(
                'label' => stream_get_contents($dataTmp ['name']),
                'value' => $dataTmp ['total']
            );
        }

        $units = array(
            'B',
            'KB',
            'MB',
            'GB',
            'TB'
        );
        $base = log($totalBytes) / log(1024);

        $totalSize = round(pow(1024, $base - floor($base)), 2) . ' ' . $units [floor($base)];

        // ----------------------------------------------------------------------
        //
		// Get this month statistcs
        //
		// ----------------------------------------------------------------------
        // ....................................................................
        // Volume bytes per day
        // Graph total bytes per day
        // ....................................................................
        $OneDayInterval = new \DateInterval('P1D');
        $strDtIni = date('Y') . '-' . date('m') . '-01 00:00:00';

        $dtTrb = \DateTime::createFromFormat('Y-m-d H:i:s', $strDtIni);
        $dataTmp = array();
        $dataGraphPerDay = array();

        while ($dtTrb->format('Ymd') <= $dtNow->format('Ymd')) {
            $dtIniTmp = \DateTime::createFromFormat('Y-m-d H:i:s', $dtTrb->format('Y-m-d 00:00:00'));
            $dtFimTmp = \DateTime::createFromFormat('Y-m-d H:i:s', $dtTrb->format('Y-m-d 23:59:59'));

            $totalBytes = $jobRepository->getTotalJobBytesPeriod($dtIniTmp, $dtFimTmp);

            $graphBytesDay [] = array(
                'label'     => (string) $dtTrb->format('d'),
                'value'     => $totalBytes,
                'formatted' => $defaultDefinitions->formatSize($totalBytes)
            );

            $dtTrb->add($OneDayInterval);
        }

        // ....................................................................
        // Total bytes stored during by day in the month
        // ....................................................................
        $OneDayInterval = new \DateInterval('P1D');
        $strDtIni = date('Y') . '-' . date('m') . '-01 00:00:00';
        $strStartDate = '1970-' . date('m') . '-01 00:00:00';

        $dtIni = \DateTime::createFromFormat('Y-m-d H:i:s', $strStartDate);
        $dtTrb = \DateTime::createFromFormat('Y-m-d H:i:s', $strDtIni);
        $dataTmp = array();
        $dataGraphStoredPerDay = array();

        while ($dtTrb->format('Ymd') <= $dtNow->format('Ymd')) {
            // $dtIniTmp = \DateTime::createFromFormat('Y-m-d H:i:s', $dtTrb->format('Y-m-d 00:00:00'));
            $dtFimTmp = \DateTime::createFromFormat('Y-m-d H:i:s', $dtTrb->format('Y-m-d 23:59:59'));

            $totalBytes = $jobRepository->getTotalJobBytesPeriod($dtIni, $dtFimTmp);

            $graphTotalStored [] = array(
                'label'     => (string) $dtTrb->format('d'),
                'value'     => $totalBytes,
                'formatted' => $defaultDefinitions->formatSize($totalBytes)
            );

            $dtTrb->add($OneDayInterval);
        }

        return $this->render('BaculaStatusBundle:Default:index.html.twig', array(
                    'running'          => $running,
                    'success'          => $success,
                    'cancelled'        => $cancelled,
                    'error'            => $error,
                    'flagError'        => $flagError,
                    'graph24Hour'      => json_encode($graph24Hour, JSON_NUMERIC_CHECK),
                    'graphPool'        => json_encode($graphPool, JSON_NUMERIC_CHECK),
                    'graphBytesDay'    => json_encode($graphBytesDay, JSON_NUMERIC_CHECK),
                    'graphTotalStored' => json_encode($graphTotalStored, JSON_NUMERIC_CHECK),
                    'totalFiles'       => $totalFiles,
                    'totalSize'        => $totalSize
                ));
    }

}
