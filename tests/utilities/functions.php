<?php 

/**
 * alias for creating a factory output for a given class
 * @param  [type] $class      [description]
 * @param  array  $attributes [description]
 * @return [type]             [description]
 */
function create($class, $attributes = [], $times = null)
{
	return factory($class, $times)->create($attributes);
}

/**
 * alias for making a factory product for a given class
 * @param  [type] $class      [description]
 * @param  array  $attributes [description]
 * @return [type]             [description]
 */
function make($class, $attributes = [], $times = null)
{
	return factory($class, $times)->make($attributes);
}