<?php

namespace Remic\Warp;

use Closure;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;

class Warp
{
	/**
	 * The class instance
	 * 
	 * @var Warp
	 */
	protected static $instance;

	/**
	 * The Key-value data store
	 * 
	 * @var array
	 */
	protected $data = [];

	/**
	 * Data providers can be register as closures, which
	 * will only be resolved if explecitely requested, thus
	 * saving performances if not needed in the current request 
	 * 
	 * @var array
	 */
	protected $callables = [];

	public function __construct()
	{
		static::$instance = $this;
	}

	/**
	 * Return singleton instance
	 * 
	 * @return Warp
	 */
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
		$this->callCallables();

		return array_map([$this, 'transformSingleItem'], $this->data);
	}

	/**
	 * Call callables and fill data
	 * 
	 * @return void
	 */
	protected function callCallables()
	{
		foreach(array_keys($this->callables) as $key) {
			$this->callableToData($key);
		}
	}

	/**
	 * Get callable value
	 * 
	 * @param  string $key 
	 * @return mixed
	 */
	protected function callableToData(string $key)
	{
		$this->data[$key] = call_user_func($this->callables[$key]);
		unset($this->callables[$key]);
	}

	/**
	 * Smart transform item for Json Conversion
	 * 
	 * @param  mixed $item]
	 * @return mixed
	 */
	protected function transformSingleItem($item)
	{
		if($item instanceof Jsonable) {
			return $item->toJson();
		}
		if($item instanceof Arrayable) {
			return $item->toArray();
		}
		return $item;
	}

	/**
	 * Add a key to the
	 *  
	 * @param  string  $key   
	 * @param  mixed   $value 
	 * @return void
	 */
	public function put(string $key, $value)
	{
		if($value instanceof Closure) {
			$this->callables[$key] = $value;
			return;
		}

		$this->data[$key] = $value;
	}

	/**
	 * Return transformed value
	 * 
	 * @param  string $key 
	 * @return mixed
	 */
	public function get(string $key)
	{
		if(array_key_exists($key, $this->callables)) {
			$this->callableToData($key);
		}

		return $this->transformSingleItem($this->data[$key]);
	}

}
