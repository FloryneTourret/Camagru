<nav class="navbar" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
    <a class="navbar-item" href="/">
      <img src="/assets/img/camera.png" width="auto" height="28">
    </a>
    <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
    </a>
  </div>

  <div id="navbarBasicExample" class="navbar-menu">
    <div class="navbar-start">
      <a class="navbar-item">
        Home
      </a>

      <a class="navbar-item">
        Documentation
      </a>
    </div>

    <div class="navbar-end">
      <div class="navbar-item">
        <?php if (isset($_SESSION['user'])){?>
          <div class="navbar-item dropdown has-dropdown is-hoverable dropdown is-right">
            <div class="dropdown-trigger">
              <a class="navbar-link">
                <?php echo $_SESSION['user']['login'];?>
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
          </div>
        </div>
        <?php } else { ?>
        <div class="buttons">
          <a class="button is-primary" href="/index.php/Register">
            <strong>Inscription</strong>
          </a>
          <a class="button is-light" href="/index.php/Login">
            Connexion
          </a>
        </div>
        <?php } ?>
      </div>
    </div>
  </div>
</nav>