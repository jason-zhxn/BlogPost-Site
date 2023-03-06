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
    You are successfully logged out of your account.

    <!-- logout session destory -->
    <br>
    <?php
        $_SESSION['isLoggedIn']=False;
        session_destroy();
        
    ?>

    <a href = "newsLoginPage.php"> Return to Login Page? </a>
</body>
</html>