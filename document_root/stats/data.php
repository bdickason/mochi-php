<?php 

$con = mysql_connect("127.0.0.1:3306","root","l4m3rs"); 

if (!$con) {
  die('Could not connect: ' . mysql_error()); 
} 

mysql_select_db("mochi", $con); 

switch($_GET['report']) {
  
  case clients:
    $result = mysql_query("SELECT t.transaction_created_date, te.transaction_entry_uid, COUNT(DISTINCT t.transaction_uid) FROM transactions_entries as te INNER JOIN transactions as t ON t.transaction_id = te.transaction_id GROUP BY te.transaction_entry_uid, YEAR(t.transaction_created_date), MONTH(t.transaction_created_date) ORDER BY YEAR(t.transaction_created_date), MONTH(t.transaction_created_date)"); 
    break;
  case 'revenue':
    $result = mysql_query("SELECT DATE_FORMAT(t.transaction_created_date, '%Y-%m'), te.transaction_entry_uid, SUM(te.`transaction_entry_price_added`) FROM transactions_entries as te INNER JOIN transactions as t ON t.transaction_id = te.transaction_id GROUP BY te.transaction_entry_uid, YEAR(t.transaction_created_date), MONTH(t.transaction_created_date) ORDER BY YEAR(t.transaction_created_date), MONTH(t.transaction_created_date)"); 
    break;
  default:
    break;
  
}


while($row = mysql_fetch_array($result)) {
  echo $row[0] . "\t" . $row[1]. "\t" . $row[2]. "\n";
  } 

mysql_close($con); 

?>