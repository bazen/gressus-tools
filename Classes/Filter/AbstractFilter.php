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
namespace Gressus\Tools\Filter;
/**
 * Abstract Filter
 *
 * @category Gressus
 * @package Gressus_Tools
 * @author Felix Krüger <krueger@gressus.de>
 */
abstract class AbstractFilter implements FilterInterface {
	/**
	 * @var AbstractFilter
	 */
	protected $nextFilter;
	/**
	 * @var mixed
	 */
	protected $options;

	/**
	 * Construct
	 * @param AbstractFilter $nextFilter
	 */
	public function __construct($options = null,AbstractFilter $nextFilter = null){

		$this->options = $options;
		$this->nextFilter = $nextFilter;

	}

	/**
	 * Distinct
	 * @param array $values
	 * @return mixed
	 */
	public function filter($values){

		$newValues = array();

		foreach($values as $value){
			if($this->matchesCondition($values)){
				$newValues[] = $value;
			}
		}


		return $newValues ;
	}


}
