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
namespace Gressus\Tools\Filter;
/**
 * Abstract Filter
 *
 * @category Gressus
 * @package Gressus_Tools
 * @author Felix Krüger <f3l1x@gressus.de>
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
	 * AbstractFilter constructor.
	 * @param null $options
	 * @param AbstractFilter|null $nextFilter
	 */
	public function __construct($options = null,AbstractFilter $nextFilter = null){

		$this->options = $options;
		$this->nextFilter = $nextFilter;

	}

	/**
	 * Filter
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
