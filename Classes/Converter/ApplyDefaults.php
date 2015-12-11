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
class ApplyDefaults extends AbstractConverter {


	/**
	 * Convert To Utf8
	 * @param mixed $input
	 * @param \Gressus\Tools\DataMapperService $dataMapper
     * @param string $fieldName
	 * @return mixed|string
	 */
	public function convert($input,DataMapperService $dataMapper,$fieldName){


        if($input === null && isset($this->options[$fieldName])){
            $input = $this->options[$fieldName];
        }

		return $input;
	}

}
