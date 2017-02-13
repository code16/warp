<?php

namespace Stubs;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;

class JsonableArrayableClass implements Arrayable, Jsonable
{

	public function toArray()
	{
		return ['array'];
	}

	public function toJson($options = 0)
	{
		return json_encode(['json']);
	}
}