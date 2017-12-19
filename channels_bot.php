<?php 
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
    case "1507":
        $reply =  "Channel is active";
        break;
    case "1531":
        $reply =  "Source problem";
        break;
    case "1506":
        $reply =  "Under maintenance";
        break;
    case "help":
        $reply =  "Type only channels number to obtain their status";
        break;
    default:
        $reply =  "No such channel";
}
// send reply
$sendto =API_URL."sendmessage?chat_id=".$chatID."&text=".$reply;
file_get_contents(urlencode($sendto));
//http_get_contents(urlencode($sendto); // alter way with curl
// Create a debug log.txt to check the response/reply from Telegram in JSON format.
// You can disable it by commenting checkJSON.
checkJSON($chatID,$update);
function checkJSON($chatID,$update){
    $myFile = "log.txt";
    $updateArray = print_r($update,TRUE);
    $fh = fopen($myFile, 'a') or die("can't open file");
    fwrite($fh, $chatID ."nn");
    fwrite($fh, $updateArray."nn");
    fclose($fh);
}
// for testing with curl
function http_get_contents($url)
{
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_TIMEOUT, 1);
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  if(FALSE === ($retval = curl_exec($ch))) {
      log2("error".$url);
    error_log(curl_error($ch));
  } else {
    return $retval;
  }
}
function log2($text){
    $myFile = "log2.txt";
    
    $fh = fopen($myFile, 'a') or die("can't open file");
    fwrite($fh, $text);
    fclose($fh);
}
?>
