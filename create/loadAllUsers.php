<?php

require_once '../src/User.php';
require_once '../src/connection.php';

$user = User::loadAllUsers($conn);

var_dump($user);

$conn->close();
$conn = NULL;