<?php

/**
 * Created by PhpStorm.
 * User: WILDcard
 * Date: 2/3/2019
 * Time: 4:03 PM
 */
require_once("initialize.php");

final class Admin
{
    private static $maxVideoSize = 100000000;//100mb: the max file size of a video allowed on this server
    private static $maxAudioSize = 20000000;//20mb: the max file size of a audio allowed on this server

    /**
     * @param $audio_file | array
     * @throws Exception
     * @return array | null
     * To be called when an artist uploads an audio file
    */
    public static function uploadSong(Array $audio_file){
        $audio_size = $audio_file["size"];
        $audio_type = $audio_file["type"];
        $rs_arr = [];

        if($audio_file["error"]==0){
            if($audio_size <= self::$maxAudioSize){//check to see if song < 20mb

                if(preg_match("/\.(mp3|m4a|mpeg|ogg)$/i", $audio_type)){//check if file type is valid
                    //move the uploaded file to the __DIR__:"../uploads/audio/"
                    $new_file_name = "audio__".time().".".getFileExtension($audio_type);
                    $perm_path = "../uploads/audios/{$new_file_name}";
                    if( move_uploaded_file($audio_file["tmp_name"], $perm_path) ){
                        //pack the file's details into an array
                        $rs_arr["audio_type"] = $audio_type;
                        $rs_arr["audio_name"] = $perm_path;
                        $rs_arr["audio_size"] = $audio_size;
                    }
                }
                else
                    throw new Exception(
                        output_err_message("Invalid audio format.Allowed formats are: mp3, m4a, mpeg, ogg")
                    );
            }
            else
                throw new Exception(
                  output_err_message("Song exceeds valid file size of 20mb")
                );
        }
        else
            throw new Exception(
                output_err_message("An error occurred while uploading song")
            );
        return ($rs_arr == null ? null : $rs_arr);
    }//End of method uploadSong()

    /**
     * @param $video_file | array
     * @throws Exception
     * @return array | null
     * To be called when an artist uploads an audio file
     */
    public static function uploadVideo(Array $video_file){
        $video_size = $video_file["size"];
        $video_type = $video_file["type"];
        $rs_arr = [];

        if($video_file["error"]==0){
            if($video_size <= self::$maxVideoSize){//check to see if song < 100mb

                if(preg_match("/\.(mp4|mkv|avi|mpeg|ogg)$/i", $video_type)){//check if file type is valid
                    //move the uploaded file to the __DIR__:"../uploads/audio/"
                    $new_file_name = "video__".time().".".getFileExtension($video_type);
                    $perm_path = "../uploads/videos/{$new_file_name}";
                    if( move_uploaded_file($video_file["tmp_name"], $perm_path) ){
                        //pack the file's details into an array
                        $rs_arr["video_type"] = $video_type;
                        $rs_arr["video_name"] = $perm_path;
                        $rs_arr["video_size"] = $video_size;
                    }
                }
                else
                    throw new Exception(
                      output_err_message("Invalid video format.Allowed formats are: mp4, mpeg, mkv, avi, ogg")
                    );
            }
            else
                throw new Exception(
                    output_err_message("Video exceeds valid file size of 100mb")
                );
        }
        else
            throw new Exception(
                output_err_message("An error occurred while uploading video")
            );
        return ($rs_arr == null ? null : $rs_arr);
    }//End of method uploadVideo()

    /**
     * @return int
     * Counts all the blog_posts in the DB table: 'blog_posts'
    */
    public static function countAllPosts(){
        global $db;
        $query = SEL_ALL." blog_posts";
        $rs = $db->query($query);
        return ($db->num_rows($rs) > 0 ? $db->num_rows($rs) : 0);
    }//End of method: countAllPosts()

    /**
     * @return int
     * Counts all the blog_comments in the DB table: 'blog_comments'
     */
    public static  function countAllComments(){
        global $db;
        $query = SEL_ALL." blog_comments";
        $rs = $db->query($query);
        return ($db->num_rows($rs) > 0 ? $db->num_rows($rs) : 0);
    }//End of method: countAllComments()

