<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?php echo $invInfo['invMake'] . ' ' . $invInfo['invModel'] ?> | PHP Motors</title>
    <meta name="description" content="This is a template for the phpmotors website." />
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
                <h1 id="info-title"><?php echo $invInfo['invMake'] . ' ' . $invInfo['invModel'] ?></h1>

                <?php if (isset($message)) {
                    echo $message;
                }
                ?>

                <?php if (isset($vehicleInformation)) {
                    echo $vehicleInformation;
                } ?>

                <p>Scroll to the bottom of the page to see the reviews for this vehicles.</p>
            </div>

            <!-- Customer reviews section -->
            <div class="reviews">
                <h2>Customer Reviews</h2>
                <!-- New review -->
                <?php if ($_SESSION['loggedin']) {
                    echo $addReview;
                } else {
                    "<p>You can add a review by <a href='/phpmotors/accounts/?action=login'>logging in</a> </p>";
                } ?>

                <hr>
            </div>
            <div class="oldreviews">

                <?php if (isset($vehicleReviews)) {
                    echo $vehicleReviews;
                } ?>

            </div>
        </main>

        <footer>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
        </footer>

    </div>
</body>

</html>