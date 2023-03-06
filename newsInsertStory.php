<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
success
    <?php
require '/home/jason.zhan/newsSqlConnection.php';

// csrf token checking
require '/home/jason.zhan/newsCSRF.php';

$inputtedTitle= (string)$_POST['inputtedTitle'];
$inputtedAuthor= (string)$_POST['inputtedAuthor'];
$inputtedBody = (string)$_POST['inputtedBody'];
$inputtedLink = (string)$_POST['inputtedLink'];
$token = $_POST['token'];

// inserting story

$stmt = $mysqli->prepare("insert into stories (title,author, body, link,user_id) values (?, ?,?,?,?)");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

$stmt->bind_param('ssssi', $inputtedTitle, $inputtedAuthor, $inputtedBody, $inputtedLink, $_SESSION['user_id']);

$stmt->execute();

$stmt->close();

header("refresh:2; url=newsPage.php");
echo htmlentities('you will be redirected to the home page shortly!');

?>
</body>
</html>