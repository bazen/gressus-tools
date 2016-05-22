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
 * Lower Than  Or Equal Filter
 *
 * @category Gressus
 * @package Gressus_Tools
 * @author Felix Krüger <f3l1x@gressus.de>
 */
class LowerThanOrEqualFilter extends AbstractFilter {

    /**
     * @param mixed $value
     * @return bool
     */
    public function matchesCondition($value){
        return $value <= $this->options;
    }



}
