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
 * Md5 Converter
 *
 * @category Gressus
 * @package Gressus_Tools
 * @author Felix Krüger <mail@felixkrueger.net>
 */
class Md5 extends AbstractConverter {
	/**
	 * Hash (md5)
	 * @param $input
	 * @param \Gressus\Tools\DataMapperService $dataMapper
	 * @param string $fieldName
	 * @return string
	 */
	public function convert($input,DataMapperService $dataMapper,$fieldName){
		return md5( $input );
	}
}
