<?php

Class Studio extends Controller{

    public function index(){
        if(!isset($_SESSION['user']))
            header('Location: /');
        $this->loadModel('Studio_model');
        $data = array();
        $data['filters'] = $this->Studio_model->get_filters();
        $data['lastpictures'] = $this->Studio_model->get_last_pictures($_SESSION['user']['user_id']);
        if (!empty($_FILES) && !empty($_POST['desc-img-up']) && !empty($_POST['filter']))
        {
            $desc = htmlspecialchars(addslashes($_POST['desc-img-up']));
            if ($_FILES['newimg']['type'] == 'image/jpeg' || $_FILES['newimg']['type'] == 'image/png'
                    || $_FILES['newimg']['type'] == 'image/jpg')
            {
                $check = getimagesize($_FILES['newimg']['tmp_name']);
                if ($check !== false)
                    $upload = 1;
                else
                    $upload = 0;
                if ($upload == 1)
                {
                    $userdir = '/var/www/html/assets/upload/';
                    if (!file_exists($userdir . $_SESSION['user']['login'])) {
                        mkdir($userdir . $_SESSION['user']['login'], 0777, true);
                    }
                    $target_dir = '/var/www/html/assets/upload/'.$_SESSION['user']['login'].'/';
                    $name = bin2hex(openssl_random_pseudo_bytes(8));
                    while (file_exists('/var/www/html/assets/upload'.$_SESSION['user']['login'].'/'.$name))
                        $name = bin2hex(openssl_random_pseudo_bytes(8));
                    if ($_POST['filter'] != "none")
                    {
                        if ($_FILES['newimg']['type'] == 'image/png')
                        {
                            $dest = imagecreatefrompng($_FILES['newimg']['tmp_name']);
                            $name = $name.'.png';
                        }
                        else if ($_FILES['newimg']['type'] == 'image/jpeg')
                        {
                            $name = $name.'.jpg';
                            $dest = imagecreatefromjpeg($_FILES['newimg']['tmp_name']);
                        }
                        $ext = substr($_POST['filter'], -3);
                        if ($ext == "png")
                            $src = imagecreatefrompng(ROOT . $_POST['filter']);
                        else
                            $src = imagecreatefromjpeg(ROOT . $_POST['filter']);
                        $srcpath = ROOT . $_POST['filter'];
                        $target_file = $target_dir . $name;
                        imagecopy($dest, $src, 0, 0, 0, 0, getimagesize($srcpath)[0], getimagesize($srcpath)[1]);
                        imagejpeg($dest, $target_file);
                        imagedestroy($dest);
                        imagedestroy($src);
                    }
                    else
                    {
                        if ($_FILES['newimg']['type'] == 'image/png')
                            $name = $name.'.png';
                        else if ($_FILES['newimg']['type'] == 'image/jpeg')
                            $name = $name.'.jpg';
                        $target_file = $target_dir . $name;
                        move_uploaded_file($_FILES['newimg']['tmp_name'], $target_file);
                    }
                    $target = 'assets/upload/'.$_SESSION['user']['login'].'/'.$name;
                    $this->Studio_model->addimg($target, $_SESSION['user']['user_id'], $desc);
                    header("Location: /index.php/Profile/".$_SESSION['user']['login']);
                }
                else
                    $data['error'] = 'Le fichier renseigné n\'est pas une image';
            }
        }
        if (!empty($_POST['snap-img']) && !empty($_POST['desc-img']) && !empty($_POST['filter-snap']))
        {
            $filter = htmlspecialchars(addslashes($_POST['filter-snap']));
            $desc = htmlspecialchars(addslashes($_POST['desc-img']));
            $target_dir = '/var/www/html/assets/upload/'.$_SESSION['user']['login'].'/';
            if (!(file_exists($target_dir)))
                mkdir($target_dir, 0777, true);
            $name = bin2hex(openssl_random_pseudo_bytes(8));
            while (file_exists('/var/www/html/assets/upload'.$_SESSION['user']['login'].'/'.$name))
                $name = bin2hex(openssl_random_pseudo_bytes(8));
            $ext = 'png';
            if ($filter != "none")
            {
                $verif = substr($filter, -3);
                if ($verif == "jpg")
                    $src = imagecreatefromjpeg(ROOT . $filter);
                else
                    $src = imagecreatefrompng(ROOT . $filter);
                $srcpath = ROOT . $filter;
                $dest = imagecreatefrompng($_POST['snap-img']);
                imagecopy($dest, $src, 0, 0, 0, 0, getimagesize($srcpath)[0], getimagesize($srcpath)[1]);
                imagejpeg($dest, $target_dir.'/'.$name.'.'.$ext);
                imagedestroy($dest);
                imagedestroy($src);
            }
            else
                file_put_contents($target_dir.$name.'.'.$ext, file_get_contents($_POST['snap-img']));
            $target = 'assets/upload/'.$_SESSION['user']['login'].'/'.$name.'.'.$ext;
            $this->Studio_model->addimg($target, $_SESSION['user']['user_id'], $desc);
            header("Location: /index.php/Profile/".$_SESSION['user']['login']);
        }

        $this->loadModel('Studio_model');
        $this->loadView('Base/header_view');
        $this->loadView('Base/navbar_view');
        $this->loadView('Studio/index_view', $data);
        $this->loadView('Base/footer_view');
    }
}

?>