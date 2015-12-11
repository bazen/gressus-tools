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
namespace Gressus\Tools\Converter;
use \Gressus\Tools\DataMapperService;
/**
 * To Decimal percent Converter
 *
 * @category Gressus
 * @package Gressus_Tools
 * @author Felix Krüger <mail@felixkrueger.net>
 */
class ToFloat extends AbstractConverter {
    /**
     * precision
     * @var int
     */
    protected $options = 2;
	/**
	 * Convert to decimal percent
	 * @param mixed $input
	 * @param \Gressus\Tools\DataMapperService $dataMapper
     * @param string $fieldName
	 * @return float
	 */
	public function convert($input,DataMapperService $dataMapper,$fieldName){
        $input = preg_replace('/[^0-9.-]*/','',$input);
        $input = floatval($input);
		return round($input,$this->options);
	}

}
