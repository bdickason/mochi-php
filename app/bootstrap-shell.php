<?php

$dir = dirname(__FILE__);

define ('APP_DIR', $dir);
define ('LIBS_DIR', $dir . '/../libs');

// Step 1: Load Nette Framework
// this allows Nette to load classes automatically so that
// you don't have to litter your code with 'require' statements
require_once LIBS_DIR . '/Nette/loader.php';

// Step 2: Enable Nette\Debug
// for better exception and error visualisation

//Debug::enable();
Environment::loadConfig();

dibi::connect(Environment::getConfig('database'));

