<?php

Class Account extends Controller{

    public function index(){
        $data = array();
        $this->loadModel('Account_model');
        if(!isset($_SESSION['user']))
            header('Location: /');
        if (isset($_POST['user_token']))
        {
            if ($_POST['user_token'] == $_SESSION['token'])
            {
                if (isset($_POST['user_old_password']) && isset($_POST['user_password']) && isset($_POST['user_password_repeat']))
                {
                    if (strlen($_POST['user_password']) > 11 && preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W)#', $_POST['user_password']))
                    {
                        if ($_POST['user_password'] == $_POST['user_password_repeat'])
                        {
                            $password = trim(htmlspecialchars(addslashes($_POST['user_old_password'])));
                            $newpassword = trim(htmlspecialchars(addslashes($_POST['user_password'])));
                            if ($this->Account_model->isPasswordOk($password, $_SESSION['user']['user_id']) == TRUE)
                            {
                                $pass = password_hash($newpassword, PASSWORD_DEFAULT);
                                $this->Account_model->changePassword($pass, $_SESSION['user']['user_id']);
                                $data['success'] = "Votre mot de passe a bien été modifié.";
                            }
                            else
                                $data['error'] = "Ancient mot de passe incorrect.";
                        }
                        else
                            $data['error'] = "Les mots de passent ne correspondent pas.";
                    }
                    else
                        $data['error'] = "Le nouveau mot de passe n'est pas conforme.";
                }
            }
            else
                $data['error'] = "Une erreur est survenue.";
        }
        $this->loadView('Base/header_view');
        $this->loadView('Base/navbar_view');
        $this->loadView('Account/index_view', $data);
        $this->loadView('Base/footer_view');
    }
}