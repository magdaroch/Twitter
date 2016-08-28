<?php

require_once '../src/User.php';
require_once '../src/connection.php';

$user = User::loadUserByEmail($conn,'marian@marian.com');

var_dump($user);
$user1 = User::loadUserByEmail($conn,'lol');
var_dump($user1);

$conn->close();
$conn = NULL;
