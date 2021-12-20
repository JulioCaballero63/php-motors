<?php
// Check for client level or session login
if((!$_SESSION['loggedin']) || ($_SESSION['clientData']['clientLevel'] < 2)) {
  header('Location: /phpmotors/index.php'); 
  exit;
}

if (isset($_SESSION['message'])) {
  $message = $_SESSION['message'];
}

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vehicle Management | PHP Motors</title>
    <meta name="description" content="This is the vehicle management for the phpmotors website."/>
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
  <h1>Vehicle Management</h1>
</div>
<ul>
    <li><a href="../vehicles/index.php?action=addcar">Add Vehicle</a></li>
    <li><a href="../vehicles/index.php?action=addclassification">Add classification</a></li>
</ul>

<?php
if (isset($message)) { 
 echo $message; 
} 
if (isset($classificationList)) { 
 echo '<h2>Vehicles By Classification</h2>'; 
 echo '<p>Choose a classification to see those vehicles</p>'; 
 echo $classificationList; 
}
?>
<noscript>
<p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
</noscript>
<table id="inventoryDisplay"></table>

</main>

<footer>
  <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php';?>
</footer> 

</div> 
<script src="../js/inventory.js"></script>
</body>
</html>
<?php unset($_SESSION['message']); ?>