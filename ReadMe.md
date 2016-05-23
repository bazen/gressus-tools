Gressus Tools for PHP-Developers
=======================

Gressus Tools is a collection of PHP Scripts for easy Data Manipulation, CSV read and write and Object Access.


## Data Mapping

You can map a source array to a target array and even apply filters and post converters.
This can help you when programming Import-Scripts with large datasets from one format to another.

```php
namespace Gressus\Tools;
require('../autoload.php');

$dataMapperService = new DataMapperService(
    array(
        'Identifier' => 'id',
        'Group + Name' => new Mapper\Concat(array(
            'group',
            new Mapper\FirstNotEmpty(array('full_name','name')))
        ),
        'Counter' => new Mapper\Counter(),
        'FirstChar' => new Mapper\FirstChar('name'),
        'Name' => new Mapper\FirstNotEmpty(array('full_name','name')),
        'Hash' => new Mapper\All(),
        'Weapons' => new Mapper\ArrayPath('special/weapons'),
    ),
    array(
          new Converter\Serialize('Hash'),
          new Converter\Md5('Hash'),
          new Converter\Implode('Weapons'),
    ),
    array(
        array('score',new Filter\GreaterThanFilter(0)),
    ),
    array(
        array('Counter',new Filter\GreaterThanFilter(1)),
    )
);



$data = array(
    array('id' => '1', 'group' => 'Police',   'name' => 'Melanie',   'score' => 1, 'full_name' => 'Melanie Meyer', 'special' => array('weapons' => array('Walter','Tonfa'))),
    array('id' => '2', 'group' => 'Police',   'name' => 'Kerstin',   'score' => 1, 'full_name' => 'Kerstin Meyer', 'special' => array('weapons' => array('Walter','Tonfa'))),
    array('id' => '3', 'group' => 'Police',   'name' => 'Thomas',    'score' => 4, 'full_name' => 'Thomas Taffil', 'special' => array('weapons' => array('Walter','Tonfa'))),
    array('id' => '5', 'group' => 'Gangster', 'name' => 'Hafti',     'score' => 10, 'special' => array('weapons' => array('Knife','AKAI 47'))),
    array('id' => '6', 'group' => 'Gangster', 'name' => 'Fler',      'score' => 0),
    array('id' => '7', 'group' => 'Press',    'name' => 'Steiger',   'score' => 0),
    array('id' => '8', 'group' => 'Press',    'name' => 'Sz',        'score' => 5),
    array('id' => '9', 'group' => 'Press',    'name' => 'Max',       'score' => 1),
    array('id' => '10','group' => 'Press',    'name' => 'Max',       'score' => 1),
);


$mappedData = $dataMapperService->map($data);

print(json_encode($mappedData,JSON_PRETTY_PRINT));


```


Output:
```json
[
    {
        "Identifier": "2",
        "Group + Name": "Police Kerstin Meyer",
        "Counter": 2,
        "FirstChar": "K",
        "Name": "Kerstin Meyer",
        "Hash": "150ca40755bb997e775fcd0a94fc0147",
        "Weapons": "Walter , Tonfa"
    },
    {
        "Identifier": "3",
        "Group + Name": "Police Thomas Taffil",
        "Counter": 3,
        "FirstChar": "T",
        "Name": "Thomas Taffil",
        "Hash": "e80d48253791a5a083f2b49b0d4a7b70",
        "Weapons": "Walter , Tonfa"
    },
    {
        "Identifier": "5",
        "Group + Name": "Gangster Hafti",
        "Counter": 4,
        "FirstChar": "H",
        "Name": "Hafti",
        "Hash": "e8bf5ce0d5e2d75346b5b4e1282c47d6",
        "Weapons": "Knife , AKAI 47"
    },
    {
        "Identifier": "8",
        "Group + Name": "Press Sz",
        "Counter": 5,
        "FirstChar": "S",
        "Name": "Sz",
        "Hash": "8ad9d3eae1f9fa75fdbcb3fbd0bac00e",
        "Weapons": null
    },
    {
        "Identifier": "9",
        "Group + Name": "Press Max",
        "Counter": 6,
        "FirstChar": "M",
        "Name": "Max",
        "Hash": "8a85c8790f0029a12584bec43c1734d0",
        "Weapons": null
    },
    {
        "Identifier": "10",
        "Group + Name": "Press Max",
        "Counter": 7,
        "FirstChar": "M",
        "Name": "Max",
        "Hash": "9b5b1d4c5ca965f0d2bcd4e039b48cba",
        "Weapons": null
    }
]
```

## Data Reducing
(behaves like MySQL group by on PHP Arrays)


```php
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
```

Output:
```json
{
    "Police": {
        "id": "1, 2, 3",
        "name": "Melanie, Kerstin, Thomas",
        "score": 6
    },
    "Press": {
        "id": "8, 9, 10",
        "name": "Sz, Max",
        "score": 7
    }
}
```
## Read CSV Data


```php
namespace Gressus\Tools;
require('../autoload.php');

$csvService = new CsvService();

$csvService->read('../Data/example-data.csv');

print_r($csvService->getAssociatedArrayData());
```
## Write CSV Data


```php
namespace Gressus\Tools;
require('../autoload.php');

$data = array(
    array('id' => '1', 'group' => 'Police',   'name' => 'Melanie',   'score' => 1, 'full_name' => 'Melanie Meyer'),
    array('id' => '2', 'group' => 'Police',   'name' => 'Kerstin',   'score' => 1, 'full_name' => 'Kerstin Meyer'),
    array('id' => '3', 'group' => 'Police',   'name' => 'Thomas',    'score' => 4, 'full_name' => 'Thomas Thiel'),
    array('id' => '5', 'group' => 'Gangster', 'name' => 'Hafti',     'score' => 10,),
    array('id' => '6', 'group' => 'Gangster', 'name' => 'Fler',      'score' => 0),
    array('id' => '7', 'group' => 'Press',    'name' => 'Steiger',   'score' => 0),
    array('id' => '8', 'group' => 'Press',    'name' => 'Sz',        'score' => 5),
    array('id' => '9', 'group' => 'Press',    'name' => 'Max',       'score' => 1),
    array('id' => '10','group' => 'Press',    'name' => 'Max',       'score' => 1),
);


$csvService = new CsvService();
$csvService
    ->setAssociatedArrayData($data)
    ->setFileName('../Data/example-data-write.csv')
    ->write();
```


## Credits

Many Thanks to [TUDOCK](http://www.tudock.de).
I originally started the development of these Tools working in the nice office at TUDOCK.