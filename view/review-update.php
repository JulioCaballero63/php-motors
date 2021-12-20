<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Review Update | PHP Motors</title>
    <meta name="description" content="This is the review update page for the phpmotors website." />
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
                <h1>Edit your review</h1>

                <?php
                if (isset($message)) {
                    echo $message;
                }
                if (isset($_SESSION['message'])) {
                    $message = $_SESSION['message'];
                }
                ?>

                <form action="/phpmotors/reviews/index.php" method="post">
                    <fieldset>
                        <label for="reviewId">Review Id</label><br>
                        <input type="text" id="reviewId" readonly name="reviewId" <?php if (isset($reviewId)) {
                                                                                        echo "value='$reviewId'";
                                                                                    } elseif (isset($reviewInfo['reviewId'])) {
                                                                                        echo "value='$reviewInfo[reviewId]'";
                                                                                    } ?> required><br>

                        <label for="reviewDate">Review Date</label><br>
                        <input type="text" id="reviewDate" readonly name="reviewDate" <?php if (isset($reviewDate)) {
                                                                                            echo "value='$reviewDate'";
                                                                                        } elseif (isset($reviewInfo['reviewDate'])) {
                                                                                            echo "value='$reviewInfo[reviewDate]'";
                                                                                        } ?> required><br>

                        <label for="reviewText">Write your review</label><br>
                        <textarea id="reviewText" required name="reviewText" rows="5" cols="50"><?php if (isset($reviewText)) {
                                                                                                    echo "$reviewText";
                                                                                                } elseif (isset($reviewInfo['reviewText'])) {
                                                                                                    echo $reviewInfo['reviewText'];
                                                                                                } ?></textarea><br>


                        <input type="submit" name="submit" value="Update Review" id="regbtn">

                        <input type="hidden" name="action" value="update">

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