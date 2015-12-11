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
namespace Gressus\Tools\Filter;
/**
 * Distinct Values Reducer
 *
 * @category Gressus
 * @package Gressus_Tools
 * @author Felix Krüger <krueger@gressus.de>
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
