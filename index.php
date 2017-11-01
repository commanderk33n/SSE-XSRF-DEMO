<?php
$user_name = 'Guest';
session_start();

if(($_SERVER['REQUEST_METHOD'] == 'POST') && (isset($_POST['username']))) {
    $_SESSION['login'] = 1;
    $user_name = $_POST['username'];
    // generate secret token to prevent XSRF vulnerability
    $_SESSION['csrf_token'] = uniqid('', true);
}
echo "WoodgroveBank:  ONLINE-BANKING</br>";
echo "Welcome $user_name!</br>";
echo "</br>Login:";

if (!isset($_SESSION['login'])) {
  ?>
  <!DOCTYPE html>
  <html>
  <head>
     <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      Username:
      <input type="text" name="username"> <br />
      <input type="submit" name="submit" value="Login">
    </form>
  </body>
  </html>

<?php } else {
  header('location: content.php');
}
?>
