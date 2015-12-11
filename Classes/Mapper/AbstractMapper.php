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
namespace Gressus\Tools\Mapper;
use \Gressus\Tools\DataMapperService;

/**
 * Abstract Mapper
 *
 * @category Gressus
 * @package Gressus_Tools
 * @author Felix Krüger <mail@felixkrueger.net>
 */
abstract class AbstractMapper implements MapperInterface {
	/**
	 * Options
	 * @var mixed
	 */
	protected $options;
	/**
	 * Origin's field name
	 * @var string
	 */
	protected $originFieldName;
 	/**
	  * Construct
	  * @param null $options
	  * @param null $originFieldName
	  */
	public function __construct($options = null,$originFieldName = null){
		$this->options = $options;
		$this->originFieldName = $originFieldName;
	}

    /**
     * @param $input
     * @param DataMapperService $dataMapper
     * @return mixed
     */
    protected function getInputValue($input,DataMapperService $dataMapper = null){
        if(is_string($this->originFieldName)){
            if(isset($input[$this->originFieldName])){
                return $input[$this->originFieldName];
            }
        }else if(is_string($this->options)){
            if(isset($input[$this->options])){
                return $input[$this->options];
            }
        }elseif($this->options instanceof AbstractMapper){
            return $this->options->map($input,$dataMapper);
        }elseif($this->originFieldName instanceof AbstractMapper){
            return $this->originFieldName->map($input,$dataMapper);
        }
    }
}
