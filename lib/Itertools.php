<?php

class Itertools {
	public function collectList(array $list, $valueCallback) {
		return array_map(function($i) use ($valueCallback) {
			return $valueCallback($i);
		}, $list);
	}

	public function collectMap(array $list, $keyCallback, $valueCallback) {
		return array_reduce($list, function($acc, $i) use($keyCallback, $valueCallback) {
			$acc[$keyCallback($i)] = $valueCallback($i);
			return $acc;
		}, array());
	}
}
