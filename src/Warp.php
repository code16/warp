<?php

namespace Remic\Warp;

use Illuminate\Support\Arrayable;

class Warp
{
	protected static $instance;

	protected $data = [];

	public function __construct()
	{
		static::$instance = $this;
	}

	public static function getInstance()
	{
		return static::$instance;
	}

	/** 
	 * Dump all data
	 * 
	 * @return array
	 */
	public function dump()
	{
		$data = array_map(function($item) {
			return $item instanceof Arrayable ? $item->toArray() : $item;
		}, $this->data);

		return $data;
	}

	public function put($key, $value)
	{
		$this->data[$key] = $value;
	}

}
