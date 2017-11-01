<?php
session_start();
// Exercise: Secure the logout function so that the malicious link from mal.php
// could not use the logout function
session_destroy();
header('location: index.php');
?>
