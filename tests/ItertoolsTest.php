<?php

require 'lib/Itertools.php';
require 'lib/Extractor.php';

class ItertoolsTest extends PHPUnit_Framework_TestCase {
	protected static $data = array(
		array('key' => 'key1', 'value' => 'value1'),
		array('key' => 'key2', 'value' => 'value2'),
		array('key' => 'key3', 'value' => 'value3'),
		array('key' => 'key4', 'value' => 'value4'),
		array('key' => 'key5', 'value' => 'value5'),
	);

	protected static $expectedList = array(
		'value1', 'value2', 'value3', 'value4', 'value5'
	);

	protected static $expectedMap = array(
		'key1' => 'value1',
		'key2' => 'value2',
		'key3' => 'value3',
		'key4' => 'value4',
		'key5' => 'value5',
	);

	public function testCollectListWithKey() {
		$actual = Itertools::collectList(self::$data, Extractor::key('value'));
		$this->assertSame(self::$expectedList, $actual);
	}

	public function testCollectListWithProperty() {
		$dataObjects = array_map(function($row) {
			return (object)$row;
		}, self::$data);
		$actual = Itertools::collectList($dataObjects, Extractor::property('value'));
		$this->assertSame(self::$expectedList, $actual);
	}

	public function testCollectListWithMethod() {
		$dataObjects = array_map(function($row) {
			return new Magic($row);
		}, self::$data);
		$actual = Itertools::collectList($dataObjects, Extractor::method('value'));
		$this->assertSame(self::$expectedList, $actual);
	}

	public function testCollectMapWithKey() {
		$actual = Itertools::collectMap(self::$data, Extractor::key('key'), Extractor::key('value'));
		$this->assertSame(self::$expectedMap, $actual);
	}

	public function testCollectMapWithProperty() {
		$dataObjects = array_map(function($row) {
			return (object)$row;
		}, self::$data);
		$actual = Itertools::collectMap($dataObjects, Extractor::property('key'), Extractor::property('value'));
		$this->assertSame(self::$expectedMap, $actual);
	}

	public function testCollectMapWithMethod() {
		$dataObjects = array_map(function($row) {
			return new Magic($row);
		}, self::$data);
		$actual = Itertools::collectMap($dataObjects, Extractor::method('key'), Extractor::method('value'));
		$this->assertSame(self::$expectedMap, $actual);
	}
}

class Magic {
	public function Magic($data) {
		$this->data = $data;
	}

	public function __call($method, $params) {
		return $this->data[$method];
	}
}
