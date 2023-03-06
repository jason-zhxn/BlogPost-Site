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
      
      
      $commentArticleId = (int)$_POST['article_id'];
    // form for inserting comments
      echo('
      <form action = "newsComment.php" method = "post" >
      type your comment: <input type = "text" name="inputtedComment"/> 
      <input type = "submit" name = "Submit" value = "submit" />
      <input type = "hidden" name = "article_id" value = "'.$commentArticleId.'"/>
      <input type = "hidden" name = "token" value = "'.$_SESSION['token'].'"/>
      ');
      
?>
        




</body>
</html>