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
namespace Gressus\Tools;
use \Gressus\Tools\Converter\ConverterInterface;
use Gressus\Tools\Filter\FilterInterface;
use \Gressus\Tools\Mapper\MapperInterface;
/**
 * Data Mapper
 *
 * @category Gressus
 * @package Gressus_Tools
 * @author Felix Krüger <mail@felixkrueger.net>
 *
 */
class DataMapperService {
	/**
	 * MAP
	 * $outputKey => $inputKey
	 * @var array
	 */
	protected $map;
	/**
	 * @var array
	 */
	protected $converter = array();
	/**
	 * @var array
	 */
	protected $preFilter = array();
	/**
	 * @var array
	 */
	protected $postFilter = array();

	/**
	 * DataMapperService constructor.
	 * @param array $map
	 * @param array $converter
	 * @param array $preFilter
	 * @param array $postFilter
	 */
    public function __construct(array $map, array $converter = array(), array $preFilter = array(), array $postFilter = array()) {
        $this->map = $map;
        $this->converter = $converter;
        $this->preFilter = $preFilter;
        $this->postFilter = $postFilter;
    }


    /**
	 * Set Map
	 * @param $map
	 */
	public function setMap($map) {
		$this->map = $map;
	}

	/**
	 * Get Map
	 * @return array
	 */
	public function getMap() {
		return $this->map;
	}

	/**
	 * @param $converter
	 */
	public function setConverter(array $converter) {
		$this->converter = $converter;
	}

	/**
	 * Add Converter
	 * @param ConverterInterface $converter
	 */
	public function addConverter(ConverterInterface $converter) {
		$this->converter[] = $converter;
	}

	/**
	 * Get Converter
	 * @return array
	 */
	public function getConverter() {
		return $this->converter;
	}

    /**
     * @return array
     */
    public function getPreFilter() {
        return $this->preFilter;
    }

    /**
     * @param array $preFilter
     */
    public function setPreFilter($preFilter) {
        $this->preFilter = $preFilter;
    }
    /**
     * Add Filter
     * @param FilterInterface $filter
     */
    public function addPreFilter(FilterInterface $filter) {
        $this->preFilter[] = $filter;
    }

	/**
	 * @return array
	 */
	public function getPostFilter() {
		return $this->postFilter;
	}

	/**
	 * @param array $postFilter
	 */
	public function setPostFilter($postFilter) {
		$this->postFilter = $postFilter;
	}


	/**
	 * Map Item
	 * @param $input
	 * @return array
	 */
	public function mapItem($input) {
		if (is_array($input)) {
			return $this->mapArray($input);
		}
		return null;
	}

	/**
	 * Map Array
	 * @param $input
	 * @return array
	 */
	protected function mapArray(array $input) {
		$output = array();
		foreach ($this->map as $outputKey => $inputKey) {
			if ($inputKey instanceof MapperInterface) {
				$output[$outputKey] = $inputKey->map($input, $this);
			} else {
				$output[$outputKey] = isset($input[$inputKey]) ? $input[$inputKey] : null;
			}
		}
		foreach ($this->getConverter() as $converter) {
			$convertTheseFields = $converter->getFields();
            if($convertTheseFields === null || $convertTheseFields === 'all') {
				$convertTheseFields = array_keys($this->map);
			}
			if (is_string($convertTheseFields)) {
				$convertTheseFields = array($convertTheseFields);
			}
			if (is_array($convertTheseFields)) {
				foreach ($convertTheseFields as $field) {
					if (isset($output[$field])) {
						$output[$field] = $converter->convert($output[$field], $this, $field);
					}
				}
			}
		}

		return $output;
	}

	/**
	 * Map
	 * @param $input
	 * @param DataMapperService $dataMapper
	 * @return array
	 */
	public function map($input,DataMapperService $dataMapper = null) {
		$output = array();
		foreach ($input as $item) {

			if(!$this->doesItemMatchFilters($item,$this->preFilter)){
				continue;
			}
			$mappedItem = $this->mapItem($item);
			if(!$this->doesItemMatchFilters($mappedItem,$this->postFilter)){
				continue;
			}
			$output[] = $mappedItem;
		}
		return $output;
	}

	/**
	 * @param $item
	 * @param $filters
	 * @return bool
	 * @throws \Exception
	 */
	protected function doesItemMatchFilters($item,$filters) {
		$matches = true;
		foreach ($filters as $filter) {
			if (!is_array($filter) || !count($filter) == 2) {
				throw new \Exception('Filter must consist of key and filter');
			}
			list($filterKey, $filterObject) = $filter;
			if (!$filterObject instanceof FilterInterface) {
				throw new \Exception('Filter be instance of \Gressus\Tools\Filter\FilterInterface');
			}
			$matches = $matches && $filterObject->matchesCondition(isset($item[$filterKey]) ? $item[$filterKey] : null);
		}
		return $matches;
	}
}