<?php

use Code16\Warp\Warp;
use Closure;
use Stubs\ArrayableClass;
use Stubs\JsonableClass;
use Stubs\JsonableArrayableClass;
use Illuminate\Support\Collection;

class WarpTest extends PHPUnit_Framework_TestCase
{
	/** @test */
	public function we_can_use_get_to_retrieve_a_single_string()
	{
		$warp = new Warp;
		$warp->put('key', 'value');
		$this->assertEquals('value', $warp->get('key'));
	}

	/** @test */
	public function we_can_use_get_to_retrieve_a_single_array()
	{
		$warp = new Warp;
		$warp->put('key', [
			'a' => 'a',
			'b' => 'b',
		]);
		$this->assertEquals([
			'a' => 'a',
			'b' => 'b',
		], $warp->get('key'));
	}

	/** @test */
	public function we_can_use_dump_to_retrieve_the_whole_payload()
	{
		$warp = new Warp;
		$warp->put('keyA', 'A');
		$warp->put('keyB', 'B');
		$this->assertEquals([
			'keyA' => 'A',
			'keyB' => 'B',
		], $warp->dump());
	}

	/** @test */
	public function we_can_use_a_callback_as_a_data_provider()
	{
		$warp = new Warp;
		$warp->put('callback', function() {
			return 'value';
		});
		$this->assertEquals('value', $warp->get('callback'));

	}

	/** @test */
	public function we_can_add_a_jsonable_item()
	{
		$warp = new Warp;
		$warp->put('json', new JsonableClass());
		$this->assertEquals(['json'], json_decode($warp->get('json')));
	}

	/** @test */
	public function we_can_use_an_arrayable_item()
	{
		$warp = new Warp;
		$warp->put('array', new ArrayableClass());
		$this->assertEquals(['array'], $warp->get('array'));
	}

	/** @test */
	public function jsonable_is_preffered_to_arrayable()
	{
		$warp = new Warp;
		$warp->put('mixed', new JsonableArrayableClass());
		$this->assertTrue(is_string($warp->get('mixed')));
		$this->assertEquals(['json'], json_decode($warp->get('mixed')));
	}
}
