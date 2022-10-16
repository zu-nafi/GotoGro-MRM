/
<?php
include_once "includes/Database.php";
$db = new Database();
if(isset($_GET["sale"]) && $_GET["sale"] == "success"){
    echo "<script>alert('Sales Record Added')</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>

    <link href= "style.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300&family=Source+Sans+Pro:wght@300&display=swap" rel="stylesheet">

        <title>GotoGro-MRM</title>
</head>


<body>
<div id="header">
    <div id="titleboxone"></div>
    <div id="titleboxtwo">
                    <h1 id="titleheading">GotoGro-MRM</h1>
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

<h2>Add Sales Record Form</h2>


<form action="includes/sales.php" method="POST">
    <fieldset>
        <legend class="legendtext">Member Details</legend>
        <label for="Member_ID">Select Member</label>
        <select name= "Member_ID" id="Member_ID" required>
            <option value="">Select Member</option>
            <?php
                $members = $db->getData(null,'members', ['id','firstname', 'lastname'], null, 'id,desc');
                foreach ($members as $member){?>
                    <option value="<?php echo $member->id ?>"><?php echo $member->firstname." ".$member->lastname ?></option>
                <?php } ?>
        </select>
        <br><br>
    </fieldset>
    <fieldset>
        <legend class="legendtext">Product Details &nbsp</legend>
        <p><label for="Product_Name">Product Name</label>
            <input type="text" name= "Product_Name" id="Product_Name" required="required" maxlength="20" size="20" pattern="^[a-zA-Z ]+$"/></p>
        <p><label for="Quantity">Quantity</label>
            <input type="text" name= "Quantity" id="Quantity" required="required" size="10" maxlength="5" pattern="\d{1-5}" /></p>
        <p><label for="Unit_Price">Unit Price</label>
            <input type="text" name= "Unit_Price" id="Unit_Price" required="required" size="10" maxlength="5" pattern="\d{1-5}" /></p>
        <p><label for="Amount">Total Amount</label>
            <input type="text" name= "Amount" id="Amount" required="required" size="10" maxlength="5" pattern="\d{1-5}" /></p>

    </fieldset>


    <fieldset>
        <legend class="legendtext">Time &nbsp</legend>
        <p><label for="Date">Date : </label>
            <input type="date" id="Date" name="Date" required></p>
    </fieldset>


    <p><input type="submit" value="Add Sales Record" class="button" />
        <input type="reset" value="Clear" class="button"/></p>

</form>


</body>
</html>

