<?php

namespace Remic/Warp;

use Illuminate\Support\Arrayable;

class Warp
{
	protected $data = [];

	/** 
	 * Dump all data
	 * 
	 * @return array
	 */
	public function dump()
	{
		$data = array_map($this->data, function($item) {
			$item instanceof Arrayable ? return $item->toArray() : $item;
		});

		return $data;
	}

	public function put($key, $value)
	{
		$this->data[$key] = $value;
	}

}
