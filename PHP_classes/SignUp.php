<?php

/**
 * Created by PhpStorm.
 * User: WILDcard
 * Date: 1/7/2019
 * Time: 9:55 PM
 */
require_once("initialize.php");

final class SignUp
{

    /**
     * @var String
     * This field holds the randomly generated binHexadecimal String assigned to each user on the user for unique ID
    */
    private $binHexGenerator;
    /**
     * @var int
     * This field holds the int ID of the proposed user's role in the System
     * E.g:
     * 1 = 'artist'
     * 2 = 'blogger'
     * 3 = 'admin'
    */
    private $userRole;
    /**
     * @var String
     *This field holds the email of the registering user
    */
    private $userEmail;
    /**
     * @var String
     * This field holds the user's name
    */
    private $userName;
    /**
     * @var String
     * This field holds the user's password
     */
    private $password;
    /**
     * @var String
     * This field holds the user's musical style
     */
    private $musicalStyle;
    /**
     * @var String
     * This field holds the estimated data/time, the user became an artist
     */
    private $activeSince;
    /**
     * @var String
     * This field holds the date of entry, when the form was submitted
     */
    private $dateOfEntry;

    public function __construct($userEmail, $userName,$password,$musicalStyle,$activeSince)
    {
        //init binHexCode
        $this->binHexGenerator = bin2hex(openssl_random_pseudo_bytes(32));
        //init userRole
        $this->userRole = 1;
        //init date_of_entry
        $this->dateOfEntry = strip_zero_from_date(strftime("*%d-*%m-%Y, %H:%I:%S", time()));

        try{
            if($this->validateFields($userEmail,$userName,$password,$musicalStyle,$activeSince)){
                //init: userEmail,userName,password, musicalStyle, activeSince
                $this->userEmail = $userEmail;
                $this->userName = $userName;
                $this->password = $this->encryptPassword($password);
                $this->musicalStyle = $musicalStyle;
                $this->activeSince = $activeSince;
            }
        }
        catch(Exception $exception){
            echo output_err_message($exception->getMessage());
        }
    }//End of method __construct()

    public function __clone()
    {
        // TODO: Implement __clone() method.
        //init binHexCode
        $this->binHexGenerator = bin2hex(openssl_random_pseudo_bytes(32));
        //init userRole
        $this->userRole = 1;
    }//End __clone method

