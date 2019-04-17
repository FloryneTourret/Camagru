<div class="columns">
    <h1 class="column is-half is-offset-one-quarter has-text-centered is-size-4">Changer mes informations</h1>
</div>

<div class="columns container-changepassword">
    <div class="column is-half is-offset-one-quarter">
        <h2>Modifier mon mot de passe</h2>
        <?php if (!empty($error)){ ?>
            <div class="column is-half is-offset-one-quarter has-text-centered">
            <p class="has-text-danger"><?php echo $error; ?></p></div>
        <?php } ?>
        <?php if (!empty($success)){ ?>
            <div class="column is-half is-offset-one-quarter has-text-centered">
            <p class="has-text-info"><?php echo $success; ?></p></div>
        <?php } ?>
        <form class="column" action="/index.php/Account" method="post">
            <div class="field">
                <label class="label">Votre mot de passe actuel</label>
                <p class="control has-icons-left">
                    <input class="input" type="password" name="user_old_password" placeholder="Votre mot de passe actuel" required value="<?php if(isset($_POST['user_login'])){echo $_POST['user_login'];}?>">
                    <span class="icon is-small is-left">
                        <i class="fas fa-lock"></i>
                    </span>
                </p>
            </div>

            <div class="field">
                <label class="label">Votre nouveau mot de passe <i class="fas fa-info-circle" id="info"></i></label>
                <p class="control has-icons-left">
                    <input class="input" type="password" name="user_password" placeholder="Votre mot de passe" required>
                    <span class="icon is-small is-left">
                        <i class="fas fa-lock"></i>
                    </span>
                </p>
            </div>

            <div class="field">
                <label class="label">Répétez votre nouveau mot de passe</label>
                <p class="control has-icons-left">
                    <input class="input" type="password" name="user_password_repeat" placeholder="Votre mot de passe" required>
                    <span class="icon is-small is-left">
                        <i class="fas fa-lock"></i>
                    </span>
                </p>
            </div>

            <input class="input" name="user_token" type="hidden" value="<?php echo $_SESSION['token'];?>">

            <div class="field">
                <button class="button is-medium is-fullwidth is-primary" type="submit">Modifier mon mot de passe</button>
            </div>
        </form>



        <h2>Modifier mon pseudo, ...</h2>
        <form class="column" action="/index.php/Account" method="post">

            <div class="field">
                <label class="label">Prénom</label>
                <p class="control has-icons-left">
                    <input class="input" type="text" name="user_firstname" placeholder="Prénom" required value="<?php echo $_SESSION['user']['firstname']; ?>">
                    <span class="icon is-small is-left">
                        <i class="fas fa-user"></i>
                    </span>
                </p>
            </div>

            <div class="field">
                <label class="label">Nom</label>
                <p class="control has-icons-left">
                    <input class="input" type="text" name="user_lastname" placeholder="Nom" required value="<?php echo $_SESSION['user']['lastname']; ?>">
                    <span class="icon is-small is-left">
                        <i class="fas fa-user"></i>
                    </span>
                </p>
            </div>

            <div class="field">
                <label class="label">Pseudo</label>
                <p class="control has-icons-left">
                    <input class="input" type="text" name="user_pseudo" placeholder="Pseudo" required value="<?php echo $_SESSION['user']['login']; ?>">
                    <span class="icon is-small is-left">
                        <i class="fas fa-user"></i>
                    </span>
                </p>
            </div>

            <div class="field">
                <label class="label">Adresse email</label>
                <p class="control has-icons-left">
                    <input class="input" type="mail" name="user_mail" placeholder="Adresse email" required value="<?php echo $_SESSION['user']['email']; ?>">
                    <span class="icon is-small is-left">
                        <i class="fas fa-envelope"></i>
                    </span>
                </p>
            </div>

            <div class="field">
                <label class="label">Biographie</label>
                <p class="control has-icons-left">
                    <textarea class="input" type="text" name="user_bio" placeholder="Biographie" required><?php if (!empty($_SESSION['user']['biography'])) echo $_SESSION['user']['biography'];?></textarea>
                    <span class="icon is-small is-left">
                        <i class="fas fa-pen-nib"></i>
                    </span>
                </p>
            </div>

            <input class="input" name="user_token" type="hidden" value="<?php echo $_SESSION['token'];?>">

            <div class="field">
                <button class="button is-medium is-fullwidth is-primary" type="submit">Mettre à jour mon profil</button>
            </div>
        </form>



    </div>
</div>

<div class="modal" id='modal'>
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head">
      <p class="modal-card-title">Règles de mot de passe</p>
      <button class="delete" id="delete" aria-label="close"></button>
    </header>
    <section class="modal-card-body">
      <p>Votre mot de passe contient au moins : </p>
      <ul class="modal_list">
        <li>12 caractères</li>
        <li>une majuscule</li>
        <li>une minuscule</li>
        <li>un chiffre</li>
        <li>un caractère spécial</li>
      </ul>
    </section>
    <footer class="modal-card-foot">
      <button class="button is-success" id="gotit">Compris !</button>
    </footer>
  </div>
</div>

<script src="/assets/js/modal.js"></script>