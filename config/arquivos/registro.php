<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/geral.php');

    if (extract($_POST)) {
        $username = (isset($_POST['username'])) ? $_POST['username'] : '';
        $email = (isset($_POST['email'])) ? $_POST['email'] : '';
        $password = (isset($_POST['password'])) ? $_POST['password'] : '';
        $rpassword = (isset($_POST['rpassword'])) ? $_POST['rpassword'] : '';

        $username_check = preg_match("/^[A-Z0-9=?!@:.-]{2,15}$/i", $username);
        $email_check = preg_match("/^[a-z0-9_\.-]+@([a-z0-9]+([\-]+[a-z0-9]+)*\.)+[a-z]{2,7}$/i", $email);

        $consult_user = $bdd->prepare("SELECT username FROM players WHERE username = ? LIMIT 1");
        $consult_user->bindValue(1, $username);
        $consult_user->execute();

        $consult_email = $bdd->prepare("SELECT email FROM players WHERE email = ? LIMIT 1");
        $consult_email->bindValue(1, $email);
        $consult_email->execute();

        if (isset($_POST['g-recaptcha-response'])){
            $captcha = $_POST['g-recaptcha-response'];
        }
        
        if (isset($username) && isset($email) && isset($password) && isset($rpassword)) {
            $failure = false;

            if ($consult_user->rowCount() > 0) {
                $mensagem1['username'] = "Esse nome já esta a ser utilizado";
                $failure = true; 
            } else if ($username_check !== 1 || empty($username) || strlen($username) < 3) {
                $mensagem5['username'] = "Esse nome não é válido";
                $failure = true;
            } else if (strlen($email) < 6) {
                $mensagem2['email'] = "Digite um endereço de e-mail válido";
                $failure = true;
            } else if ($email_check !== 1) {
                $mensagem2['email'] = "Digite um endereço de e-mail válido";
                $failure = true;
            } else if ($consult_email->rowCount() > 0) {
                $mensagem2['email'] = "Este endereço de email já existe.";
                $failure = true; 
            } else if ($password !== $rpassword) {
                $mensagem3['password'] = "As senhas não coincidem.";
                $failure = true;
            } else if (strlen($password) < 6) {
                $mensagem3['password'] = "Sua senha deve ter pelo menos 6 caracteres.";
                $failure = true;
            } else if (!$captcha) {
                $mensagem4['captcha'] = "Você esqueceu de nos informar que você não é um Robô.";
                $failure = true;
            }

            $erros = $mensagem1['username'] . $mensagem2['email'] . $mensagem3['password'] . $mensagem4['captcha'] . $mensagem5['username'];

            if (!$failure) {
                $password_hash = md5($password);

                $register = $bdd->prepare("INSERT INTO players (username, password, email, account_created, figure, motto, gender, credits, ip_reg, ip_last) VALUES (?,?,?,?,?,?,?,?,?,?)");
                $register->bindValue(1, $username);
                $register->bindValue(2, $password_hash);
                $register->bindValue(3, $email);
                $register->bindValue(4, time());
                $register->bindValue(5, hybbe('figure'));
                $register->bindValue(6, hybbe('missao'));
                $register->bindValue(7, 'M');
                $register->bindValue(8, hybbe('moedas'));
                $register->bindValue(9, $Auth->IP());
                $register->bindValue(10, $Auth->IP());
                $register->execute();

                session_regenerate_id();

                if(!isset($_SESSION)){
                    session_start();
                }

                $_SESSION['username'] = $username;
                $_SESSION['password'] = $password_hash;

                Redirect(URL . "/me");

                exit();
            }
        } 
    }
?>
