<?php

class Emailer {

    public function send ($to, $from, $subject, $message, $attachment = null) {
        
        date_default_timezone_set("America/New_York");
        $mail = new Zend_Mail();
        $mail->addTo($to);
        $mail->setFrom($from);
        $mail->setSubject($subject);
        $mail->setBodyText($message);
        try {
            $rtn = $mail->send();
        } catch (Zend_Mail_Transport_Exception $e) {
            // Do something here, mail failed to send
            print "Mail send failed";
        }
    }



}

?>