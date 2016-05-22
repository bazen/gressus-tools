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
/**
 * Abstract Converter
 *
 * @category Gressus
 * @package Gressus_Tools
 * @author Felix Krüger <f3l1x@gressus.de>
 */
abstract class  AbstractConverter implements ConverterInterface {
	/**
	 * @var null
	 */
	protected $options;
	/**
	 * Fields
	 * @var mixed|null
	 */
	protected $fields;

	/**
	 * Construct
	 * @param mixed $fields
	 * @param mixed $options
	 */
	public function __construct($fields = null, $options = null){
        if(is_string($fields)){
            $fields = array($fields);
        }
		$this->fields = $fields;
		if(null !== $options){
			$this->options = $options;
		}

	}

	/**
	 * Get Fields
	 * @return mixed|null
	 */
	public function getFields(){
		return $this->fields;
	}

	/**
	 * Is Option True
	 * @param $key
	 * @return bool
	 */
	protected function isOptionTrue($key){
        return isset($this->options[$key]) && $this->options[$key];
    }


}
