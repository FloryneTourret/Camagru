<nav class="navbar is-light is-fixed-top" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
    <a class="navbar-item" href="/">
          <img src="/assets/img/picture.png" width="auto" height="28">
    </a>
    <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
    </a>
  </div>

  <div id="navbarBasicExample" class="navbar-menu">
    <div class="navbar-start">
      <a class="navbar-item" href="/index.php/Studio">
          <img src="/assets/img/filter.png" width="auto" height="28">
      </a>
    </div>

    <div class="navbar-end">
        <?php if (isset($_SESSION['user'])){?>
          <div class="navbar-item has-dropdown is-hoverable">
            <a class="navbar-link">
              <img id="user_picture" src="/assets/img/avatar.png" width="auto" height="28"><?php echo $_SESSION['user']['login'];?>
            </a>

            <div class="navbar-dropdown is-right">
              <a class="navbar-item" href="/index.php/Profile">
                Profil
              </a>
              <a class="navbar-item" href="/index.php/Account">
                Gestion du compte
              </a>
              <hr class="navbar-divider">
              <a class="navbar-item" href="/index.php/Logout">
                Déconnexion
              </a>
            </div>
          </div>
        <?php } else { ?>
        <div class="navbar-item">
          <div class="buttons">
            <a class="button is-primary" href="/index.php/Register">
              <strong>Inscription</strong>
            </a>
            <a class="button is-light" href="/index.php/Login">
              Connexion
            </a>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
  </div>
</nav>


