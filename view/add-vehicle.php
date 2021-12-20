<?php
// Check for client level or session login
if ((!$_SESSION['loggedin']) || ($_SESSION['clientData']['clientLevel'] < 2)) {
  header('Location: /phpmotors/index.php');
  exit;
}

// Build a select list
$classificationList = '<select  name="classificationId">';
$classificationList .= "<option disabled selected>Choose Car Classification</option>";
foreach ($classifications as $classification) {
  $classificationList .= "<option value='$classification[classificationId]'";
  if (isset($classificationId)) {
    if ($classification['classificationId'] === $classificationId) {
      $classificationList .= ' selected ';
    }
  }
  $classificationList .= ">$classification[classificationName]</option>";
}
$classificationList .= '</select>';

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Add Vehicle | PHP Motors</title>
  <meta name="description" content="This is the add-vehicle page for the phpmotors website." />
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
        <h1>Add Vehicle</h1>
      </div>

      <div class="addvehicle">

        <?php
        if (isset($message)) {
          echo $message;
        }
        ?>

        <form action="/phpmotors/vehicles/index.php" method="post">

          <p class="required">*Note all Fields are Required</p>

          <div class="select">
            <?php echo $classificationList; ?><br>
          </div>

          <label for="invMake">Make</label><br>
          <input type="text" id="invMake" name="invMake" <?php if (isset($invMake)) {
                                                            echo "value='$invMake'";
                                                          }  ?> required><br>

          <label for="invModel">Model</label><br>
          <input type="text" id="invModel" name="invModel" <?php if (isset($invModel)) {
                                                              echo "value='$invModel'";
                                                            }  ?> required><br>

          <label for="invDescription">Description</label><br>
          <textarea id="invDescription" name="invDescription" rows="5" cols="50" required><?php echo $invDescription; ?></textarea><br>

          <label for="invImage">Image Path</label><br>
          <input type="text" id="invImage" name="invImage" value="/phpmotors/images/vehicles/no-image.png" <?php if (isset($invImage)) {
                                                                                                              echo "value='$invImage'";
                                                                                                            }  ?> required><br>

          <label for="invThumbnail">Thumbnail Path</label><br>
          <input type="text" id="invThumbnail" name="invThumbnail" value="/phpmotors/images/vehicles/no-image.png" <?php if (isset($invThumbnail)) {
                                                                                                                      echo "value='$invThumbnail'";
                                                                                                                    }  ?> required><br>

          <label for="invPrice">Price</label><br>
          <input type="text" id="invPrice" name="invPrice" <?php if (isset($invPrice)) {
                                                              echo "value='$invPrice'";
                                                            }  ?> required><br>

          <label for="invStock"># In Stock</label><br>
          <input type="text" id="invStock" name="invStock" <?php if (isset($invStock)) {
                                                              echo "value='$invStock'";
                                                            }  ?> required><br>

          <label for="invColor">Color</label><br>
          <input type="text" id="invColor" name="invColor" <?php if (isset($invColor)) {
                                                              echo "value='$invColor'";
                                                            }  ?> required><br>

          <input type="submit" name="submit" value="Addvehicle" id="regbtn">

          <input type="hidden" name="action" value="addvehicle">

        </form>

      </div>
    </main>

    <footer>
      <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
    </footer>

  </div>
</body>

</html>