<?php

require_once '../src/User.php';
require_once '../src/connection.php';

$user = User::loadUserById($conn,4);
$user->setName('Marianna');
var_dump($user->saveToDB($conn));
$user = User::loadUserById($conn,4);
var_dump($user);

$conn->close();
$conn = NULL;
