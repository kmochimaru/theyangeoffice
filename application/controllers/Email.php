<?php
 
class Email extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('mail');
    }

    public function index() {
        $email = "john.doe@example.com";
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo("$email<br>is a valid email address");
        } else {
            echo("$email<br>is not a valid email address");
        }
    }

    public function sendemail() {
        $email = filter_var($this->input->post('email'), FILTER_SANITIZE_EMAIL);
        $title = $this->input->post('title');
        $content = $this->input->post('content');
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $data = array(
                'news_title' => $title,
                'news_content' => $content,
            );
            $content = $this->load->view('ajax/email_create', $data, true);
            $setting_email = $this->accesscontrol->getMailConfig();
            $mail = $this->mail;
            $mail->CharSet = "utf-8";
            $mail->isSMTP();
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            $mail->SMTPDebug = 0;
            $mail->Debugoutput = 'html';
            $mail->Host = $setting_email->smtp_host;
            $mail->Port = $setting_email->smtp_port;
            $mail->SMTPSecure = $setting_email->smtp_secure;
            $mail->SMTPAuth = true;
            $mail->Username = $setting_email->smtp_user;
            $mail->Password = $setting_email->smtp_password;
            $mail->setFrom($setting_email->from_email, $setting_email->from_name);
            $mail->addAddress($email);
            $mail->Subject = $title;
            $mail->msgHTML($content);
            if (!$mail->send()) {
                //echo '0';
            } else {
                $mail->ClearAllRecipients();
                $mail->ClearAttachments();
                //echo '1';
            }
        } else {
            //echo '0';
        }
    }

}
