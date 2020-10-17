<?php 

$msg = $_POST['postmsg'];

$chatbot = exec("python chatbot.py $msg");
echo $chatbot;

?>