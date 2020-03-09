<?php

/**
 * Created by PhpStorm.
 * User: WILDcard
 * Date: 7/20/2018
 * Time: 10:40 AM
 */
require_once("initialize.php");
require_once(LIB_PATH.DS."config.php");
//require_once("../Lib/PHPMailer-master/src/Exception.php");
//require_once("../Lib/PHPMailer-master/src/PHPMailer.php");
//require_once("../Lib/PHPMailer-master/src/SMTP.php");

class Contact
{
    protected static $name;
    protected static $email;
    protected static $phone_no;
    protected static $subject;
    protected static $inquiry;
    protected static $date;

    public function __construct($name="", $email="", $phone_no="", $subject="", $inquiry="", $date="")
    {
        self::$name = $name;
        self::$email = $email;
        self::$phone_no = $phone_no;
        self::$subject  =$subject;
        self::$inquiry = $inquiry;
        self::$date = $date;

        if(self::insert_to_db())
        {
            if(self::send_mail()){ die(output_success_message("SUCCESS: YOUR INQUIRY WAS SUBMITTED, PLEASE EXPECT OUR REPLY")); }
        }
    }

    //checks o see if the values for the field are valid
    //return true | false
    protected static function validateFields(){
        $valid = false;
        if(!empty(self::$name)){
            //check if the name is not a number[0-9]
            if(preg_match("/[a-zA-Z]+/i", self::$name)){

                //check if email is empty
                if(!empty(self::$email)){
                    //check if email is valid
                    if(filter_var(self::$email, FILTER_VALIDATE_EMAIL)){

                        //check if the phone_no fields is empty
                        if(!empty(self::$phone_no)){
                            if(!preg_match("/^\+234[0-9]{10}/", self::$phone_no)){
                                die(output_err_message("ERROR: ONLY NUMBERS FROM NIGERIA ALLOWED"));
                            }
                        }

                        if(!empty(self::$subject)){
                            if(!empty(self::$inquiry)) $valid = true;

                            else die(output_err_message("ERROR: INQUIRY IS REQUIRED"));
                        }
                        else die(output_err_message("ERROR: SUBJECT IS REQUIRED"));
                    }
                }
                else die(output_err_message("ERROR: EMAIL IS REQUIRED"));
            }

            else die(output_err_message("ERROR: ONLY LETTERS[A-Z] ALLOWED"));
        }
        else die(output_err_message("ERROR: NAME IS REQUIRED"));

        return (bool)$valid;
    }


    protected static function send_mail(){
        $mail_sent = false;
        //use php_mailer class
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.sendgrid.net';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'aptech-web';                 // SMTP username
            $mail->Password = 'secretpassword123';                           // SMTP password
            /** Enable TLSy encryption, `ssl` also accepted */
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;                                    // TCP port to connect to
            $mail->WordWrap = 50;

            //Recipients
            $mail->setFrom(self::$email, strtoupper(self::$name));
            /** Add a recipient */
            $mail->addAddress("abelanico6@gmail.com");
            $mail->addBCC('admin@manogrove.com');
            $mail->addReplyTo(self::$email);

            //Content
            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = self::$subject;
            $mail->AltBody = self::$inquiry;

            if($mail->send()) $mail_sent = true;
        }
        catch(Exception $err){
            die(output_err_message("ERROR: $err"));
        }

        return (bool)$mail_sent;
    }

    //inserts into db table contact
    //returns true | false
    protected static function insert_to_db(){
        $rs = false;
        if(self::validateFields()){
            global $db;
            //check if the person has made a similar contact b/4
            $query = "SELECT * FROM contacts WHERE((name='".static::$name."' AND subject='".static::$subject."')";
            $query .= "OR(name='".static::$name."' AND inquiry='".static::$inquiry."'))";
            $rs = $db->query($query);
            if($db->num_rows($rs) >0){
                die(output_err_message("ERROR: YOU'VE SENT US A SIMILAR INQUIRY BEFORE"));
            }
            else {
                //run insert query here
                $query = "INSERT INTO contacts(name, phone_no,email,subject,inquiry,date_of_entry)";
                $query .= "VALUES('" . self::$name . "','" . self::$phone_no . "', '" . self::$email . "',";
                $query .= "'" . self::$subject . "', '" . self::$inquiry . "', '" . self::$date . "')";

                if ($db->query($query)) $rs = true;
            }
        }
        return (bool)$rs;
    }


    public static function getAllDbContacts(){
        global $db;
        $query = "SELECT * FROM contacts WHERE(msg_read=0) ORDER BY id DESC";
        $rs = $db->query($query);

        $rs_arr = [];
        if($db->num_rows($rs) >0){
            while($row = $db->fetch_array($rs)){
                $id = $row['id'];
                $name = $row['name'];
                $email = $row['email'];
                $subject = $row['subject'];
                $inquiry = $row['inquiry'];
                $dOe = $row['date_of_entry'];

                array_push($rs_arr, array(
                    "id"=>$id,
                    "name"=>$name,
                    "email"=>$email,
                    "subject"=>$subject,
                    "inquiry"=>$inquiry,
                    "dOe"=>$dOe
                ));
            }
        }
        return ($rs_arr==null) ? null : (Array)$rs_arr;
    }

    //returns void
    public static function mark_read_contact($contact_id=0){
        global $db;
        if(isset($contact_id)){
            $query = "UPDATE contacts SET msg_read =1 WHERE(id='{$contact_id}')";
            if($db->query($query)){
                die(output_success_message("SUCCESS: CONTACT INFO $contact_id READ"));
            }
        }
    }

}