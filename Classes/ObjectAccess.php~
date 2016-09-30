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
 * Object Access
 *
 * @category Gressus
 * @package Gressus_Tools
 * @author Felix Krüger <f3l1x@gressus.de>
 *
 */


class ObjectAccess {

    /**
     * Get Value of array or object without checking isset()
     *
     * $array = array(
     *   'foo' => array(
     *      'bar' => 'baz'
     *   )
     * );
     *
     * $baz = ObjectAccess::get($array,'foo/bar');
     *
     *
     * @param array|Object $object
     * @param string $query
     * @param mixed $default
     * @return null
     */
    public static function get($object, $query, $default = null){
        if(is_string($query)){
            $query = explode('/',$query);
        }
        if(count($query) == 0){
            return $object;
        }
        $currentKey = array_shift($query);
        if(is_array($object)){
            if(!isset($object[$currentKey]) && is_numeric($currentKey)){
                $currentKey = (int)$currentKey;
            }
            if(isset($object[$currentKey])){
                return self::get($object[$currentKey],$query,$default);
            }
        }else if(is_object($object)){
            if(isset($object->$currentKey)){
                return self::get($object->$currentKey,$query,$default);
            }

        }
        return $default;
    }

    /**
     * Same as get, but throws exception if it's not set or null
     * @param array|Object $object
     * @param string $query
     * @return mixed
     * @throws \Exception
     */
    public static function getOrThrowException($object, $query){
        $value = self::get($object,$query);
        if($value === null){
            throw new \Exception('Could Not Retrieve '.$query);
        }
        return $value;
    }
}