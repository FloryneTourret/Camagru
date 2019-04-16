<?php
if (isset($error))
    echo '<div class="columns"><div class="column is-half is-offset-one-quarter"><p class="has-text-danger">'.$error.'</p></div></div>';
?>
<div class="columns">
<form class="column is-half is-offset-one-quarter" action="/index.php/Login/forgotpassword" method="post">

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

    <input class="input" name="user_token" type="hidden" value="<?php echo $_SESSION['token'];?>">

    <div class="field">
        <button class="button is-medium is-fullwidth is-primary" type="submit">Envoyez moi un mail</button>
    </div>
</form>
</div>