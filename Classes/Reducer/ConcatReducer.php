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
 * Concat Values Reducer
 *
 * @category Gressus
 * @package Gressus_Tools
 * @author Felix Krüger <f3l1x@gressus.de>
 */
class ConcatReducer extends AbstractReducer {
    /**
     * @var array
     */
    protected $options = array(
        'splitChar' => ', ',
        'distinct' => false,
    );

    /**
     * Concat
     * @param $values
     * @param $key
     * @param $input
     * @return string
     */
    public function reduce($values,$key,$input){

        $vals = array();
        foreach($values as $v){
            if($v){
                $vals[] = $v;
            }
        }
        if($this->options['distinct']){
            $vals = array_unique($vals);
        }

        return join($this->options['splitChar'],$vals) ;
	}



}
