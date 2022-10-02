<?php
include_once 'Database.php';
$db = new Database();
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=data.csv');
$output = fopen("php://output", "w");
fputcsv($output, array('Product Name', 'Quantity', 'Unit Price', 'Total', 'Purchase Date'));
$data = $db->getData(null, 'sales', ['productname', 'quantity', 'unitprice', 'total', 'purch_date'], null,'purch_date,desc');
foreach ($data as $d){
    fputcsv($output, (array) $d);
}
fclose($output);
