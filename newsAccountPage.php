<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>Welcome to your posts!</h1>
<br>
These are all the articles you posted:

<?php
session_start();
require '/home/jason.zhan/newsSqlConnection.php';

//selecting all stories that match current user's id
$stmt = $mysqli->prepare("select title, author, id from stories where user_id=?");
if(!$stmt){
    printf("Query Prep Failed: %s\n",$mysqli->error);
    exit;
}
$stmt->bind_param('i', $_SESSION['user_id']);
$stmt->execute();
$stmt->bind_result($title, $author, $article_id);

echo"<ul>\n";
// printing all the stories that match the user's id
while($stmt->fetch()){
    printf("\t<li>%s by %s</li>\n", 
        htmlentities($title),
        htmlentities($author)
    );
    echo"</ul>\n";
    echo('<form action = "newsDetailedPage.php" method = "post">  
        <input type = "submit" name = "openStory" value="open" />
        <input type = "hidden" name = "article_id" value = "'.$article_id.'"></form>
    ');
    
}
?>
<br>
<br>
<br>
<a href="newsPage.php">Go back to the home page here</a>


    
</body>
</html>