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
// checking csrf token
require '/home/jason.zhan/newsCSRF.php';

//deleting stories with matching article id
$article_id = (int)$_POST['article_id'];
$stmt = $mysqli->prepare("delete from stories where id=?");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

$stmt->bind_param('i', $article_id);

$stmt->execute();

$stmt->close();

header("refresh:2; url=newsPage.php");
echo htmlentities('you will be redirected to the home page shortly!');

?>
</body>
</html>