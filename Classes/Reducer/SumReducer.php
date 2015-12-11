<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2012
 *  All rights reserved
 *
 *  GRESSUS
 *
 * @category Gressus
 * @package Gressus_Tools
 ***************************************************************/
namespace Gressus\Tools\Reducer;
/**
 * Sums up all values
 *
 * @category Gressus
 * @package Gressus_Tools
 * @author Felix Krüger <krueger@gressus.de>
 */
class SumReducer extends AbstractReducer {

    /**
     * Concat
     * @param array $values
     * @param string $key
     * @param array $input
     * @return string
     */
    public function reduce($values,$key,$input){

        $sum=0;
        foreach($values as $value){
            $sum += $value;
        }

        return $sum ;
	}



}
