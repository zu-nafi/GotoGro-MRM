//
<?php
include_once "includes/Database.php";
$db = new Database();
$id = $_GET['id'];
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $memberid = $_POST['Member_ID'];
    $prodname = $_POST['Product_Name'];
    $quantity = $_POST['Quantity'];
    $unitprice = $_POST['Unit_Price'];
    $amount = $_POST['Amount'];
    $purchdate = $_POST['Date'];
    if($db->updateData('sales', ['member_id', 'productname', 'quantity', 'unitprice', 'total', 'purch_date'], [$memberid,$prodname,$quantity,$unitprice,$amount,$purchdate], ["id = '$id'"])){
        echo "<script>alert('Record updated successfully!')</script>";
    }
}
$record = $db->getData(null,'sales',null, ["id = '$id'"])[0];
$products = [
    ['name' => 'Select Product', 'price' => 0],
    ['name' => 'Chicken', 'price' => 50],
    ['name' => 'Fish', 'price' => 30],
    ['name' => 'Pasta', 'price' => 20],
    ['name' => 'Rice', 'price' => 40],
    ['name' => 'Bread', 'price' => 50],
    ['name' => 'Flour', 'price' => 32],
    ['name' => 'Cereal', 'price' => 20],
    ['name' => 'Oil', 'price' => 10],
    ['name' => 'Butter', 'price' => 70],
    ['name' => 'Milk', 'price' => 30],
    ['name' => 'Eggs', 'price' => 40],
    ['name' => 'Yogurt', 'price' => 60],
    ['name' => 'Onions', 'price' => 70],
    ['name' => 'Garlic', 'price' => 20],
    ['name' => 'Lentil', 'price' => 40],
    ['name' => 'Tomatoes', 'price' => 60],
    ['name' => 'Salt', 'price' => 90],
    ['name' => 'Honey', 'price' => 60],
    ['name' => 'Vinegar', 'price' => 10],
    ['name' => 'Sugar', 'price' => 30],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>


    <link href= "style.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300&family=Source+Sans+Pro:wght@300&display=swap" rel="stylesheet">

    <title>Goto Gro MRM</title>
</head>


<body>
<div id="header">
    <div id="titleboxone"></div>
    <div id="titleboxtwo">
        <h1 id="titleheading">Goto Grocery</h1>
    </div>
</div>

<div id="navbarbg">
    <p id="navbartext">
        <a id="whitelink" href="index.php"> Home &nbsp;</a> | &nbsp;
        <a id="whitelink" href="addmember.php">Add Member &nbsp;</a> | &nbsp;
        <a id="whitelink" href="membersearchdelete.php">Member Search/Delete &nbsp;</a> | &nbsp;
        <a id="whitelink" href="addsalesrecord.php">Add Sales Record &nbsp;</a> | &nbsp;
        <a id="whitelink" href="salesrecordsearchdelete.php">Sales Record Search/Delete </a>
    </p>
</div>

<h2>Edit Sales Record</h2>


<form action="" method="POST">
    <input type="hidden" name="Member_ID" value="<?php echo $record->member_id ?>">
    <fieldset>
        <legend class="legendtext">Product Details &nbsp</legend>
        <p><label for="Product_Name">Product Name</label>
            <select type="text" name= "Product_Name" id="Product_Name" required="required">
                <?php foreach ($products as $key => $product){ ?>
                    <option price="<?php echo $product['price'] ?>" value="<?php echo $product['name'] ?>"><?php echo $product['name'] ?></option>
                <?php } ?>
            </select></p>
        <p><label for="Quantity">Quantity</label>
            <input type="text" name= "Quantity" id="Quantity" required="required" size="10" maxlength="5" pattern="\d{1-5}" value="<?php echo $record->quantity?>"/></p>
        <p><label for="Unit_Price">Unit Price</label>
            <input type="text" name= "Unit_Price" id="Unit_Price" required="required" size="10" maxlength="5" pattern="\d{1-5}" value="<?php echo $record->unitprice?>" /></p>
        <p><label for="Amount">Total Amount</label>
            <input type="text" name= "Amount" id="Amount" required="required" size="10" maxlength="5" pattern="\d{1-5}" value="<?php echo $record->total?>" /></p>

    </fieldset>


    <fieldset>
        <legend class="legendtext">Time &nbsp</legend>
        <p><label for="Date">Date : </label>
            <input type="date" id="Date" name="Date" required value="<?php echo $record->purch_date?>"></p>
    </fieldset>


    <p><input type="submit" value="Update Sales Record" class="button" />

</form>


<script>
    const products = document.getElementById('Product_Name');
    products.addEventListener('change',function(){
        const price = products.options[products.selectedIndex].getAttribute('price');
        document.getElementById('Unit_Price').value = price;
        const quantity = document.getElementById('Quantity').value;
        document.getElementById('Amount').value = quantity * price;
    })
    document.getElementById('Quantity').addEventListener('keyup',function(){
        const quantity = document.getElementById('Quantity').value;
        const price = document.getElementById('Unit_Price').value;
        document.getElementById('Amount').value = quantity * price;
    })
</script>
</body>
</html>

