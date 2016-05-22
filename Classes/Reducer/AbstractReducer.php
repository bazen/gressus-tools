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
namespace Gressus\Tools\Reducer;
/**
 * Abstract Reducer
 *
 * @category Gressus
 * @package Gressus_Tools
 * @author Felix Krüger <f3l1x@gressus.de>
 */
abstract class AbstractReducer implements ReducerInterface {
	/**
	 * @var null
	 */
	protected $options;
	/**
	 * @var string
	 */
	protected $alternativeColumn;

	/**
	 * AbstractReducer constructor.
	 * @param mixed $options
	 * @param string $alternativeColumn
	 */
	public function __construct( $options = null,$alternativeColumn = null){

		if($options  !== null){
			if(is_array($this->options)){
				$this->options = $options + $this->options  ;
			}else{
				$this->options = $options;
			}
		}

		$this->alternativeColumn = $alternativeColumn;
	}

	/**
	 * @return string|null
	 */
	public function getAlternativeColumn() {
		return $this->alternativeColumn;
	}

	/**
	 * @param string|null $alternativeColumn
	 */
	public function setAlternativeColumn($alternativeColumn) {
		$this->alternativeColumn = $alternativeColumn;
	}



}
