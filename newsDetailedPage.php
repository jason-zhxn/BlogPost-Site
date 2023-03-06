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

        $openArticleId = (int)$_POST["article_id"];
        
        // displaying title, author, link, and article for selected article

        $stmt = $mysqli->prepare("select title, author, body, link from stories where id=?");
        if(!$stmt){
            printf("Query Prep Failed: %s\n",$mysqli->error);
            exit;
        }

        $stmt->bind_param('i', $openArticleId);
        $stmt->execute();
        $stmt->bind_result($title,$author,$body,$link);
        $stmt->fetch();
        
        echo htmlentities("$title by $author   <br> ");

        
        echo htmlentities('<a href= '.$link.'>link to original article</a><br><br>');

        echo htmlentities("$body");

        $stmt->close();




    ?>
    <!-- home page button -->
    <form action = "newsPage.php">
        <input type = "submit" value = "Home Page" />
    </form>
    <br><br>


   
    
    <?php

    //check if logged in to see if user can comment
    if(isset($_SESSION['isLoggedIn'])){
        if($_SESSION['isLoggedIn']){

        echo('
        <form action = "newsCommentPage.php" method = "post" >  
        <input type = "submit" name = "Submit" value = "Comment" />
        <input type = "hidden" name = "article_id" value = "'.$openArticleId.'">
        </form> 
        <br>
        ');
        }
    }

    // display comments
    $stmt = $mysqli->prepare("select username, body, user_id, id from comments where article_id=?");
        if(!$stmt){
            printf("Query Prep Failed: %s\n",$mysqli->error);
            exit;
        }

        $stmt->bind_param('i', $openArticleId);
        $stmt->execute();
        $stmt->bind_result($commentUsername,$commentBody,$commentUserId, $commentId);
        while($stmt->fetch()){
            echo"<ul>\n";
            printf("\t<li>%s:<br> %s</li>\n", 
                htmlspecialchars($commentUsername),
                htmlspecialchars($commentBody)
            );
            

            if(isset($_SESSION['user_id'])){


                //checking if user owns certain comments to see if edit and delete buttons are displayed
                if($_SESSION['user_id']==$commentUserId){
                    echo(' 
                    <form action = "newsDeleteComment.php" method = "post" >  
                    <input type = "submit" name = "deleteComment" value="Delete" />
                    <input type = "hidden" name = "comment_id" value = "'.$commentId.'">
                    <input type = "hidden" name = "token" value = "'.$_SESSION['token'].'"/>
                    </form>
        
                    <form action = "newsEditCommentPage.php" method = "post" >  
                    <input type = "submit" name = "editComment" value="Edit" />
                    <input type = "hidden" name = "comment_id" value = "'.$commentId.'">
                    <input type = "hidden" name = "article_id" value = "'.$openArticleId.'">
                    </form> 
                
                ');
                }
                }
        }
        
        $stmt->close();

?>

</body>
</html>