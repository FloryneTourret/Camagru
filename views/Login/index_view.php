<?php
if (isset($error))
    echo '<div class="columns"><div class="column is-half is-offset-one-quarter"><p class="has-text-danger">'.$error.'</p></div></div>';
?>
<div class="columns">
<form class="column is-half is-offset-one-quarter" action="/index.php/Login" method="post">
    <div class="field">
        <label class="label">Votre pseudo</label>
        <p class="control has-icons-left">
            <input class="input" type="text" name="user_login" placeholder="Votre pseudo" required value="<?php if(isset($_POST['user_login'])){echo $_POST['user_login'];}?>">
            <span class="icon is-small is-left">
                <i class="fas fa-user"></i>
            </span>
        </p>
    </div>

    <div class="field">
        <label class="label">Votre mot de passe <i class="fas fa-info-circle" id="info"></i></label>
        <p class="control has-icons-left">
            <input class="input" type="password" name="user_password" placeholder="Votre mot de passe" required>
            <span class="icon is-small is-left">
                <i class="fas fa-lock"></i>
            </span>
        </p>
    </div>

    <input class="input" name="user_token" type="hidden" value="<?php echo $_SESSION['token'];?>">

    <div class="field">
        <button class="button is-medium is-fullwidth is-primary" type="submit">Me connecter</button>
    </div>
    <div class="field has-text-right">
      <a class="has-text-primary" href="/index.php/login/forgotpassword">Mot de passe oublié?</a>
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