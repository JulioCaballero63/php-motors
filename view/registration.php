<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Registration | PHP Motors</title>
  <meta name="description" content="This is the registration page for the phpmotors website." />
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
        <h1>Register</h1>
      </div>

      <div class="registration">

        <?php
        if (isset($message)) {
          echo $message;
        }
        ?>

        <form action="/phpmotors/accounts/index.php" method="post">

          <label for="clientFirstname">First Name</label><br>
          <input type="text" id="clientFirstname" name="clientFirstname" <?php if (isset($clientFirstname)) {
                                                                            echo "value='$clientFirstname'";
                                                                          }  ?> required><br>

          <label for="clientLastname">Last Name</label><br>
          <input type="text" id="clientLastname" name="clientLastname" <?php if (isset($clientLastname)) {
                                                                          echo "value='$clientLasttname'";
                                                                        }  ?> required><br>

          <label for="clientEmail">Email</label><br>
          <input type="email" id="clientEmail" name="clientEmail" placeholder="phpmotors@gmail.com" <?php if (isset($clientEmail)) {
                                                                                                      echo "value='$clientEmail'";
                                                                                                    }  ?> required><br>

          <label for="clientPassword">Password:</label><br>
          <span>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span>
          <input type="password" name="clientPassword" id="clientPassword" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">

          <input type="submit" name="submit" value="Register" id="regbtn">

          <input type="hidden" name="action" value="register">

        </form>
      </div>
    </main>

    <footer>
      <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
    </footer>

  </div>
</body>

</html>