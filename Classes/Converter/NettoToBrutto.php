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
 * Netto To Brutto Converter
 *
 * @category Gressus
 * @package Gressus_Tools
 * @author Felix Krüger <mail@felixkrueger.net>
 */
class NettoToBrutto extends AbstractConverter {

	/**
	 * Convert Brutto to Netto
	 * @param mixed $input
	 * @param \Gressus\Tools\DataMapperService $dataMapper
     * @param string $fieldName
	 * @return float
	 */
	public function convert($input,DataMapperService $dataMapper,$fieldName){
        $input = str_replace(',','.',$input);
        return $input * ( $this->options/100 +1)     ;
	}

}
