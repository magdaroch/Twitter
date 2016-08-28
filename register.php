<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
   if(isset($_POST['name']) && strlen(trim($_POST['name'])) > 0 && isset($_POST['email']) && strlen(trim($_POST['email'])) >= 5 && isset($_POST['password']) && strlen(trim($_POST['password'])) > 5 && isset($_POST['repeated_password']) && trim($_POST['password']) == trim($_POST['repeated_password'])){
       require_once 'src/User.php';
       require_once 'src/connection.php';
       
       $user = new User();
       $user->setName(trim($_POST['name']));
       $user->setEmail(trim($_POST['email']));
       $user->setPassword(trim($_POST['password']));
       if($user->saveToDB($conn)){
           header('Location: index.php');
           echo 'Uda³o siê zrejestrowaæ u¿ytkownika';
       }else{
           echo 'B³¹d w rejestracji';
       }
   }else{
       echo 'B³êdne dane w formularzu';
   }
}
?>

<html>
    <head></head>
    <body>
        <form method='POST'>
            <label>
                Name:<br>
                <input type='text' name='name'>
            </label><br>
            <label>
                Email:<br>
                <input type='text' name='email'>
            </label><br>
            <label>
                Password:<br>
                <input type='password' name='password'>
            </label><br>
            <label>
                Repeat password:<br>
                <input type='password' name='repeated_password'>
            </label><br>
            <input type='submit' value='Register'><br>
            
        </form>
    </body>
</html>
