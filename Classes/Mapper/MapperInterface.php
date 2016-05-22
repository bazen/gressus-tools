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
namespace Gressus\Tools\Mapper;
use \Gressus\Tools\DataMapperService;

/**
 * Mapper Interface
 *
 * @category Gressus
 * @package Gressus_Tools
 * @author Felix Krüger <f3l1x@gressus.de>
 */
interface MapperInterface{
	/**
	 * Construct
	 * @param null $options
	 * @param null $originFieldName
	 */
	public function __construct($options = null,$originFieldName = null);
	/**
	 * Map Data
	 * @abstract
	 * @param $input
	 * @param $dataMapper
	 */
	public function map($input,DataMapperService $dataMapper = null);

}
