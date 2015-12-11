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
 * Static Value Mapper
 *
 * @category Gressus
 * @package Gressus_Tools
 * @author Felix Krüger <mail@felixkrueger.net>
 */
class ArrayPath extends AbstractMapper {
	/**
	 * @param $input
	 * @param DataMapperService $dataMapper
	 * @return null
	 */
	public function map($input,DataMapperService $dataMapper = null){


        $paths = $this->options;
        if(!is_array($paths)){
            $paths = array($paths);
        }

        foreach($paths as $p){
            $path = explode('/',$p);
            $result = $this->getIterative($input,$path);
            if($result){
                return $result;
            }
        }
		return null;
	}

    /**
     * @param array $array
     * @param array $path
     * @return null
     */
    protected function getIterative($array,$path){
        $firstPathPart = array_shift($path);
        if(!isset($array[$firstPathPart])){
            return null;
        }
        $value = $array[$firstPathPart];
        if(count($path)){
            return $this->getIterative($value,$path);
        }
        return $value;
    }

}
