<?php

class Extractor {
	public static function key($name) {
		return function($o) use ($name) {
			return $o[$name];
		};
	}

	public static function property($name) {
		return function($o) use ($name) {
			return $o->$name;
		};
	}

	public static function method($name /* , ... */) {
		$params = func_num_args() > 1 ? array_slice(func_get_args(), 1) : array();
		return function($o) use ($name, $params) {
			return call_user_method_array($name, $o, $params);
		};
	}
}
