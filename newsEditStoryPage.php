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
    $editArticleId = (int)$_POST["article_id"];
    session_start();
    $_SESSION['edit_article_id']=$editArticleId;
    ?>
Reinsert all the information you would like for your newly edited story<br><br>
<!-- form to edit story -->
<form action = "newsEditStory.php" method = "post" >  
      title: <input type = "text" name="editInputtedTitle"/> 
        author: <input type = "text" name="editInputtedAuthor"/> 
        body: <input type = "text" name="editInputtedBody"/> 
        link: <input type = "text" name="editInputtedLink"/> 
        <input type = "submit" name = "Submit" value = "Edit" />
        <input type = "hidden" name = "token" value = <?php echo $_SESSION['token'];?>>

    </form> 

</body>
</html>