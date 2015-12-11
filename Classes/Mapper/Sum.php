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
class Sum extends AbstractMapper {
	/**
	 * @param $input
	 * @param DataMapperService $dataMapper
	 * @return null
	 */
	public function map($input,DataMapperService $dataMapper = null){

        $output = 0;
        foreach($this->options as $option){
            if($option instanceof AbstractMapper){
                $output += (float)$option->map($input,$dataMapper);
            }elseif(isset($input[$option])){
                $output += (float)$input[$option];
            }
        }

		return $output;
	}


}
