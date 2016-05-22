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
 * FirstChar Value Mapper
 *
 * @category Gressus
 * @package Gressus_Tools
 * @author Felix Krüger <f3l1x@gressus.de>
 */
class FirstChar extends AbstractMapper {
    /**
     * @param $input
     * @param DataMapperService $dataMapper
     * @return null
     */
    public function map($input,DataMapperService $dataMapper = null){

        $name =  $this->getInputValue($input,$dataMapper) ;
        if($name){
            $name = strtoupper(substr(trim($name),0,1));
            $name = str_replace("Ä",'A',$name);
            $name = str_replace("Á",'A',$name);
            $name = str_replace("Å",'A',$name);
            $name = str_replace("É",'E',$name);
            $name = str_replace("Ë",'E',$name);
            $name = str_replace("Ü",'U',$name);
            $name = str_replace("Ú",'U',$name);
            $name = str_replace("Í",'I',$name);
            $name = str_replace("Ö",'O',$name);
            $name = str_replace("Ö",'O',$name);
            $name = str_replace("Ø",'O',$name);
            $name = str_replace("Œ",'O',$name);

        }
        return $name;
    }

}