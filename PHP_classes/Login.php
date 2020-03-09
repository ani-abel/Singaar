<?php

/**
 * Created by PhpStorm.
 * User: WILDcard
 * Date: 1/9/2019
 * Time: 12:09 AM
 */
require_once("initialize.php");

final class Login extends DatabaseObject
{

    /**
     * @param $isPasswordRemembered | boolean
     * @param $username
     * @param $password
     * @throws Exception
     * List of standout $_SESSION variables are:
     * @var $_SESSION['user_id']
     * @var $_SESSION['role']
     * @var $_SESSION['temp_token'](Optional):
     * Used only when the user defaults on their payments. It blocks all access to a user's public page.
     * But it also allows the user to only open the payment page on their user account
    */
    public static function logUser($username, $password, $isPasswordRemembered = false){
        try{
            //make sure the user exists
            global $session;
            $password = static::encryptPassword($password);
            //see if user exists in the DB table users
            $found_user = User::authenticate($username, $password);
            if($found_user){
                if(User::isActivated($username, $password)){
                    $session->login($found_user);
                    //get id, role, username, password
                    $userDetails = static::getAllUserFields($username, $password)[0];
                    $user_id = $userDetails["id"];//set the users id here
                    $user_role = $userDetails["role"];
                    $trialEnds = $userDetails["trial_basis_ends_on"];
                    //email of the user(will be displayed only on the side-bar)
                    $_SESSION['email'] = $userDetails["email"];
                    //set the users id here, will be used as an anchor point throughout the portal area
                    $_SESSION['user_id'] = $user_id;


                    switch($user_role){
                        case 1:
                            //set the session variables here for role
                            $_SESSION['role'] = "artist";
                            //check to see if the trial period is over
                            if(SignUp::isTrialOver($trialEnds)){

                                if(static::isPaymentPeriodOver($user_id)){
                                    /**
                                     * payment period is over.
                                     * Grant temporary token(only accesses the payment page)
                                     * Switch off the visibility of the user's public page
                                     * Block user in the DB table users(isBlocked=0)
                                     */
                                    $_SESSION['temp_token'] = "payment only";
                                    if(static::blockUser($user_id)){//Block the user(for defaulting on payment)
                                        if(static::turnPublicPageVisibilityOff($user_id))
                                            die("payment only");
                                    }
                                }
                                else {
                                    //set cookies for remember me
                                    static::setCookies($username, $password, $user_role, $isPasswordRemembered);
                                    goto default_statement;
                                }
                            }
                            else{
                                //set cookies for remember me
                                static::setCookies($username, $password, $user_role, $isPasswordRemembered);
                                default_statement:die("artist user");
                            }

                            break;

                        case 2:
                            //set the session variables here for role
                            $_SESSION['role'] = "blogger";
                            //set cookies for remember me
                            if($isPasswordRemembered){
                                static::setCookies($username, $password, $user_role, $isPasswordRemembered);
                            }
                            die("blogger user");
                            break;

                        case 3:
                            //set the session variables here for role
                            $_SESSION['role'] = "admin";
                            //set cookies for remember me
                            static::setCookies($username, $password, $user_role, $isPasswordRemembered);
                            die("admin user");//set a text by-which ajax knows which pages to route the user to
                            break;
                    }//End of switch
                }
                else throw new Exception(
                    output_err_message("Please activate your account")
                );
            }
            else throw new Exception(
                output_err_message("Wrong user credentials")
            );
        }
        catch(Exception $exception){
            echo $exception->getMessage();
        }
    }//End of method logUser()


    public static function sendPasswordToMail($email=""){
        global $db;
        $rs = $db->query(SEL_ALL.static::$table_name." WHERE(email='{$email}')");

        //check to see if the email exists in the users table
        if($db->num_rows($rs) > 0){
            $row = $db->fetch_array($rs);//get a result set from the DB
            $username = $row['username'];
            $password = static::clearUpPassword($row['password']);

            //get the email body ready
            $yr = date("Y");
            $userfName = ucfirst(explode(" ",$username)[0]);
            $htmlBody = "<div style='background:#1565C0;width:70%;margin:0 auto;
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
                <a href='http://localhost/singaar.com/php/blog'
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
        <h5 style='font-weight: normal;font-size: 17px;'>Dear {$userfName},</h5>

        <article style='font-size:20px; !important;word-break:break-all;font-family:inherit'>
            <p style='font-family: arial, helvetica, sans-serif;font-size: 17px !important;'>
                Your user credentials are:<br>
                <ul>
                    <li style='font-size:15px !important;font-family: arial, helvetica, sans-serif !important;
                    padding-bottom: 10px;list-style: none;'>USERNAME: {$username}</li>
                    <li style='font-family: arial, helvetica, sans-serif;font-size: 15px;
                    padding-bottom: 10px;list-style: none;'>PASSWORD: {$password}</li>
                </ul>
            </p>
            <p style='font-family: arial, helvetica, sans-serif;font-size: 17px !important;'>
                Please protect your credentials in the future.
            </p>
        </article>
        <h5 style='font-weight:normal;font-family:arial, helvetica, sans-serif;font-size: 17px;'>Thanks, the singaar team</h5>
    </div>
    <footer style='background:#1976D2;font-family:arial, helvetica, sans-serif;margin-top:12px;padding:8px;font-size:inherit;
    word-break:break-all;'>
        &copy;{$yr} Singaar. All rights reserved.
    </footer>
</div>";
            $altBody = "Your user details are:\n\nUSERNAME:{$username}\nPASSWORD:{$password}";
            //send the mail with recovered credentials to the user's mail inbox
            if(Mail::sendHtmlMail($email,$username,$htmlBody,$altBody,"Recover password")){
                die(
                output_success_message("Check your mailbox for your login credentials")
                );
            }
            else die(
                output_err_message("Oops...the system seems slow. Try again later")
            );

        }
        else throw new Exception(
            output_err_message("This isn't your registered email")
        );
        //get the user's ID

    }//End method sendPasswordToMail

