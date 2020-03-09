<?php

/**
 * Created by PhpStorm.
 * User: WILDcard
 * Date: 6/5/2018
 * Time: 8:05 PM
 */
require_once("initialize.php");
require_once(LIB_PATH.DS."database.php");

class User extends databaseobject
{
    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;

    public static function authenticate($username="", $password=""){
        global $database;
        $database->escape_value($username);
        $database->escape_value($password);

        $sql = "SELECT * FROM ".self::$table_name." WHERE(username='{$username}' AND password='{$password}') ";
        $sql .= "LIMIT 1";
        $result_array = self::find_by_sql($sql);
        return !empty($result_array) ? array_shift($result_array) : false;
    }

    public static function isActivated($username, $password){
        global $database;
        $database->escape_value($username);
        $database->escape_value($password);

        $sql = "SELECT * FROM ".self::$table_name." WHERE(username='{$username}' AND password='{$password}' ";
        $sql .= "AND isBlocked=1) LIMIT 1";
        $result_array = self::find_by_sql($sql);
        return !empty($result_array) ? array_shift($result_array) : false;
    }

    public function full_name(){
        return (isset($this->first_name, $this->last_name)) ? $this->first_name ." ". $this->last_name :  "";
    }

    /**
     * @param $user_id | int
     * @return array | null
     * This method gets all the users details from the DB
    */
    public static function getAllUserDetails($user_id=0){
        global $db;
        $result = [];
        $query = "SELECT *,profile_images.img_lg_path, profile_images.img_sm_path, profile_images.img_type FROM ";
        $query .= "users INNER JOIN profile_images on users.id = profile_images.user_id ";
        $query .= "WHERE(users.id='{$user_id}' AND users.isBlocked=1)";
        $query .=" LIMIT 1";
        $rs = $db->query($query);
        if($rs){
            if($db->num_rows($rs) >0){
                $row = $db->fetch_array($rs);
                array_push($result, array(
                    "id" => $row['id'],
                    "username" => $row['username'],
                    "password"=> $row['password'],
                    "email" => $row['email'],
                    "active_since" => $row['active_since'],
                    "musical_style" => $row['musical_style'],
                    "role" => $row['role'],
                    "isBlocked" => (int)$row['isBlocked'],
                    "date_of_entry" => $row['date_of_entry'],
                    "isTrialBasisOver" => (int)$row['isTrialBasisOver'],
                    "profile_imgLg" => $row['img_lg_path'],
                    "profile_imgSm" => $row['img_sm_path'],
                    "profile_imgType" => $row['img_type'],
                    "isActive"=>( ($row["isActive"] == 1) ? true: false)
                ));
            }
        }
        return ($result == null ? null : (Array)$result);
    }//End of method: getAllUserDetails()

    /**
     * @param $username
     * @param $password
     * @param $usernamePasswordList[]
     * @return boolean
    */
    public static function authenticateUsingArray( $username="", $password="", Array $usernamePasswordList=null ){
        $isMatchFound = false;
        if( !($usernamePasswordList==null) ){
            /**
             * array format: Array(
             *   0=>Array("username"=>"justin_bieber", "password"=>"rex4456"),
             *   1=>Array("username"=>"jim_reynolds", "password"=>"rex4456")
             * );
             */
            foreach($usernamePasswordList as $key=>$value){
                if( ($username == $value["username"] && $password == $value["password"]) ){
                    //if the above condition returns 'true', register the user's token & allow access
                    $isMatchFound = true;
                    break;
                }
            }
        }
        return (boolean)$isMatchFound;
    }

}