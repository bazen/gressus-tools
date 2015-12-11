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
class Concat extends AbstractMapper {
	/**
	 * @param $input
	 * @param DataMapperService $dataMapper
	 * @return null
	 */
	public function map($input,DataMapperService $dataMapper = null){

        $output = array();
        foreach($this->options as $option){
            if($option instanceof AbstractMapper){
                $output[] = $option->map($input,$dataMapper);
            }elseif(isset($input[$option])){
                $output[] = $input[$option];
            }
        }

		return join(' ',$output);
	}


}
