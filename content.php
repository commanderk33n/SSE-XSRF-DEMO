<?php

session_start();

if (isset($_SESSION['login'])) {
  ?>
  <!DOCTYPE html>
  <html>
  <head>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
  <a href="logout.php">Logout!</a><br />
  <?php
  echo "<br />Security-Information: <br />";
  echo "You are logged in with session id: <br />".session_id()."<br />";
  echo "You secret token is: <br />" .$_SESSION['csrf_token']. "<br />";
  ?>
  <form action="content.php" method="GET">
    <!-- hidden input field to pass the csrf_token -->
    <input type="hidden" name="csrf" value="<?php echo $_SESSION['csrf_token']; ?>">
    <input type="number" name="transfer" />
    <input type="submit" value="Transfer Money (€)"/>
  </form>
  <?php
  if(isset($_GET['transfer'])) {
    $myFile='accountLog';
    $fh = fopen($myFile, 'a') or die("can’t open file");
    // check if request got csrf_token from session
    if ($_GET['csrf'] == $_SESSION['csrf_token']) {
      fwrite($fh, $_GET['transfer']."\n");
      echo $_GET['transfer']." € has been transfered to another bank account!";
    } else {
      // csrf_token wrong or not available
      die("Wrong Token!!");
    }
  }
}
else {
  echo "You are not logged in.<br />";
  echo "<a href=index.php>Login</a><br />";
  echo "</body>";
  echo "</html>";
}
?>
