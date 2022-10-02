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

<h2>Member Search / Delete Form</h2>

<form method="POST">
    <fieldset>
        <legend class="legendtext"> Member Details &nbsp</legend>
        <p><label for="First_Name">Member Name (First or Last)</label>
            <input type="text" name= "Name_Value" id="Name_Value" required="required" maxlength="25" size="30" pattern="^[a-zA-Z ]+$"/>
    </fieldset>

    <p>
        <input type="submit" name="Search_Member" value="Search Member" class="button" />
        <input type="reset" value="Clear" class="button"/>
    </p>

</form>
<?php
include_once 'includes/Database.php';

$db = new Database();


if(isset($_POST['Search_Member']))
{
    $namevalue = $_POST['Name_Value'];
    $rows = $db->getData(null,'members',null,["firstname LIKE '%$namevalue%' || lastname LIKE '%$namevalue%'"]);


    if(count($rows) <= 0) {
        echo "<p>Member Not Found!</p>";
    } else { ?>
        <style>
            #member{
                margin-left: auto; margin-right: auto; border-collapse: collapse; font-family: 'Source Sans Pro', sans-serif; width: 90%;
            }
        </style>

        <table id="member" border="1">
            <tr>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Email</th>
                <th scope="col">Street Address</th>
                <th scope="col">Suburb/Town</th>
                <th scope="col">Postcode</th>
                <th scope="col">Phone No</th>
                <th scope="col">Preferred Contact</th>
            </tr>
            <?php
            foreach ($rows as $row){?>
                <tr>
                    <td><?php echo $row->firstname ?></td>
                    <td><?php echo $row->lastname ?></td>
                    <td><?php echo $row->email ?></td>
                    <td><?php echo $row->staddress ?></td>
                    <td><?php echo $row->subtown ?></td>
                    <td><?php echo $row->postcode ?></td>
                    <td><?php echo $row->phoneno ?></td>
                    <td><?php echo $row->prefcon ?></td>
                    <td>
                        <form method="post">
                            <input type="hidden" name="id" value="<?php echo $row->id ?>">
                            <input type="submit" name="Delete_Member" value="Delete Member" class="button" />
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </table>
    <?php }
}

if(isset($_POST['Delete_Member'])){
    $id = $_POST["id"];
    if($db->deleteData('members', ["id = '$id'"])){
        echo "<script>alert('Member deleted')</script>";
    }
}
?>

</body>
</html>