/
<?php
include_once 'includes/Database.php';
$database = new Database();
$id = $_GET["id"];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST['First_Name'];
    $lastname = $_POST['Last_Name'];
    $email = $_POST['Email_ID'];
    $staddress = $_POST['Street_Address'];
    $subtown = $_POST['Suburb/Town'];
    $postcode = $_POST['Postcode'];
    $phoneno = $_POST['Phone_Number'];
    $prefcon = $_POST['Preferred_Contact'];
    $resutl = $database->updateData(
        "members",
        ["firstname", "lastname", "email", "staddress", "subtown", "postcode", "phoneno", "prefcon"],
        [$firstname,$lastname,$email,$staddress,$subtown,$postcode,$phoneno,$prefcon],
        ["id" => $id]
    );
    if ($resutl) {
        echo "<script>alert('Member Updated Successfully!');</script>";
    } else {
        echo "<script>alert('Member Update Failed!');</script>";
    }
}
$data = $database->getData(null, 'members', null, ["id = '$id'"])[0];
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

<h2>Edit Member</h2>

<form method="POST">
    <fieldset>
        <legend class="legendtext"> Personal Details &nbsp</legend>
        <p><label for="First_Name">First Name</label>
            <input type="text" name= "First_Name" id="First_Name" required="required" maxlength="25" size="30" pattern="^[a-zA-Z ]+$" value="<?php echo $data->firstname ?>"/>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <label for="Last_Name">Last Name</label>
            <input type="text" name= "Last_Name" id="Last_Name" required="required" maxlength="25" size="30" pattern="^[a-zA-Z ]+$" value="<?php echo $data->lastname ?>"/></p>
        <p><label for="Email_ID">Email Address</label>
            <input type="email" name= "Email_ID" id="Email_ID" required="required" size="30" placeholder="name@example.com" value="<?php echo $data->email ?>" /></p>
    </fieldset>

    <fieldset>
        <legend class="legendtext">Address &nbsp</legend>
        <p><label for="Street_Address">Street Address</label>
            <input type="text" name= "Street_Address" id="Street_Address" required="required" maxlength="40" size="40" value="<?php echo $data->staddress ?>" /></p>
        <p><label for="Suburb/Town">Suburb/Town</label>
            <input type="text" name= "Suburb/Town" id="Suburb/Town" required="required" maxlength="20" size="20" value="<?php echo $data->subtown ?>" /></p>
        <p><label for="Postcode">Postcode</label>
            <input type="text" name= "Postcode" id="Postcode" required="required" size="10" maxlength="4" pattern="\d{4}" value="<?php echo $data->postcode ?>" /></p>
    </fieldset>

    <fieldset>
        <legend class="legendtext">Contact Details &nbsp</legend>
        <p><label for="Phone_Number">Phone Number</label>
            <input type="tel" name= "Phone_Number" id="Phone_Number" required="required" size="20" maxlength="10" pattern="\d{10}" placeholder="(##) ####-####" value="<?php echo $data->phoneno ?>" />
        </p>
        <p><label>Preferred Contact</label><br />
            <input type="radio" name="Preferred_Contact" value="Email" required="required" checked="checked" />Email
            <input type="radio" name="Preferred_Contact" value="Post" required="required" />Post
            <input type="radio" name="Preferred_Contact" value="Phone" required="required" />Phone
    </fieldset>

    <p><input type="submit" value="Update Member" class="button" />

</form>


<?php
if(isset($_GET["member"]) && $_GET["member"] == "success"){
    echo "<script>alert('Member added')</script>";
}
?>
</body>
</html>
