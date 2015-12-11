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
 * LbsToOz Converter
 *
 * @category Gressus
 * @package Gressus_Tools
 * @author Felix Krüger <mail@felixkrueger.net>
 */
class LbsToOz extends AbstractConverter {

	/**
	 * Convert to decimal percent
	 * @param mixed $input
	 * @param \Gressus\Tools\DataMapperService $dataMapper
     * @param string $fieldName
	 * @return float
	 */
	public function convert($input,DataMapperService $dataMapper,$fieldName){

		$input = trim($input);
		return $input/16;
	}

}