    /**
     * @param $userEmail | String
     * @param $userName | String
     * @param $musicalStyle | String
     * @param $password | String
     * @param $activeSince | String
     * @throws Exception
     * @return boolean
    */
    private function validateFields($userEmail, $userName,$password,$musicalStyle,$activeSince){
        $areFieldsValid = false;

        if( !(empty($userName) && empty($userEmail) && empty($password)
            && empty($musicalStyle) && empty($activeSince)) ){
            //validate Email
            if(filter_var($userEmail, FILTER_VALIDATE_EMAIL)){
                //validate password
                if(preg_match(PASSWORD_PATTERN, $password)){
                    $areFieldsValid = true;
                }
                else throw new Exception(
                    output_err_message("Password must contain at least 3
                               lowercase letters,1 number & 2 uppercase letters")
                );
            }
            else throw new Exception(
                output_err_message("Email format is wrong")
            );

        }
        else throw new Exception(
            output_err_message("All fields are required")
        );
        return (boolean)$areFieldsValid;
    }//End method validateFields()


    public static function activateAccount($token="", $user=""){
        global $db;
        if( !(empty($token) && empty($user)) ){
            $user = strtolower(base64_decode($user));
            //get the user's details from the DB
            $query1 = SEL_ALL." users WHERE(binHexCode='{$token}' AND username='{$user}')";
            $rs = $db->query($query1);
            if($rs){
                $row = $db->fetch_array($rs);
                $id = $row['id'];

                //update the required columns in users table: isBlocked, trial_basis_ends_on
                $trialStarts = static::convertNowToSeconds();
                $trialEnds = static::convertEndOfTrialToSeconds();
                $query2 = "UPDATE users SET isBlocked=1, trial_basis_starts_on='{$trialStarts}', ";
                $query2 .= "trial_basis_ends_on='{$trialEnds}' WHERE id='{$id}'";
                $rs = $db->query($query2);

                if($rs){
                    $date_of_entry = strip_zero_from_date(strftime("*%d-*%m-%Y, %H:%I:%S", time()));
                    //insert the user's profile image into DB table: profile_images
                    $query3 = INS." profile_images(user_id, img_sm_path, date_of_entry)";
                    $query3 .= "VALUES('{$id}', '../images/user_male.png', '{$date_of_entry}')";
                    $rs = $db->query($query3);

                    if($rs){
                        //create a public page for the user
                        static::createUserPublicPage($id);
                        $msg = base64_encode("Account is currently activated");
                        redirect_to("../php/login.php?msg={$msg}");
                    }
                }
            }
        }
        else redirect_to("../php/sign_up.php");
    }//End of method: activateAccount()

    /**
     * @param $user_id | int
     * Creates a public page for the user after confirming that they don't have one
    */
    private static function createUserPublicPage($user_id){
        global $db;
        //check to see if the user already has a public page
        $query1 = SEL_ALL." public_page_details WHERE(user_id='{$user_id}')";
        $rs = $db->query($query1);

        if($db->num_rows($rs) < 1){
            //create a public page for the user
            $query2 = INS." public_page_details(user_id)VALUES('{$user_id}')";
            $db->query($query2);
        }
    }//End of method: createUserPublicPage()

    private function encryptPassword($password=""){
        return (String)base64_encode("JinGo".$password."si ng aar");
    }//End of method encryptPassword()

    private function insertUserToDB(){
        global $db;
        //escape values for DB ops
        $this->userName = $db->escape_value($this->userName);
        $this->password = $db->row_exists($this->password);
        $this->userEmail = $db->escape_value($this->userEmail);
        $this->activeSince = $db->escape_value($this->activeSince);
        $this->musicalStyle = $db->escape_value($this->musicalStyle);
        $this->binHexGenerator = $db->escape_value($this->binHexGenerator);

        //insert into the db
        $query2 = INS." users(username,password, email, role, active_since, musical_style,";
        $query2 .= "binHexCode,date_of_entry)";
        $query2 .= "VALUES('{$this->userName}', '{$this->password}', '{$this->userEmail}',";
        $query2 .= "'{$this->userRole}', '{$this->activeSince}', '{$this->musicalStyle}',";
        $query2 .= "'{$this->binHexGenerator}', '{$this->dateOfEntry}')";

        //run sql query
        $rs = $db->query($query2);
        if($rs){
            output_success_message("Welcome to singaar.Check your email for your activation code");
        }
    }//End of method insertUserToDB()


    /**
     * @return String
     * This method will make a call to Mail::sendHtmlMail(), but only after validating the parameters
    */
    public function addUser(){
        global $db;
        $rs = "";
        try{
            if($this->validateFields($this->userEmail,$this->userName,$this->password,
                $this->musicalStyle,$this->activeSince)){

                //check to see if the user already exists
                $query1 = SEL_ALL." users WHERE (username='{$db->escape_value($this->userName)}' ";
                $query1 .= "OR password='{$db->escape_value($this->password)}' ";
                $query1 .="OR binHexCode='{$db->escape_value($this->binHexGenerator)}'";
                $query1 .= "OR email='{$db->escape_value($this->userEmail)}')";
                $rs1 = $db->query($query1);
                if($db->num_rows($rs1) > 0){
                    throw new Exception(
                        output_err_message("Username or password already in use")
                    );
                }
                else{
                    //user's first name to be used in salutation
                    $userFName = ucwords(explode(" ", $this->userName)[0]);
                    $encodeUsername = base64_encode($this->userName);

                    //link to activate account. Query string params: binHexCode & username
                    $activationLink = defaultEmailUrl("ajax_codes/activate_account.php");
                    $activationLink.="?token={$this->binHexGenerator}&user={$encodeUsername}";

                    //php: date("Y"). To be displayed in the footer of html message
                    $yr = date("Y");

                    $htmlBody = "<div style='background:#1565C0;width:100%;margin:0 auto;
box-shadow:0 2px 2px 0 rgba(0,0,0,0.14),
 0 1px 5px 0 rgba(0,0,0,0.12),
 0 3px 1px -2px rgba(0,0,0,0.2);
 color:#fff;padding:20px 10px;text-align:center;'>
    <span style='background:#1976D2;padding: 10px 20px;font-family: Forte;
    font-size:60px;border-radius:20px;'>
        Singaar
    </span>
    <nav style='width:100%;margin-top: 15px;background:#1976D2;padding:10px;box-sizing:border-box;'>
        <ul style=\"padding: 0;margin: 0;\">
            <li style='display: inline;list-style: none;padding-left:15px;'>
                <a href='http://localhost/singaar.com' style='color:#fff;font-family:arial, helvetica, sans-serif;
                text-decoration: none;font-size: 16px;'
                onmouseover=\"this.style.textDecoration='underline';\"
                   onmouseout=\"this.style.textDecoration='none';\">HOME</a>
            </li>
            <li style='display: inline;list-style: none;padding-left:15px;'>
                <a href='http://localhost/singaar.com/php/blog?cat=local'
                   style='color:#fff;font-family:arial, helvetica, sans-serif;
                text-decoration: none;font-size: 16px;'
                   onmouseover=\"this.style.textDecoration='underline';\"
                   onmouseout=\"this.style.textDecoration='none';\">BLOG</a>
            </li>
            <li style='display: inline;list-style: none;padding-left:15px;'>
                <a href='http://localhost/singaar.com/php/music'
                   style='color:#fff;font-family:arial, helvetica, sans-serif;
                text-decoration: none;font-size: 16px;'
                   onmouseover=\"this.style.textDecoration='underline';\"
                   onmouseout=\"this.style.textDecoration='none';\">MUSIC</a>
            </li>
        </ul>
    </nav>
    <div style='width:100%;margin-top:15px;background:#1976D2;padding:10px;
    display:block;box-sizing:border-box;font-family:arial, helvetica, sans-serif;
    font-size:18px;text-align:left;min-height:400px;'>
        <img src='../images/band-2179313_1920.jpg' style='width:100%;height:400px;color:#fff;' alt='Welcome image'/>
        <h5 style='font-weight: normal;font-size: 17px;'>Dear {$userFName},</h5>

        <article style='font-size:20px; !important;word-break:break-all;font-family:inherit'>
            <p style='font-family: arial, helvetica, sans-serif;font-size: 17px !important;'>
                Welcome to the singaar community. Please click the link below to activate your account
            </p>
            <p>
                <a style='background:#58ACA1;color:#fff;box-shadow:0 2px 2px 0 rgba(0,0,0,0.14),
 0 1px 5px 0 rgba(0,0,0,0.12),0 3px 1px -2px rgba(0,0,0,0.2);padding: 10px 12px; border: none;
 display: block;font-size: 18px;width:25%;text-decoration: none;text-align: center;
 font-family:arial, helvetica, sans-serif' href='{$activationLink}'>
                    Activate account
                </a>
            </p>
        </article>
        <h5 style='font-weight:normal;font-family:arial, helvetica, sans-serif;font-size: 17px;'>Thanks, the singaar team</h5>
    </div>
    <footer style='background:#1976D2;font-family:arial, helvetica, sans-serif;margin-top:12px;padding:8px;font-size:inherit;
    word-break:break-all;'>
        &copy;{$yr} Singaar. All rights reserved.
    </footer>
</div>";
                    $altBody = "Dear {$userFName},Welcome to the singaar community.";
                    $altBody .= "<a href='{$activationLink}'>Please click this link to activate your account</a>";

                    //check to see if the mail was sent
                    if(Mail::sendHtmlMail($this->userEmail, $this->userName, $htmlBody, $altBody,
                        'Activate your singaar account')){
                        $this->insertUserToDB();
                    }
                }
            }
        }
        catch(Exception $exception){
            echo output_err_message($exception->getMessage());
        }
        finally{
            return $rs;
        }
    }//End method insertUserIntoDB()



    /**
     * @return String
    */
    public function getBinHexGenerator(){
        return (String)$this->binHexGenerator;
    }//End method getBinHexGenerator()

    /**
     * @return String
     */
    public function getUserName(){
        return (String)$this->userName;
    }//End method getUserName()

    /**
     * @return String
     */
    public function getUserEmail(){
        return (String)$this->userEmail;
    }//End of method: getUserEmail()

    /**
     * @return String
     */
    public function getMusicalStyle(){
        return (String)$this->musicalStyle;
    }//End of method: getMusicalStyle()

    /**
     * @return String
     */
    public function getActiveDate(){
        return (String)$this->activeSince;
    }//End of method: getActiveDate()

    /**
     * @return String
     */
    public function getDateOfEntry(){
        return (String)$this->dateOfEntry;
    }//End of method: getDateOfEntry()

    public function getPassword(){
        return (String)$this->password;
    }//End of method: getPassword()

    public static function getEndOfTrialDate(){
        $date =  strftime("*%d-*%m-%Y, %H:%I:%S", strtotime("+3 months", time()));
        return strip_zero_from_date($date);
    }//End of method: getEndOfTrialDate()

    public static function convertEndOfTrialToSeconds(){
        return strtotime("+3 months", time());
    }//End of method: convertEndOfTrialToSeconds()

    public static function convertNowToSeconds(){
        return strtotime("now", time());
    }//End of method: convertNowToSeconds()

    /**
     * @param $trialEnd
     * @return boolean
    */
    public static function isTrialOver($trialEnd){
        return (static::convertNowToSeconds() > $trialEnd);
    }//End of method isTrialOver()

}//End class: SignUp