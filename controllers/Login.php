<?php

Class Login extends Controller{

    public function index(){
        if(isset($_SESSION['user']))
            header('Location: /');
            
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

    public function forgotpassword()
    {
        if(isset($_SESSION['user']))
            header('Location: /');
        
        $this->loadModel('Register_model');
        $data = array();

        if(isset($_POST['user_email']))
        {
            $email = trim(strtolower(htmlspecialchars(addslashes($_POST['user_email']))));
            if ($this->Register_model->email_already_used($email) == TRUE)
            {
                $token = bin2hex(openssl_random_pseudo_bytes(15));
                $link = 'http://'.$_SERVER["HTTP_HOST"].'/index.php/Login/resetpassword/'.$token;
                $this->Register_model->create_token($email, $token);
                $message = "Bienvenue sur Camagru\r\nPour récupérer votre mot de passe, veuillez cliquer sur le lien suivant\r\n".$link;
                mail($email, 'Camagru - Password recovery', $message);
                header('Location: /index.php/Login');
            }
            else
                $data['error'] = "Cet email n'existe pas";
        }
        $this->loadView('Base/header_view');
        $this->loadView('Base/navbar_view');
        $this->loadView('Login/forgot_password_view', $data);
        $this->loadView('Base/footer_view');
        
    }
}

?>