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
 * First Not Empty Value Reducer
 *
 * @category Gressus
 * @package Gressus_Tools
 * @author Felix Krüger <f3l1x@gressus.de>
 */
class NotEmptyReducer extends AbstractReducer {


    /**
     * Return First Not Empty
     * @param array $values
     * @param string $key
     * @param string $input
     * @return mixed
     */
    public function reduce($values,$key,$input){


        if(count($values)){
            foreach($values as $v){
                if($v){
                    return $v;
                }
            }
        }

        return  null ;
	}



}
