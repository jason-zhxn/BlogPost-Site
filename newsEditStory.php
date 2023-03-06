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

$editArticleId = $_SESSION["edit_article_id"];
// deleting old selected story
$stmt = $mysqli->prepare("delete from stories where id=?");

if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

$stmt->bind_param('i', $editArticleId);

$stmt->execute();

$stmt->close();

$editInputtedTitle = (string)$_POST['editInputtedTitle'];
$editInputtedAuthor= (string)$_POST['editInputtedAuthor'];
$editInputtedBody = (string)$_POST['editInputtedBody'];
$editInputtedLink = (string)$_POST['editInputtedLink'];
// replacing old story with new inserted story
$stmt = $mysqli->prepare("insert into stories (title,author, body, link,user_id) values (?, ?,?,?,?)");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

$stmt->bind_param('ssssi', $editInputtedTitle, $editInputtedAuthor, $editInputtedBody, $editInputtedLink, $_SESSION['user_id']);

$stmt->execute();

$stmt->close();

header("refresh:2; url=newsPage.php");
echo htmlentities("Edit Successful! <br> you will be redirected to the home page shortly!");

?>


    




</body>
</html>