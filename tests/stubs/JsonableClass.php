<?php

namespace Stubs;

use Illuminate\Contracts\Support\Jsonable;

class JsonableClass implements Jsonable
{
	public function toJson($options = 0)
	{
		return json_encode(['json']);
	}
}
