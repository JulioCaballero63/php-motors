<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Server Error | PHP Motors</title>
    <meta name="description" content="This is the server error page."/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/small.css" media="screen"/>
    <link rel="stylesheet" href="../css/medium.css" media="screen"/>
    <link rel="stylesheet" href="../css/large.css" media="screen"/>
</head>

<body>
<div class="container">
<div class="banner">
<header>
<div class="logo">
          <picture>
            <img src="../images/site/logo.png" alt="logo" />
          </picture>
          <div class="section">
            <a href="#">My Account</a>
            </div>
        </div>
</header>

<nav>
  <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/navigation.php';?>
</nav>
</div>

<main>
<div class="contentTitle">
  <h1>Server Error</h1>
</div>
<p>Sorry our server seems to be experiencing some technical difficulties. Please check back later.</p>
</main>

<footer>
  <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php';?>
</footer> 

</div> 
</body>
</html>