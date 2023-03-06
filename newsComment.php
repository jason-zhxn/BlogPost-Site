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
session_start();

require '/home/jason.zhan/newsSqlConnection.php';
// csrf token checking
require '/home/jason.zhan/newsCSRF.php';


$commentedArticleId = (int)$_POST['article_id'];

$inputtedComment= (string)$_POST['inputtedComment'];
//inserting comments
$stmt = $mysqli->prepare("insert into comments(username,body,article_id, user_id) values (?,?,?,?)");
if(!$stmt){
	printf ("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

$stmt->bind_param('ssii', $_SESSION['username'], $inputtedComment, $commentedArticleId, $_SESSION['user_id']);

$stmt->execute();

$stmt->close();

header("refresh:2; url=newsPage.php");
echo htmlentities('Your comment was successfully uploaded! You will be redirected to the home page shortly!');
?>


</body>
</html>