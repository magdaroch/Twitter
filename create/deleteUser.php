<?php

require_once '../src/User.php';
require_once '../src/connection.php';

$user = User::loadUserById($conn,4);
var_dump($user->delete($conn));
var_dump($user);

$conn->close();
$conn = NULL;
