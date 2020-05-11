<?php 
    if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['rpassword'])) {
        $username = safe($_POST['username'],'SQL');
        $email = safe($_POST['email'],'SQL');
        $password = safe($_POST['password'],'SQL');
        $rpassword = safe($_POST['rpassword'],'SQL');
        $idPost = safe($_POST['id'], 'SQL');

        $username_check = preg_match("/^[A-Z0-9=?!@:.-]{2,15}$/i", $username);
        $email_check = preg_match("/^[a-z0-9_\.-]+@([a-z0-9]+([\-]+[a-z0-9]+)*\.)+[a-z]{2,7}$/i", $email);
        $tmp_sql = $bdd->prepare("SELECT id FROM players WHERE username = :username LIMIT 1");
        $tmp_sql->execute(Array(":username" => $username));
        $tmp_sql_2 = $bdd->prepare("SELECT id FROM players WHERE email = :email LIMIT 1");
        $tmp_sql_2->execute(Array(":email" => $email));

        if(isset($_POST['g-recaptcha-response'])){
            $captcha = $_POST['g-recaptcha-response'];
        }

        if(isset($username) && isset($email) && isset($password) && isset($rpassword)) {
            $failure = false;
            if ($tmp_sql->rowCount() > 0) {
                $mensagem1['username'] = "Esse nome já esta sendo utilizado!";
                $failure = true;
            } else if ($username_check !== 1) {
                $mensagem5['username'] = "Esse nome não é válido!";
                $failure = true;
            } else if (strlen($email) < 6) {
                $mensagem2['email'] = "Digite um endereço de e-mail válido.";
                $failure = true;
            } else if ($email_check !== 1) {
                $mensagem2['email'] = "Digite um endereço de e-mail válido.";
                $failure = true;
            } else if ($tmp_sql_2->rowCount() > 0) {
                $mensagem2['email'] = "Esse endereço de email já existe!";
                $failure = true;
            } else if ($password !== $rpassword) {
                $mensagem3['password'] = "As senhas não são iguais!";
                $failure = true;
            } elseif (strlen($password) < 6) {
                $mensagem3['password'] = "Sua senha deve ter ao menos 6 caracteres!";
                $failure = true;
            }/* else if (!$captcha) {
                $mensagem4['captcha'] = "Parece que você não marcou o captcha.";
                $failure = true;
            }*/

            $erros = $mensagem1['username'].$mensagem2['email'].$mensagem3['password']./*$mensagem4['captcha'].*/$mensagem5['username'];

            if ($failure == false {
                $password = md5($password);
                $Db->InsertSQL('players', array(
                    'username' => $username,
                    'password' => $password,
                    'email' => $email,
                    'rank' => hybbe('rank'),
                    'credits' => hybbe('moedas'),
                    'activity_points' => hybbe('gemas'),
                    'vip_points' => hybbe('rubis'),
                    'figure' => hybbe('figure'),
                    'gender' => 'M',
                    'motto' => hybbe('missao'),
                    'account_created' => time(),
                    'ip_last' => $Auth->IP(),
                    'ip_reg' => $Auth->IP(),
                    'last_online' => time(),
                ));
                $_SESSION['username'] = $username;
                $_SESSION['password'] = $password;
                Redirect(URL."/principal");
                exit();
            }
        } 
    }
?>