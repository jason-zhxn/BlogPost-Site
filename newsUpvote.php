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

    // code to increment the upvote count when the button is pressed
    $likeArticleId = (int)$_POST['article_id'];
    require '/home/jason.zhan/newsSqlConnection.php';

    $stmt = $mysqli->prepare("update stories set upvotes=upvotes+1 where id=?;");
    if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }

    $stmt->bind_param('i', $likeArticleId);

    $stmt->execute();

    $stmt->close();
    //quick refresh to display new upvotes
    header("refresh:0; url=newsPage.php");
    echo htmlentities('you will be redirected to the home page shortly!');
    ?>






</body>
</html>