<?php

/**
 * &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
 * List bacula clients
 * 
 * @author Evaldo Prestes de Oliveira <evaldoprestes@yahoo.com.br>
 * @copyright (c) 2014, 
 * &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
 */

namespace Bacula\StatusBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Bacula\StatusBundle\Entity\Client;
use Bacula\StatusBundle\Common\DefaultDefinitions;

class ClientController extends Controller {

    /**
     * Lista of bacula clients
     *
     * @param \Symfony\Component\HttpFoundation\Request $request            
     * @return Render twig template
     */
    public function listClientsAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $defaultDefinitions = new DefaultDefinitions();

        $clientRepository = $this->getDoctrine()->getRepository('BaculaStatusBundle:Client');

        $listClients = $clientRepository->listAllClients();

        $dataClient = array();
        foreach ($listClients as $client) {
            $dataTmp['id'] = $client->getClientId();
            $dataTmp['name'] = $client->getName();
            $dataTmp['so'] = $client->getUName();
            $dataTmp['jobRetention'] = $defaultDefinitions->formatTimeStamp($client->getJobRetention());
            $dataTmp['fileRetention'] = $defaultDefinitions->formatTimeStamp($client->getFileRetention());
            $dataTmp['autoPrume'] = $client->getAutoPrune();

            $dataClient[] = $dataTmp;
        }

        return $this->render('BaculaStatusBundle:Client:listClients.html.twig', array(
                    'listClients' => $dataClient
        ));
    }

    /**
     * Dashboard of Bacula Clients
     * 
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return Render Twig template
     */
    public function dashboardAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $defaultDefinitions = new DefaultDefinitions();

        $dtNow = new \DateTime('NOW');
        $dt24hours = new \DateTime('NOW');
        $last24hours = new \DateInterval('PT24H');
        $dt24hours->sub($last24hours); // get date/time of last 24 hours
        // Get parameters
        $dtIni = $request->query->get('dt_ini', $dt24hours);
        $dtEnd = $request->query->get('dt_end', $dtNow);

        if (!$dtIni instanceof \DateTime) {            
            $dtIni = \DateTime::createFromFormat($this->container->getParameter('date_format_php'), $dtIni);
        }

        if (!$dtEnd instanceof \DateTime) {
            $dtEnd = \DateTime::createFromFormat($this->container->getParameter('date_format_php'), $dtEnd);
        }        
        
        $clientRepository = $this->getDoctrine()->getRepository('BaculaStatusBundle:Client');
        $jobRepository = $em->getRepository('BaculaStatusBundle:Job');

        /*
         * ------ Search data for populating the charts ------
         */

        // Get total jobs by client
        $totalJobClient = $jobRepository->getTotalJobsOfClientPeriod($dtIni, $dtEnd);

        foreach ($totalJobClient as $dataTmp) {
            $dataGraphJobClient[] = array(
                stream_get_contents($dataTmp['name'], - 1, 0),
                (int) $dataTmp['total']
            );
            $graphJob[] = array(
                'label' => stream_get_contents($dataTmp['name'], - 1, 0),
                'value' => (int) $dataTmp['total']
            );
        }

        // Get total files by client
        $totalFilesClient = $jobRepository->getTotalFilesOfClientPeriod($dtIni, $dtEnd);

        foreach ($totalFilesClient as $dataTmp) {
            $dataGraphFileClient[] = array(
                stream_get_contents($dataTmp['name'], - 1, 0),
                (int) $dataTmp['total']
            );
            $graphFiles[] = array(
                'label' => stream_get_contents($dataTmp['name'], - 1, 0),
                'value' => (int) $dataTmp['total']
            );
        }

        // Get total bytes by client
        $totalBytesClient = $jobRepository->getTotalBytesOfClientPeriod($dtIni, $dtEnd);

        foreach ($totalBytesClient as $dataTmp) {
            $dataGraphBytesClient[] = array(
                stream_get_contents($dataTmp['name'], - 1, 0),
                (int) $dataTmp['total']
            );
            $graphSize[] = array(
                'label'     => stream_get_contents($dataTmp['name'], - 1, 0),
                'value'     => (int) $dataTmp['total'],
                'formatted' => $defaultDefinitions->formatSize($dataTmp['total'])
            );
        }

        return $this->render('BaculaStatusBundle:Client:dashboard.html.twig', array(
                    'dt_ini'               => $dtIni->format($this->container->getParameter('date_format_php')),
                    'dt_end'               => $dtEnd->format($this->container->getParameter('date_format_php')),
                    'graphJob'             => $graphJob,
                    'graphFiles'           => $graphFiles,
                    'graphSize'            => $graphSize,
                    'dataGraphJobClient'   => json_encode($dataGraphJobClient, JSON_NUMERIC_CHECK),
                    'dataGraphFileClient'  => json_encode($dataGraphFileClient, JSON_NUMERIC_CHECK),
                    'dataGraphBytesClient' => json_encode($dataGraphBytesClient, JSON_NUMERIC_CHECK)
        ));
    }

}

?>
