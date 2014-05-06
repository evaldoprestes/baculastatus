<?php

/**
 * &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
 * Default definitions
 * 
 * @author Evaldo Prestes de Oliveira <evaldoprestes@yahoo.com.br>
 * @copyright (c) 2014, Unimed Chapecó
 * &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
 */

namespace Bacula\StatusBundle\Common;

class DefaultDefinitions {

    /**
     * Return description of job type
     * 
     * @param string $key
     * @return string
     */
    public function getJobType($key) {
        $jobtype['B'] = "type.backup";
        $jobtype['M'] = "type.migrate";
        $jobtype['V'] = "type.verify";
        $jobtype['R'] = "type.restore";
        $jobtype['I'] = "type.internal";
        $jobtype['D'] = "type.admin";
        $jobtype['A'] = "type.archive";
        $jobtype['c'] = "type.copy";
        $jobtype['C'] = "type.console";
        $jobtype['G'] = "type.migration";

        if (NULL === $key) {
            return $jobtype;
        } else {
            return $jobtype[$key];
        }
    }

    /**
     * Return description of job level
     * 
     * @param string $key
     * @return string
     */
    public function getJobLevel($key) {
        $joblevel['F'] = "full";
        $joblevel['I'] = "incremental";
        $joblevel['D'] = "differential";

        if (NULL === $key) {
            $joblevel;
        } else {
            return $joblevel[$key];
        }
    }

    /**
     * Return Status description of job
     * 
     * @param string $key
     * @return string
     */
    public function getJobStatus($key = NULL) {
        $jobstatus['C'] = 'status.created';
        $jobstatus['R'] = 'status.running';
        $jobstatus['B'] = 'status.blocked';
        $jobstatus['T'] = 'status.terminated';
        $jobstatus['W'] = 'status.terminatedw';
        $jobstatus['E'] = 'status.errof';
        $jobstatus['e'] = 'status.errornfatal';
        $jobstatus['f'] = 'status.errorfatal';
        $jobstatus['D'] = 'status.diferrences';
        $jobstatus['A'] = 'status.canceled';
        $jobstatus['I'] = 'status.incomplete';
        $jobstatus['F'] = 'status.waitingfd';
        $jobstatus['S'] = 'status.waitingsd';
        $jobstatus['m'] = 'status.waitingvol';
        $jobstatus['M'] = 'status.waitingmount';
        $jobstatus['s'] = 'status.waitingstor';
        $jobstatus['j'] = 'status.waitingjobr';
        $jobstatus['c'] = 'status.waitingclient';
        $jobstatus['d'] = 'status.waitingmaxjob';
        $jobstatus['t'] = 'status.waitingstart';
        $jobstatus['p'] = 'status.waitinghprior';
        $jobstatus['i'] = 'status.batch';
        $jobstatus['a'] = 'status.sddespooling';
        $jobstatus['l'] = 'status.datadespooling';
        $jobstatus['L'] = 'status.commiting';

        if (NULL === $key) {
            return $jobstatus;
        } else {
            return $jobstatus[$key];
        }
    }

    /**
     * Return icon of the status
     * @param string $key
     * @return string
     */
    public function getJobTypeIcon($key) {

        $jobstatusIcon['C'] = "fa fa-circle-o";
        $jobstatusIcon['R'] = "fa fa-cog fa-spin";
        $jobstatusIcon['B'] = "fa fa-lock red";
        $jobstatusIcon['T'] = "fa fa-check green";
        $jobstatusIcon['W'] = "fa fa-warning yellow";
        $jobstatusIcon['E'] = "fa fa-times-circle-o red";
        $jobstatusIcon['e'] = "fa fa-times-circle-o red";
        $jobstatusIcon['f'] = "fa fa-times-circle-o red";
        $jobstatusIcon['D'] = "fa fa-circle-o";
        $jobstatusIcon['A'] = "fa fa-ban yellow";
        $jobstatusIcon['I'] = "fa fa-circle-o";
        $jobstatusIcon['F'] = "fa fa-clock-o";
        $jobstatusIcon['S'] = "fa fa-clock-o";
        $jobstatusIcon['m'] = "fa fa-clock-o";
        $jobstatusIcon['M'] = "fa fa-clock-o";
        $jobstatusIcon['s'] = "fa fa-clock-o";
        $jobstatusIcon['j'] = "fa fa-clock-o";
        $jobstatusIcon['c'] = "fa fa-clock-o";
        $jobstatusIcon['d'] = "fa fa-clock-o";
        $jobstatusIcon['t'] = "fa fa-clock-o";
        $jobstatusIcon['p'] = "fa fa-clock-o";
        $jobstatusIcon['i'] = "fa fa-circle-o";
        $jobstatusIcon['a'] = "fa fa-save";
        $jobstatusIcon['l'] = "fa fa-save";
        $jobstatusIcon['L'] = "fa fa-save";

        if (NULL === $key) {
            return $jobstatusIcon;
        } else {
            return $jobstatusIcon[$key];
        }
    }

    /**
     * Format bytes in MB, GB, TB, etc
     * 
     * @param integer $bytes
     * @return string
     */
    public function formatSize($bytes) {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');

        $totalSize = '0 B';

        if ($bytes > 0) {
            $base      = log($bytes) / log(1024);
            $totalSize = round(pow(1024, $base - floor($base)), 2) . ' ' . $units[floor($base)];
        }

        return $totalSize;
    }

    /**
     * Convert timestamp to human readable format
     * 
     * @return string
     */
    public function formatTimeStamp($timestamp) {
        $ret = null;

        $bit = array(
            'Y' => $timestamp / 31556926 % 12,
            'W' => $timestamp / 604800 % 52,
            'D' => $timestamp / 86400 % 7,
            'H' => $timestamp / 3600 % 24,
            'M' => $timestamp / 60 % 60,
            'S' => $timestamp % 60
        );

        foreach ($bit as $k => $v) {
            if ($v > 0) {
                $ret[] = $v . $k;
            }
        }
        
        if ($timestamp > 0) {
            return join(' ', $ret);
        } else {
            return ' ';
        }
        
    }

}

?>