    /**
     * @return int
     * Counts all the videos in the DB table: 'videos'
     */
    public static function countAllVideos(){
        global $db;
        $query = SEL_ALL." videos";
        $rs = $db->query($query);
        return ($db->num_rows($rs) > 0 ? $db->num_rows($rs) : 0);
    }//End of method: countAllVideos()

    /**
     * @return int
     * Counts all the audios in the DB table: 'audios'
     */
    public static function countAllAudios(){
        global $db;
        $query = SEL_ALL." audios";
        $rs = $db->query($query);
        return ($db->num_rows($rs) > 0 ? $db->num_rows($rs) : 0);
    }//End of method: countAllAudios()

    public static function countAllArtists(){
        global $db;
        $query = SEL_ALL." users WHERE(role=1) ORDER BY id DESC";
        $rs = $db->query($query);
        return ($db->num_rows($rs) > 0 ? $db->num_rows($rs) : 0);
    }//End of method: countAllArtists()

    public static function deleteVideo($video_id=0){
        global $db;
        $query = "SELECT v_path FROM videos WHERE v_id='{$video_id}' ORDER BY v_id DESC LIMIT 1";
        $rs = $db->query($query);
        if($rs && $db->num_rows($rs) > 0) {
            $row = $db->fetch_array($rs);
            $path = $row["v_path"];

            $query = "DELETE FROM videos WHERE v_id='{$video_id}'";
            $query2 = "DELETE FROM v_comments WHERE v_id='{$video_id}'";
            $query3 = "DELETE FROM v_ratings WHERE v_id='{$video_id}'";
            if($db->query($query) && $db->query($query2) && $db->query($query3)){
                @unlink($path);//delete the audio file from the local __DIR__
                die(
                output_success_message("Video has been deleted")
                );
            }
        }
    }//End of method: deleteVideo()

    public static function deleteAudio($audio_id=0){
        global $db;
        $query = "SELECT a_path FROM audios WHERE a_id='{$audio_id}' ORDER BY a_id DESC LIMIT 1";
        $rs = $db->query($query);
        if($rs && $db->num_rows($rs) > 0){
            $row = $db->fetch_array($rs);
            $path = $row["a_path"];

            $query = "DELETE FROM audios WHERE a_id='{$audio_id}'";
            $query2 = "DELETE FROM a_comments WHERE a_id='{$audio_id}'";
            $query3 = "DELETE FROM a_ratings WHERE a_id='{$audio_id}'";
            if($db->query($query) && $db->query($query2) && $db->query($query3)){
                @unlink($path);//delete the audio file from the local __DIR__
                die(
                output_success_message("Audio file deleted")
                );
            }
        }
    }//End of method: deleteAudio()

    public static function getProfileImageFromDb($user_id=0){
        global $db;
        $inner_query = "SELECT img_sm_path FROM profile_images WHERE(user_id='{$user_id}')";
        $inner_query .= " ORDER BY img_id DESC LIMIT 1";
        $inner_rs = $db->query($inner_query);
        $row = $db->fetch_array($inner_rs);
        $profile_img = $row["img_sm_path"];
        return (empty($profile_img) ? "../images/user_male.png" : $profile_img);
    }//End of method: getProfileImageFromDb()

    public static function getUserName($user_id=0){
        global $db;
        $query = "SELECT username FROM users WHERE id='{$user_id}' ORDER BY id DESC LIMIT 1";
        $rs = $db->query($query);
        $row = $db->fetch_array($rs);
        return $row["username"];
    }//End of method: getUserName()

