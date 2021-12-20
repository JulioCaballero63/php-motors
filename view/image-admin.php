<?php
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Image Management | PHP Motors</title>
    <meta name="description" content="This is the image management page for the phpmotors website." />
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
                <h1>Image Management</h1>
                <p class="image-p">Choose one of the options below:</p>

                <h2>Add New Vehicle Image</h2>
                <?php
                if (isset($message)) {
                    echo $message;
                } ?>

                <form class="image-admin" action="/phpmotors/uploads/" method="post" enctype="multipart/form-data">
                    <label class="image-label" for="invItem">Vehicle</label>
                    <?php echo $prodSelect; ?>
                    <fieldset class="image-fieldset">
                        <label>Is this the main image for the vehicle?</label>
                        <label for="priYes" class="pImage" id="yes">Yes</label>
                        <input type="radio" name="imgPrimary" id="priYes" class="pImage yes" value="1">
                        <label for="priNo" class="pImage no">No</label>
                        <input type="radio" name="imgPrimary" id="priNo" class="pImage no" checked value="0">
                    </fieldset>
                    <label class="upload-image">Upload Image:</label>
                    <input type="file" name="file1">
                    <input type="submit" id="image-button" class="regbtn" value="Upload">
                    <input type="hidden" name="action" value="upload">
                </form>

                <hr>

                <h2>Existing Images</h2>
                <p class="notice">If deleting an image, delete the thumbnail too and vice versa.</p>
                <div class="image-admin-area">
                    <?php
                    if (isset($imageDisplay)) {
                        echo $imageDisplay;
                    } ?>
                </div>
            </div>
        </main>

        <footer>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
        </footer>

    </div>
</body>

</html>
<?php unset($_SESSION['message']); ?>