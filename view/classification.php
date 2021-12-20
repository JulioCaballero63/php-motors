<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?php echo $classificationName; ?> vehicles | PHP Motors</title>
    <meta name="description" content="This the classification view for the phpmotors website." />
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
                <h1><?php echo $classificationName; ?> vehicles</h1>
                <?php if (isset($message)) {
                    echo $message;
                }
                ?>
                <?php if (isset($vehicleDisplay)) {
                    echo $vehicleDisplay;
                } ?>
            </div>
        </main>

        <footer>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
        </footer>

    </div>
</body>

</html>