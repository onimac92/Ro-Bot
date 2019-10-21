<?php
error_reporting(0);
header("Content-type: application/json");

if ($_GET['user'] or $argv[1]) {
  if ($_GET['user']) {
    if ($_GET['x'] == "true") {
      $user = urldecode($_GET['user']);
      $user = ucfirst($user);
    } else {
      $user = ucfirst($_GET['user']);
    }
  } elseif ($argv[1]) {
    if ($argv[4] == "true") {
      $user = urldecode($argv[1]);
      $user = ucfirst($user);
    } else {
      $user = ucfirst($argv[1]);
    }
  }

  $uno   = "stimulus=";
  $dos   = ".&cb_settings_language=es&cb_settings_scripting=no&islearning=1&icognoid=wsf&icognocheck=";
  $tres  = $uno.$user.$dos;
  $token = md5(substr($tres, 7, 26));
  $todo  = $uno.$user.$dos.$token;

  if ($_GET['id'] or $argv[2]) {
    if ($_GET['id']) {
      if ($_GET['id'] !== "false") {
        $id   = $_GET['id'];
        $dos  = ".&cb_settings_language=es&cb_settings_scripting=no&sessionid=".$id."&islearning=1&icognoid=wsf&icognocheck=";
        $todo = $uno.$user.$dos.$token;
      } else {
        $id = false;
      }
    } elseif ($argv[2]) {
      if ($argv[2] !== "false") {
        $id = $argv[2];
        $dos  = ".&cb_settings_language=es&cb_settings_scripting=no&sessionid=".$id."&islearning=1&icognoid=wsf&icognocheck=";
        $todo = $uno.$user.$dos.$token;
      } else {
        $id = false;
      }
    }
  }
} else {
  $user = "";
}

if ($user !== "") {
  if ($_GET['cookie'] == "false" or $argv[3] == "false") {

    $url     = "https://www.cleverbot.com";
    $recibir = get_headers($url);
    $cookie  = explode("Set-cookie: ", $recibir[6]);
    $cookie  = explode(";Path=/", $cookie[1])[0];
    
  } else {
    if ($_GET['cookie']) {
      $cookie = $_GET['cookie'];
    } elseif ($argv[3]) {
      $cookie = $argv[3];
    }
  }
} else {
  $user = false;
}

if ($user !== false) {
  $ch = curl_init();
  if ($id !== false) {
    curl_setopt($ch, CURLOPT_URL, 'https://www.cleverbot.com/webservicemin?uc=UseOfficialCleverbotAPI&cbsid='.$id);
  } else {
    curl_setopt($ch, CURLOPT_URL, 'https://www.cleverbot.com/webservicemin?uc=UseOfficialCleverbotAPI&');
  }

  curl_setopt($ch, CURLOPT_POSTFIELDS, $todo);
  curl_setopt($ch, CURLOPT_COOKIE, $cookie);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_VERBOSE, 0);
  curl_setopt($ch, CURLOPT_HEADER, 1);
  $response = curl_exec($ch);
  if (curl_errno($ch)) {
      echo '{"error_description":"No hay conexion"}';
  }
  $h_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
  curl_close($ch);
  $h_size  = $h_size - 3;
  $header  = substr($response, 0, $h_size);
  $body    = substr($response, $h_size);
  $array   = explode(PHP_EOL, $header);
  $session = explode(": ", $array[5])[1];
  $bot     = explode(": ", $array[6])[1];

  echo '{';
  echo '"id":"'.$session.'",';
  echo '"user":"'.$user.'",';
  echo '"bot":"'.$bot.'",';
  echo '"cookie":"'.$cookie.'"';
  echo '}';
}

?>