<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php
require '/home/jason.zhan/newsSqlConnection.php';

$chosenUsername= (string)$_POST['chosenUsername'];
$chosenPassword = (string)$_POST['chosenPassword'];
$chosenEmail = (string)$_POST['chosenEmail'];

//putting account credentials into userInfo data table

$stmt = $mysqli->prepare("insert into userInfo (username,hashed_pass, email) values (?, ?,?)");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}
$hashedChosenPassword = password_hash($chosenPassword,PASSWORD_BCRYPT);

$stmt->bind_param('sss', $chosenUsername, $hashedChosenPassword, $chosenEmail);

$stmt->execute();

$stmt->close();

?>
Account created successfully.
<a href="newsLoginPage.php">Click here to return to login page.</a>

</body>
</html>