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
    <link rel="stylesheet" href="main.css">
    <style>
    </style>
    <script src=""></script>
    <body>
        
        <p id="title">Welcome<?php echo " ".$_GET['name']?></p>
        <div>
        <?php
            $sql_ing = "Select * from Ingredient";
            $stmt_ing = $pdo->prepare($sql_ing);
            $stmt_ing->execute();

            $Ing_name = array();

            
            echo('<table id="ing_table">');
            $numbering = 1;
            echo("<th>No</th>
                <th>Ingredient</th>
                <th>Amount</th>
                <th>Unit</th>
                <th>Type</th>
                <th>Expire date</th>");
            while($row=$stmt_ing->fetch(PDO::FETCH_ASSOC))
            {
                echo("<tr>
                        ");
                        echo('<td>'.$numbering.'</td>');
                        echo('<td>'.htmlentities($row['Ing_name']).'</td>');
                        echo('<td>'.htmlentities($row['Ing_amount']).'</td>');
                        echo('<td>'.htmlentities($row['Ing_unit']).'</td>');
                        echo('<td>'.htmlentities($row['Ing_type']).'</td>');
                        echo('<td>'.htmlentities($row['Ing_expdate']).'</td>');

                        echo('<form method="post" >');
                        echo('<td id="delete-td">'.'<input id="delete-btn"  type="submit" name="delete" value="delete">'.'</td>');
                        echo('<input type="hidden" name="id" value='.htmlentities($row['Ing_id']).'>');
                        echo("</form>");
                echo('</tr>');
                $numbering=$numbering+1;
            }

            echo('</table>');
            
        ?>
        </div>

        <div id="insert-back-btn">
        <form method="post">
            <input class="btn" type="submit" name="insert" value="Insert">
            <input class="btn" type="submit" name="back" value="Back">
        </form>
        </div>
    </body>
    </html>

    <?php
        session_destroy();
    ?>