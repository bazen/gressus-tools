Gressus Tools for PHP-Developers
=======================

Gressus Tools is a collection of PHP Scripts for easy Data Manipulation, CSV read and write and Object Access.


## Data Mapping

You can map a source array to a target array and even apply filters and post converters.
This can help you when programming Import-Scriopts with large datasets from one format to another.

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

print_r($mappedData);


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

print_r($reducedData);
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