<?php

namespace Gressus\Tools;

require('../autoload.php');


$object = ObjectAccess::set(new \stdClass(),'foo/bar','baz');
print_r($object);


$object = ObjectAccess::set($object,'foo/baz','bar');
print_r($object);