    /**
     * @param $get_all
     * @param $st_limit
     * @param $end_limit
     * @return null | array
    */
    public static function getAllVideos($get_all=false, $st_limit=0, $end_limit=10){
        global $db;
        $rs_arr = [];
        $query = ($get_all ? SEL_ALL." videos ORDER BY v_id DESC LIMIT {$st_limit}, {$end_limit}"
            : SEL_ALL." videos ORDER BY v_id DESC LIMIT 6");
        $rs = $db->query($query);
        if($rs && $db->num_rows($rs) > 0){
            while($row = $db->fetch_array($rs)){
                $profile_img = static::getProfileImageFromDb($row['uploaded_by']);
                $artist_name = static::getUserName($row["uploaded_by"]);

                array_push($rs_arr, array(
                    "v_id"=>$row["v_id"],
                    "v_name"=>$row["v_name"],
                    "v_path"=>$row["v_path"],
                    "v_description"=>$row["v_description"],
                    "v_tags"=>explode(",", $row["v_tags"]),
                    "uploaded_by"=>$artist_name,
                    "no_of_views"=>$row["no_of_views"],
                    "no_of_comments"=>$row["no_of_comments"],
                    "profile_image"=>$profile_img,
                    "date_of_entry"=>dateToString($row["date_of_entry"])
                ));
            }
        }
        return ($rs_arr == null ? null : $rs_arr);
    }//End of method: getAllVideos()

    /**
     * @param $get_all
     * @param $st_limit
     * @param $end_limit
     * @return null | array
     */
    public static function getAllAudios($get_all=false, $st_limit=0, $end_limit=10){
        global $db;
        $rs_arr = [];
        $query = ($get_all ? SEL_ALL." audios ORDER BY a_id DESC LIMIT {$st_limit}, {$end_limit}"
            : SEL_ALL." audios ORDER BY a_id DESC LIMIT 5");
        $rs = $db->query($query);
        if($rs && $db->num_rows($rs) > 0){
            while($row = $db->fetch_array($rs)){
                $profile_img = static::getProfileImageFromDb($row['uploaded_by']);
                $artist_name = static::getUserName($row["uploaded_by"]);

                array_push($rs_arr, array(
                    "a_id"=>$row["a_id"],
                    "a_name"=>$row["a_name"],
                    "a_path"=>$row["a_path"],
                    "a_description"=>$row["a_description"],
                    "a_tags"=>explode(",", $row["a_tags"]),
                    "uploaded_by"=>$artist_name,
                    "profile_image"=>$profile_img,
                    "no_of_views"=>$row["no_of_views"],
                    "no_of_comments"=>$row["no_of_comments"],
                    "date_of_entry"=>dateToString($row["date_of_entry"])
                ));
            }
        }
        return ($rs_arr == null ? null : $rs_arr);
    }//End of method: getAllVideos()

    public static function getAllInterviews($get_all=false){
        global $db;
        $rs_arr = [];
        $query = ($get_all ? SEL_ALL." interviews WHERE(isApproved=0) ORDER BY id DESC" :
            SEL_ALL." interviews WHERE(isApproved=0) ORDER BY id DESC LIMIT 5");
        $rs = $db->query($query);
        if($rs && $db->num_rows($rs) > 0){
            while($row = $db->fetch_array($rs)){
                $artist_name = static::getUserName($row["artist_id"]);
                $uploaded_by = static::getUserName($row["uploaded_by"]);
                $profile_image = static::getProfileImageFromDb($row["artist_id"]);
                array_push($rs_arr, array(
                    "id"=>$row["id"],
                    "month_of"=>$row["month_of"],
                    "year"=>$row["year"],
                    "video_link"=>$row["video_link"],
                    "artist_name"=>$artist_name,
                    "profile_image"=>$profile_image,
                    "uploaded_by"=>$uploaded_by,
                    "video_text"=>$row["video_text"]
                ));
            }
        }
        return ($rs_arr == null ? null : $rs_arr);
    }


