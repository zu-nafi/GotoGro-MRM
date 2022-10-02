<?php
include_once 'includes/Database.php';
$db = new Database();
$members = $db->getData(null,'members', ['id','firstname', 'lastname'], null, 'id,desc');
$memberid = '';
$sales = [];
if(isset($_GET["member"])){
    $memberid = $_GET["member"];
    $sales = $db->getData(null,'sales', null, ["member_id = $memberid"], 'id,desc');
}
if(isset($_POST['Delete_Sales'])){
    $id = $_POST["id"];
    if($db->deleteData('sales', ["id = '$id'"])){
        echo "<script>alert('Sales Record Deleted')</script>";
    }
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

<h2>Sales Record Search Form</h2>


<form method="post">
    <fieldset>
        <legend class="legendtext"> Member and Sales Details &nbsp</legend>
        <p><label for="Member_ID">Select Member</label>
            <select name="Member_ID" id="Member_ID" required onchange="selectMember(this)">
                <option value="">Select Member</option>
                <?php
                foreach ($members as $member){
                    $selected = '';
                    if(!empty($memberid)){
                        $selected = $member->id == $memberid ? 'selected' : '';
                    }
                    ?>
                    <option <?php echo $selected ?> value="<?php echo $member->id ?>"><?php echo $member->firstname." ".$member->lastname ?></option>
                <?php } ?>
            </select>
        </p>

        <p><label for="Sales_ID">Sales Date</label>
            <select name="Sales_ID" id="Sales_ID">
                <option value="">Select Date</option>
                <?php
                foreach ($sales as $sale){ ?>
                    <option value="<?php echo $sale->id ?>"><?php echo $sale->purch_date ?></option>
                <?php } ?>
            </select>
        </p>
    </fieldset>

    <p>
        <input type="submit" name="Search_Sales" value="Search Sales Record" class="button" />
        <input type="reset" value="Clear" class="button"/>
        <a href="/includes/export.php?id=<?php echo isset($_GET["member"]) ? $_GET["member"] : '' ?>" class="button">Download Sales Analysis</a>
    </p>

</form>

<!--<form action="includes/export.php" method="POST">-->
<!--    <input type="submit" name="Export_Analyze" value="Download Sales Analysis" class="button" />-->
<!--</form>-->
<br><br>
<?php
if(isset($_POST['Search_Sales']))
{
    $salesid = $_POST['Sales_ID'];
    $memberid = $_POST['Member_ID'];

    $record = $db->getData(null,'sales', null, ["id='$salesid' && member_id='$memberid'"]);

    if(count($record) <= 0) {
        echo "<p>Sales record not found</p>";
    } else {?>
        <style>
            #member{
                margin-left: auto; margin-right: auto; border-collapse: collapse; font-family: 'Source Sans Pro', sans-serif; width: 90%;
            }
        </style>
        <table id="member" border="1">
            <tr>
                <th scope="col">Product Name</th>
                <th scope="col">Quantity</th>
                <th scope="col">Unit Price</th>
                <th scope="col">Total</th>
                <th scope="col">Purchase Date</th>
                <th></th>
            </tr>
            <?php
            foreach ($record as $row){?>
                <tr>
                    <td><?php echo $row->productname ?></td>
                    <td><?php echo $row->quantity ?></td>
                    <td><?php echo $row->unitprice ?></td>
                    <td><?php echo $row->total ?></td>
                    <td><?php echo $row->purch_date ?></td>
                    <td>
                        <form method="post">
                            <input type="hidden" name="id" value="<?php echo $row->id ?>">
                            <input type="submit" name="Delete_Sales" value="Delete Sales Record" class="button" />
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </table>
    <?php } } ?>

<script>
    function selectMember($this){
        window.location = window.location.href.split('?')[0] + '?member=' + $this.value;
    }
</script>
</body>
</html>