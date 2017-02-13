<?php

namespace Stubs;

use Illuminate\Contracts\Support\Arrayable;

class ArrayableClass implements Arrayable
{

	public function toArray()
	{
		return ['array'];
	}
}