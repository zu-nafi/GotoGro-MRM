//
<?php
include_once 'Database.php';

$db = new Database();

$firstname = $_POST['First_Name'];
$lastname = $_POST['Last_Name'];
$email = $_POST['Email_ID'];
$staddress = $_POST['Street_Address'];
$subtown = $_POST['Suburb/Town'];
$postcode = $_POST['Postcode'];
$phoneno = $_POST['Phone_Number'];
$prefcon = $_POST['Preferred_Contact'];

if(!$db->isRecordExists('members',["email = '$email'"])){
    $result = $db->insertData('members', ['firstname', 'lastname', 'email', 'staddress', 'subtown', 'postcode', 'phoneno', 'prefcon'], [$firstname, $lastname, $email, $staddress, $subtown, $postcode, $phoneno, $prefcon]);
    if($result){
        header("Location: ../addmember.php?member=success");
    }
}else{
    echo "<h1> Member already exists</h1>";
    header("Location: ../addmember.php?member=failure");
    return false;
}
