<?php session_start();

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
    <h1>Welcome to News!</h1>

    <?php
    require '/home/jason.zhan/newsSqlConnection.php';
    //retrieving stories to list them
    $stmt = $mysqli->prepare("select title, author, user_id, id, upvotes from stories");
    if(!$stmt){
        printf("Query Prep Failed: %s\n",$mysqli->error);
        exit;
    }

    $stmt->execute();
    $stmt->bind_result($title, $author, $story_user_id, $article_id, $upvotes);
    echo"<ul>\n";
    while($stmt->fetch()){
        printf("\t<li>%s by %s</li>\nupvotes: $upvotes \n", 
            htmlspecialchars($title),
            htmlspecialchars($author)
        );

        //displaying open buttons
        echo('<form action = "newsDetailedPage.php" method = "post">  
            <input type = "submit" name = "openStory" value="open" />
            <input type = "hidden" name = "article_id" value = "'.$article_id.'"></form>
        ');

        if(isset($_SESSION['user_id'])){


        if($_SESSION['isLoggedIn']){
            //if user is logged in, the upvote button is displayed

            echo('<form action = "newsUpvote.php" method = "post" >  
            <input type = "submit" name = "upvote" value="upvote" />
            <input type = "hidden" name = "article_id" value = "'.$article_id.'">
            </form>
            ');

        }

        if($_SESSION['user_id']==$story_user_id){
            //if user owns story, delete and edit buttons displayed
            echo(' 
            <form action = "newsDeleteStory.php" method = "post" >  
            <input type = "submit" name = "deleteStory" value="Delete" />
            <input type = "hidden" name = "article_id" value = "'.$article_id.'">
            <input type = "hidden" name = "token" value = "'.$_SESSION['token'].'"/>
            </form>
            

            <form action = "newsEditStoryPage.php" method = "post" >  
            <input type = "submit" name = "editStory" value="Edit" />
            <input type = "hidden" name = "article_id" value = "'.$article_id.'">
            </form> 
        
        ');
        }
        }
    }
    
    if(isset($_SESSION['isLoggedIn'])){

        if($_SESSION['isLoggedIn']){

            // for submitting a story
            echo( 
                '<br><br><br><form action = "newsInsertStoryPage.php">  
            <input type = "submit" name = "Submit" value = "Submit a Story" />
            </form>  
        ');

            // for account page
            echo( 
                '<br><br><br><form action = "newsAccountPage.php">  
            <input type = "submit" name = "accountButton" value = "my articles" />
            </form>  
        ');
    
        }
    }

    
    ?>
    
 <!-- button to login page -->
<br><br><br><br>
    <form action = "newsLoginPage.php">
        <input type = "submit" value = "Login" />
    </form>
    <!-- button to logout -->
    <form action = "newsLogout.php">
        <input type = "submit" value = "Log out" />
    </form>

</body>
</html>