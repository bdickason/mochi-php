<?php

abstract class Mapper
{	
	abstract function save(DataEntity $entity);
	abstract function load($identifier);
	protected abstract function createEntity($data);
	protected abstract function extractData(DataEntity $entity);
}