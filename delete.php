<?php
require_once "pdo.php";
session_start();




if (isset($_POST['confirm_delete'])) {
    
    $sql_insert = "DELETE FROM ingredient WHERE Ing_id = :ing_id";
    $stmt_insert = $pdo->prepare($sql_insert);
    $stmt_insert->execute(array(
        ":ing_id" => $_GET['Ing_id'],
    ));

    $_SESSION["success"] = "One ingredient is removed.";
    header("Location: main.php?name=$_GET[name]");
    exit;
    
}

if(isset($_POST['cancel_delete']))
{
    header("Location: main.php?name=$_GET[name]");
    exit;
}


?>

<html lang="en">
    <link rel="stylesheet" href="">
    <style>
    </style>
    <script src=""></script>
    <body>
        <p>Remove Ingredient</p>
        <form method="post">


            <table>
                <tr>
                    <td>
                        <input type="submit" name="confirm_delete" value="Confirm">
                    </td> 
                    
                    <td>
                        <input type="submit" name="cancel_delete" value="Cancel">
                    </td> 
            </table>
        </form>
    </body>
    </html>