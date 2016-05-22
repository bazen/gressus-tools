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
namespace Gressus\Tools\Mapper;
use \Gressus\Tools\DataMapperService;

/**
 * First Not Empty Column Value Mapper
 *
 * @category Gressus
 * @package Gressus_Tools
 * @author Felix Krüger <f3l1x@gressus.de>
 */
class FirstNotEmpty extends AbstractMapper {
	/**
	 * @param $input
	 * @param DataMapperService $dataMapper
	 * @return null
	 */
	public function map($input,DataMapperService $dataMapper = null){
        $output = '';
        if(is_string($this->options)){
            $this->options = explode(',',$this->options);
        }
        foreach($this->options as $option){
            if(is_string($option)){
                $option = trim($option);
            }
            if($option instanceof AbstractMapper){
                $output = $option->map($input,$dataMapper);
            }elseif(isset($input[$option])){
                $output = $input[$option];
            }
            if($output){
                break;
            }
        }

		return $output;
	}


}
