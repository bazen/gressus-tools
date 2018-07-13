<?php

namespace Gressus\Tools;

require('../autoload.php');


$array = ObjectAccess::set([],'foo/bar','baz');
print_r($array);


$array = ObjectAccess::set($array,'foo/baz','bar');
print_r($array);