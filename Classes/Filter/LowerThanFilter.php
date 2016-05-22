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
namespace Gressus\Tools\Filter;
/**
 * Lower Than Filter
 *
 * @category Gressus
 * @package Gressus_Tools
 * @author Felix Krüger <f3l1x@gressus.de>
 */
class LowerThanFilter extends AbstractFilter {

    /**
     * @param mixed $value
     * @return bool
     */
    public function matchesCondition($value){
        return $value < $this->options;
    }



}
