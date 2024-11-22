<?php
require_once "pdo.php";

session_start();



if(isset($_POST['username']) && isset($_POST['password']))
{
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
    <link rel="stylesheet" href="index.css">
    <style>
    </style>
    <script src=""></script>
    <body>
        <div>
        <p id="title">Login</p>
        <form method="post">
            <p>Username: <input type="text" name="username"></input></p>
            <p>Password: <input type="text" name="password"></input></p>
            <input id="submit_btn" type="submit" name="submit" value="submit"></input>

        </form>
        <?php
            if(isset($_SESSION["error"]))
            {
                echo("<p id='incorrect_cre'>".$_SESSION['error']."</p>");
                unset($_SESSION['error']);
            }
        ?>
        </div>
    </body>
    </html>
