<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Account Login | PHP Motors</title>
    <meta name="description" content="This is account login page for the phpmotors website."/>
    <?php include_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/head.php';?>
</head>

<body>
<div class="container">
<div class="banner">
<header>
  <?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/header.php';
  ?>
</header>

<nav>
<?php echo $navList; ?>
</nav>
</div>

<main>
<div class="contentTitle">
  <h1>Sign in</h1>
</div>
<div class="signin">

<?php
  if (isset($_SESSION['message'])) {
  echo $_SESSION['message'];
  }
 
?>

<form method="post" action="../accounts/">
  <label for="clientEmail">Email</label><br>
  <input type="email" id="clientEmail" name="clientEmail" placeholder="phpmotors@gmail.com" <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?> required><br>

  <label for="clientPassword">Password:</label><br> 
  <span>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span> 
  <input type="password" name="clientPassword" id="clientPassword" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">

  <input type="submit" name="submit" value="Sign-in" id="regbtn">

  <input type="hidden" name="action" value="Login">
</form> 
</div>
<div class="newmember"><a href="/phpmotors/accounts/index.php?action=registration">Not a member yet? Sign up here!</a></div>
</main>

<footer>
  <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php';?>
</footer> 

</div> 
</body>
</html>