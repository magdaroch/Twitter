<?php
require_once 'src/connection.php';
require_once 'src/User.php';
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
   if(isset($_POST['email']) && strlen(trim($_POST['email'])) >= 5 && isset($_POST['password']) && strlen(trim($_POST['password'])) > 5){
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $user = User::login($conn,$email,$password);
        echo $email;
        echo $password;
        var_dump($user);
        if($user){
            $_SESSION['userId'] = $user->getId();
            header('Location: index.php');
        }else{
            echo 'Niepoprawne dane logowania';
        }
    }
}

?>

<html>
    <head></head>
    <body>
        <form method="post">
            <label>
                Email:<br>
                <input type='text' name='email'>
            </label><br>
            <label>
                Password:<br>
                <input type='password' name='password'>
            </label><br>
            <input type='submit' value='login'>
        </form>
    </body>
</html>

