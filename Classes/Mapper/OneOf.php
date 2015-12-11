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
class OneOf extends AbstractMapper {
	/**
	 * @param $input
	 * @param DataMapperService $dataMapper
	 * @return null
	 */
	public function map($input,DataMapperService $dataMapper = null){


        $keys = $this->options;
        if(!is_array($keys)){
            $keys = explode(',',$keys);
        }

        foreach($keys as $key){

            if(isset($input[$key])){
                return $input[$key];
            }
        }
		return null;
	}



}
