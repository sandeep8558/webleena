<?php

namespace Core;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mail {

    public $config;
    public $mail;

    function __construct() {

        /* Pass config file array to config variable */
        $this->config = require("../Config/mail.config.php");

        /* Configure PHPMailer */
        $this->configure();

    }

    public function configure(){
        
        $this->mail = new PHPMailer(true);

        $this->mail->isSMTP();
        $this->mail->Host = $this->config['HOST'];
        $this->mail->SMTPAuth = true;
        $this->mail->Username = $this->config['USERNAME'];
        $this->mail->Password = $this->config['PASSWORD'];
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $this->mail->Port = $this->config['PORT'];

        $this->debug();
        $this->html();
        $this->replyTo();
        $this->sender();
    }

    public function debug($is = false){
        if($is) {
            $this->mail->SMTPDebug = SMTP::DEBUG_SERVER;
        }
    }

    public function html($is = true){
        $this->mail->isHTML($is);
    }

    public function replyTo($email = null,  $name = null){
        $email = isset($email) ? $email : $this->config["REPLY_TO"];
        $name = isset($name) ? $name : $this->config["REPLY_TO_NAME"];
        $this->mail->addReplyTo($email, $name);
    }

    public function sender($email = null,  $name = null){
        $email = isset($email) ? $email : $this->config["FROM"];
        $name = isset($name) ? $name : $this->config["FROM_NAME"];
        $this->mail->setFrom($email, $name);
    }

    public function cc($cc = ''){
        $ccs = explode(",", $cc);
        foreach($ccs as $c){
            $this->mail->addCC($c);
        }
    }

    public function bcc($bcc = ''){
        $bccs = explode(",", $bcc);
        foreach($bccs as $b){
            $this->mail->addBCC($b);
        }
    }

    public function altBody($AltBody ){
        $this->mail->AltBody = $AltBody ;
    }

    private function to($to){
        $tos = explode(",", $to);
        foreach($tos as $t){
            $this->mail->addAddress($t);
        }
    }

    public function send($to, $subject, $body){
        $this->to($to);
        $this->mail->Subject = $subject;
        $this->mail->Body = $body;
        $this->mail->send();
        return json_encode(['message' => 'Message has been sent']);
    }

}