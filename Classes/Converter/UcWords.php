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
 * UC-Words Converter
 *
 * @category Gressus
 * @package Gressus_Tools
 * @author Felix Krüger <f3l1x@gressus.de>
 */
class UcWords extends AbstractConverter {


	/**
	 * Convert To Uppercase Words
	 * @param mixed $input
	 * @param \Gressus\Tools\DataMapperService $dataMapper
     * @param string $fieldName
	 * @return mixed
	 */
	public function convert($input,DataMapperService $dataMapper,$fieldName){
        if(!$this->isOptionTrue('only_upper_case') || strtoupper($input) === $input){
            return str_replace(' ', ' ', ucwords(str_replace(' ', ' ', mb_strtolower($input)))) ;
        }
        return $input ;
	}

}