    /**
     * @param $password
     * @return String
     * Clear the salted characters from the front & back of the password
    */
    public static function clearUpPassword($password){
        $salt = base64_decode($password);
        $salt1= decodePassword($salt);
        $salt2 = decodeLastPart($salt1);
        $r =  base64_decode($salt2);
        $r= preg_replace("/^JinGo/","",$r);
        $r =preg_replace("/si ng aar$/","",$r);
        return (String)$r;
    }//End of method: clearUpPassword()

    /**
     * @param $password | String
     * @return String
    */
    public static function encryptPassword($password){
        $password = "JinGo".$password."si ng aar";
        return base64_encode($password);
    }

    private static function setCookies($username="", $password="", $role="", $isRemembered=false){
        if($isRemembered){
            setcookie("singaar_uName", base64_encode($username), time()+(60*60*24*365),"/");
            setcookie("singaar_uPass", static::encryptPassword($password),
                time()+(60*60*24*365),"/");
            setcookie("singaar_uRole", base64_encode($role), time()+(60*60*24*365),"/");
        }
        else{
            setcookie("singaar_uName", base64_encode($username), time()-(60*60*24*365),"/");
            setcookie("singaar_uPass", static::encryptPassword($password),
                time()-(60*60*24*365),"/");
            setcookie("singaar_uRole", base64_encode($role), time()-(60*60*24*365),"/");
        }

    }//End method setCookies()

    /**
     * @param $username | String
     * @param $password | String
     * @return array | null
     */
    public static function getAllUserFields($username="", $password=""){
        global $db;
        $rs_array = [];
        $db->escape_value($username);
        $db->escape_value($password);
        $query = SEL_ALL." users WHERE (username='{$username}' AND password='{$password}' AND isBlocked=1) LIMIT 1";
        $rs = $db->query($query);
        if($db->num_rows($rs) > 0){
            //fetch fields from DB
            $row = $db->fetch_array($rs);

            array_push($rs_array, array(
                    "id" => $row['id'],
                    "username" => $row['username'],
                    "role" => $row['role'],
                    "email" => $row['email'],
                    "date_of_entry" => $row['date_of_entry'],
                    "trial_basis_starts_on" => $row['trial_basis_starts_on'],
                    "trial_basis_ends_on" => $row['trial_basis_ends_on']
                )
            );
        }

        return ( !($rs_array==null) ? (Array)$rs_array : null);
    }//End of method getAllUserFields()

    /**
     * @param $user_id | int
     * @return boolean
    */
    public static function isPaymentPeriodOver($user_id = 0){
        global $db;
        $result = false;
        $db->escape_value($user_id);
        $query = SEL_ALL." payments WHERE(user_id='{$user_id}') ORDER BY p_id DESC LIMIT 1";
        $rs = $db->query($query);
        $row = $db->fetch_array($rs);
        $payment_ends_on = $row["payment_ends_on"];

        //check to see if the payment period(6 months) has expired
        if(SignUp::isTrialOver($payment_ends_on))
            $result = true;
        return (boolean)$result;
    }//End of method: checkForLatestPayment()

    private static function turnPublicPageVisibilityOff($user_id=0){
        global $db;
        $result = false;
        $query = "UPDATE public_page_details SET isPublic=0 WHERE(user_id='{$user_id}')";
        if($db->query($query))
            $result = !$result;
        return (boolean)$result;
    }

    public static function blockUser($user_id){
        global $db;
        $query = "UPDATE users SET isBlocked=0 WHERE id='{$user_id}'";
        $rs = $db->query($query);
        return ($rs ? true: false);
    }

}//End of class Login()