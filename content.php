<?php

session_start();

if (isset($_SESSION['login'])) {
  ?>
  <a href="logout.php">Get out</a><br />
  <?php
  echo "You are logged in with session id: <br />".session_id()."<br />";
  echo "You secret token is: <br />" .$_SESSION['csrf_token']. "<br />";
  ?>
  <form action="content.php" method="GET">
    <input type="hidden" name="csrf" value="<?php echo $_SESSION['csrf_token']; ?>">
    <input type="text" name="write" />
    <input type="submit" value="Write this"/>
  </form>
  <?php
  if(isset($_GET['write'])) {
      $myFile='text';
      $fh = fopen($myFile, 'a') or die("can’t open file");
     if ($_GET['csrf'] == $_SESSION['csrf_token']) {
      fwrite($fh, $_GET['write']."\n");
      echo $_GET['write']." has been written down on file";
      } else {
     die("Wrong Token!!");
   }
  }

}
else {
  echo "You are not logged in.<br />";
  echo "<a href=index.php>Login</a><br />";
}
?>
