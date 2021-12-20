<?php
if (!$_SESSION['loggedin']) {
  header('Location: /phpmotors/index.php');
  exit;
}
if (isset($_SESSION['message'])) {
  $message = $_SESSION['message'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Administration | PHP Motors</title>
  <meta name="description" content="This is the administration page for the phpmotors website." />
  <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/head.php'; ?>
</head>

<body>
  <div class="container">
    <div class="banner">
      <header>
        <?php
        require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php';
        ?>
      </header>

      <nav>
        <?php echo $navList; ?>
      </nav>
    </div>

    <main>
      <div class="contentTitle">
        <h1><?php echo $_SESSION['clientData']['clientFirstname'], " ", $_SESSION['clientData']['clientLastname'] ?></h1>


        <?php if (isset($message)) {
          echo $message;
        } ?>



        <p class="greating">You are logged in.</p>


        <ul>
          <li>First name: <?php echo $_SESSION['clientData']['clientFirstname'] ?></li>
          <li>Last name: <?php echo $_SESSION['clientData']['clientLastname'] ?></li>
          <li>Email: <?php echo $_SESSION['clientData']['clientEmail'] ?></li>
        </ul>

        <div class="accountManagement">
          <h2>Account Management</h2>
          <p>Use this link to update account information.</p>
          <a href="../accounts/index.php?action=accountupdate">Update Account Information</a>
        </div>

        <?php
        if ($_SESSION['clientData']['clientLevel'] > 1) {
          echo '<h2 class="inventoryManagement">Inventory Management</h2>';
          echo '<p>Use thins link to manage the inventory.</p>';
          echo '<p><a href="/phpmotors/vehicles/index.php" class="vehicleManagement" title="vehicle-management">Vehicle Management</a></p>';
        }
        ?>
      </div>

      <!-- Reviews -->
      <div class="adminreviews">

        <?php if (isset($showReviews)) {
          echo $showReviews;
        } ?>

      </div>
    </main>

    <footer>
      <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
    </footer>

  </div>
</body>

</html>