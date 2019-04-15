<?php

Class Register extends Controller{

    public function index()
    {
        $data['loaded'] = 1;
        $this->loadModel('Register_model');
        // $data['users'] = $this->Register_model->get_users();
        if (isset($_POST['user_firstname']) && isset($_POST['user_lastname']) && isset($_POST['user_email'])
            && isset($_POST['user_email_confirm']) && isset($_POST['user_login']) && isset($_POST['user_password'])
            && isset($_POST['user_password_confirm']) && isset($_POST['user_token']))
        {
            if ($_POST['user_email'] == $_POST['user_email_confirm'])
            {
                if ($_POST['user_password'] == $_POST['user_password_confirm'])
                {
                    $firstname = ucfirst(htmlspecialchars(addslashes($_POST['user_firstname'])));
                    $lastname = strtoupper(htmlspecialchars(addslashes($_POST['user_lastname'])));
                    $login = strtolower(htmlspecialchars(addslashes($_POST['user_login'])));
                    $email = strtolower(htmlspecialchars(addslashes($_POST['user_email'])));
                    if (strlen($_POST['user_password']) > 11 && preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W)#', $_POST['user_password'])) 
                    {
                        $password = password_hash(htmlspecialchars(addslashes($_POST['user_password'])), PASSWORD_DEFAULT);
                        if ($this->email_already_used($email) == FALSE)
                        {
                            $this->Register_model->register($firstname, $lastname, $login, $email, $password);
                        }
                        else
                            $data['error'] = "Désolé, cet email est déjà utilisé.";
                    }
                    else {
                        $data['error'] = "Le mot de passe n'est pas conforme.";
                    }
                }
                else
                    $data['error'] = "Les mots de passe ne correspondent pas.";
            }
            else
                $data['error'] = "Les emails ne correspondent pas.";
        }
        $this->loadView('Base/header_view');
        $this->loadView('Base/navbar_view');
        $this->loadView('Register/index_view', $data);
        $this->loadView('Base/footer_view');
    }
}

?>