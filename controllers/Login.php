<?php

Class Login extends Controller{

    public function index(){
        $data = array();
        $this->loadModel('Login_model');

        if (isset($_POST['user_login']) && isset($_POST['user_password']))
        {
            $login = trim(strtolower(htmlspecialchars(addslashes($_POST['user_login']))));
            $password = htmlspecialchars(addslashes($_POST['user_password']));
            $user = $this->Login_model->get_user($login);
            if (!empty($user))
            {
                if (password_verify($password, $user['password']))
                {
                    if ($user['enabled'] == 1)
                    {
                        $_SESSION['user'] = $user;
                        header('Location: /');
                    }
                    else
                        $data['error'] = "Votre compte n'est pas encore activé. Veuillez l'activer depuis le lien envoyé sur votre adresse email.";
                }
                else
                    $data['error'] = "Mot de passe incorrect. Veuillez ré-essayer.";
            }
            else
                $data['error'] = "Identifiants inconnus.";
        }
        $this->loadView('Base/header_view');
        $this->loadView('Base/navbar_view');
        $this->loadView('Login/index_view', $data);
        $this->loadView('Base/footer_view');
    }
}

?>