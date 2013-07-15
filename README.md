PHP Itertools

## Usage

Simple value extraction from arrays. Inspired by the more verbose version we use at work.

```php
$people = array(
	array('first_name' => 'Ren', 'last_name' => 'Hoek'),
	array('first_name' => 'Stimpson', 'last_name' => 'Cat'),
);

$firsts = Itertools::collectList($people, Extractor::key('first_name'));

// array('Ren', 'Stimpson')
```

## Test

```
% phpunit tests/ItertoolsTest.php 
```