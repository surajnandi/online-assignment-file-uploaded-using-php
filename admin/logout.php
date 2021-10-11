<?php
session_start();
include('../config/connection.php');
unset($_SESSION['IS_LOGIN']);
header('location:index.php');
die();
