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
 * Implode Converter
 *
 * @category Gressus
 * @package Gressus_Tools
 * @author Felix Krüger <mail@felixkrueger.net>
 */
class Implode extends AbstractConverter {

	/**
	 * Split String
	 * @var string
	 */
	protected $options = ' , ';
	/**
	 * Implode Value
	 * @param array $input
	 * @param \Gressus\Tools\DataMapperService $dataMapper
     * @param string $fieldName
	 * @return string
	 */
	public function convert($input,DataMapperService $dataMapper,$fieldName){
	 	if(is_array($input)){
			 foreach($input as $k => $v){
				 $input[$k] = str_replace(' , ',', ',$v);
			 }
			 return implode($this->options,$input);
		 }
		//Fallback
		return $input;
	}

}
