<?php
if (isset($error))
    echo '<div class="columns"><div class="column is-half is-offset-one-quarter"><p class="has-text-danger">'.$error.'</p></div></div>';
?>
<div class="columns">
<form class="column is-half is-offset-one-quarter" action="/index.php/Register" method="post">

    <div class="field">
        <label class="label">Prénom</label>
        <div class="control">
        <p class="control has-icons-left">
            <input class="input" type="text" name="user_firstname" placeholder="Votre prénom" required value="<?php if(isset($_POST['user_firstname'])){echo $_POST['user_firstname'];}?>">
            <span class="icon is-small is-left">
                <i class="fas fa-user"></i>
            </span>
        </p>
        </div>
    </div>

    <div class="field">
        <label class="label">Nom</label>
        <div class="control">
        <p class="control has-icons-left">
            <input class="input" type="text" name="user_lastname" placeholder="Votre nom" required value="<?php if(isset($_POST['user_lastname'])){echo $_POST['user_lastname'];}?>">
            <span class="icon is-small is-left">
                <i class="fas fa-user"></i>
            </span>
        </p>
        </div>
    </div>

    <div class="field">
        <label class="label">Pseudo</label>
        <div class="control">
        <p class="control has-icons-left">
            <input class="input" type="text" name="user_login" placeholder="Votre pseudo" required value="<?php if(isset($_POST['user_login'])){echo $_POST['user_login'];}?>">
            <span class="icon is-small is-left">
                <i class="fas fa-user"></i>
            </span>
        </p>
        </div>
    </div>

    <div class="field">
        <label class="label">Email</label>
        <div class="control">
        <p class="control has-icons-left">
            <input class="input" type="email" name="user_email" placeholder="Votre adresse email" required value="<?php if(isset($_POST['user_email'])){echo $_POST['user_email'];}?>">
            <span class="icon is-small is-left">
                <i class="fas fa-envelope"></i>
            </span>
        </p>
        </div>
    </div>

    <div class="field">
        <label class="label">Confirmez votre email</label>
        <div class="control">
        <p class="control has-icons-left">
            <input class="input" type="email" name="user_email_confirm" placeholder="Confirmez votre adresse email" required value="<?php if(isset($_POST['user_email_confirm'])){echo $_POST['user_email_confirm'];}?>">
            <span class="icon is-small is-left">
                <i class="fas fa-envelope"></i>
            </span>
        </p>
        </div>
    </div>

    <div class="field">
        <label class="label">Mot de passe <i class="fas fa-info-circle" id="info"></i></label>
        <div class="control">
        <p class="control has-icons-left">
            <input class="input" type="password" name="user_password" placeholder="Votre mot de passe" required>
            <span class="icon is-small is-left">
                <i class="fas fa-lock"></i>
            </span>
        </p>
        </div>
    </div>

    <div class="field">
        <label class="label">Confirmez votre mot de passe</label>
        <div class="control">
        <p class="control has-icons-left">
            <input class="input" type="password" name="user_password_confirm" placeholder="Confirmez votre mot de passe" required>
            <span class="icon is-small is-left">
                <i class="fas fa-lock"></i>
            </span>
        </p>
        </div>
    </div>

    <input class="input" name="user_token" type="hidden" value="<?php echo $_SESSION['token'];?>">

    
    
    <div class="field">
    <div class="g-recaptcha" data-sitekey="6LeUtpwUAAAAAI6IF7x7U1v8_9Ugs71V8F9paE2D"></div>
        <button class="button is-medium is-fullwidth is-primary" type="submit">M'inscrire</button>
    </div>
</form>
</div>

<div class="modal" id='modal'>
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head">
      <p class="modal-card-title">Règles de mot de passe</p>
      <button class="delete" id="delete" aria-label="close"></button>
    </header>
    <section class="modal-card-body">
      <p>Un mot de passe doit contenir au moins : </p>
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