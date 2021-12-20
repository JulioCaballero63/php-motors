<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>PHP Motors Home Page | PHP Motors
    </title>
    <meta name="description" content="This is a the home page for the phpmotors website." />
    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/head.php';
    ?>
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
                <h1>Welcome to PHP Motors!</h1>
            </div>

            <div class="grid">

                <div class="car-details">
                    <h2>DMC Delorean</h2>
                    <p>3 Cup holders</p>
                    <p>Superman doors</p>
                    <p>Fuzzy dice!</p>
                </div>

                <div class="delorean">
                    <img class="car" src="/phpmotors/images/vehicles/delorean.jpg" alt="delorean car from back to the future.">
                </div>

                <div class="own-today">
                    <img src="/phpmotors/images/site/own_today.png" alt="link to aplication">
                </div>
            </div>

            <div class="gridtwo">
                <div class="reviews">
                    <h3>DMC Delorean Reviews</h3>
                    <ul>
                        <li>"So fast its almost like traveling in time." (4/5)</li>
                        <li>"Coolest ride on the road." (4/5)</li>
                        <li>"I'm feeling Marty McFly!" (5/5)</li>
                        <li>"The most futuristic ride of our day." (4.5/5)</li>
                        <li>"80's livin and I love it!" (5/5)</li>
                    </ul>
                </div>

                <div class="upgrades">
                    <h4>Delorean Upgrades</h4>
                    <div class="upgrade flux">
                        <figure>
                            <img class="upgrade-img" src="/phpmotors/images/upgrades/flux-cap.png" alt="flux capacitor">
                            <figcaption>
                                <a href="#">Flux Capacitor</a>
                            </figcaption>
                        </figure>
                    </div>

                    <div class="upgrade flame">
                        <figure>
                            <img class="upgrade-img" src="/phpmotors/images/upgrades/flame.jpg" alt="flame decal">
                            <figcaption>
                                <a href="#">Flame Decals</a>
                            </figcaption>
                        </figure>
                    </div>

                    <div class="upgrade bumper">
                        <figure>
                            <img class="upgrade-img" src="/phpmotors/images/upgrades/bumper_sticker.jpg" alt="bumper sticker">
                            <figcaption>
                                <a href="#">Bumper Stickers</a>
                            </figcaption>
                        </figure>
                    </div>

                    <div class="upgrade hub">
                        <figure>
                            <img class="upgrade-img" src="/phpmotors/images/upgrades/hub-cap.jpg" alt="hub cap">
                            <figcaption>
                                <a href="#">Hub Caps</a>
                            </figcaption>
                        </figure>
                    </div>
                </div>
            </div>
        </main>

        <footer>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
        </footer>

    </div>
</body>

</html>