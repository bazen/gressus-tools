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
namespace Gressus\Tools\Converter;
use \Gressus\Tools\DataMapperService;
/**
 * Float To Int Converter
 *
 * @category Gressus
 * @package Gressus_Tools
 * @author André Petersr <peters@gressus.de>
 */
class FloatToInt extends AbstractConverter {
    /**
     * Convert Float To Int
     * @param $input
     * @param \Gressus\Tools\DataMapperService $dataMapper
     * @param string $fieldName
     * @return string
     */
    public function convert($input,DataMapperService $dataMapper,$fieldName){
        return (int) $input;
    }

}
