<?php

function safe($val, $type = 'SQL')
{
    if ($type == NULL)
        $type = 'SQL';
    if ($type == 'HTML') {
        $val = strip_tags($val);
        return htmlspecialchars($val);
    } else if ($type == 'SQL') {
        if (get_magic_quotes_gpc())
            $val = stripslashes($val);
        return $val;
    }
    return (false);
}

function IsEven($int)
{
    if ($int % 2 == 0) {
        return true;
    } else {
        return false;
    }
}

function Redirect($url)
{
    if (!headers_sent())
        header('Location:' . safe($url, 'SQL'));
    else
        print '<script>window.location.replace("' . safe($url, 'SQL') . '");</script>';
    exit;
}

function hybbe($str)
{
    global $bdd;
    $tmp2 = $bdd->query("SELECT * FROM hybbe_geral LIMIT 1");
    $tmp = $tmp2->fetch(PDO::FETCH_ASSOC);

    return $tmp[$str];
}

function MUS($command, $data = '')
{
    $mus_ip   = Serveur('Host');
    $mus_port = Serveur('Mus');
    $MUSdata  = $command . chr(1) . $data;
    $proto    = @getprotobyname('tcp');
    $socket   = @socket_create(AF_INET, SOCK_STREAM, $proto);
    @socket_connect($socket, $mus_ip, $mus_port);
    @socket_send($socket, $MUSdata, strlen($MUSdata), MSG_DONTROUTE);
    @socket_close($socket);
}

function date_fr($format, $timestamp = true)
{
    if (!$timestamp)
        $date_en = date($format);
    else
        $date_en = date($format, $timestamp);
    $texte_en = array(
        "Monday",
        "Tuesday",
        "Wednesday",
        "Thursday",
        "Friday",
        "Saturday",
        "Sunday",
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December"
    );
    $texte_fr = array(
        "Lundi",
        "Mardi",
        "Mercredi",
        "Jeudi",
        "Vendredi",
        "Samedi",
        "Dimanche",
        "Janvier",
        "F&eacute;vrier",
        "Mars",
        "Avril",
        "Mai",
        "Juin",
        "Juillet",
        "Ao&ucirc;t",
        "Septembre",
        "Octobre",
        "Novembre",
        "D&eacute;cembre"
    );
    $date_fr  = str_replace($texte_en, $texte_fr, $date_en);
    $texte_en = array(
        "Mon",
        "Tue",
        "Wed",
        "Thu",
        "Fri",
        "Sat",
        "Sun",
        "Jan",
        "Feb",
        "Mar",
        "Apr",
        "May",
        "Jun",
        "Jul",
        "Aug",
        "Sep",
        "Oct",
        "Nov",
        "Dec"
    );
    $texte_fr = array(
        "Lun",
        "Mar",
        "Mer",
        "Jeu",
        "Ven",
        "Sam",
        "Dim",
        "Jan",
        "F&eacute;v",
        "Mar",
        "Avr",
        "Mai",
        "Jui",
        "Jui",
        "Ao&ucirc;",
        "Sep",
        "Oct",
        "Nov",
        "D&eacute;c"
    );
    $date_fr  = str_replace($texte_en, $texte_fr, $date_fr);
    return $date_fr;
}

function encrypt($data)
{
    $key  = "secret";
    $data = serialize($data);
    $td   = mcrypt_module_open(MCRYPT_DES, "", MCRYPT_MODE_ECB, "");
    $iv   = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
    mcrypt_generic_init($td, $key, $iv);
    $data = base64_encode(mcrypt_generic($td, '!' . $data));
    mcrypt_generic_deinit($td);
    return $data;
}

function decrypt($data)
{
    $key = "secret";
    $td  = mcrypt_module_open(MCRYPT_DES, "", MCRYPT_MODE_ECB, "");
    $iv  = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
    mcrypt_generic_init($td, $key, $iv);
    $data = mdecrypt_generic($td, base64_decode($data));
    mcrypt_generic_deinit($td);
    if (substr($data, 0, 1) != '!')
        return false;
    $data = substr($data, 1, strlen($data) - 1);
    return unserialize($data);
}

function tabelaexiste($table)
{
    global $bdd;
    try {
        $result = $bdd->query("SELECT 1 FROM $table LIMIT 1");
    }catch (Exception $e) {
        return FALSE;
    }
    return $result !== FALSE;
}

