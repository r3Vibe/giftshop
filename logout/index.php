<?php
session_start();

$_SESSION['user'] = NULL;

$_SESSION['role'] = NULL;

header("Location: ../");
?>