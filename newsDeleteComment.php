<?php
session_start();
?>
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
// csrf token checking
require '/home/jason.zhan/newsCSRF.php';

$comment_id= (int)$_POST['comment_id'];

// deleting comments with matching comment id
$stmt = $mysqli->prepare("delete from comments where id=?");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

$stmt->bind_param('i', $comment_id);

$stmt->execute();

$stmt->close();

header("refresh:2; url=newsPage.php");
echo htmlentities('success! You will be redirected to the home page shortly!');

?>
</body>
</html>