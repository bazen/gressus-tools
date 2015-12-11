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
 * Mysql Date Converter
 *
 * @category Gressus
 * @package Gressus_Tools
 * @author Felix Krüger <mail@felixkrueger.net>
 */
class FromExcelToMysqlDate extends AbstractConverter {

	/**
	 * Convert to standard mysql date format
	 * @param mixed $input
	 * @param \Gressus\Tools\DataMapperService $dataMapper
     * @param string $fieldName
	 * @return string
	 */
	public function convert($input,DataMapperService $dataMapper,$fieldName){
		if(is_numeric($input)){

			$date = new DateTime('1900-01-01');
			$date->modify('+'.$input.' days');
			return $date->format('Y-m-d');

		}
		return date('Y-m-d',strtotime($input));
	}

}
