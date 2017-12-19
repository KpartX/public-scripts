<?php
 
phpinfo();

define('BOT_TOKEN', '503130623:AAE5Kt2SA7dibpNETFYBkDQVrgGrQV6_TZM');
define('API_URL', 'https://api.telegram.org/bot'.BOT_TOKEN.'/');

// read incoming info and grab the chatID
$content    = file_get_contents("php://input");
$update     = json_decode($content, true);
$chatID     = $update["message"]["chat"]["id"];
$message    = $update["message"]["text"];

// compose reply
$reply ="";
switch ($message) {
    case "1550":
        $reply =  "Source issue";
        break;
    case "1551":
        $reply =  "Active";
        break;
    case "1122":
        $reply =  "Down";
        break;
    case "1144":
        $reply =  "Under maintenance";
        break;
    default:
        $reply =  "No such channel";
}

// send reply
$sendto =API_URL."sendmessage?chat_id=".$chatID."&text=".$reply;
file_get_contents(urlencode($sendto));
//http_get_contents($sendto);

// Create a debug log.txt to check the response/repy from Telegram in JSON format.
// You can disable it by commenting checkJSON.
checkJSON($chatID,$update);
function checkJSON($chatID,$update){

    $myFile = "channels_bot_log.txt";
    $updateArray = print_r($update,TRUE);
    $fh = fopen($myFile, 'a') or die("can't open file");
    fwrite($fh, $chatID ."nn");
    fwrite($fh, $updateArray."nn");
    fclose($fh);
}

function http_get_contents($url)
{
  /*$ch = curl_init();
  curl_setopt($ch, CURLOPT_TIMEOUT, 1);
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  if(FALSE === ($retval = curl_exec($ch))) {
      log2("error".$url);
    error_log(curl_error($ch));
  } else {
    return $retval;
  }*/
    if ( ! function_exists( 'curl_init' ) ) 
    {
        log2("error".$url);
        die( 'The cURL library is not installed.' );
    }
    $ch = curl_init();
    curl_setopt( $ch, CURLOPT_URL, $url );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
    if (FALSE == $output = curl_exec( $ch ))
    {
        log2("error".$url);
    }
    curl_close( $ch );
    return $output;
}



function log2($text){

    $myFile = "channels_bot_log2.txt";
    
    $fh = fopen($myFile, 'a') or die("can't open file");
    fwrite($fh, $text);
    fclose($fh);
}

?>
