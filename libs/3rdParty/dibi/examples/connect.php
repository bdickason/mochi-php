<h1>dibi::connect() example</h1>
<?php

require_once 'Nette/Debug.php';
require_once '../dibi/dibi.php';


// connects to SQlite
echo '<p>Connecting to Sqlite: ';
try {
	dibi::connect(array(
		'driver'   => 'sqlite',
		'database' => 'sample.sdb',
	));
	echo 'OK';

} catch (DibiException $e) {
	echo get_class($e), ': ', $e->getMessage(), "\n";
}
echo "</p>\n";



// connects to MySQL using DSN
echo '<p>Connecting to MySQL: ';
try {
	dibi::connect('driver=mysql&host=localhost&username=root&password=xxx&database=test&charset=utf8');
	echo 'OK';

} catch (DibiException $e) {
	echo get_class($e), ': ', $e->getMessage(), "\n";
}
echo "</p>\n";



// connects to MySQLi using array
echo '<p>Connecting to MySQL: ';
try {
	dibi::connect(array(
		'driver'   => 'mysqli',
		'host'     => 'localhost',
		'username' => 'root',
		'password' => 'xxx',
		'database' => 'dibi',
		'charset'  => 'utf8',
	));
	echo 'OK';

} catch (DibiException $e) {
	echo get_class($e), ': ', $e->getMessage(), "\n";
}
echo "</p>\n";



// connects to ODBC
echo '<p>Connecting to ODBC: ';
try {
	dibi::connect(array(
		'driver'   => 'odbc',
		'username' => 'root',
		'password' => '***',
		'dsn'      => 'Driver={Microsoft Access Driver (*.mdb)};Dbq='.dirname(__FILE__).'/sample.mdb',
	));
	echo 'OK';

} catch (DibiException $e) {
	echo get_class($e), ': ', $e->getMessage(), "\n";
}
echo "</p>\n";



// connects to PostgreSql
echo '<p>Connecting to PostgreSql: ';
try {
	dibi::connect(array(
		'driver'     => 'postgre',
		'string'     => 'host=localhost port=5432 dbname=mary',
		'persistent' => TRUE,
	));
	echo 'OK';

} catch (DibiException $e) {
	echo get_class($e), ': ', $e->getMessage(), "\n";
}
echo "</p>\n";



// connects to PDO
echo '<p>Connecting to Sqlite via PDO: ';
try {
	dibi::connect(array(
		'driver'  => 'pdo',
		'dsn'     => 'sqlite2::memory:',
	));
	echo 'OK';

} catch (DibiException $e) {
	echo get_class($e), ': ', $e->getMessage(), "\n";
}
echo "</p>\n";



// connects to MS SQL
echo '<p>Connecting to MS SQL: ';
try {
	dibi::connect(array(
		'driver'   => 'mssql',
		'host'     => 'localhost',
		'username' => 'root',
		'password' => 'xxx',
	));
	echo 'OK';

} catch (DibiException $e) {
	echo get_class($e), ': ', $e->getMessage(), "\n";
}
echo "</p>\n";



// connects to Oracle
echo '<p>Connecting to Oracle: ';
try {
	dibi::connect(array(
		'driver'   => 'oracle',
		'username' => 'root',
		'password' => 'xxx',
		'database' => 'db',
	));
	echo 'OK';

} catch (DibiException $e) {
	echo get_class($e), ': ', $e->getMessage(), "\n";
}
echo "</p>\n";