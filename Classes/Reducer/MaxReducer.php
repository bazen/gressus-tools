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
 * Max Value Reducer
 *
 * @category Gressus
 * @package Gressus_Tools
 * @author Felix Krüger <f3l1x@gressus.de>
 */
class MaxReducer extends AbstractReducer {


    /**
     * Return Maximum
     * @param array $values
     * @param string $key
     * @param string $input
     * @return mixed
     */
    public function reduce($values,$key,$input){
        $max = null;
        if(count($values)){
            $max = floatval($values[0]);
            foreach($values as $value){
                $value = floatval($value);
                if($value > $max){
                    $max = $value;
                }
            }
        }
        return $max ;
	}



}
