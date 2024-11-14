<?php
require_once "pdo.php";
session_start();

$sql="Select Author_name from Authors WHERE Author_name = :name";
$stmt=$pdo->prepare($sql);
$stmt->execute(array(
    ':name' => $_GET['name']
));

$row = $stmt->fetch(PDO::FETCH_ASSOC);
if($row==false)
{
    $_SESSION["error"] ="Please login again";
    header("Location: index.php");
    exit;

}

if(isset($_SESSION['success']))
{
    echo ("<p>".$_SESSION['success']."</p>");
    unset($_SESSION['success']);
}

if(isset($_POST["insert"]))
{
    header("Location: insert.php?name=$_GET[name]");
    exit;
}

if(isset($_POST["delete"]))
{
    header("Location: delete.php?name=$_GET[name]&Ing_id=$_POST[id]");
    exit;
}

if(isset($_POST["back"]))
{
    header("Location: index.php");
    exit;
}

?>

<html lang="en">
    <link rel="stylesheet" href="">
    <style>
    </style>
    <script src=""></script>
    <body>
        <p>Welcome<?php echo " ".$_GET['name']?></p>
        
        <?php
            $sql_ing = "Select * from Ingredient";
            $stmt_ing = $pdo->prepare($sql_ing);
            $stmt_ing->execute();

            $Ing_name = array();

            
            echo('<table id="ing_table" border=1>');
            while($row=$stmt_ing->fetch(PDO::FETCH_ASSOC))
            {
                echo("<tr>
                        <td>");
                        echo(htmlentities($row['Ing_id']).'</td>');
                        echo('<td>'.htmlentities($row['Ing_name']).'</td>');
                        echo('<td>'.htmlentities($row['Ing_amount']).'</td>');
                        echo('<td>'.htmlentities($row['Ing_unit']).'</td>');
                        echo('<td>'.htmlentities($row['Ing_type']).'</td>');
                        echo('<td>'.htmlentities($row['Ing_expdate']).'</td>');

                        echo('<form method="post">');
                        echo('<td>'.'<input type="submit" name="delete" value="delete">'.'</td>');
                        echo('<td>'.'<input type="hidden" name="id" value='.htmlentities($row['Ing_id']) .'></td>');
                        echo("</form>");
                echo('</tr>');
            }

            echo('</table">');
            
        ?>

        <form method="post">
            <input type="submit" name="insert" value="Insert">
            <input type="submit" name="back" value="Back">
        </form>
    </body>
    </html>

    <?php
        session_destroy();
    ?>