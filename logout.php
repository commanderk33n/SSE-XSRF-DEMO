<?php
session_start();
// Exercise: Secure the logout function
session_destroy();
header('location: index.php');
?>
