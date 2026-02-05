<?php
session_start();

if(isset($_POST['g-recaptcha-response'])){
$token = $_POST['g-recaptcha-response'];
$url = 'https://www.google.com/recaptcha/api/siteverify';
$data = array(
'secret' => '6Lcv_losAAAAALgmId0ujnWyFEzApB_LYkdkIALq',
'response' => $token
);
$options = array(
'http' => array (

'header' => "Content-Type: application/x-www-form-urlencoded\r\n",

'method' => 'POST',
'content' => http_build_query($data)
)
);

$context = stream_context_create($options);
$result = file_get_contents($url, false, $context);
$response = json_decode($result);
/*
- google response score is between 0.0 to 1.0
- if score is 0.5, it's a human
- if score is 0.0, it's a bot
- google recommend to use score 0.5 for verify human
*/
if ($response->success && $response->score >= 0.5) {
//Le test est réussi, on peut inscrire la personne si le
pseudo et le mot de passe sont bons

var_dump(array('success' => true, "msg"=>"You are not a robot!",

"response"=>$response));
}else{
/*
* if score is less than 0.5, you can do following things

* login => With low scores, require 2-factor-authentica-
tion or email

verification to prevent credential stuffing attacks.

* social => With low scores, require additional verifica-
tion steps, such as a

CAPTCHA or email verification.
* - Limit unanswered friend requests from abusive users and
send risky
comments to moderation.

* e-commerce => Put your real sales ahead of bots and identi-
fy risky

transactions.
* */
var_dump(array('success' => false, "msg"=>"You are a robot!",
"response"=>$response));
}
}
?>