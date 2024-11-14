<?php
require_once "pdo.php";

session_start();

if(isset($_SESSION["error"]))
{
    echo("<p id='invalid_msg'>".$_SESSION['error']."</p>");
    unset($_SESSION['error']);
}

if(isset($_POST['username']) && isset($_POST['password']))
{
    echo "<p>3</p>";
    if(strlen($_POST['username']) > 1 && strlen($_POST['password']) > 1)
    {
        $sql= "Select * from Authors WHERE Author_username = :username AND Author_pw =:password";

        $stmt = $pdo->prepare($sql);
        $stmt ->execute(array(
            ':username'=>$_POST['username'],
            ':password'=>$_POST['password']));

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row!=false)
        {
            $_SESSION["success"] = "";
            header("Location: main.php?name=$row[Author_name]");
            exit;
        }
        else
        {
            $_SESSION["error"] = "Incorrect username or password";
            header("Location: index.php");
            exit;
        }
    }
}



?>

<html lang="en">
    <link rel="stylesheet" href="">
    <style>
    </style>
    <script src=""></script>
    <body>
        <p>Login</p>
        <form method="post">
            <p>Username: <input type="text" name="username"></input></p>
            <p>Password: <input type="text" name="password"></input></p>
            <input type="submit" name="submit" value="submit"></input>

        </form>
    </body>
    </html>