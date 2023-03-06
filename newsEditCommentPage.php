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
      $editCommentId = (int)$_POST['comment_id'];

        //form to edit comment
      echo('
      <form action = "newsEditComment.php" method = "post" >
      retype your new comment: <input type = "text" name="inputtedComment"/> 
      <input type = "submit" name = "Submit" value = "submit" />
      <input type = "hidden" name = "article_id" value = "'.$commentArticleId.'"/>
      <input type = "hidden" name = "comment_id" value = "'.$editCommentId.'"/>
      <input type = "hidden" name = "token" value = "'.$_SESSION['token'].'"/>
      </form> ');
      
?>
    
        
    
</body>
</html>