<?php

$user = new users();
$formError = array();
$mail = '';
$password = '';

if (isset($_POST['login'])) {
    if (!empty($_POST['mail'])) {
        if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
            $mail = htmlspecialchars($_POST['mail']);
        } else {
            $formError['mail'] = 'Le mail n\'est pas valide';
        }
    } else {
        $formError['mail'] = 'Veuillez renseigner un mail svp.';
    }
    if (isset($_POST['password'])) {
        if (!empty($_POST['password'])) {
            $password = htmlspecialchars($_POST['password']);
        } else {
            $formError['password'] = 'Veuillez renseigner un mot de passe svp.';
        }
    }
    if (count($formError) == 0) {
        $user->mail = $mail;
        $hash = $user->getHashFromUser();
        if (is_object($hash)) {
            $isConnect = password_verify($password, $hash->password);
            //l'utilisateur est connecté
            if ($isConnect) {
                $userInfo = $user->getUserInfo();
                $_SESSION['nickname'] = $userInfo->nickname;
                $_SESSION['mail'] = $userInfo->mail;
                $_SESSION['password'] = $userInfo->password;
                $_SESSION['idGroup'] = $userInfo->idGroup;
                $_SESSION['id'] = $userInfo->id;
                $_SESSION['isConnect'] = true;
                header('Location:index.php');
                exit();
            }
        }
    }
} 