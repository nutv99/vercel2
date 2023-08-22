<?php
  /*
   1.µéÍ§¡ÒÃãËéÃÑº string ÁÒ ¨Ò¡ get ËÃ×ÍÃÑºÁÒ¨Ò¡ line bot ¨Ò¡¹Ñé¹Êè§ÃÙ» ¡ÃÒ¿·ÕèµéÍ§¡ÒÃ ¡ÅÑºä»·Õè bot 
    
  */
//  echo 'Nutv99 ';

$LineIQToken=
  'ESNfupPazi/L0Ru9imhUXMKSa5EC1UvRotAEVQJ8TMu3sIepHfqpaC7tBtD7PGdz4cAuy/9unfldrgdTTLkIJz0COpUIzwQKdflBQA9atzdADjbmZNT49WkzqNMD6lc0RunPKxL1HFXFTIIdayeDEgdB04t89/1O/w1cDnyilFU=';
token = "EfFZH8Q3NZq6BUovs0TDHSCDCC8KMHSraCLSczapf6p"

//$access_token = $LineIQToken ;
$access_token = $token ;
echo 'Token = ' . $token ;
$content = file_get_contents('php://input');
// á»Å§à»ç¹ JSON
$events = json_decode($content, true);
if (!empty($events['events'])) {
    foreach ($events['events'] as $event) {
        if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
            // ¢éÍ¤ÇÒÁ·ÕèÊè§¡ÅÑº ÁÒ¨Ò¡ ¢éÍ¤ÇÒÁ·ÕèÊè§ÁÒ
            // ÃèÇÁ¡Ñº USER ID ¢Í§äÅ¹ì·ÕèàÃÒµéÍ§¡ÒÃãªéã¹¡ÒÃµÍº¡ÅÑº
            $messages = array(
                'type' => 'text',
                'text' => 'Reply message : '.$event['message']['text']."\nUser ID : ".$event['source']['userId'],
            );
            $post = json_encode(array(
                'replyToken' => $event['replyToken'],
                'messages' => array($messages),
            ));
            // URL ¢Í§ºÃÔ¡ÒÃ Replies ÊÓËÃÑº¡ÒÃµÍº¡ÅÑº´éÇÂ¢éÍ¤ÇÒÁÍÑµâ¹ÁÑµÔ
            $url = 'https://api.line.me/v2/bot/message/reply';
            $headers = array('Content-Type: application/json', 'Authorization: Bearer '.$access_token);
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            $result = curl_exec($ch);
            curl_close($ch);
            echo $result;
        }
    }
}


?>