    public static function getAllBlogPosts($st_limit=0, $end_limit=10){
        global $db;
        $rs_arr = [];
        $query = "SELECT *, blog_categories.category FROM blog_posts ";
        $query .= "INNER JOIN blog_categories USING(category_id) ";
        $query .= "ORDER BY blog_posts.post_id DESC LIMIT {$st_limit}, {$end_limit}";
        $rs = $db->query($query);

        if($db->num_rows($rs) > 0){
            while($row = $db->fetch_array($rs)){
                array_push($rs_arr, array(
                    "post_id"=>$row["post_id"],
                    "post_title"=>$row["post_title"],
                    "post_body"=>$row["post_body"],
                    "post_imgLg"=>$row["post_imgLg"],
                    "post_imgSm"=>$row["post_imgSm"],
                    "no_of_comments"=>$row["no_of_comments"],
                    "category"=>$row["category"],
                    "date_of_entry"=>dateToString($row["date_of_entry"])
                ));
            }
        }
        return ($rs_arr == null) ? null : $rs_arr;

    }//End of method: getAllBlogPosts()


    public static function getAllArtists($st_limit=0, $end_limit=10){
        global $db;
        $rs_arr = [];
        $query = "SELECT *, profile_images.img_sm_path FROM users INNER JOIN profile_images ";
        $query .= "ON users.id=profile_images.user_id WHERE(role=1) ";
        $query .= "ORDER BY users.id DESC LIMIT {$st_limit}, {$end_limit}";
        $rs = $db->query($query);
        if($rs && $db->num_rows($rs) > 0){
            while($row = $db->fetch_array($rs)){
                array_push($rs_arr, array(
                    "id"=>$row["id"],
                    "profile_image"=>$row["img_sm_path"],
                    "username"=>$row["username"],
                    "email"=>$row["email"],
                    "active_since"=>$row["active_since"],
                    "musical_style"=>$row["musical_style"],
                    "isBlocked"=>$row["isBlocked"],
                    "rank"=>$row["rank"],
                    "binHexCode"=>$row["binHexCode"],
                    "date_of_entry"=>dateToString($row["date_of_entry"])
                ));
            }
        }
        return ($rs_arr == null) ? null : $rs_arr;
    }//End of method getAllArtists()

    public static function getSearchedArtists($searched_item=""){
        global $db;
        $rs_arr = [];
        $query = SEL_ALL." users WHERE(role=1 AND(username LIKE '%{$searched_item}%' ";
        $query .= "OR email LIKE '%{$searched_item}%' OR musical_style LIKE '%{$searched_item}%')) ";
        $query .= "ORDER BY id DESC";
        $rs = $db->query($query);
        if($rs && $db->num_rows($rs) > 0){
            while($row = $db->fetch_array($rs)){
                $query2 = "SELECT img_sm_path FROM profile_images WHERE(user_id='{$row["id"]}')";
                $rs2 = $db->query($query2);
                $img = $db->fetch_array($rs2)["img_sm_path"];
                array_push($rs_arr, array(
                    "id"=>$row["id"],
                    "profile_image"=>$img,
                    "username"=>$row["username"],
                    "email"=>$row["email"],
                    "active_since"=>$row["active_since"],
                    "musical_style"=>$row["musical_style"],
                    "isBlocked"=>$row["isBlocked"],
                    "rank"=>$row["rank"],
                    "binHexCode"=>$row["binHexCode"],
                    "date_of_entry"=>dateToString($row["date_of_entry"])
                ));
            }
        }
        return ($rs_arr == null) ? null : $rs_arr;
    }//End of method getAllArtists()


    public static function blockUser($user_id=0){
        global $db;
        $query ="UPDATE users SET isBlocked=0 WHERE(id='{$user_id}')";
        $rs = $db->query($query);
        if($rs)
            die(
            output_success_message("User has been blocked")
            );
    }//End of method: blockUser()

    public static function unblockUser($user_id=0){
        global $db;
        $query ="UPDATE users SET isBlocked=1 WHERE(id='{$user_id}')";
        $rs = $db->query($query);
        if($rs)
            die(
            output_success_message("User has been unblocked")
            );
    }//End of method: unblockUser()

