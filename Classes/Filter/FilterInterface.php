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
 * Filter Interface
 *
 * @category Gressus
 * @package Gressus_Tools
 * @author Felix Krüger <f3l1x@gressus.de>
 */
interface FilterInterface {
	/**
	 * FilterInterface constructor.
	 * @param mixed $options
	 * @param AbstractFilter|null $nextFilter
	 */
	public function __construct($options = null,AbstractFilter $nextFilter = null);

    /**
     * Filter
     * @abstract
     * @param array $values
     * @return array
     */
    public function filter($values);

	/**
	 * @param mixed $value
	 * @return boolean
	 */
	public function matchesCondition($value);
}
