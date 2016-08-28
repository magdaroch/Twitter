
<?php
require_once '../src/User.php';
require_once '../src/connection.php';

$user1 = new User();
$user1->setName("Marian");
$user1->setEmail("marian@marian.com");
$user1->setPassword("cojestgrane");

var_dump($user1->saveToDB($conn));

$conn->close();
$conn = NULL;
        