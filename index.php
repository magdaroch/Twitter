<?php
session_start();
if(!isset($_SESSION['userId'])){
    header('Location: login.php');
}

?>

<html>
    <head></head>
    <body>
        Strona g��wna
        <?php
            if(isset($_SESSION['userId'])){
                echo '<a href="logout.php">Logout</a>';
            }
        ?>
    </body>
</html>