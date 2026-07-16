<?php
/*
* Do not forget to set the right credentials in the class for the mysql connection
* modify the queries here below.
*/

include('class.mysql2xls_xml.php');

$xls_xml = new excel_xml;

/*
* short query: select all fields from table
*/
$xls_xml->short_query('akempcodb','tbl_product');
$xls_xml->save_as('output_short.xml');

$xls_xml = new excel_xml;

/*
* short query: select field_1 ans field_2 from table, orders by field_1 and limit 2 records
*/
$xls_xml->short_query('akempcodb','tbl_product', array('prod_no','prod_name'), ' ORDER BY prod_name');
$xls_xml->save_as('output_short_extended.xml');

$xls_xml = new excel_xml;

/*
* short query: select all fields from table where field_1 > 0 and field_1 < 100, orders by field_1 and limit 1 record
* this method can be used for more complex queries with joins and so on...
*/
//$xls_xml->long_query('dbase_name','SELECT * FROM table_name WHERE field_1 > 0 AND field_1 < 100 ORDER BY field_1 LIMIT 1');
//$xls_xml->save_as('output_long.xml');

/*
* send the output to browser and triggers the office software. Tested with MS Office 2007 and libre office 3.6.2.2
*/
$xls_xml->to_excel('output_to_browser.xml');
?>