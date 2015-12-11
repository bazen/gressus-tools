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
 * First
 *
 * @category Gressus
 * @package Gressus_Tools
 * @author Felix Krüger <krueger@gressus.de>
 */
class MinReducer extends AbstractReducer {


    /**
     * Return Minimum
     * @param array $values
     * @param string $key
     * @param string $input
     * @return mixed
     */
    public function reduce($values,$key,$input){
        $min = null;
        if(count($values)){
            $min = floatval($values[0]);
            foreach($values as $value){
                $value = floatval($value);
                if($value < $min){
                    $min = $value;
                }
            }
        }


        return $min ;
	}



}
