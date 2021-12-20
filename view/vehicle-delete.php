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
    <title><?php if (isset($invInfo['invMake']) && isset($invInfo['invModel'])) {
                echo "Delete $invInfo[invMake] $invInfo[invModel]";
            } ?> | PHP Motors</title>
    <meta name="description" content="This is the delete-vehicle page for the phpmotors website." />
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
                        echo "Delete $invInfo[invMake] $invInfo[invModel]";
                    } ?></h1>
            </div>

            <div class="deletevehicle">

                <?php
                if (isset($message)) {
                    echo $message;
                }
                ?>

                <form action="/phpmotors/vehicles/index.php" method="post">
                    <fieldset>
                        <p class="required delete">Confirm Vehicle Deletion. The delete is permanent.</p>

                        <label for="invMake">Make</label><br>
                        <input type="text" id="invMake" readonly name="invMake" <?php if (isset($invInfo['invMake'])) {
                                                                                    echo "value='$invInfo[invMake]'";
                                                                                } ?>><br>

                        <label for="invModel">Model</label><br>
                        <input type="text" id="invModel" readonly name="invModel" <?php if (isset($invInfo['invModel'])) {
                                                                                        echo "value='$invInfo[invModel]'";
                                                                                    } ?>><br>

                        <label for="invDescription">Description</label><br>
                        <textarea id="invDescription" name="invDescription" rows="5" cols="50" readonly><?php if (isset($invInfo['invDescription'])) {
                                                                                                            echo $invInfo['invDescription'];
                                                                                                        } ?></textarea><br>

                        <input type="submit" name="submit" value="Delete Vehicle" id="regbtn">

                        <input type="hidden" name="action" value="deleteVehicle">

                        <input type="hidden" name="invId" value="<?php if (isset($invInfo['invId'])) {
                                                                        echo $invInfo['invId'];
                                                                    } ?>">
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