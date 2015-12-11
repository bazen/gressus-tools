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
 * Utf8 Converter
 *
 * @category Gressus
 * @package Gressus_Tools
 * @author Felix Krüger <mail@felixkrueger.net>
 */
class ToUtf8 extends AbstractConverter {


	/**
	 * Convert To Utf8
	 * @param mixed $input
	 * @param \Gressus\Tools\DataMapperService $dataMapper
     * @param string $fieldName
	 * @return mixed|string
	 */
	public function convert($input,DataMapperService $dataMapper,$fieldName){
		//Check if we need to convert the string
		if ("UTF-8" != mb_detect_encoding($input, "UTF-8")
			|| !mb_check_encoding($input, "UTF-8")
		) {
			//Convert the string
			$tmp = @iconv('ISO-8859-1', 'UTF-8', $input);

			//Check if the conversion are successfully
			if (!empty($input) && !empty($tmp)) {
				return $tmp;
			}
		}
		//Fallback
		return $input;
	}

}