    /**
     * @param $user_id | int
     * @param $message_title | String
     * @param $message | String
     * @throws Exception
     * @return void
     * This method sends a message from the 'singaar' team to a selected artist
    */
    public static function messageArtists($user_id=0, $message_title="",$message=""){
        global $db;
        if( !(empty($message_title) && empty($message) && ($user_id > 0 && is_int($user_id)) ) ){
            $message_title = $db->escape_value($message_title);
            $message = $db->escape_value($message);
            $user_id = $db->escape_value($user_id);
            $date_of_entry = time();
            //run sql query here
            $query = INS." message_to_artists(msg_title, msg_to, msg, date_of_entry)";
            $query .= "VALUES('{$message_title}', '{$user_id}', '{$message}', '{$date_of_entry}')";
            $rs = $db->query($query);
            if($rs)
                die(
                    output_success_message("Message sent")
                );
        }
        else throw new Exception(
            output_err_message("Invalid arguments...check out the method documentation")
        );
    }//End of method: messageArtist()

    public static function getAllComplaints($get_all=false, $st_limit=0, $end_limit=10){
        global $db;
        $rs_arr = [];
        $query = SEL_ALL." customer_care WHERE(no_of_replies < 1) ORDER BY msg_id DESC";
        $query .= ($get_all) ? " LIMIT {$st_limit}, {$end_limit}" : " LIMIT 5";
        $rs = $db->query($query);
        if($rs && $db->num_rows($rs) > 0){
            while($row = $db->fetch_array($rs)){
                array_push($rs_arr, array(
                    "msg_id"=>$row["msg_id"],
                    "msg_from"=>static::getUserName($row["msg_from"]),
                    "profile_image"=>static::getProfileImageFromDb($row["msg_from"]),
                    "msg_title"=>$row["msg_title"],
                    "msg"=>$row["msg"],
                    "no_of_replies"=>$row["no_of_replies"],
                    "date_of_entry"=>dateToString($row["date_of_entry"])
                ));
            }
        }
        return ($rs_arr == null) ? null : $rs_arr;
    }//End of method: getAllComplaints()

    public static function getACompliant($complaint_id=0){
        global $db;
        $rs_arr = [];
        $query = SEL_ALL." customer_care WHERE(msg_id='{$complaint_id}') ORDER BY msg_id DESC LIMIT 1";
        $rs = $db->query($query);
        if($rs){
            $row = $db->fetch_array($rs);
            array_push($rs_arr, array(
                "msg_id"=>$row["msg_id"],
                "msg_title"=>$row["msg_title"],
                "msg"=>$row["msg"],
                "msg_from_id"=>$row["msg_from"],
                "msg_from"=>static::getUserName($row["msg_from"]),
                "no_of_replies"=>$row["no_of_replies"],
                "date_of_entry"=>dateToString($row["date_of_entry"])
            ));
        }
        return ($rs_arr == null) ? null : $rs_arr;
    }


    public static function reply_c_c_messages($msg_id=0, $msg=""){
        global $db;
        $msg = $db->escape_value($msg);
        $date_of_entry = time();
        $no_of_replies = get_no_of_replies("customer_care", "msg_id", $msg_id) + 1;
        $query = INS." c_c_replies(reply_to, reply, date_of_entry)";
        $query .= "VALUES('{$msg_id}', '{$msg}', '{$date_of_entry}')";

        $query2 = "UPDATE customer_care SET no_of_replies='{$no_of_replies}' WHERE(msg_id='{$msg_id}')";

        if($db->query($query) && $db->query($query2))
            die(
                output_success_message("Reply sent")
            );
    }//End of method: reply_c_c_messages()

    /**
     * @param $audio_id
     * This method adds a video to the official youtube channel of the site & deletes it from it's current __DIR__ location
     */
    public static function addAudioToYouTubeChannel($audio_id){

    }//End of method: addAudioToYouTubeChannel()

    /**
     * @param $video_id
     * This method adds a video to the official youtube channel of the site & deletes it from it's current __DIR__ location
     */
    public static function addVideoToYouTubeChannel($video_id){

    }//End of method: addVideoToYouTubeChannel()


}//End of class: Admin