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
namespace Gressus\Tools;
/**
 * Reducer
 *
 * @category Gressus
 * @package Gressus_Tools
 * @author Felix Krüger <f3l1x@gressus.de>
 *
 */
use \Gressus\Tools\Filter\FilterInterface;
use \Gressus\Tools\Reducer\FirstReducer;

class ReducerService {
	/**
	 * Reducer Map
	 * $k => instance of Reducer
	 * @var array
	 */
	protected $reducer;
	/**
	 * Filter
	 * $k => Filter
	 * @var array
	 */
	protected $filter;
    /**
	 * Default Reducer
	 * @var array
	 */
	protected $defaultReducer;
    /**
     * @var string
     */
    protected $groupBy;


    /**
     * ReducerService constructor.
     * @param null $groupBy
     * @param null $reducerMap
     * @param array $filter
     */
    public function __construct($groupBy = null, $reducerMap = null,$filter = array()) {
        $this->groupBy = $groupBy;
        $this->reducer = $reducerMap;
        $this->defaultReducer = new FirstReducer();
        $this->filter = $filter;
	}

	/**
	 * Set Reducer
	 * @param $reducer
	 */
	public function setReducer($reducer) {
		$this->reducer = $reducer;
	}

	/**
	 * Get Reducer
	 * @return array
	 */
	public function getReducer() {
		return $this->reducer;
	}


    /**
     * @param array $input
     * @param $allKeys
     * @return array
     */
    protected function reduceItem(array $input,$allKeys) {

        $output = array();

        foreach($allKeys as $inputKey){

            $outputKey = $inputKey;

            if(isset($this->reducer[$inputKey])){
                $reducer = $this->reducer[$inputKey];
            }else{
                $reducer = $this->defaultReducer;
            }
            $values = array();

            if($reducer->getAlternativeColumn()){
                $inputKey = $reducer->getAlternativeColumn();
            }

            foreach($input as $inputRow){
                if(isset($inputRow[$inputKey])){
                    $values[] = $inputRow[$inputKey];
                }
            }
            $output[$outputKey] = $reducer->reduce($values,$inputKey,$input);
        }
        return $output;
    }

    /**
     * @param $input
     * @param bool|false $reduceAll
     * @return array
     * @throws \Exception
     */
    public function reduce($input,$reduceAll = false) {

        $allKeys = array_keys($this->reducer);
        if($reduceAll){

            foreach($input as $inputRow){
                foreach($inputRow as $k => $va){
                    if(!in_array($k,$allKeys)){
                        $allKeys[] = $k;
                    }
                }
            }
        }

        $grouped = array();

        foreach($input as $k => $v){

            if(!is_array($v) && is_object($v) && is_callable(array($v,'__toArray'))){
                $arr = $v->__toArray();
            }else{
                $arr = $v;
            }
            $matches = true;

            foreach($this->filter as $filter){
                if(!is_array($filter) || !count($filter) == 2){
                    throw new \Exception('Filter must consist of key and filter');
                }
                list($filterKey,$filterObject) = $filter;
                if(!$filterObject instanceof FilterInterface ){
                    throw new \Exception('Filter must be instance of \Gressus\Tools\Filter\FilterInterface');
                }
                $matches = $matches && $filterObject->matchesCondition(isset($arr[$filterKey]) ? $arr[$filterKey] : null);
            }

            if(!$matches){
                continue;
            }

            $groupValue = isset($arr[$this->groupBy]) ?  $arr[$this->groupBy] : "_____empty";
            if(!isset($grouped[$groupValue])){
                $grouped[$groupValue] = array();
            }
            $grouped[$groupValue][] = $arr;
        }

		$output = array();
		foreach ($grouped as $k => $item) {
			$output[$k] = $this->reduceItem($item,$allKeys);
		}
		return $output;
	}
}