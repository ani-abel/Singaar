<?php

/**
 * Created by PhpStorm.
 * User: WILDcard
 * Date: 2/17/2019
 * Time: 7:22 AM
 */
require_once("../PHP_classes/initialize.php");

final class Artists
{

    public static function getMessagesFromSingaar(){
        global $db;
        global $session;
        $rs_arr = [];
        $query = SEL_ALL." message_to_artists WHERE(msg_to='{$session->user_id}')";
        $query .= "ORDER BY msg_id DESC";
        $rs = $db->query($query);
        if($rs && $db->num_rows($rs) > 0){
            while($row = $db->fetch_array($rs)){
                array_push($rs_arr, array(
                    "msg_id"=>$row["msg_id"],
                    "msg_title"=>$row["msg_title"],
                    "msg"=>$row["msg"],
                    "date_of_entry"=>dateToString($row["date_of_entry"])
                ));
            }
        }
        return ($rs_arr == null) ? null : $rs_arr;
    }//End of method: getMessagesFromSingaar()

    public static function deleteMessageFromSingaar($msg_id=0){
        global $db;
        $query = "DELETE FROM message_to_artists WHERE(msg_id='{$msg_id}')";
        $rs = $db->query($query);
        if($rs){
            die(
                output_success_message("Message deleted")
            );
        }
    }//End of method: deleteMessageFromSingaar()

    public static function makeComplaintToSingaar($complaint_title="", $complaint_body=""){
        global $db;
        global $session;
        $msg_from = $session->user_id;
        $date_of_entry = time();
        $complaint_title = $db->escape_value($complaint_title);
        $complaint_body = $db->escape_value($complaint_body);
        $query = INS." customer_care(msg_from, msg_title, msg, date_of_entry)";
        $query .= "VALUES('{$msg_from}', '{$complaint_title}', '{$complaint_body}','{$date_of_entry}')";
        $rs = $db->query($query);
        if($rs)
            die(
                output_success_message("Complaint made")
            );
    }//End of method: makeComplaintToSingaar()

    public static function getAllComplaints(){
        global $db;
        global $session;
        $rs_arr = [];
        $query = SEL_ALL." customer_care WHERE(msg_from='{$session->user_id}') ORDER BY msg_id DESC";
        $rs = $db->query($query);
        if($rs && $db->num_rows($rs) > 0){
            while($row = $db->fetch_array($rs)){
                array_push($rs_arr, array(
                    "msg_id"=>$row["msg_id"],
                    "msg_title"=>$row["msg_title"],
                    "msg"=>$row["msg"],
                    "no_of_replies"=>$row["no_of_replies"],
                    "date_of_entry"=>dateToString($row["date_of_entry"])
                ));
            }
        }
        return ($rs_arr == null) ? null : $rs_arr;
    }//End of method: getAllComplaints()

    public static function getAllRepliesToComplaints($msg_id=0){
        global $db;
        $rs_arr = [];
        $query = SEL_ALL." c_c_replies WHERE(reply_to='{$msg_id}') ORDER BY reply_id DESC";
        $rs = $db->query($query);
        if($rs && $db->num_rows($rs) > 0){
            while($row = $db->fetch_array($rs)){
                array_push($rs_arr, array(
                    "reply_id"=>$row["reply_id"],
                    "reply"=>$row["reply"],
                    "date_of_entry"=>dateToString($row["date_of_entry"])
                ));
            }
        }
        return ($rs_arr == null) ? null : $rs_arr;
    }//End of method: getAllRepliesToComplaints()

    public static function deleteAComplaint($complaint_id=0){
        global $db;
        $query = "DELETE FROM customer_care WHERE(msg_id='{$complaint_id}')";
        $query2 = "DELETE FROM c_c_replies WHERE(reply_to='{$complaint_id}')";
        $rs1 = $db->query($query);
        $rs2 = $db->query($query2);

        if($rs1 && $rs2){
            die(
                output_success_message("Complaint deleted")
            );
        }
    }//End of method: deleteAComplaint()

    public static function countAllArtistVideos(){
        global $db, $session;
        $result = 0;
        $query = SEL_ALL." videos WHERE(uploaded_by='{$session->user_id}')";
        $rs = $db->query($query);
        if($rs)
            $result = $db->num_rows($rs);
        return (int)$result;
    }//End of method: countAllArtistVideos()

