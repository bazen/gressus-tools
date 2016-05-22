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
 * To Decimal percent Converter
 *
 * @category Gressus
 * @package Gressus_Tools
 * @author Felix Krüger <f3l1x@gressus.de>
 */
class ToDecimalPercent extends AbstractConverter {

	/**
	 * Convert to decimal percent
	 * @param mixed $input
	 * @param \Gressus\Tools\DataMapperService $dataMapper
     * @param string $fieldName
	 * @return float
	 */
	public function convert($input,DataMapperService $dataMapper,$fieldName){
		$input = str_replace('%','',$input);
		$input = trim($input);
		return $input/100;
	}

}
