<?php 

namespace RodrigoTutz\SendEmail;

use Exception;
use stdClass;
use PHPMailer\PHPMailer\PHPMailer;

class Mail {

    private $mail;
    private $data;
    private $error;

    public function __construct(){
        $this->mail = new PHPMailer(true);
        $this->data = new stdClass();

        $this->mail->isSMTP();
        $this->mail->isHTML();
        $this->mail->setLanguage('br');

        $this->mail->SMTPAuth = true;
        $this->mail->SMTPSecure = 'tls';
        $this->mail->CharSet = 'utf-8';

        $this->mail->Host = MAIL['host'];
        $this->mail->Port = MAIL['port'];
        $this->mail->Username = MAIL['user'];
        $this->mail->Password = MAIL['passwd'];
    }

    public function add($subject, $body, $recipient_name, $recipient_email) : Mail {
        $this->data->subject = $subject;
        $this->data->body = $body;
        $this->data->recipient_name = $recipient_name;
        $this->data->recipient_email = $recipient_email;

        return $this;
    }

    public function attach($filePath, $fileName){
        $this->data->attach[$filePath] = $fileName;
    }

    public function send($from_name = MAIL['from_name'], $from_email = MAIL['from_email']) : bool{

        try {

            $this->mail->Subject = $this->data->subject;
            $this->mail->msgHTML($this->data->body);
            $this->mail->addAddress( $from_email, $from_name);
            $this->mail->setFrom($this->data->recipient_email, $this->data->recipient_name);

            if(!empty($this->data->attach)){
                foreach($this->data->attach as $path => $name) {
                    $this->mail->addAttachment($path, $name);
                }
            }

            $this->mail->send();
            return true;

        }catch(Exception $exeception) {
            $this->error = $exeception;
            return false;
        }
    }

    public function error() : ? Exception {
        return $this->error;
    }
}