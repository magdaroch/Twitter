<?php
$serverName = 'localHost';
$userName = 'root';
$password = 'coderslab';
$database = 'twitter_db';

$conn = new mysqli($serverName,$userName,$password,$database);

if($conn->connect_error){
    die("Polaczenie nieudane. Blad: ".$conn->connect_error);
}else{
    echo("Polaczenie udane<BR>");
}
$conn->set_charset('utf8');