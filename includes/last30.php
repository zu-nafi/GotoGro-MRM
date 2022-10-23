<?php
include_once 'Database.php';
$db = new Database();
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=data_last_30_days.csv');
$output = fopen("php://output", "w");
fputcsv($output, array('Product Name', 'Quantity', 'Unit Price', 'Total', 'Purchase Date'));
// get last 30 days sales
$data = $db->getData("SELECT productname, quantity, unitprice, total, purch_date FROM sales WHERE purch_date BETWEEN DATE_SUB(NOW(), INTERVAL 30 DAY) AND NOW() ORDER BY purch_date DESC");
foreach ($data as $d){
    fputcsv($output, (array) $d);
}
fclose($output);