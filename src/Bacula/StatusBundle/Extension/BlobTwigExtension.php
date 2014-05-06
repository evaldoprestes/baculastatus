<?php

/**
 * &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
 * Extends twig to convert blob types in template.
 * 
 * @author Evaldo Prestes de Oliveira <evaldoprestes@yahoo.com.br>
 * @copyright (c) 2014, 
 * &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
 */

namespace Bacula\StatusBundle\Extension;

class BlobTwigExtension extends \Twig_Extension {

    private $container;
    
    public function __construct($container) {
        $this->container = $container;

    }

    public function getName() {
        return "blobtwigextension";
    }

    public function getFilters() {

        return array(
            'blob_convert' => new \Twig_Filter_Method($this, 'blobConvert')            
        );
    }


    public function blobConvert($str) {
        if (is_resource($str)) {
            return stream_get_contents($str, -1, 0);
        } else {
            return $str;
        }
        
    }

}

?>
