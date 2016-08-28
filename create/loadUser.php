<?php

require_once '../src/User.php';
require_once '../src/connection.php';

$user = User::loadUserById($conn,4);

var_dump($user);
$user1 = User::loadUserById($conn,1);
var_dump($user1);

$conn->close();
$conn = NULL;