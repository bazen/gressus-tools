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
 * Converter Interface
 *
 * @category Gressus
 * @package Gressus_Tools
 * @author Felix Krüger <f3l1x@gressus.de>
 */
interface ConverterInterface{
	/**
	 * Construct
	 * @param mixed $options
	 */
	public function __construct($options = null);

	/**
	 * Convert Data
	 * @abstract
	 * @param mixed $input
	 * @param \Gressus\Tools\DataMapperService $dataMapper
     * @param string $fieldName
	 */
	public function convert($input,DataMapperService $dataMapper,$fieldName);

}
