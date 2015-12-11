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
class FirstReducer extends AbstractReducer {


    /**
     * Return First Element
     * @param array $values
     * @param string $key
     * @param string $input
     * @return mixed
     */
    public function reduce($values,$key,$input){

        return count($values) ? $values[0] : null ;
	}



}
