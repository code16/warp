<?php

namespace Remic/Warp;

use Illuminate\Support\Arrayable;

class Warp
{
	protected $data = [];

	/** 
	 * Dump all data
	 * @return [type] [description]
	 */
	public function dump()
	{
		$data = array_map($this->data, function($item) {
			$item instanceof Arrayable ? return $item->toArray() : $item;
		});

		$data['csrf_token'] = csrf_token();

		return $data;
	}

	public function put($key, $value)
	{
		$this->data[$key] = $value;
	}

}
