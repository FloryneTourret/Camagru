<?php if (isset($error)){?>
<div class="columns">
    <div class="column is-half is-offset-one-quarter">
        <article class="message is-danger">
        <div class="message-header">
            <p>Récupération de mot de passe</p>
        </div>
        <div class="message-body"> 
            <p><?php echo $error; ?></p>
            <div class="has-text-right">
                <a href="/index.php/Login/forgotpassword" class="has-text-grey-dark">Renvoyez moi un mail !</a>
            </div>
        </div>
        </article>
    </div>
</div>
<?php } else if (isset($success)) {?>
<?php
if (isset($error_password))
    echo '<div class="columns"><div class="column is-half is-offset-one-quarter"><p class="has-text-danger">'.$error_password.'</p></div></div>';
?>
<div class="columns">
<form class="column is-half is-offset-one-quarter" action="/index.php/Login/resetpassword/<?php echo $token;?>" method="post">
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
        <label class="label">Répetez votre nouveau mot de passe</label>
        <p class="control has-icons-left">
            <input class="input" type="password" name="user_password_confirm" placeholder="Répetez votre mot de passe" required>
            <span class="icon is-small is-left">
                <i class="fas fa-lock"></i>
            </span>
        </p>
    </div>

    <input class="input" name="user_token" type="hidden" value="<?php echo $_SESSION['token'];?>">

    <div class="field">
        <button class="button is-medium is-fullwidth is-primary" type="submit">Changer mon mot de passe</button>
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
<?php } ?>