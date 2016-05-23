<?php

namespace Gressus\Tools;

require('../autoload.php');


$reducer = new ReducerService(
    'group',
    array(
        'id' => new Reducer\ConcatReducer(),
        'name' => new Reducer\ConcatReducer(array('distinct' => true)),
        'score' => new Reducer\SumReducer(),
    ),
    array(
        array('score',new Filter\GreaterThanFilter(0)),
        array('score',new Filter\LowerThanFilter(10)),
    )
);



$data = array(
    array('id' => '1','group' => 'Police', 'name' => 'Melanie','score' => 1),
    array('id' => '2','group' => 'Police', 'name' => 'Kerstin','score' => 1),
    array('id' => '3','group' => 'Police', 'name' => 'Thomas','score' => 4),
    array('id' => '5','group' => 'Gangster', 'name' => 'Hafti','score' => 10),
    array('id' => '6','group' => 'Gangster', 'name' => 'Fler','score' => 0),
    array('id' => '7','group' => 'Press', 'name' => 'Steiger','score' => 0),
    array('id' => '8','group' => 'Press', 'name' => 'Sz','score' => 5),
    array('id' => '9','group' => 'Press', 'name' => 'Max','score' => 1),
    array('id' => '10','group' => 'Press', 'name' => 'Max','score' => 1),
);


$reducedData = $reducer->reduce($data);

print(json_encode($reducedData,JSON_PRETTY_PRINT));
