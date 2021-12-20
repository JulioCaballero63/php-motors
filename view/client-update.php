<?php
if (!$_SESSION['loggedin']) {
    header('Location: /phpmotors/index.php');
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Account Management | PHP Motors</title>
    <meta name="description" content="This is the account management page for the phpmotors website." />
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
                <h1>Manage Account</h1>
            </div>

            <div class="registration">

                <?php
                if (isset($message)) {
                    echo $message;
                }
                if (isset($_SESSION['message'])) {
                    $message = $_SESSION['message'];
                }
                ?>
                <!-- Account Update -->

                <form action="/phpmotors/accounts/index.php" method="post">
                    <fieldset>
                        <h2 class="updateUser">Change Profile Information</h2>
                        <label for="clientFirstname">First Name</label><br>
                        <input type="text" id="clientFirstname" required name="clientFirstname" <?php if (isset($clientFirstname)) {
                                                                                                    echo "value='$clientFirstname'";
                                                                                                } elseif (isset($userInfo['clientFirstname'])) {
                                                                                                    echo "value='$userInfo[clientFirstname]'";
                                                                                                }
                                                                                                ?>><br>


                        <label for="clientLastname">Last Name</label><br>
                        <input type="text" id="clientLastname" required name="clientLastname" <?php if (isset($clientLastname)) {
                                                                                                    echo "value='$clientLastname'";
                                                                                                } elseif (isset($userInfo['clientLastname'])) {
                                                                                                    echo "value='$userInfo[clientLastname]'";
                                                                                                } ?>><br>


                        <label for="clientEmail">Email</label><br>
                        <input type="text" id="clientEmail" required name="clientEmail" <?php if (isset($clientEmail)) {
                                                                                            echo "value='$clientEmail'";
                                                                                        } elseif (isset($userInfo['clientEmail'])) {
                                                                                            echo "value='$userInfo[clientEmail]'";
                                                                                        } ?>><br>

                        <input type="submit" name="submit" value="Update User" id="regbtn">

                        <input type="hidden" name="action" value="updateUser">
                        <input type="hidden" name="clientId" value="
                                                                <?php if (isset($userInfo['clientId'])) {
                                                                    echo $userInfo['clientId'];
                                                                } elseif (isset($clientId)) {
                                                                    echo $clientId;
                                                                } ?>
                                                                ">
                    </fieldset>
                </form>


                <!-- Change Password -->
                <form action="/phpmotors/accounts/index.php" method="post">
                    <fieldset>
                        <h2 class="updateUser">Change Your Password</h2>
                        <label for="clientPassword">New Password:</label><br>
                        <span class="warning">By entering a new password you will change your current password!</span><br>
                        <span>Password must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span>
                        <input type="password" name="clientPassword" id="clientPassword" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
                        <input type="submit" name="submit" value="Update Password" id="updtbtn">
                        <input type="hidden" name="action" value="updatePassword">
                        <input type="hidden" name="clientId" value="
                                                                <?php if (isset($userInfo['clientId'])) {
                                                                    echo $userInfo['clientId'];
                                                                } elseif (isset($clientId)) {
                                                                    echo $clientId;
                                                                } ?>
                                                                ">
                    </fieldset>
                </form>


            </div>
        </main>

        <footer>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
        </footer>

    </div>
</body>

</html>

<?php unset($_SESSION['message']); ?>