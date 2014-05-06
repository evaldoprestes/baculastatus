<?php

namespace Bacula\StatusBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Bacula\StatusBundle\Common\DefaultDefinitions;

class PoolController extends Controller {

    public function listPoolsAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $defaultDefinitions = new DefaultDefinitions();

        $poolRepository  = $em->getRepository('BaculaStatusBundle:Pool');
        $mediaRepository = $em->getRepository('BaculaStatusBundle:Media');

        $listPools = $poolRepository->findAll();

        //var_dump($listPools);

        $data = array();

        foreach ($listPools as $pool) {
            $listMedia = $mediaRepository->findBy(array('poolId' => $pool->getPoolId()));

            $dataPool  = NULL;
            $dataMedia = NULL;

            if (count($listMedia) > 0) {
                $dataPool['id']   = $pool->getPoolId();
                $dataPool['name'] = $pool->getName();
                $dataMediaTmp     = array();

                foreach ($listMedia as $media) {

                    // Get color by status to display in the list
                    $status = $media->getVolStatus();
                    if ($status == "Used") {
                        $statusColor = "label label-warning";
                    } elseif ($status == "Append") {
                        $statusColor = "label label-success";
                    } elseif ($status == "Error") {
                        $statusColor = "label label-danger";
                    } elseif ($status == "Full") {
                        $statusColor = "label label-primary";
                    } else {
                        $statusColor = "label label-default";
                    }

                    $maxVolBytes = $media->getMaxVolBytes();
                    $volBytes    = $media->getVolBytes();

                    // Max vol bytes not set
                    if ($maxVolBytes == 0) {
                        $maxVolBytes = $volBytes;
                    }
                    
                    $percent = 0; // Default
                    if ($volBytes > 0) {
                        $percent = floor(($volBytes / $maxVolBytes) * 100);
                    }
                    

                    $dataMedia['id']          = $media->getMediaId();
                    $dataMedia['name']        = $media->getVolumeName();
                    $dataMedia['status']      = $status;
                    $dataMedia['statusColor'] = $statusColor;
                    $dataMedia['type']        = $media->getMediaType();
                    $dataMedia['size']        = $defaultDefinitions->formatSize($media->getVolBytes());
                    $dataMedia['percent']     = $percent;
                    $dataMedia['jobs']        = $media->getVolJobs();
                    $dataMedia['useDuration'] = $defaultDefinitions->formatTimeStamp($media->getVolUseDuration());
                    $dataMedia['retention']   = $defaultDefinitions->formatTimeStamp($media->getVolRetention());
                    // Use date format 'Y-m-d h:i' to sorter correctly
                    $dataMedia['lastWritten'] = $media->getLastWritten()->format('Y-m-d h:i'); //$media->getLastWritten()->format($this->container->getParameter('date_format'));
                    $dataMediaTmp[]           = $dataMedia;
                }
                $dataPool['media'] = $dataMediaTmp;

                $data[] = $dataPool;
                //echo stream_get_contents($pool->getName(), -1, 0) . " " . count($listMedia) . "<br />";
            }
        }

        //\Doctrine\Common\Util\Debug::dump($data);
        //var_dump($data);

        return $this->render('BaculaStatusBundle:Pool:listPools.html.twig', array(
                    'listPools' => $data
                        )
        );
    }

}
