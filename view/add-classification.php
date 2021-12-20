<?php
// Check for client level or session login
if ((!$_SESSION['loggedin']) || ($_SESSION['clientData']['clientLevel'] < 2)) {
  header('Location: /phpmotors/index.php');
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Add Classification | PHP Motors</title>
  <meta name="description" content="This is the add-classification page for the phpmotors website." />
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
        <h1>Add Classification</h1>
      </div>

      <div class="addclass">

        <?php
        if (isset($message)) {
          echo $message;
        }
        ?>

        <form action="/phpmotors/vehicles/index.php" method="post">

          <label for="classificationName">Classification Name</label><br>
          <span>Classification name is limited to 30 characters.</span>
          <input type="text" id="classificationName" name="classificationName" required pattern="^.{1,30}$"><br>

          <input type="submit" name="submit" value="Register" id="regbtn">

          <input type="hidden" name="action" value="addclass">

        </form>
      </div>
    </main>

    <footer>
      <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
    </footer>

  </div>
</body>

</html>