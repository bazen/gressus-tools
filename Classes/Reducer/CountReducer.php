<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2016
 *  All rights reserved
 *
 *  GRESSUS
 *
 * @category Gressus
 * @package Gressus_Tools
 ***************************************************************/
namespace Gressus\Tools\Reducer;
/**
 * Count Rows 
 *
 * @category Gressus
 * @package Gressus_Tools
 * @author Felix Krüger <f3l1x@gressus.de>
 */
class CountReducer extends AbstractReducer {

    /**
     * Concat
     * @param array $values
     * @param string $key
     * @param array $input
     * @return string
     */
    public function reduce($values,$key,$input){

        return count($values) ;
	}



}