function GenerateRandom($type = "sso", $length = 0)
{
    switch ($type) {
        case "sso":
            $data = GenerateRandom("random", 8) . "-" . GenerateRandom("random", 4) . "-" . GenerateRandom("random", 4) . "-" . GenerateRandom("random", 4) . "-" . GenerateRandom("random", 12);
            return $data;
            break;
        case "app_key":
            $data = strtoupper(GenerateRandom("random", 32)) . ".resin-fe-" . GenerateRandom("random_number", 1);
            return $data;
            break;
        case "random":
            $data     = "";
            $possible = "0123456789abcdef";
            $i        = 0;
            while ($i < $length) {
                $char = substr($possible, mt_rand(0, strlen($possible) - 1), 1);
                $data .= $char;
                $i++;
            }
            return $data;
            break;
        case "random_number":
            $data     = "";
            $possible = "0123456789";
            $i        = 0;
            while ($i < $length) {
                $char = substr($possible, mt_rand(0, strlen($possible) - 1), 1);
                $data .= $char;
                $i++;
            }
            return $data;
            break;
    }
}

function Random($type = "sso", $lenght = 0) {
    switch ($type) {
        case "sso":
            $data = GenerateRandom("random", 8) . "-" . GenerateRandom("random", 4) . "-" . GenerateRandom("random", 4) . "-" . GenerateRandom("random", 4) . "-" . GenerateRandom("random", 12);
            return $data;
        break;
        case "random":
            $data = null;
            $possible  = 'abcdefghijklmnopqrstuvwxyz';
            $possible .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $possible .= '1234567890';

            for ($i = 0; $i < $length; $i++) {
                $data .= substr($possible, rand() % (strlen($possible)), 1);
            }

            return $data;
        break;
        case "random_number":
            $data = "";
            $possible = "1234567890";
            $i  = 0;

            while ($i < $length) {
                $char = substr($possible, mt_rand(0, strlen($possible) - 1), 1);
                $data = $char;
                $i++;
            }

            return $data;
        break;
    }
}

function UpdateSSO($username) {
    global $bdd;
    
    $ticket = Random();

    $updateTicket = $bdd->prepare("UPDATE players SET auth_ticket = ? WHERE username = ? AND online='0'");
    $updateTicket->bindValue(1, $ticket);
    $updateTicket->bindValue(2, $username);
    $updateTicket->execute();

    return $ticket;
}

function TicketRefresh($username)
{
    global $bdd;
    for ($i = 1; $i <= 3; $i++): {
        $base = $base . rand(0, 99);
        $base = uniqid($base);
    }
    endfor;
    $request = $bdd->query("UPDATE players SET auth_ticket = '" . safe($base, 'SQL') . "' WHERE username = '" . safe($username, 'SQL') . "' LIMIT 1");
    return $base;
}

function str_contains($haystack, $needle, $ignoreCase = false)
{
    if ($ignoreCase) {
        $haystack = strtolower($haystack);
        $needle   = strtolower($needle);
    }
    $needlePos = strpos($haystack, $needle);
    return ($needlePos === false ? false : ($needlePos + 1));
}

function suppr_accents($chaine)
{
    $accents = array(
        'À',
        'Á',
        'Â',
        'Ã',
        'Ä',
        'Å',
        'Ç',
        'È',
        'É',
        'Ê',
        'Ë',
        'Ì',
        'Í',
        'Î',
        'Ï',
        'Ò',
        'Ó',
        'Ô',
        'Õ',
        'Ö',
        'Ù',
        'Ú',
        'Û',
        'Ü',
        'Ý',
        'à',
        'á',
        'â',
        'ã',
        'ä',
        'å',
        'ç',
        'è',
        'é',
        'ê',
        'ë',
        'ì',
        'í',
        'î',
        'ï',
        'ð',
        'ò',
        'ó',
        'ô',
        'õ',
        'ö',
        'ù',
        'ú',
        'û',
        'ü',
        'ý',
        'ÿ'
    );
    $sans    = array(
        'A',
        'A',
        'A',
        'A',
        'A',
        'A',
        'C',
        'E',
        'E',
        'E',
        'E',
        'I',
        'I',
        'I',
        'I',
        'O',
        'O',
        'O',
        'O',
        'O',
        'U',
        'U',
        'U',
        'U',
        'Y',
        'a',
        'a',
        'a',
        'a',
        'a',
        'a',
        'c',
        'e',
        'e',
        'e',
        'e',
        'i',
        'i',
        'i',
        'i',
        'o',
        'o',
        'o',
        'o',
        'o',
        'o',
        'u',
        'u',
        'u',
        'u',
        'y',
        'y'
    );
    return str_replace($accents, $sans, $chaine);
}

function before($this, $inthat)
{
    return substr($inthat, 0, strpos($inthat, $this));
}

