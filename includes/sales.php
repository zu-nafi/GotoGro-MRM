//
<?php
    include_once 'Database.php';
    $db = new Database();

    $memberid = $_POST['Member_ID'];
    $prodname = $_POST['Product_Name'];
    $quantity = $_POST['Quantity'];
    $unitprice = $_POST['Unit_Price'];
    $amount = $_POST['Amount'];
    $purchdate = $_POST['Date'];

    if($db->insertData('sales', ['member_id', 'productname', 'quantity', 'unitprice', 'total', 'purch_date'], [$memberid,$prodname,$quantity,$unitprice,$amount,$purchdate])){
        header("Location: ../addsalesrecord.php?sale=success");
    }
