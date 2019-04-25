<nav class="navbar is-light is-fixed-top" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
    <a class="navbar-item" href="/">
          <img src="/assets/img/picture.png" width="auto" height="28">
    </a>
    <?php if (isset($_SESSION['user'])){?>
      <a class="navbar-item" href="/index.php/Studio">
          <img src="/assets/img/filter.png" width="auto" height="28">
      </a>
    <?php } ?>
    <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
    </a>
  </div>

  <div id="navbarBasicExample" class="navbar-menu">

    <div class="navbar-end">
        <?php if (isset($_SESSION['user'])){?>
          <div class="navbar-item has-dropdown is-hoverable">
            <a class="navbar-link">
              <?php if (!empty($_SESSION['user']['path_profile_picture'])){?>
                  <div style='background-image: url("/<?php echo $_SESSION['user']['path_profile_picture']?>"); background-size: cover; background-position: 50% 50%; border-radius: 100%; height: 28px; width: 28px; margin-right:10px;'>
              <?php }else{ ?>
                <div style='background-image: url("/assets/img/avatar.png"); background-size: cover; border-radius: 100%; background-position: 50% 50%; height: 28px; width: 28px; margin-right:10px;'>
              <?php } ?>
                </div>
              <?php echo $_SESSION['user']['login'];?>
            </a>

            <div class="navbar-dropdown is-right">
              <a class="navbar-item" href="/index.php/Profile/<?php echo $_SESSION['user']['login'];?>">
                Profil
              </a>
              <a class="navbar-item" href="/index.php/Account">
                Gestion du compte
              </a>
              <?php if ($_SESSION['admin'] == 1){?>
              <a class="navbar-item" href="/index.php/Admin">
                Panel administrateur
              </a>
              <?php } ?>
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


