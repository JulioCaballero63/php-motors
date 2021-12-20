<?php
// Check for client level or session login
if ((!$_SESSION['loggedin']) || ($_SESSION['clientData']['clientLevel'] < 2)) {
  header('Location: /phpmotors/index.php');
  exit;
}

// Build a select list
$classificationList = '<select  name="classificationId" id="classificationId">';
$classificationList .= "<option>Choose Car Classification</option>";
foreach ($classifications as $classification) {
  $classificationList .= "<option value='$classification[classificationId]'";
  if (isset($classificationId)) {
    if ($classification['classificationId'] === $classificationId) {
      $classificationList .= ' selected ';
    }
  } elseif (isset($invInfo['classificationId'])) {
    if ($classification['classificationId'] === $invInfo['classificationId']) {
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
  <title><?php if (isset($invInfo['invMake']) && isset($invInfo['invModel'])) {
            echo "Modify $invInfo[invMake] $invInfo[invModel]";
          } elseif (isset($invMake) && isset($invModel)) {
            echo "Modify $invMake $invModel";
          } ?> | PHP Motors</title>
  <meta name="description" content="This is the modify-vehicle page for the phpmotors website." />
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
        <h1><?php if (isset($invInfo['invMake']) && isset($invInfo['invModel'])) {
              echo "Modify $invInfo[invMake] $invInfo[invModel]";
            } elseif (isset($invMake) && isset($invModel)) {
              echo "Modify $invMake $invModel";
            } ?></h1>
      </div>

      <div class="updatevehicle">

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
          <input type="text" id="invMake" required name="invMake" <?php if (isset($invMake)) {
                                                                    echo "value='$invMake'";
                                                                  } elseif (isset($invInfo['invMake'])) {
                                                                    echo "value='$invInfo[invMake]'";
                                                                  } ?> required><br>

          <label for="invModel">Model</label><br>
          <input type="text" id="invModel" required name="invModel" <?php if (isset($invModel)) {
                                                                      echo "value='$invModel'";
                                                                    } elseif (isset($invInfo['invModel'])) {
                                                                      echo "value='$invInfo[invModel]'";
                                                                    } ?> required><br>

          <label for="invDescription">Description</label><br>
          <textarea id="invDescription" required name="invDescription" rows="5" cols="50" required><?php if (isset($invDescription)) {
                                                                                                      echo $invDescription;
                                                                                                    } elseif (isset($invInfo['invDescription'])) {
                                                                                                      echo $invInfo['invDescription'];
                                                                                                    } ?></textarea><br>

          <label for="invImage">Image Path</label><br>
          <input type="text" id="invImage" required name="invImage" <?php if (isset($invImage)) {
                                                                      echo "value='$invImage'";
                                                                    } elseif (isset($invInfo['invImage'])) {
                                                                      echo "value='$invInfo[invImage]'";
                                                                    } ?> required><br>

          <label for="invThumbnail">Thumbnail Path</label><br>
          <input type="text" id="invThumbnail" required name="invThumbnail" <?php if (isset($invThumbnail)) {
                                                                              echo "value='$invThumbnail'";
                                                                            } elseif (isset($invInfo['invThumbnail'])) {
                                                                              echo "value='$invInfo[invThumbnail]'";
                                                                            } ?> required><br>

          <label for="invPrice">Price</label><br>
          <input type="text" id="invPrice" required name="invPrice" <?php if (isset($invPrice)) {
                                                                      echo "value='$invPrice'";
                                                                    } elseif (isset($invInfo['invPrice'])) {
                                                                      echo "value='$invInfo[invPrice]'";
                                                                    } ?> required><br>

          <label for="invStock"># In Stock</label><br>
          <input type="text" id="invStock" required name="invStock" <?php if (isset($invStock)) {
                                                                      echo "value='$invStock'";
                                                                    } elseif (isset($invInfo['invStock'])) {
                                                                      echo "value='$invInfo[invStock]'";
                                                                    } ?> required><br>

          <label for="invColor">Color</label><br>
          <input type="text" id="invColor" required name="invColor" <?php if (isset($invColor)) {
                                                                      echo "value='$invColor'";
                                                                    } elseif (isset($invInfo['invColor'])) {
                                                                      echo "value='$invInfo[invColor]'";
                                                                    } ?> required><br>

          <input type="submit" name="submit" value="Update Vehicle" id="regbtn">

          <input type="hidden" name="action" value="updateVehicle">

          <input type="hidden" name="invId" value="<?php if (isset($invInfo['invId'])) {
                                                      echo $invInfo['invId'];
                                                    } elseif (isset($invId)) {
                                                      echo $invId;
                                                    } ?>">

        </form>

      </div>
    </main>

    <footer>
      <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
    </footer>

  </div>
</body>

</html>