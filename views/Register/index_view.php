<?php 
if (isset($error))
    echo '<div class="columns"><div class="column is-half is-offset-one-quarter"><p class="has-text-danger">'.$error.'</p></div></div>';
?>
<div class="columns">
<form class="column is-half is-offset-one-quarter" action="/index.php/register" method="post">

    <div class="field">
        <label class="label">Prénom</label>
        <div class="control">
            <input class="input" type="text" name="user_firstname" placeholder="Votre prénom" required>
        </div>
    </div>

    <div class="field">
        <label class="label">Nom</label>
        <div class="control">
            <input class="input" type="text" name="user_lastname" placeholder="Votre nom" required>
        </div>
    </div>

    <div class="field">
        <label class="label">Pseudo</label>
        <div class="control">
            <input class="input" type="text" name="user_login" placeholder="Votre pseudo" required>
        </div>
    </div>

    <div class="field">
        <label class="label">Email</label>
        <div class="control">
            <input class="input" type="email" name="user_email" placeholder="Votre adresse email" required>
        </div>
    </div>

    <div class="field">
        <label class="label">Confirmez votre email</label>
        <div class="control">
            <input class="input" type="email" name="user_email_confirm" placeholder="Confirmez votre adresse email" required>
        </div>
    </div>

    <div class="field">
        <label class="label">Mot de passe <i class="fas fa-info-circle" id="info"></i></label>
        <div class="control">
            <input class="input" type="password" name="user_password" placeholder="Votre mot de passe" required>
        </div>
    </div>

    <div class="field">
        <label class="label">Confirmez votre mot de passe</label>
        <div class="control">
            <input class="input" type="password" name="user_password_confirm" placeholder="Confirmez votre mot de passe" required>
        </div>
    </div>

    <input class="input" name="user_token" type="hidden" value="<?php echo $_SESSION['token'];?>">

    <div class="field">
        <button class="button is-medium is-fullwidth is-primary" type="submit">M'inscrire</button>
    </div>
</form>
</div>

<div class="modal" id='modal'>
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head">
      <p class="modal-card-title">Modal title</p>
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