    public static function editProfile($username, $email, $password, $musical_style, Array $profile_img=null){
        global $db, $session;

        if( isset($username, $password, $email, $musical_style) ){
            if( filter_var($email, FILTER_VALIDATE_EMAIL) ){//validate email
                if(preg_match(PASSWORD_PATTERN, $password)) {//check if password matches the chosen pattern
                    $password = Login::encryptPassword($password);
                    $username = $db->escape_value($username);
                    $password = $db->escape_value($password);
                    $email = $db->escape_value($email);
                    $profile_imgLg = getCurrentProfileImage()["img_lg"];
                    $profile_imgSm = getCurrentProfileImage()["img_sm"];
                    $img_size = 0;
                    $img_type = "png";

                    if( !($profile_img==null && empty($profile_img["name"])) ){
                        $img_size = (!empty($profile_img["size"]) ? $profile_img["size"] : 0);
                        $img_type = (!empty($profile_img["type"]) ?
                            strtolower(end(explode("/", $profile_img["type"]))) : "png");
                        $default_image_types = array(
                            "image/jpg",
                            "image/png",
                            "image/gif",
                            "image/jpeg",
                        );
                        $images_array = Mk_Uploads::uploadImage($profile_img, $default_image_types,
                            1000000,100,100, true);
                        $profile_imgLg = (!$images_array == null || count($images_array) > 0)
                            ? $images_array[0] : $profile_imgLg;
                        $profile_imgSm = (!$images_array == null || count($images_array) > 0) ?
                            @($images_array[1] == null ? " " : $images_array[1]) : $profile_imgSm;
                    }
                    deleteOlderProfileImage($profile_img);//delete any older 'profile pictures' the user had

                    $query = "UPDATE users SET username='{$username}', password='{$password}',";
                    $query .= "email='{$email}', musical_style='{$musical_style}' WHERE(id='{$session->user_id}')";
                    $rs = $db->query($query);

                    $query2 = "UPDATE profile_images SET img_lg_path='{$profile_imgLg}', img_sm_path='{$profile_imgSm}',";
                    $query2 .= "img_size='{$img_size}', img_type='{$img_type}' WHERE user_id='{$session->user_id}'";
                    $rs2 = $db->query($query2);

                    if($rs && $rs2)
                        die(
                        output_success_message("Profile info has been changed")
                        );
                }
                else throw new Exception(
                    die(
                    output_err_message("Password must contain at least 3
                               lowercase letters,1 number & 2 uppercase letters")
                    )
                );
            }
            else throw new Exception(
                die(
                    output_err_message("Invalid email address")
                )
            );
        }
    }//End of method: editProfile()

    public static function countAllArtistAudios(){
        global $db, $session;
        $result = 0;
        $query = SEL_ALL." audios WHERE(uploaded_by='{$session->user_id}')";
        $rs = $db->query($query);
        if($rs){ $result = $db->num_rows($rs); }
        return (int)$result;
    }//End of method: countAllArtistAudios()

    //@Todo: 12 months, godaddy rate: #30,280.68

    public static function getPublicPageDetails(){
        global $db, $session;
        $rs_arr = [];
        $query = SEL_ALL." public_page_details WHERE(user_id='{$session->user_id}') ORDER BY id DESC LIMIT 1";
        $rs = $db->query($query);
        if($rs)
            array_push($rs_arr, $db->fetch_array($rs));
        return ($rs_arr == null) ? null : $rs_arr;
    }

    public static function managePublicPage($isVisible=1, $public_profile="",
                                            $fb_page="", $twitter_handle="", $instagram_page="", $whatsapp_numbers=""){
        global $db, $session;
        $public_profile = $db->escape_value($public_profile);
        $fb_page = addHttpWwwToDL($fb_page);
        $fb_page = $db->escape_value($fb_page);
        $whatsapp_numbers = $db->escape_value($whatsapp_numbers);
        $twitter_handle = $db->escape_value($twitter_handle);
        $instagram_page = $db->escape_value($instagram_page);
        $isVisible = (int)$isVisible;

        if(!empty($twitter_handle))
            $twitter_handle =(preg_match("/^\@/i", $twitter_handle) ? $db->escape_value($twitter_handle):die(
                output_err_message("Twitter handle must begin with an @sign")
            ));

        if(!empty($instagram_page))
            $instagram_page =(preg_match("/^\@/i", $instagram_page) ? $db->escape_value($instagram_page):die(
            output_err_message("Instagram handle must begin with an @sign")
            ));

        if(!empty($fb_page))
            $fb_page = (filter_var($fb_page, FILTER_VALIDATE_URL) ? addHttpWwwToDL($fb_page) : die(
                output_err_message("Invalid facebook url")
            ));

        $query1 = "UPDATE public_page_details SET profile_text='{$public_profile}',fb_link='{$fb_page}',";
        $query1 .= "twitter_link='{$twitter_handle}',instagram_page='{$instagram_page}',isPublic='{$isVisible}',";
        $query1 .= "whatsapp_numbers='{$whatsapp_numbers}' WHERE(user_id='{$session->user_id}')";

        $query2 = INS." public_page_details(user_id, profile_text, fb_link, twitter_link, instagram_page, ";
        $query2 .= "whatsapp_numbers, isPublic) VALUES('{$session->user_id}', '{$public_profile}', '{$fb_page}',";
        $query2 .= "'{$twitter_handle}','{$instagram_page}','{$whatsapp_numbers}','{$isVisible}')";

        $query = (static::isAPublicPageFound() ? $query1 : $query2);
        $rs = $db->query($query);

        if($rs)
            die(
                output_success_message("Settings updated")
            );

    }//End of method: managePublicPage()

    private static function isAPublicPageFound(){
        global $db, $session;
        $result = false;
        $query = SEL_ALL." public_page_details WHERE(user_id='{$session->user_id}')";
        $query .= "ORDER BY id DESC LIMIT 1";
        $rs = $db->query($query);
        if($rs && $db->num_rows($rs) >0)
            $result = true;
        return (boolean)$result;
    }//End of method: isAPublicPageFound()

    private static function uploadAudioFile(Array $audio_file, $audio_title){
        global $default_audio_type_list;
        $audio_size = $audio_file["size"];
        $audio_type = $audio_file["type"];
        $path = "";

        if( in_array($audio_type, $default_audio_type_list) ){
            //check the file size
            if( ($audio_size < 5000000) ){
                //convert audio file to mp4
                $path = convertAudioToMp4Video($audio_file, $audio_title);
                if( (filesize($path) > (3000000 /2)) ){//if audio file > 1.5mb, then compress the file
                    //@TODO: Find a way to compress audio files here
                    $path = compressAudioFile($path, $audio_title);
                }
            }
            else die(
                output_err_message("Song exceeds 5mb")
            );
        }
        else die(
            output_err_message("Invalid file type.Only 'wav','aac','mp3','m4a' are valid")
        );

        return (String)$path;
    }//End of method: uploadAudioFile()

    public static function uploadAudioDetailsToSingaar($audio_title, $audio_desc, Array $audio_file){
        global $db;
        try{
            if( !(empty($audio_title) && empty($audio_desc) && empty($audio_file["name"])) ){
                $audio_title = $db->escape_value($audio_title);
                $audio_desc = $db->escape_value($audio_desc);
                $audio_tags = static::createTags($audio_title, $audio_desc);//generate tags for the song

                //check to see if a similar song exists to avoid piracy
                if( !static::similarSongFound($audio_title, $audio_desc) ){
                    $audio_path = static::uploadAudioFile($audio_file, $audio_title);//convert file to mp3 and upload
                    static::insertSongToDb($audio_title, $audio_path, $audio_tags, $audio_desc);//add song's details to db
                }
                else throw new Exception(
                    die(
                        output_err_message("A song with a similar name was found.")
                    )
                );
            }
            else throw new Exception(
                die(
                    output_err_message("All fields are required")
                )
            );
        }
        catch(Exception $exception){
            die(
                $exception->getMessage()
            );
        }
    }//End of method: uploadAudioDetailsToSingaar()

    private static function similarSongFound($audio_title, $audio_desc){
        global $db, $session;
        $result = false;
        $query1 = SEL_ALL." audios WHERE(uploaded_by='{$session->user_id}' AND ";
        $query1 .= "(a_name='{$audio_title}' OR a_description='{$audio_desc}'))";
        $rs = $db->query($query1);

        if($rs){
            if($db->num_rows($rs) > 0)
                $result = true;
        }
        return $result;
    }//End of method: similarSongFound()

    private static function insertSongToDb($a_name, $a_path, $a_tags, $a_desc){
        global $db, $session;
        $date_of_entry = time();
        $query = INS." audios(a_name, a_path, a_tags, a_description, uploaded_by, date_of_entry)";
        $query .= "VALUES('{$a_name}', '{$a_path}', '{$a_tags}', '{$a_desc}', '{$session->user_id}', '{$date_of_entry}')";
        $rs = $db->query($query);
        if($rs)
            die(
                output_success_message("Upload complete")
            );
    }//End of method: insertSongToDb()

    private static function uploadVideoFile(Array $video_file, $video_title){
        global $session, $default_video_types;
        $video_type = $video_file["type"];
        $video_size = $video_file["size"];
        $path = "";

        if( in_array($video_type, $default_video_types) ){
            if( ($video_size < 15000000) ){//allow a grace of 15mb so files can be compressed
                if( (getFileExtension($video_type) == "mp4") ){
                    //move the file normally
                    $generated_title = createAFileNAmeBasedOnTitle($video_title)."__v_{$session->user_id}.mp4";
                    $path = "../uploads/videos/{$generated_title}";
                    move_uploaded_file($video_file["tmp_name"], $path);
                }
                else $path = convertVideoToMp4($video_file, $video_title); //convert the video to mp4

                if( (filesize($path) > 8000000) ){//if file size > 8mb compress file
                    //compress the video file and return the new path to @var: $path
                    $path = compressVideoFile($path, $video_title);
                }
            }
            else die(
                output_err_message("Video exceeds 15mb")
            );
        }
        else die(
            output_err_message("Invalid file type.Only 'mp4','flv','ogg','mkv' are valid")
        );

        return (String)$path;
    }//End of method: uploadVideoFile()

    public static function uploadVideoDetailsToSingaar($video_title="", $video_desc="", Array $video){
        global $db;
        try{
            $video_title = $db->escape_value($video_title);
            $video_desc = $db->escape_value($video_desc);
            $video_tags = static::createTags($video_title, $video_desc);

            if( !(empty($video_title) && empty($video_desc) && empty($video["name"])) ){
                if( !static::similarVideoFound($video_title, $video_desc) ){
                    $video_path = static::uploadVideoFile($video, $video_title);
                    static::insertVideoToDb($video_title, $video_path, $video_tags, $video_desc);
                }
                else throw new Exception(
                    die(
                    output_err_message("A video with a similar name was found.")
                    )
                );
            }
            else throw new Exception(
                die(
                    output_err_message("All fields are required")
                )
            );

        }
        catch(Exception $exception){
            die(
                $exception->getMessage()
            );
        }

    }//End of method: uploadVideoDetailsToSingaar()

    private static function insertVideoToDb($v_name, $v_path, $v_tags, $v_desc){
        global $db, $session;
        $date_of_entry = time();
        $query = INS." videos(v_name, v_path, v_tags, v_description, uploaded_by, date_of_entry)";
        $query .= "VALUES('{$v_name}', '{$v_path}', '{$v_tags}', '{$v_desc}', '{$session->user_id}', '{$date_of_entry}')";
        $rs = $db->query($query);
        if($rs)
            die(
            output_success_message("Upload complete")
            );
    }//End of method: insertVideoToDb()

    private static function similarVideoFound($video_title, $video_desc){
        global $db, $session;
        $result = false;
        $query1 = SEL_ALL." videos WHERE(uploaded_by='{$session->user_id}' AND ";
        $query1 .= "(v_name='{$video_title}' OR v_description='{$video_desc}'))";
        $rs = $db->query($query1);

        if($rs){
            if($db->num_rows($rs) > 0)
                $result = true;
        }
        return $result;
    }//End of method: similarVideoFound()

    public static function searchForArtist($search_for=""){
        global $session, $db;
        $rs_arr = [];
        $username = Admin::getUserName($session->user_id);
        $query = SEL_ALL." users WHERE((username LIKE '%{$search_for}%' OR email LIKE '%{$search_for}%' ";
        $query .= "OR active_since LIKE '%{$search_for}%') AND NOT(username='{$username}'))";
        $rs = $db->query($query);

        if($rs && $db->num_rows($rs) > 0){
            while($row = $db->fetch_array($rs)){
                array_push($rs_arr, array(
                    "user_id"=>$row["id"],
                    "profile_image"=>Admin::getProfileImageFromDb($row["id"]),
                    "username"=>$row["username"],
                    "first_name"=>getArtistFirstName($row["username"]),
                    "email"=>$row["email"],
                    "active_since"=>$row["active_since"],
                    "musical_style"=>$row["musical_style"],
                    "binHexCode"=>$row["binHexCode"],
                    "rank"=>$row["rank"],
                    "date_of_entry"=>dateToString($row["date_of_entry"])
                ));
            }
        }
        return ($rs_arr == null ? null : $rs_arr);
    }//End of method: searchForArtist()

    public static function searchForContact($search_for=""){
        global $db;
        $rs_arr = [];
        $contact_ids = static::getContactIds();
       if( (!$contact_ids == null && count($contact_ids) > 0) ){//make sure contacts exist
           foreach($contact_ids as $key=>$value){//get all the contact_ids belonging to the currently logged-in user
               $query = $query = SEL_ALL." users WHERE((username LIKE '%{$search_for}%' OR email LIKE '%{$search_for}%' ";
               $query .= "OR active_since LIKE '%{$search_for}%' OR musical_style LIKE '%{$search_for}%') ";
               $query .= "AND (id='{$value}'))";
               $rs = $db->query($query);
               if($rs && $db->num_rows($rs) > 0){
                   $row = $db->fetch_array($rs);
                   array_push($rs_arr, array(
                       "user_id"=>$row["id"],
                       "profile_image"=>Admin::getProfileImageFromDb($row["id"]),
                       "username"=>$row["username"],
                       "first_name"=>getArtistFirstName($row["username"]),
                       "email"=>$row["email"],
                       "active_since"=>$row["active_since"],
                       "musical_style"=>$row["musical_style"],
                       "binHexCode"=>$row["binHexCode"],
                       "rank"=>$row["rank"],
                       "date_of_entry"=>dateToString($row["date_of_entry"]),
                       "isActive"=>( ($row["isActive"] == 1) ? true: false)
                   ));
               }
           }
       }
        return ($rs_arr == null ? null : $rs_arr);
    }//End of method: searchForContact()

    public static function addArtistToContacts($user_id){
        global $db, $session;
        if( !(static::isArtistAContact($user_id)) ){
            if( static::composeContactNotification($user_id) ){//compose a notification
                $query = INS." artist_contacts(user_id, contacts) VALUES('{$session->user_id}', '{$user_id}')";
                $rs = $db->query($query);
                if($rs)
                    die(
                    output_success_message("Contact added")
                    );
            }
        }
        else die(
            output_err_message("Contact already exists")
        );
    }//End of method: addArtistToContacts()

    /**
     * @param $user_id
     * @param $n_id
     * @return void
     * This version of addArtistToContacts() is used when the requested artist accepts
     * the invitation initially extended to them
     * NOTE: It sends a confirmation notification to the artist who sent the request
    */
    public static function addArtistToContacts2($user_id, $n_id){
        global $db, $session;
        if( !(static::isArtistAContact($user_id)) ){
            if( static::composeAcceptanceNotification($user_id) ){
                $query = INS." artist_contacts(user_id, contacts) VALUES('{$session->user_id}', '{$user_id}')";
                $rs = $db->query($query);
                if( ($rs && static::deleteNotification($n_id)) )
                    die(
                        output_success_message("Contact added")
                    );
            }
        }
        else die(
        output_err_message("Contact already exists")
        );
    }//End of method: addArtistToContacts()

    public static function declineContactInvitation($user_id, $n_id){
        if( static::composeDeclineContactNotification($user_id) ){
            if( static::deleteNotification($n_id) )
                die(
                    output_success_message("Contact declined")
                );
        }
    }//End of method: declineContactInvitation()

    /**
     * @param $user_id
     * @return boolean
     * @var $n_type:
     * 1 = Send contact invitation to another artist
     * 2 = Send contact invitation accepted
     * 3 = Decline the invitation from another artist
    */
    private static function composeContactNotification($user_id){
        global $db, $session;
        $n_type = 1;
        $n_from = $session->user_id;
        $date_of_entry = time();
        $query = INS." notifications_table(n_from, n_to, n_type, date_of_entry)";
        $query .= "VALUES('{$n_from}', '{$user_id}', '{$n_type}', '{$date_of_entry}')";

        return ($db->query($query) ? true : false);
    }//End of method: composeContactNotification()

    private static function composeAcceptanceNotification($user_id){
        global $db, $session;
        $n_type = 2;
        $n_from = $session->user_id;
        $date_of_entry = time();
        $query = INS." notifications_table(n_from, n_to, n_type, date_of_entry)";
        $query .= "VALUES('{$n_from}', '{$user_id}', '{$n_type}', '{$date_of_entry}')";

        return ($db->query($query) ? true : false);
    }//End of method: composeAcceptanceNotification()

    private static function composeDeclineContactNotification($user_id){
        global $db, $session;
        $n_type = 3;
        $n_from = $session->user_id;
        $date_of_entry = time();
        $query = INS." notifications_table(n_from, n_to, n_type, date_of_entry)";
        $query .= "VALUES('{$n_from}', '{$user_id}', '{$n_type}', '{$date_of_entry}')";

        return ($db->query($query) ? true : false);
    }//End of method: composeAcceptanceNotification()



    public static function deleteNotification($n_id=0){
        global $db;
        $query = "DELETE FROM notifications_table WHERE(n_id='{$n_id}')";
        return ($db->query($query) ? true : false);
    }//End of method: deleteNotification()

    public static function isArtistAContact($user_id){
        global $db, $session;
        $result = false;
        $query1 = SEL_ALL." artist_contacts WHERE(user_id='{$session->user_id}' AND contacts='{$user_id}')";
        $rs1 = $db->query($query1);
        if($rs1 && $db->num_rows($rs1) > 0){
            $result = true;
        }
        return $result;
    }//End of method: isArtistAContact()

    public static function deleteArtistFromContacts($user_id){
        global $db, $session;
        $query = "DELETE FROM artist_contacts WHERE(user_id='{$session->user_id}' AND contacts='{$user_id}')";
        $rs = $db->query($query);
        if( ($rs && static::composeDeclineContactNotification($user_id)) ){
            die(
                output_success_message("Contact removed")
            );
        }
    }//End of method: deleteArtistFromContacts()

    public static function getContacts(){
        global $db;
        $rs_arr = [];
        $contact_ids = static::getContactIds();
        if( ($contact_ids != null && count($contact_ids) > 0) ){
            foreach($contact_ids as $key=>$value){
                $query = SEL_ALL." users WHERE(id='{$value}') ORDER BY username DESC";
                $rs = $db->query($query);
                if($rs)
                    array_push($rs_arr, getArtistInfo($value));
            }
        }
        return ($rs_arr == null ? null : $rs_arr);
    }//End of method: getContacts()

    public static function addChat($msg_to, $msg){
        global $db, $session;
        $msg_from = $session->user_id;
        $msg_to = (int)$msg_to;
        $msg = $db->escape_value($msg);
        $date_of_entry = time();

        if( isset($msg_to, $msg) ){
            $query = INS." chat_messages(msg_to, msg_from, msg, date_of_entry) ";
            $query .= "VALUES('{$msg_to}', '{$msg_from}','{$msg}','{$date_of_entry}')";

            if( $db->query($query) )
                die(
                    "<audio hidden='hidden' autoplay='autoplay'>
                    <source src='../uploads/audios/definite.mp3' type='audio/mp3'/>
                    <embed src='../uploads/audios/definite.mp3' hidden='hidden'/>
                </audio>"
                );
        }
    }//End of method: addChat()

    public static function getArtistChats($you){
        global $db, $session;
        $me = $session->user_id;
        $rs_arr = [];
        $query = SEL_ALL." chat_messages WHERE((msg_from='{$me}' AND msg_to='{$you}') ";
        $query .= "OR (msg_to='{$me}' AND msg_from='{$you}')) ORDER BY msg_id ASC";
        $rs = $db->query($query);

        if($rs && $db->num_rows($rs) >0){
            while($row = $db->fetch_array($rs)){
                array_push($rs_arr, array(
                    "msg_id"=>$row["msg_id"],
                    "msg_from"=>$row["msg_from"],
                    "msg_to"=>$row["msg_to"],
                    "msg"=>deleteEscape($row["msg"]),
                    "date_of_entry"=>dateToString2($row["date_of_entry"]),
                    "isMessageFromMe"=>( ($row["msg_from"] == $session->user_id) ? true : false)
                ));
            }
        }
        return ($rs_arr == null ? null : $rs_arr);
    }//End of method: getArtistChats()

    public static function getAllContactInvitationNotifications(){
        global $db, $session;
        $rs_arr = [];
        $query = SEL_ALL." notifications_table WHERE(n_type=1 AND n_to='{$session->user_id}') ORDER BY n_id DESC";
        $rs = $db->query($query);
        if($rs && $db->num_rows($rs) > 0){
            while($row = $db->fetch_array($rs)){
                array_push($rs_arr, array(
                    "n_id"=>$row["n_id"],
                    "n_from"=>Admin::getUserName($row["n_from"]),
                    "n_from_id"=>$row["n_from"],
                    "date_of_entry"=>dateToString2($row["date_of_entry"]),
                    "profile_image"=>Admin::getProfileImageFromDb($row["n_from"])
                ));
            }
        }
        return ($rs_arr == null ? null : $rs_arr);
    }//End of method: getAllContactInvitationNotifications()

    public static function getAllContactInvitationConfirmedNotifications(){
        global $db, $session;
        $rs_arr = [];
        $query = SEL_ALL." notifications_table WHERE(n_type=2 AND n_to='{$session->user_id}') ORDER BY n_id DESC";
        $rs = $db->query($query);
        if($rs && $db->num_rows($rs) > 0){
            while($row = $db->fetch_array($rs)){
                array_push($rs_arr, array(
                    "n_id"=>$row["n_id"],
                    "n_from"=>Admin::getUserName($row["n_from"]),
                    "n_from_id"=>$row["n_from"],
                    "date_of_entry"=>dateToString2($row["date_of_entry"]),
                    "profile_image"=>Admin::getProfileImageFromDb($row["n_from"])
                ));
            }
        }
        return ($rs_arr == null ? null : $rs_arr);
    }//End of method: getAllContactInvitationNotifications()

    public static function getAllContactDeclinedNotf(){
        global $db, $session;
        $rs_arr = [];
        $query = SEL_ALL." notifications_table WHERE(n_type=3 AND n_to='{$session->user_id}') ORDER BY n_id DESC";
        $rs = $db->query($query);
        if($rs && $db->num_rows($rs) > 0){
            while($row = $db->fetch_array($rs)){
                array_push($rs_arr, array(
                    "n_id"=>$row["n_id"],
                    "n_from"=>Admin::getUserName($row["n_from"]),
                    "n_from_id"=>$row["n_from"],
                    "n_type"=>$row["n_type"],
                    "date_of_entry"=>dateToString2($row["date_of_entry"]),
                    "profile_image"=>Admin::getProfileImageFromDb($row["n_from"])
                ));
            }
        }
        return ($rs_arr == null ? null : $rs_arr);
    }//End of method: getAllContactDeclinedNotf()

    public static function unRepliedFanMail(){
        global $db, $session;
        $result = 0;
        $query = "SELECT * FROM fan_mail WHERE(mail_to='{$session->user_id}' AND no_of_replies = 0)";
        $rs = $db->query($query);
        if($rs)
            $result = $db->num_rows($rs);
        return $result;
    }//End of method: unRepliedFanMail()

    private static function getContactIds(){
        global $db, $session;
        $rs_arr = [];
        $query = "SELECT contacts FROM artist_contacts WHERE (user_id='{$session->user_id}') ORDER BY id DESC";
        $rs = $db->query($query);
        if($rs && $db->num_rows($rs) > 0){
            while($row = $db->fetch_array($rs)){
                if(!in_array($row["contacts"], $rs_arr))
                    array_push($rs_arr, $row["contacts"]);
            }
        }
        return ($rs_arr == null ? null : $rs_arr);
    }//End of method: getContactIds()

    private static function createTags($file_title="", $file_description=""){
        global $session;
        $username = Admin::getUserName($session->user_id);
        $file_tags = "";
        $file_tags .= "{$username},";
        $file_tags .= "{$file_title},";
        $file_tags .= arrayToString( explode(" ", $file_description) ).",";
        $file_tags .= arrayToString( explode(" ", $file_title) ).",";
        $file_tags .= "{$username} {$file_title}";
        return $file_tags;
    }//End of method: createTags()

}//End of class: 'Artists'