
        <div class="logo">
          <picture>
            <img src="/phpmotors/images/site/logo.png" alt="logo" />
          </picture>
          <div class="section">
            <?php 
            if(!$_SESSION['loggedin']){
              echo '<a href="/phpmotors/accounts/index.php?action=login" title="login to PHP motors account">My Account</a>';}
              else {
                echo '<a href="/phpmotors/accounts/index.php?action=admin" title="user first name">', 'Welcome ', $_SESSION['clientData']['clientFirstname'],'</a>';
                echo '<a href="/phpmotors/accounts/index.php?action=logout" title="logout of PHP motors account">Logout</a>';
              }
            ?>
            
            </div>
        </div>
        