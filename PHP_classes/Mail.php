<?php

/**
 * Created by PhpStorm.
 * User: WILDcard
 * Date: 10/31/2018
 * Time: 8:14 PM
 */
//set namespaces
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once("initialize.php");

final class Mail
{
    /**
     * This field holds the name of the person sending the email
    */
    private $mailSenderName;
    /**
     * This field holds the subject of the email to be sent
    */
    private $mailSubject;
    /**
     * This field holds the body of the email to be sent
    */
    private $mailBody;

    public function __construct( $mailSenderName, $mailSubject, $mailBody )
    {
        $this->mailSenderName = $mailSenderName;
        $this->mailSubject = $mailSubject;
        $this->mailBody = $mailBody;
        /**
         * This next line sanitizes, the input fields entered by the user before inserting them into the DB
        */
        $this->cleanMessage( $this->mailSenderName, $this->mailSubject, $this->mailBody );
        /**
         * send the email-to the blog owners mailBox
         */
        $this->sendNormalMail( $this->mailSenderName, $this->mailSubject, $this->mailBody );
    }//End of __constructor()

    public function __clone()
    {
        // TODO: Implement __clone() method.
        /**
         * This next line sanitizes, the input fields entered by the user before inserting them into the DB
         */
        $this->cleanMessage( $this->mailSenderName, $this->mailSubject, $this->mailBody );
        /**
         * send the email-to the blog owners mailBox
         */
        $this->sendNormalMail( $this->mailSenderName, $this->mailSubject, $this->mailBody );
    }//End of method __clone()

    /**
     * @param $mailSubject
     * @param $mailBody
     * @param $mailSenderName
     * This method sanitizes the data to be sent as mail
    */
    private function cleanMessage( $mailSenderName, $mailSubject, $mailBody ){
        sanitize($mailSubject);
        sanitize($mailSenderName);
        sanitize($mailBody);
    }

    /**
     * @param $mailSubject
     * @param $mailBody
     * @param $mailSender
     * This method sends the email to the Blog owner
    */
    private function sendNormalMail($mailSender="", $mailSubject="",$mailBody){
        $composedMessage = "Mail From: ".strtoupper($mailSender)."\n.Sent from your blog.\n".$mailBody;
        mail("abelanico6@gmail.com", $mailSubject, $composedMessage);//sends the mail to the user
    }//End of method sendNormalMail()

    /**
     * @param $senderEmail
     * @param $sendName
     * @param $receiversMail
     * This method sends an email using sendMail or any other 3rd part service
     * Is formats the mail and send both a html message & a non-html message
    */
    public static function sendFormattedMail( $senderEmail, $sendName, $receiversMail ){

    }//End of method sendFormattedMessage()

    /**
     * @return String
    */
    public function __toString()
    {
        // TODO: Implement __toString() method.
        $returnString = "Mail From: "
            .strtoupper($this->mailSenderName)."\nMail Subject: ".$this->mailBody."\nMail Body: ".$this->mailBody;
        return (String)$returnString;
    }

    /**
     * @param $userEmail | String
     * @param $userName | String
     * @param $htmlMailBody | String
     * @param $altMailBody | String
     * @param $subject | String
     * @return boolean
     * @throws Exception
     * This method sends activation messages to users using phpMailer
    */
    public static function sendHtmlMail($userEmail, $userName, $htmlMailBody, $altMailBody, $subject=""){
        $rs = false;
        $mail = new PHPMailer(true);
        try{
            if(filter_var($userEmail, FILTER_VALIDATE_EMAIL)){
                //Server settings
                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = 'smtp.mailgun.org';  // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = 'abelanico6@gmail.com';                 // SMTP username
                $mail->Password = 'IamMax%&';                           // SMTP password
                /** Enable TLSy encryption, `ssl` also accepted */
                $mail->SMTPSecure = 'ssl';
                $mail->Port = 587;                                    // TCP port to connect to
                $mail->WordWrap = 50;

                //Recipients
                $mail->From = "admin@singaar.com";
                $mail->FromName = "Singaar.com";
                /** Add a recipient */
                $mail->addAddress($userEmail, ucwords($userName));
                $mail->addBCC('admin@singaar.com');

                //Content
                $mail->isHTML(true); // Set email format to HTML
                $mail->Subject = $subject;
                $mail->Body    = $htmlMailBody;
                $mail->AltBody = $altMailBody;

                if($mail->send()){
                    $rs =  true;
                }
                else echo "Mailer Error: {$mail->ErrorInfo}";
            }
            else throw new Exception(
                output_err_message("Invalid Email address")
            );
        }
        catch(Exception $exception){
            echo $exception->getMessage();
        }
        finally{
            return $rs;
        }
    }//End of method sendHtmlMail()

}//End of class Mail