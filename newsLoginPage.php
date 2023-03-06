<?php session_start();
$_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32));
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
    <h1>
    
    Login to Monke News! <br> <br>
</h1>
        <!-- form to login -->
    <form name ="input" action = "newsLogin.php" method="Post">  
        Username: <input type = "text" name="username"/> 
        Password: <input type = "text" name="password"/>
        <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
        <input type = "submit" name = "Submit" value = "Submit" />

    </form> 

    <br>

    <!-- link to create account page -->
    <a href = "newsCreateAccount.html">If you don't have an account register here: </a>
    <br>
    <br>
    Continue without an account?
    <form action = "newsPage.php">
        <input type = "submit" value = "Yes" />
    </form>
       

    



    
</body>
</html>