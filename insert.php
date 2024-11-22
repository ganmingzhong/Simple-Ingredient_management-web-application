<?php
require_once "pdo.php";
session_start();

if(isset($_SESSION['error']))
{
    echo("<p>".$_SESSION['error']."</p>");
    unset($_SESSION['error']);
}

if(isset($_POST['cancel_insert']))
{
    header("Location: main.php?name=$_GET[name]");
    exit;
}

if (isset($_POST['confirm_insert'])) {
    if (empty($_POST['ing_name']) || empty($_POST['ing_amount']) || empty($_POST['ing_unit'])
        || empty($_POST['ing_type']) || empty($_POST['ing_expdate'])) {

        $_SESSION["error"] = "Input is incomplete ";
    } else {
        $sql_insert = "INSERT INTO ingredient (Ing_name, Ing_amount, Ing_unit, Ing_type, Ing_expdate)
                       VALUES (:ing_name, :ing_amount, :ing_unit, :ing_type, :ing_expdate)";
        $stmt_insert = $pdo->prepare($sql_insert);
        $stmt_insert->execute(array(
            ":ing_name" => $_POST['ing_name'],
            ":ing_amount" => $_POST['ing_amount'],
            ":ing_unit" => $_POST['ing_unit'],
            ":ing_type" => $_POST['ing_type'],
            ":ing_expdate" => $_POST['ing_expdate']
        ));

        $_SESSION["success"] = "New ingredient is added.";
        header("Location: main.php?name={$_GET['name']}");
        exit;
    }
}


?>

<html lang="en">
    <link rel="stylesheet" href="insert.css">
    <style>
    </style>
    <script src=""></script>
    <body>
        
        <div>
        <p id="title">Insert New Ingredient</p>
        <form method="post">
            <table>
            <tr>
                <td><p>Ingredient Name: <input type="text" name="ing_name"></input></p></td>
                <td><p>Ingredient Amount: <input type="number" name="ing_amount"></input></p></td>
            </tr>

            <tr>
                <td><p>Ingredient Unit: <input type="text" name="ing_unit"></input></p></td>
                <td><p>Ingredient Type: <input type="text" name="ing_type"></input></p></td>
            </tr>

            <tr>
                <td><p>Ingredient Expire Date: <input type="date" name="ing_expdate"></input></p></td>
            </tr>
            </table>

            <table>
                <tr>
                    <td>
                        <input id="btn" type="submit" name="confirm_insert" value="Confirm">
                    </td> 
                    
                    <td>
                        <input id="btn" type="submit" name="cancel_insert" value="Cancel">
                    </td> 
            </table>
        </form>
        </div>
    </body>
    </html>