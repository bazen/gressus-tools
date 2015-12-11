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
 * Matrix Converter
 *
 * @category Gressus
 * @package Gressus_Tools
 * @author Felix Krüger <mail@felixkrueger.net>
 */
class Matrix extends AbstractConverter {

	/**
	 * Convert based on a given matrix
	 * @param mixed $input
	 * @param \Gressus\Tools\DataMapperService $dataMapper
     * @param string $fieldName
	 * @return null
	 */
	public function convert($input, DataMapperService $dataMapper,$fieldName ){

		$result = null;
		if (isset($this->options[$input])){
			$result = $this->options[$input];
		}
		return $result;
	}

}
