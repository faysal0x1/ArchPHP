<?php

namespace Core;
class Validator
{

	public function string($value, $min = 1, $max = INF) {
		if (!is_string($value)) {
			return false;
		}
		$length = mb_strlen($value);
		if ($length < $min || $length > $max) {
			return false;
		}
		return true;
	}


	public function email($value) {
		return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
	}

	public function url($value) {
		return filter_var($value, FILTER_VALIDATE_URL) !== false;
	}

	public function integer($value, $min = null, $max = null) {
		if (!is_int($value)) {
			return false;
		}
		if ($min !== null && $value < $min) {
			return false;
		}
		if ($max !== null && $value > $max) {
			return false;
		}
		return true;
	}

	public function boolean($value) {
		return is_bool($value) || in_array($value, [0, 1, '0', '1'], true);
	}

	public function required($value) {
		return !empty($value) || $value === '0';
	}

	public function inArray($value, $array) {
		return in_array($value, $array, true);
	}

	public function date($value, $format = 'Y-m-d') {
		$dateTime = DateTime::createFromFormat($format, $value);
		return $dateTime && $dateTime->format($format) === $value;
	}
}