<?php session_start();

    if(!$_SESSION['isLoggedIn']){
    header("refresh:2; url=newsPage.php");
    echo 'you cannot add stories without being logged in, you will be redirected shortly';
    exit; }
    
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
   
        <!-- form to insert story -->
      <form action = "newsInsertStory.php" method = "post" >  
      title: <input type = "text" name="inputtedTitle"/> 
        author: <input type = "text" name="inputtedAuthor"/> 
        body: <input type = "text" name="inputtedBody"/> 
        link: <input type = "text" name="inputtedLink"/> 
        <input type = "submit" name = "Submit" value = "Submit a Story" />
        <input type = "hidden" name = "token" value = <?php echo $_SESSION['token'];?>>

    </form> 
    

   

</body>
</html>