function LastOnline($a){
    if(!empty($a) || !$a == ''){
        if(is_numeric($a)){
            $date = $a;
            $date_now = time();
            $difference = $date_now - $date;
            if($difference <= '59'){ $echo = 'há '; }
            elseif($difference <= '3599' && $difference >= '60'){
                $minutos = date('i', $difference);
                if($minutos[0] == 0) { $minutos = $minutos[1]; }
                if($minutos == 1) { $minutos_str = 'minuto'; }
                else { $minutos_str = 'minutos'; }
                $echo = 'há '.$minutos.' '.$minutos_str;//Minutos
            }elseif($difference <= '82799' && $difference >= '3600'){
                $horas = date('G', $difference);
                if($horas == 1) { $horas_str = 'hora'; }
                else { $horas_str = 'horas'; }
                $echo = 'há '.$horas.' '.$horas_str;//Minutos
            }elseif($difference <= '518399' && $difference >= '82800'){
                $dias = date('j', $difference);
                if($dias == 1) { $dias_str = 'dia'; }
                else { $dias_str = 'dias'; }
                $echo = 'há '.$dias.' '.$dias_str;//Minutos
            }elseif($difference <= '2678399' && $difference >= '518400'){
                $semana = floor(date('j', $difference) / 7).'<!-- WTF -->';
                if($semana == 1) { $semana_str = 'semana'; }
                else { $semana_str = 'semanas'; }
                $echo = 'há '.floor($semana).' '.$semana_str;//Minutos
            }else { $echo = 'há '.date('n', $difference).' mês(es)'; }
            return $echo;
        }else{ return $a; }
    }else{ return 'Não está conectado'; }
}

function Onlines(){
    global $bdd;
    $onlines = $bdd->prepare("SELECT * FROM players WHERE online = ?");
    $onlines->bindValue(1, '1');
    $onlines->execute();
    $online = $onlines->rowCount();

    if ($online >= 50) {
        $online = $online;
    } else {
        $online = "Muitos";
    }
    return $online;
}

function FilterText($a){
    $a = stripslashes(htmlspecialchars($a));
    $a = trim($a);
    
    $a = str_replace('"','',$a);
    $a = str_replace("'","",$a);
    $a = str_replace("<script","bobba",$a);
    $a = str_replace("(","",$a);
    $a = str_replace(")","",$a);
    $a = str_replace("abre.ai","hybbe hotel",$a);
    $a = str_replace("http://","bobba",$a);
    $a = str_replace("https://","bobba",$a);
    $a = str_replace("<?php","",$a);
    $a = str_replace("<a","",$a);
    $a = str_replace("</a>","",$a);
    return $a;
}

