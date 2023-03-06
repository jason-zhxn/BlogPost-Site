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

<?php
require '/home/jason.zhan/newsSqlConnection.php';
// checking database for matching login info
$stmt = $mysqli->prepare("SELECT COUNT(*), id, hashed_pass FROM userInfo WHERE username=?");

// Bind the parameter
$user = (string)$_POST['username'];
$stmt->bind_param('s', $user);
$stmt->execute();

// Bind the results
$stmt->bind_result($cnt, $user_id, $pwd_hash);
$stmt->fetch();

$pwd_guess = $_POST['password'];
// Compare the submitted password to the actual password hash
$_SESSION['isLoggedIn']=False;
if($cnt == 1 && password_verify($pwd_guess, $pwd_hash)){
	// Login succeeded!
    

    if(!hash_equals($_SESSION['token'], $_POST['token'])){
        die("Request forgery detected");
    }

    $_SESSION['user_id'] = $user_id;
    $_SESSION['username'] = $user;
    echo($_SESSION['user_id']);
    $_SESSION['isLoggedIn']=True;

    if(  $_SESSION['isLoggedIn'] ){
        header("Location: newsPage.php");
        exit;
    }

} 
//if login failed or password is wrong
else{
    if(!$_SESSION['isLoggedIn']){
        header("refresh:2; url=newsLoginPage.php");
        echo htmlentities('login failed, you will be redirected shortly');
        exit;
    }
    //redirect to login page
}
?>

</body>
</html>