<?php if (isset($error)){?>
<div class="columns">
    <div class="column is-half is-offset-one-quarter">
        <article class="message is-danger">
        <div class="message-header">
            <p>Activation du compte</p>
        </div>
        <div class="message-body"> 
            <p><?php echo $error; ?></p>
            <div class="has-text-right">
                <a href="/index.php/Register/sendmail" class="has-text-grey-dark">Renvoyez moi un mail !</a>
            </div>
        </div>
        </article>
    </div>
</div>
<?php } else if (isset($success)) {?>
<div class="columns">
    <div class="column is-half is-offset-one-quarter">
        <article class="message is-primary">
        <div class="message-header">
            <p>Activation du compte</p>
        </div>
        <div class="message-body"> 
            <p><?php echo $success; ?></p>
            <div class="has-text-right">
                <a href="/index.php/Login" class="has-text-grey-dark">Me connecter</a>
            </div>
        </div>
        </article>
    </div>
</div>
<?php } ?>