function FilterLink($a){
    $a = stripslashes(htmlspecialchars($a));
    $a = trim($a);
    
    $a = str_replace('"','&#34;',$a);
    $a = str_replace("'","&#39;",$a);
    $a = str_replace("<script","",$a);
    $a = str_replace(" ", "-", $a); 
    $a = str_replace("[", "(", $a); 
    $a = str_replace("]", ")", $a); 
    $a = str_replace("á", "a", $a);
    $a = str_replace("é", "e", $a);
    $a = str_replace("í", "i", $a);
    $a = str_replace("ó", "o", $a);
    $a = str_replace("ú", "u", $a);
    $a = str_replace("!", "", $a);
    $a = str_replace("¡", "", $a);
    $a = str_replace("?", "", $a);
    $a = str_replace("¿", "", $a);
    $a = str_replace("/", "", $a);
    $a = str_replace(".", "", $a);
    $a = str_replace(",", "", $a);
    $a = str_replace("A", "a", $a);
    $a = str_replace("E", "e", $a);
    $a = str_replace("I", "i", $a);
    $a = str_replace("O", "o", $a);
    $a = str_replace("U", "u", $a);
    $a = str_replace("ç", "c", $a);
    $a = str_replace("P", "p", $a);
    $a = str_replace("õ", "o", $a);
    return $a;
}

 function IP(){
    if(!empty($_SERVER['HTTP_CF_CONNECTING_IP'])){
        $ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
    }else if(!empty($_SERVER['HTTP_INCAP_CLIENT_IP'])){
        $ip = $_SERVER['HTTP_INCAP_CLIENT_IP'];
    }else if(!empty($_SERVER['HTTP_X_SUCURI_CLIENTIP'])){
        $ip = $_SERVER['HTTP_X_SUCURI_CLIENTIP'];
    }else if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else if (!empty($_SERVER['HTTP_X_FORWARDED'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED'];
    }else if (!empty($_SERVER['HTTP_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_FORWARDED_FOR'];
    } else if (!empty($_SERVER['HTTP_FORWARDED'])) {
        $ip = $_SERVER['HTTP_FORWARDED'];
    } else if (!empty($_SERVER['REMOTE_ADDR'])) {
        $ip = $_SERVER['REMOTE_ADDR'];
    }

    return $ip;
}

function Filter($type, $string) {
    if($type == 'emoji'){
        $value = htmlspecialchars_decode($string);
        $value = trim($value);

        $search = [
            ":D", ":d", ":laughing:", ":rindo:",
            "<3", ":heart:", ":coracao:",
            ":O", ":o", ":gaping:", ":supreso:", ":boquiaberto:",
            ";P", ":stuck_out_tongue_winking_eye:", ":piscando_com_a_lingua_pra_fora:",
            ";(", ":crying:", ":chorando:",
            ":(", ":sad:", ":triste:",
            "B)", "b)", ":sunglasses:", ":cool:", ":descolado:",
            ":|", ":neutral_face:", ":entendiado:",
            ":)", ":happy_face:", ":sorrindo:"	
        ];

        $replace = [
            '<img class="emoji" src="' . CDN . '/assets/img/emoticons/laughing.png">', '<img class="emoji" src="' . CDN . '/assets/img/emoticons/laughing.png">', '<img class="emoji" src="' . CDN . '/assets/img/emoticons/laughing.png">', '<img class="emoji" src="' . CDN . '/assets/img/emoticons/laughing.png">',
            '<img class="emoji" src="' . CDN . '/assets/img/emoticons/heart.png">', '<img class="emoji" src="' . CDN . '/assets/img/emoticons/heart.png">', '<img class="emoji" src="' . CDN . '/assets/img/emoticons/heart.png">',
            '<img class="emoji" src="' . CDN . '/assets/img/emoticons/gaping.png">', '<img class="emoji" src="' . CDN . '/assets/img/emoticons/gaping.png">', '<img class="emoji" src="' . CDN . '/assets/img/emoticons/gaping.png">', '<img class="emoji" src="' . CDN . '/assets/img/emoticons/gaping.png">', '<img class="emoji" src="' . CDN . '/assets/img/emoticons/gaping.png">', 
            '<img class="emoji" src="' . CDN . '/assets/img/emoticons/blinking.png">', '<img class="emoji" src="' . CDN . '/assets/img/emoticons/blinking.png">', '<img class="emoji" src="' . CDN . '/assets/img/emoticons/blinking.png">',
            '<img class="emoji" src="' . CDN . '/assets/img/emoticons/crying.png">', '<img class="emoji" src="' . CDN . '/assets/img/emoticons/crying.png">', '<img class="emoji" src="' . CDN . '/assets/img/emoticons/crying.png">', 
            '<img class="emoji" src="' . CDN . '/assets/img/emoticons/sad.png">', '<img class="emoji" src="' . CDN . '/assets/img/emoticons/sad.png">', '<img class="emoji" src="' . CDN . '/assets/img/emoticons/sad.png">',
            '<img class="emoji" src="' . CDN . '/assets/img/emoticons/sunglasses.png">', '<img class="emoji" src="' . CDN . '/assets/img/emoticons/sunglasses.png">', '<img class="emoji" src="' . CDN . '/assets/img/emoticons/sunglasses.png">', '<img class="emoji" src="' . CDN . '/assets/img/emoticons/sunglasses.png">', '<img class="emoji" src="' . CDN . '/assets/img/emoticons/sunglasses.png">', 
            '<img class="emoji" src="' . CDN . '/assets/img/emoticons/bored.png">', '<img class="emoji" src="' . CDN . '/assets/img/emoticons/bored.png">', '<img class="emoji" src="' . CDN . '/assets/img/emoticons/bored.png">', 
            '<img class="emoji" src="' . CDN . '/assets/img/emoticons/smiling.png">', '<img class="emoji" src="' . CDN . '/assets/img/emoticons/smiling.png">', '<img class="emoji" src="' . CDN . '/assets/img/emoticons/smiling.png">', 
        ];
        
        $value = str_replace($search, $replace, $value);
    }else if($type == 'XSS' || $type == 'xss'){
        $value = htmlspecialchars_decode($string);
        $value = trim($value);

        # 18
        $search = [
            "<script", "/script>", 
            "<div", "/div>",
            "<a", "/a>",
            "<button", "/button>",
            "<?php", "?>",
            "<?=", "?>",
            "<svg", "/svg>",
            "<link", "<?xml"
        ];

        $replace = [
            "", "", 
            "", "", 
            "", "",
            "", "",
            "", "", 
            "", "", 
            "", "", 
            "", "", 
            "", ""
        ];
        
        $value = str_replace($search, $replace, $value);
    }

    return $value;
}


?>
